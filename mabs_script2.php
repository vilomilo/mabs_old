<?php
//
// maBS PHP Script
//

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");


$update = false;

$handle = fopen("info.dat", "r");
$name1 = fgets($handle, 4096);
$name2 = fgets($handle, 4096);
$uid = fgets($handle, 4096);
$rdstitle = fgets($handle, 4096);
$mediatype = fgets($handle, 4096);



fclose($handle);

if (isset($_POST['name1'])) {
	$name1 = $_POST['name1'];
	$update = true;
}

if (isset($_POST['name2'])) {
	$name2 = $_POST['name2'];
	$update = true;
}

if (isset($_POST['uid'])) {
	$uid = $_POST['uid'];
	$update = true;
}

if (isset($_POST['rdstitle'])) {
	$rdstitle = $_POST['rdstitle'];
	$update = true;
}

if (isset($_POST['mediatype'])) {
	$mediatype = $_POST['mediatype'];
	$update = true;
}

if ($update == true) {
	$handle = fopen("info.dat", "w");
	fwrite($handle, $name1 . "\n");
	fwrite($handle, $name2 . "\n");
	fwrite($handle, $uid . "\n");
	fwrite($handle, $rdstitle . "\n");
	fwrite($handle, $mediatype. "\n");

	fclose($handle);

	echo "updated";
	exit;
}
?>