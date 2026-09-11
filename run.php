<?php
$folder = $argv[1] ?? null;

if ($folder === "git") {
    $commitMsg = date('Y-m-d H:i:s');

    if (isset($argv[2])) {
        // Escapes shell argument to prevent injection
        $remoteUrl = escapeshellarg($argv[2]);

        system("git init && git add . && git commit -m \"{$commitMsg}\" && git remote add origin {$remoteUrl} && git push -u origin master");
    } else {
        system("git init && git add . && git commit -m \"{$commitMsg}\" && git push");
    }
} else {
    // Determine public root folder
    $targetFolder = empty($folder) ? "public" : escapeshellcmd($folder);

    system("php -S localhost:8000 -t " . $targetFolder);
}
