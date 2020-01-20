<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FFmpeg Command Execution</title>
    <link rel='stylesheet' href='./assets/bootstrap.min.css'>
    <style>
		.preview{display:none;}
        .log{display:none;white-space:pre-line;text-align:left;overflow-y:scroll;height:300px;}
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

                    <ul class="list-group-item">
                        <?php foreach(glob('output/*') as $file): ?>
                            <li class="list-group mt-2">
                                <a target="_blank" href="<?php echo $file; ?>"><?php echo basename($file); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <hr>

                <div class="form-group">
                    <label for="url">Enter m3u8 URL</label>
                    <input type="text" id="url" class="form-control" placeholder="http://">
                </div>

                <div class="form-group">
                    <label for="time">Split video by time (in seconds)</label>
                    <input type="number" id="time" class="form-control" value="60">
                </div>

                <div class="col-md-12 text-center my-2">
                    <button id="start" class="btn btn-danger text-white">
                        Start Record Video
                    </button>
                    <button id="stop" class="btn btn-success text-white disabled">
                        Stop Record
                    </button>
                </div>

                <div class="mt-3">
                    <div id="timer" class="text-center text-danger"></div>
                </div>

                <hr/>


                <h5 class="text-muted text-center">Log contents</h5>
                <div class="col-md-12 mt-4">
                    <div id="log" class="log"></div>
                </div>
				
                <h5 class="text-muted text-center">Preview</h5>
                <div class="col-md-12 mt-4">
                    <div id="preview" class="preview text-center">
						<small class="text-warning">Notes:Some videos not play in here!</small>
						<video id="video" style="width: 100%; height: 100%;" controls></video>
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
