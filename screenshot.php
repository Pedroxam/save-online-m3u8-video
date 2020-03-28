<?php
/*
* By Pedram
* Telegram: @Pedroxam
* Email: pedroxam@gmail.com
*/

$log = './screenshot_log.txt';

if(!isset($_POST['video']) && empty($_POST['video']))
	exit('error');

$video = trim($_POST['video']);

$command = "ffmpeg -i $video -deinterlace -an -ss 1 -t 00:00:05 -r 1 -y -vcodec mjpeg -f mjpeg $video.jpg";

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
{
    pclose(popen("start /B " . $command . " 1> $log 2>&1", "r")); //Windows
}
else
{
    shell_exec($command . " 1> $log 2>&1 >/dev/null &"); //Linux
}


exit(true);
