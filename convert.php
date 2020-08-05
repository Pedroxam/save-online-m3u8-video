<?php
/*
* By Pedram
* Telegram: @Pedroxam
* Email: pedroxam@gmail.com
*/

if(!isset($_POST['video']) && empty($_POST['video']))
	exit('error');
	
$root = dirname(__FILE__);

$input = trim($_POST['video']);

$output = $root . '/output/' . basename($input) . '_converted.mp4';

$command = "ffmpeg -i $input $output";

$log = './log.txt';

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
{
    pclose(popen("start /B " . $command . " 1> $log 2>&1", "r")); //Windows
}
else
{
    shell_exec($command . " 1> $log 2>&1 >/dev/null &"); //Linux
}

exit(true);
