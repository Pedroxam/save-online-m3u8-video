<?php
/*
* By Pedram
* Telegram: @Pedroxam
* Email: pedroxam@gmail.com
*/

//Windows
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $command = dirname(__FILE__) . '/pskill.exe ffmpeg';
    exec($command);
}

//Linux or other os
else
{
    exec("kill -9 ffmpeg");
    exec("KILL ffmpeg");
    exec("killall ffmpeg");
    exec("pkill ffmpeg");
    exec("sudo kill ffmpeg");
}