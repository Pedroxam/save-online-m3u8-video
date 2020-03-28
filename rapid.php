<?php
/*
* By Pedram
* Telegram: @Pedroxam
* Email: pedroxam@gmail.com
*/

set_time_limit(0);

$root = dirname(__FILE__);

if(!isset($_POST['start']) && empty($_POST['start']))
	exit('ERROR: Please Check Start number.');

if(!isset($_POST['end']) && empty($_POST['end']))
	exit('ERROR: Please Check End number.');

if(!isset($_POST['ts']) && empty($_POST['ts']))
	exit('ERROR: Please Enter URL');

// Remove all illegal characters from a url
$url = filter_var(trim($_POST['ts']), FILTER_SANITIZE_URL);
	
// Validate url
if (!filter_var($url, FILTER_VALIDATE_URL))
	exit('Please Enter Valid URL');

for ($i=intval($_POST['start']);$i<=intval($_POST['end']);$i++){
	
	$video = str_ireplace('OUT', $i, $url);
	$output = $root . '/output/' . 'rapid_' . time() . '_num_' . $i . '.mp4';
	
	$put = file_put_contents($output, useCurl($video));

	if($put)
		echo "Chunk number $i was downloaded. \n";
}

function useCurl($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_AUTOREFERER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
	curl_setopt($ch, CURLOPT_TIMEOUT, 120);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_ENCODING, '');
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:31.0) Gecko/20100101 Firefox/31.0');
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
