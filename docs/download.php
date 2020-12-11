<?php

$zip = new ZipArchive;
if ($zip->open('source-edm.zip', ZipArchive::CREATE) === TRUE)
{

    // Add folder source - edm
    if ($handle = opendir('source'))
    {
        // Add all files inside the directory
        while (false !== ($entry = readdir($handle)))
        {
            if ($entry != "." && $entry != ".." && !is_dir('source/' . $entry))
            {
                $zip->addFile('source/' . $entry);
            }
        }
        closedir($handle);
    }
    // Add folder image
    if ($handle = opendir('source/image/'))
    {
        while (false !== ($entry = readdir($handle)))
        {
            if ($entry != "." && $entry != "..")
            {
                $zip->addFile('source/image/' . $entry);
            }
        }
        closedir($handle);
    }
    
    $zip_name=$name.'source-edm.zip';
    $zip->close();
}

//Download the created zip file
header("Content-type: application/zip");
header("Content-Disposition: attachment; filename = $zip_name");
header("Pragma: no-cache");
header("Expires: 0");
readfile("$zip_name");
exit;
