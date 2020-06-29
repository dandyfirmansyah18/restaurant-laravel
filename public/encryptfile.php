<?php
// The version number (9_5_0) should match version of the Chilkat extension used, omitting the micro-version number.
// For example, if using Chilkat v9.5.0.48, then include as shown here:
include("chilkat/chilkat_9_5_0.php");

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

$type = $input["type"];
$path_file = $input["path_file"];

if($type=='encrypt'){
	echo Encrypted($path_file);
}else if($type=='decrypt'){
	$filename = $input["filename"];
	echo Dencrypted($path_file, $filename);
}

//  This requires the Chilkat API to have been previously unlocked.
//  See Global Unlock Sample for sample code.
function Encrypted($param)
{
	$crypt = new CkCrypt2();

	$success = $crypt->UnlockComponent('HADIMACrypt_geHYyXETXR9X');
	if (!$success) {
	    print $crypt->lastErrorText() . "\n";
	    exit;
	}

	$crypt->put_CryptAlgorithm('aes');
	$crypt->put_CipherMode('cbc');
	$crypt->put_KeyLength(128);
	$crypt->put_PaddingScheme(0);

	$ivHex = '581b524c8088737dd0b6f733fb222bfc0e974c14';
	$crypt->SetEncodedIV($ivHex,'hex');

	$keyHex = '7548c52670da8c237f3adab9baacb156';
	$crypt->SetEncodedKey($keyHex,'hex');

	$direnc = "/var/www/laravel/storage/app/Report/enc/";
	$dirdec = "/var/www/laravel/storage/app/Report/dec/";

	if (!is_dir($direnc)) {
	    mkdir($direnc, 0777, true);         
	}

	if (!is_dir($dirdec)) {
	    mkdir($dirdec, 0777, true);         
	}

	$dataFile = $param;
	$outFile = $direnc.date("Ymdhis").'.ENC';
	// $outFile2 = $dirdec.'Test_'.date("Ymdhis").'.pdf';

	$success = $crypt->CkEncryptFile($dataFile,$outFile);
	if($success){
		return 'success#'.$outFile;
	}else{
		return 'error#'.$crypt->lastErrorText();
	}
	// $success = $crypt->CkDecryptFile($outFile,$outFile2);

	// $fac = new CkFileAccess();
	// $bEqual = $fac->FileContentsEqual($dataFile,$outFile2);
	// if ($bEqual != true) {
	//     return 'Decrypted file not equal to the original.';
	// }
	// else {
	//     return 'Success.';
	// }
}

function Dencrypted($param, $filename)
{
	$crypt = new CkCrypt2();

	$success = $crypt->UnlockComponent('HADIMACrypt_geHYyXETXR9X');
	if (!$success) {
	    print $crypt->lastErrorText() . "\n";
	    exit;
	}

	$crypt->put_CryptAlgorithm('aes');
	$crypt->put_CipherMode('cbc');
	$crypt->put_KeyLength(128);
	$crypt->put_PaddingScheme(0);

	$ivHex = '581b524c8088737dd0b6f733fb222bfc0e974c14';
	$crypt->SetEncodedIV($ivHex,'hex');

	$keyHex = '7548c52670da8c237f3adab9baacb156';
	$crypt->SetEncodedKey($keyHex,'hex');

	$direnc = "/var/www/laravel/storage/app/Report/enc/";
	$dirdec = "/var/www/laravel/storage/app/Report/dec/";

	if (!is_dir($direnc)) {
	    mkdir($direnc, 0777, true);         
	}

	if (!is_dir($dirdec)) {
	    mkdir($dirdec, 0777, true);         
	}

	$dataFile = $param;
	// $outFile = $direnc.date("Ymdhis").'.ENC';
	$outFile2 = $dirdec.$filename;

	$success = $crypt->CkDecryptFile($dataFile,$outFile2);
	if($success){
		return 'success#'.$outFile2;
	}else{
		return 'error#'.$crypt->lastErrorText();
	}

	// $fac = new CkFileAccess();
	// $bEqual = $fac->FileContentsEqual($dataFile,$outFile2);
	// if ($bEqual != true) {
	//     return 'Decrypted file not equal to the original.';
	// }
	// else {
	//     return 'Success.';
	// }
}
?>