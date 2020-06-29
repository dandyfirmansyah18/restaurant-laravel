<?php

$input = json_decode(file_get_contents('php://input'),true);
$listfile = $input["listfile"];
$filename = $input["namefile"];

$archive_file_name = $filename;
// $archive_file_name = 'cok.zip';
$dir_file = '/var/www/laravel/storage/app/TempZIP/'.$archive_file_name;

// header("Content-type: application/zip"); 
// header("Content-Disposition: attachment; filename=$archive_file_name");
// header("Content-length: " . filesize($archive_file_name));
// header("Pragma: no-cache"); 
// header("Expires: 0"); 
// readfile("$archive_file_name");

// die();


// The version number (9_5_0) should match version of the Chilkat extension used, omitting the micro-version number.
// For example, if using Chilkat v9.5.0.48, then include as shown here:
include("chilkat/chilkat_9_5_0.php");

$zip = new CkZip();

//  Any string unlocks the component for the 1st 30-days.
$success = $zip->UnlockComponent('Anything for 30-day trial');
if ($success != true) {
    echo $zip->lastErrorText() . "\n";
    exit;
}

$success = $zip->NewZip($dir_file);
if ($success != true) {
    echo $zip->lastErrorText() . "\n";
    exit;
}

// $listfile = array('robots.txt','robots2.txt');

$zip->SetPassword('secret');
$zip->put_PasswordProtect(true);

$saveExtraPath = false;
$success = null;

foreach ($listfile as $filepath) {
	$success = $zip->AppendOneFileOrDir($filepath,$saveExtraPath);
	// $success = $zip->AppendOneFileOrDir('/var/www/laravel/storage/app/Report/dec/'.$filepath,$saveExtraPath);
}

$success = $zip->WriteZipAndClose();
if ($success != true) {
    echo $zip->lastErrorText() . "\n";
    exit;
}

echo $archive_file_name;

?>