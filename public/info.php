<?php  
// $dir = str_replace('/public', "", __DIR__). DIRECTORY_SEPARATOR . "storage/app/Report";
// rrmdir($dir);

// function rrmdir($dir) {
//   if (is_dir($dir)) {
//     $objects = scandir($dir);
//     foreach ($objects as $object) {
//       if ($object != "." && $object != "..") {
//         if (filetype($dir."/".$object) == "dir") 
//            rrmdir($dir."/".$object); 
//         else unlink   ($dir."/".$object);
//       }
//     }
//     reset($objects);
//     rmdir($dir);
//   }
//  }

//  test password zip

// $zip = new ZipArchive();
// $testfile = str_replace('/public', "", __DIR__). DIRECTORY_SEPARATOR . "storage/app/TempZIP/20180322162533.zip";
// $zip_status = $zip->open('test.zip');

// if ($zip_status === true)
// {
//     $setpassword = $zip->setPassword("MySecretPassword");
//      if ($setpassword) {
//     	$zip->close();
//      	echo 'set password success';
//      }else{
//      	echo 'set password gagal';
//      }


// }
// else
// {
//     die("Failed opening archive: ". @$zip->getStatusString() . " (code: ". $zip_status .")");
// }

// exec ("find /var/www/laravel/storage/app/Report -type d -exec chmod 0777 {} +");
exec ("find /var/www/laravel/storage/app/Report -type f -exec chmod 0777 {} +");

?>