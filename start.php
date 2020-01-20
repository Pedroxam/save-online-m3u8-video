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

$output = $root . '/output/' . time() . '_';

$time = intval($_POST['time']);

$command = "ffmpeg -i $url -c copy -flags +global_header -f segment -segment_time $time -segment_format_options movflags=+faststart -reset_timestamps 1 $output%d.mp4";

$log = './log.txt';

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
{
    pclose(popen("start /B " . $command . " 1> $log 2>&1", "r")); // windows
}
else
{
    shell_exec($command . " 1> $log 2>&1 >/dev/null &"); //linux
}
