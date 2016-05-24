<?php

$zipFile = "/lib/testZip.zip";
$zipArchive = new \ZipArchive();

if (!$zipArchive->open($zipFile, \ZIPARCHIVE::OVERWRITE))
    die("Failed to create archive\n");

$zipArchive->addGlob("/www/vendor/NBAData");
if (!$zipArchive->status == \ZIPARCHIVE::ER_OK)
    echo "Failed to write files to zip\n";

$zipArchive->close();
