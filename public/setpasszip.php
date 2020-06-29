<?php

header('Content-Description: File Transfer');
header('Content-Type: application/force-download');
header("Content-Disposition: attachment; filename=zip/test1234.zip;");
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize("zip/test1234.zip"));
ob_clean();
flush();
readfile("zip/test1234.zip"); //showing the path to the server where the file is to be download
exit;

include("chilkat/chilkat_9_5_0.php");

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

$zip = new CkZip();

$success = $zip->UnlockComponent('Anything for 30-day trial');
if (!$success) {
    print $zip->lastErrorText() . "\n";
    exit;
}

$success = $zip->NewZip('zip/test1234.zip');
// die("test");
if ($success != true) {
    print $zip->lastErrorText() . "\n";
    exit;
}

$zip->SetPassword('secret');
$zip->put_PasswordProtect(true);

$saveExtraPath = false;
$success = $zip->AppendOneFileOrDir('robots.txt',$saveExtraPath);

$success = $zip->WriteZipAndClose();
if ($success != true) {
    print $zip->lastErrorText() . "\n";
    exit;
}

