<?php
/*
* By Pedram
* Telegram: @Pedroxam
* Email: pedroxam@gmail.com
*/

$root = dirname(__FILE__);

if(isset($_POST['log'])) {
    exit(file_get_contents($root . '/log.txt'));
}

// Remove all illegal characters from a url
$url = filter_var(trim($_POST['url']), FILTER_SANITIZE_URL);

// Validate url
if (!filter_var($url, FILTER_VALIDATE_URL)) {
    exit('error');
}

// Check Proxy
if(isset($_POST['proxy']) && !empty($_POST['proxy'])){
    $proxy = "-http_proxy " . trim($_POST['proxy']);
}
else $proxy = "";

// Check Duration
if(isset($_POST['from']) && !empty($_POST['from'])
&& isset($_POST['to']) && !empty($_POST['to']))
{
	if(strlen($_POST['from']) == 8 &&
	   strlen($_POST['to']) == 8
	){
		$from = trim($_POST['from']);
		
		$_from = str_replace(':', '', $from);
		$_to = str_replace(':', '', trim($_POST['to']));
		
		$calc = intval($_to) - intval($_from);
		$to = gmdate("H:i:s", $calc);
		
		$duration = "-ss $from -t $to";
	} else {
		exit('error');
	}
}
else $duration = "";

$output = $root . '/output/' . time() . '_';

$time = intval($_POST['time']);

$command = "ffmpeg $proxy -i \"$url\" $duration -c copy -flags +global_header -f segment -segment_time $time -segment_format_options movflags=+faststart -reset_timestamps 1 $output%d.mp4";

$log = './log.txt';

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
{
    pclose(popen("start /B " . $command . " 1> $log 2>&1", "r")); // Windows
}
else
{
    shell_exec($command . " 1> $log 2>&1 >/dev/null &"); //Linux
}
