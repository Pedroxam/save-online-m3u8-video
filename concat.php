<?php
/*
* By Pedram
* Telegram: @Pedroxam
* Email: pedroxam@gmail.com
*/

$root = dirname(__FILE__);

$files = glob('output/*');

if(!count($files)) exit;

if(file_exists('./list.txt')) @unlink('./list.txt');

foreach($files as $file){
	if(!preg_match('/concated/',$file)){
		file_put_contents('./list.txt', "file '$file'" . "\n", FILE_APPEND);
	}
}

$output = $root . '/output/' . 'concated_' . time();

$command = "ffmpeg -f concat -safe 0 -i ./list.txt -c copy $output.mp4";

$log = './concat_log.txt';

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
{
    pclose(popen("start /B " . $command . " 1> $log 2>&1", "r")); // windows
}
else
{
    shell_exec($command . " 1> $log 2>&1 >/dev/null &"); //linux
}
