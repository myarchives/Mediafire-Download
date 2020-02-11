<?php

	//
	// PHP Mediafire Downloader [Single Link Downloader]
	// Created By : Speciment ID :D
	// Usage : php mediafire.php
	//

error_reporting(0);

function ambilKata($param, $kata1, $kata2){
    if(strpos($param, $kata1) === FALSE) return FALSE;
    if(strpos($param, $kata2) === FALSE) return FALSE;
    $start = strpos($param, $kata1) + strlen($kata1);
    $end = strpos($param, $kata2, $start);
    $return = substr($param, $start, $end - $start);
    return $return;
}

echo "".PHP_EOL;
echo "\e[1;37m Mediafire Downloader [Single]".PHP_EOL;
echo "\e[1;37m Created By Speciment ID".PHP_EOL;
echo "".PHP_EOL;

echo "\e[1;32m[Input]\e[1;37m List Url : ";
$url = trim(fgets(STDIN));

$input = @file_get_contents($url) or die("Could not access file: $url");
$filegan = ambilKata($input, '<div class="filename">', '</div>');
$directory = "./files";
if (!file_exists($directory)) {
	mkdir($directory);
}
$destination = $directory."/".$filegan;
$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
if(preg_match_all("/$regexp/siU", $input, $matches)) {

	$linkgan = $matches[2][6];
	echo "\e[1;32m[Info]\e[1;37m Filename : ".$filegan.PHP_EOL;
	sleep(1);
	echo "\e[1;32m[Info]\e[1;37m Saved : ".$directory."/".$filegan;
	echo "".PHP_EOL;
	sleep(1);
	echo "\e[1;32m[Info]\e[1;37m Loading Please Wait...".PHP_EOL;
	sleep(1);
	$ch = curl_init ($linkgan);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$data = curl_exec($ch);
$error = curl_error($ch);
curl_close ($ch);
echo $error;

$file = fopen($destination, "w+");
$nambah = fputs($file, $data);


if ($nambah) {
fclose($file);
echo "\e[1;32m[Info]\e[1;37m File Downloaded Please Check".PHP_EOL;
}else{
echo "\e[1;31m[Alert]\e[1;37m Can't Download FIle";
echo "\e[1;31m[\e[1;37m+\e[1;31m[\e]\e[1;37m Please Download Manualy : ".PHP_EOL;
echo $matches[2][6];
}
}
?>