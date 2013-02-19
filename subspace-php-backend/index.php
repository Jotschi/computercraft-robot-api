<?php

$id = $_GET['id'];
$cmd = $_GET['cmd'];

//echo "CMD:$cmd";
//echo "ID:$id";

$dir = "/var/www/cc/messages/";
mkdir($dir, 0777, true);
$file = "message.$id";

if ($cmd == "fetch") {
  $start = time();
  for ($i = 1; $i <= 20; $i++) {
    $isExisting = file_exists($dir . $file);
    if ($isExisting) {
        $content = file_get_contents($dir . $file);
	echo $content;
	unlink($dir . $file);    
        exit(0);
    }
    $time = time()- $start;
   // echo "i: $i =  $time  ";
    if($time >= 3) {
      echo "NA";
      exit(1);
    }
   sleep(1.2);
  }

} else if ($cmd=="send") {
  $postdata = file_get_contents("php://input");
  file_put_contents($dir . $file, $postdata);
  //echo "Saved data";
}

