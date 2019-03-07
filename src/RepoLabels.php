<?php


namespace yiisoft;


use Github\Client;

class RepoLabels
{
    private $username;
    private $repository;
    private $labelsApi;

    /**
     * RepoLabels constructor.
     * @param $client
     */
    public function __construct(Client $client, $username, $repository)
    {
        $this->client = $client;
        $this->username = $username;
        $this->repository = $repository;

        $labelsApi = new Labels($client);
        $labelsApi->setPerPage(1000);
        $this->labelsApi = $labelsApi;
    }

    public function rename(array $config): array
    {
        $skipped = [];
        $renamed = [];

        foreach ($config as $oldName => $newName) {
            try {
                $existingLabelData = $this->labelsApi->show($this->username, $this->repository, $oldName);
            } catch (\Github\Exception\RuntimeException $e) {
                if ($e->getMessage() !== 'Not Found') {
                    throw $e;
                }

                // skip non-existing labels
                $skipped[] = $oldName;
                continue;
            }

            $this->labelsApi->update($this->username, $this->repository, $oldName, [
                'name' => $newName,
                'color' => $existingLabelData['color'],
            ]);
            $renamed[] = $oldName . ' -> ' . $newName;
        }

        return [$skipped, $renamed];
    }

    public function ensure($config, array $labelsGroups, $deleteUnlisted = false): array
    {
        $currentLabelsData = $this->labelsApi->all($this->username, $this->repository);

        $currentLabels = [];
        foreach ($currentLabelsData as $currentLabelsDatum) {
            $currentLabels[$currentLabelsDatum['name']] = [
                'color' => $currentLabelsDatum['color'],
                'description' => $currentLabelsDatum['description'] ?? '',
            ];
        }

        $labelsToEnsure = [];
        foreach ($labelsGroups as $labelsGroup) {
            if (!isset($config[$labelsGroup])) {
                throw new \RuntimeException("Missing $labelsGroup group in labels config.");
            }
            foreach ($config[$labelsGroup] as $labelToEnsure) {
                $labelsToEnsure[$labelToEnsure['name']] = [
                    'color' => $labelToEnsure['color'],
                    'description' => $labelToEnsure['description'] ?? '',
                ];
            }
        }
        
        $missingLabels = array_diff_key($labelsToEnsure, $currentLabels);
        $existingLabels = array_intersect_key($labelsToEnsure, $currentLabels);
        $labelsToDelete = array_diff_key($currentLabels, $labelsToEnsure);

        $deleted = [];
        if ($deleteUnlisted) {
            $deleted = $this->deleteLabels($labelsToDelete);
        }

        $added = $this->addLabels($missingLabels);
        $updated = $this->updateLabelsIfNeeded($existingLabels, $currentLabels);

        return [$added, $updated, $deleted];
    }

    /**
     * @param array $missingLabels
     * @throws \Github\Exception\MissingArgumentException
     */
    private function addLabels(array $missingLabels): array
    {
        $added = [];
        foreach ($missingLabels as $name => $data) {
            $this->labelsApi->create($this->username, $this->repository, [
                'name' => $name,
                'color' => $data['color'],
                'description' => $data['description'],
            ]);
            $added[] = $name;
        }
        return $added;
    }

    /**
     * @param array $existingLabels
     * @param array $currentLabels
     * @throws \Github\Exception\MissingArgumentException
     */
    private function updateLabelsIfNeeded(array $existingLabels, array $currentLabels): array
    {
        $updated = [];

        foreach ($existingLabels as $name => $data) {
            $needUpdate = $currentLabels[$name]['color'] !== $data['color'] || $currentLabels[$name]['description'] !== $data['description'];

            if (!$needUpdate) {
                continue;
            }

            $this->labelsApi->update($this->username, $this->repository, $name, [
                'name' => $name,
                'color' => $data['color'],
                'description' => $data['description'],
            ]);

            $updated[] = $name;
        }
        return $updated;
    }

    /**
     * @param array $labelsToDelete
     */
    private function deleteLabels(array $labelsToDelete): array
    {
        $deleted = [];
        foreach ($labelsToDelete as $name => $data) {
            $this->labelsApi->remove($this->username, $this->repository, $name);
            $deleted[] = $name;
        }
        return $deleted;
    }
}
