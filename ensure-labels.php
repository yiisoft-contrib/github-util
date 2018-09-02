<?php
require_once __DIR__ . '/vendor/autoload.php';

if (empty($argv[1])) {
    echo "Usage: php ensure-labels.php <your_github token>";
}
$token = $argv[1];

$labelsConfig = require 'config/labels.php';
$labelsRenameConfig = require 'config/labels-rename.php';
$packages = require 'config/packages.php';

$client = new \Github\Client();
$client->authenticate($token, null, Github\Client::AUTH_HTTP_TOKEN);

foreach ($packages as $package) {
    echo "Processing $package.\n";
    $repoLabels = new \yiisoft\RepoLabels($client, 'yiisoft', $package);
    $repoLabels->rename($labelsRenameConfig);
    $repoLabels->ensure($labelsConfig, ['common', 'pr', 'status', 'type', 'severity'], true);
}
