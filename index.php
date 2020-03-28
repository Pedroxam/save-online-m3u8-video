<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FFmpeg M3U8 Downloader</title>
    <link rel='stylesheet' href='./assets/bootstrap.min.css'>
    <style>
		.preview,.timer,.log, .rapid_log {display:none;}
        .log{white-space:pre-line;text-align:left;overflow-y:scroll;height:300px;}
		.file_list, .file_list img, .file_list div {-webkit-transition: all 250ms ease-in;transition: all 250ms ease-in;}
		.file_list div:hover { transition: all 0.3s ease-out; -o-transition: all 0.3s ease-out; -ms-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out;transform: scale(1.03);}
		.file_list a:hover {text-decoration: none;}
		.file_list img:hover {box-shadow: 1px -1px 7px #999 !important}
    </style>
</head>
<body class="my-3" style="background:#EEE;">
<div class="container">

    <div class="row">
        <div class="col-md-8 my-3 m-auto">

            <h3 class="text-center my-4">Save Online m3u8</h3>

            <div class="col shadow p-4 bg-white">

                <h5 class="text-center mb-4">Video List</h5>

                <div class="col my-3">
                    <div class="row file_list">
                        <?php foreach(glob('./output/*.mp4') as $file): ?>
                        <?php if(filesize($file) > 900): //900 byte ?>
                        <?php
							if(
							  strpos($file, 'concat') !== false ||
							  strpos($file, 'rapid') !== false
							):
						 ?>
							<?php 
								if(file_exists( $screenshot = $file . '.jpg' )):
							?>
								<div class="col-lg-3 col-md-6 col-sm-12 mb-1">
									<a target="_blank" href="<?php echo $file; ?>" title="View File: <?php echo basename($file); ?>">
										<img class="img-fluid w-100 shadow" alt="screenshot" src="./<?= $screenshot; ?>">
									<span class="btn btn-sm btn-secondary btn-block rounded-0">
									<?php echo basename($file); ?></span>
									</a>
								</div>
							<?php	
								else:
							?>
								<div class="col-lg-3 col-md-6 col-sm-12 mb-1">
									<a target="_blank" href="<?php echo $file; ?>" title="View File: <?php echo basename($file); ?>">
										<img class="img-fluid w-100 shadow" alt="screenshot" src="./output/default.jpg">
									</a>
									<button class="btn btn-sm btn-primary btn-block rounded-0"
										data-file="<?php echo trim($file); ?>">Generate Screenshot</button>
								</div>
							<?php	
								endif;
								endif;
								endif;
							?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <label for="url">Enter m3u8 URL</label>
                    <input type="text" id="url" class="form-control" placeholder="http://">
                </div>

                <div class="form-group">
                    <label for="time">Split video by time (in seconds)</label>
                    <input type="number" id="time" class="form-control" value="30">
                </div>

                <div class="form-group">
                    <label for="time">Proxy Setting (optional)</label>
                    <input type="text" id="proxy" class="form-control" placeholder="192.0.0.0:3128">
                </div>

                <div class="col-md-12 text-center my-2">
                    <button id="start" class="btn btn-danger text-white">
                        Start Record Video
                    </button>
                    <button id="stop" class="btn btn-success text-white disabled">
                        Stop Record
                    </button>
                    <button id="concat" class="btn btn-secondary text-white">
                        Force Concat
                    </button>
                </div>

                <div class="mt-3" class="timer">
					<input type="hidden" id="el">
					Elapsed Time: <span id="timer" class="text-center text-danger"></span>
                </div>

                <hr/>

                <h5 class="text-muted text-center">Log contents</h5>
                <div class="col-md-12 mt-4">
                    <div id="log" class="log"></div>
                </div>
				
                <div class="col-md-12 mt-4">
                    <div id="preview" class="preview text-center">
						<h5 class="text-muted text-center">Preview</h5>
						<small class="text-warning">Note: Some videos not play in here!</small>
						<video id="video" style="width: 100%; height: 100%;" controls></video>
					</div>
                </div>
				
				<hr/>
				
			    <h5 class="text-primary text-center">Second Tools</h5>
				
                <div class="col-md-12 mt-4">
					<h5 class="text-muted text-center">Rapid Saver (chunk files)</h5>
					
						<div class="form-group">
							<label for="time">Start From</label>
							<input type="number" id="s" class="form-control" value="1">
						</div>

						<div class="form-group">
							<label for="time">To End</label>
							<input type="number" id="e" class="form-control" value="30">
						</div>

						<div class="form-group">
							<label for="time">Direct TS Link</label>
							<input type="url" id="ts" class="form-control" placeholder="http://" autocomplete="off">
							<small class="text-danger">User "OUT" instead of chunk number. Example: index04.ts must be indexOUT.ts<small>
						</div>
					
						<div class="form-group text-center">
							<button id="rapid" class="btn btn-primary text-white">
								Save Now
							</button>
						</div>
					
						<div class="form-group text-center">
							<p class="text-dark rapid_log"></p>
						</div>
					
                </div>
				
                </div>

            </div>

        </div>
    </div><!-- row -->

</div><!-- container -->
<script src="./assets/jquery.min.js"></script>
<script src="./assets/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script src="./assets/app.js"></script>
</body>
</html>
