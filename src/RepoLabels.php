<?php


namespace yiisoft;


use Github\Client;

class RepoLabels
{
    private $client;
    private $username;
    private $repository;

    /**
     * RepoLabels constructor.
     * @param $client
     */
    public function __construct(Client $client, $username, $repository)
    {
        $this->client = $client;
        $this->username = $username;
        $this->repository = $repository;
    }

    public function rename(array $config)
    {
        $repoApi = new \Github\Api\Repo($this->client);
        $labelsApi = $repoApi->labels();

        foreach ($config as $oldName => $newName) {
            try {
                $existingLabelData = $labelsApi->show($this->username, $this->repository, $oldName);
            } catch (\Github\Exception\RuntimeException $e) {
                // skip non-existing labels
                if ($e->getMessage() !== 'Not Found') {
                    throw $e;
                }
                continue;
            }

            $labelsApi->update($this->username, $this->repository, $oldName, [
                'name' => $newName,
                'color' => $existingLabelData['color'],
            ]);
        }
    }

    public function ensure($config, array $labelsGroups, $deleteUnlisted = false)
    {
        $repoApi = new \Github\Api\Repo($this->client);
        $labelsApi = $repoApi->labels();
        $labelsApi->setPerPage(1000);
        $currentLabelsData = $labelsApi->all($this->username, $this->repository);

        $currentLabels = [];
        foreach ($currentLabelsData as $currentLabelsDatum) {
            $currentLabels[$currentLabelsDatum['name']] = $currentLabelsDatum['color'];
        }

        $labelsToEnsure = [];
        foreach ($labelsGroups as $labelsGroup) {
            if (!isset($config[$labelsGroup])) {
                throw new \RuntimeException("Missing $labelsGroup group in labels config.");
            }
            foreach ($config[$labelsGroup] as $labelToEnsure) {
                $labelsToEnsure[$labelToEnsure['name']] = $labelToEnsure['color'];
            }
        }
        
        $missingLabels = array_diff_key($labelsToEnsure, $currentLabels);
        $existingLabels = array_intersect_key($labelsToEnsure, $currentLabels);
        $labelsToDelete = array_diff_key($currentLabels, $labelsToEnsure);

        // delete unlisted labels
        if ($deleteUnlisted) {
            foreach ($labelsToDelete as $name => $color) {
                $labelsApi->remove($this->username, $this->repository, $name);
            }
        }

        // add missing labels
        foreach ($missingLabels as $name => $color) {
            $labelsApi->create($this->username, $this->repository, [
                'name' => $name,
                'color' => $color,
            ]);
        }

        // update existing label colors if needed
        foreach ($existingLabels as $name => $color) {
            if ($currentLabels[$name] !== $color) {
                $labelsApi->update($this->username, $this->repository, $name, [
                    'name' => $name,
                    'color' => $color,
                ]);
            }
        }
    }
}
