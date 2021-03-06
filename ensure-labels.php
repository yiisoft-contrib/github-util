<?php
require_once __DIR__ . '/vendor/autoload.php';

if (empty($argv[1]) || empty($argv[2])) {
    echo 'Usage: php ensure-labels.php <repository> <your_github token>';
    exit(0);
}

$package = $argv[1];
$token = $argv[2];

$labelsConfig = require 'config/labels.php';
$labelsRenameConfig = require 'config/labels-rename.php';

$client = new \Github\Client();
$client->authenticate($token, null, Github\Client::AUTH_HTTP_TOKEN);

ensureLabels($client, $package, $labelsConfig, $labelsRenameConfig);

function ensureLabels(\Github\Client $client, string $package, array $labelsConfig, array $labelsRenameConfig)
{
    echo "Processing $package.\n";

    [$vendor, $packageName] = explode('/', $package);

    $repoLabels = new \yiisoft\RepoLabels($client, $vendor, $packageName);

    echo '[Renaming Labels] ';
    try {
        [$skipped, $renamed] = $repoLabels->rename($labelsRenameConfig);
    } catch (\Github\Exception\RuntimeException $e) {
        echo '[' . $e->getCode() . '] ' . $e->getMessage() . ":\n" . $e->getTraceAsString() . "\n";
        exit(1);
    }

    if ($skipped !== []) {
        echo 'Skipped: ' . implode(', ', $skipped) . ' ';
    }
    if ($renamed !== []) {
        echo 'Renamed: ' . implode(', ', $renamed) . ' ';
    }
    echo "\n";

    echo '[Ensuring Labels] ';

    try {
        [$added, $updated, $deleted] = $repoLabels->ensure($labelsConfig, ['common', 'pr', 'status', 'type', 'severity'], false);
    } catch (\Github\Exception\RuntimeException $e) {
        echo '[' . $e->getCode() . '] ' . $e->getMessage() . ":\n" . $e->getTraceAsString() . "\n";
        exit(1);
    }

    if ($added !== []) {
        echo 'Added: ' . implode(', ', $added) . ' ';
    }

    if ($updated !== []) {
        echo 'Updated: ' . implode(', ', $updated) . ' ';
    }

    if ($deleted !== []) {
        echo 'Deleted: ' . implode(', ', $deleted) . ' ';
    }

    echo "\n";
}
