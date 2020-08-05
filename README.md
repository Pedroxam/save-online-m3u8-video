# save-online-m3u8-video
Record and preview online m3u8 and m3u Videos, including split videos by time and concate videos.

You can record any online videos with specfield time.
<br/>

<img src="https://raw.githubusercontent.com/Pedroxam/save-online-m3u8-video/master/shot2.png" alt="m3u8 video php saver screenshot">
<br/>
<img src="https://raw.githubusercontent.com/Pedroxam/save-online-m3u8-video/master/shot.png" alt="m3u8 video php saver screenshot">
<br/>

Please make sure latest <a href="https://www.ffmpeg.org/" target="_blank">ffmpeg module</a> installed on your server.
<br/><br/>
First Tools (Stream Downloader):<br/><br/>
Enter stream video url in first field and enter seconds time on second field. click on record button. for example if you enter 60 seconds, the video file cuts for every 60 seconds, and with stop button, you can view confirm box to set concat all files to 1 file. 

Second Tools (Chunk Downloader):<br/><br/>
Enter Start Number in the first field and End number to second field, for the staring download target ".ts" video.

<br/>
<b>Update 5: </b> Adding video conversion button for stream downloaded videos. (can optimize and reduce size of stream recorded videos).
<br/>
<b>Update 4: </b> Adding Record on time to stream downloader ! (record from start to end / etc: 01:50:10 => 01:50:15 can record 5 seconds)
<br/>
<b>Update 3: </b> Adding ScreenShot video viewer for file.
<br/>
<b>Update 2: </b> Adding Stream CHUNK downloader.
<br/>
<b>Update 1: </b> Adding Custom HTTP Proxy for download videos.

<h2>Record M3U8 and M3U Videos</h2>
<b style="color:blue">Save most of online videos services.</b>

<br/>

<h2>Split video by time</h2>
<b style="color:blue">Split videos in parts with time.</b>

<h2>Concat videos (merge videos)</h2>
<b style="color:blue">Merge all video parts in 1 file (after recording was done)</b>

<h2>Preivew While recording</h2>
<b style="color:blue">Preview video while recording.</b>

<h2>Add Custom Proxy</h2>
<b style="color:blue">http proxy for using download videos.(using proxy over ffmpeg)</b>
<br/>

<h2>Live FFmpeg Logs</h2>
<b style="color:blue">Live ffmpeg logs.</b>
<br/>

<h2>Video ScreenShot</h2>
<b style="color:blue">Auto generate video screenshot.</b>
<br/>

<h2>Stream Chunk Downloader</h2>
<b style="color:blue">Simple stream chunk downloader. (just with php)</b>
<br/> 

<h3>Windows Notes:</h3>

- For stopping ffmpeg in windows, i put a simple excutable file called "pskill.exe". for use this file, first open and select agree of use.

<h3>Usage Notes:</h3>

- Don't forget, All ffmpeg tasks can run in the background, so when you close the page, the task can't be stop. for stopping ffmpeg task, just click on "Stop Record", this will run "kill ffmpeg command". you can press this button any time you want to make sure about stoping all ffmpeg tasks.

<h3>Credits:</h3>

<ul>
<li>php</li>
<li>ffmpeg</li>
<li>bootstrap</li>
<li>jquery</li>
<li>hls</li>
<li>pskill</li>
</ul>

Enjoy
