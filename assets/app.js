/*
  * By Pedram
  * Telegram: @Pedroxam
  * Email: pedroxam@gmail.com
*/

/**
 * Global Progress var
 */
var doProgress;

/**
 * Set Start Progress Encode Video
 */
function SetProgressStart(m3u8) {
	
	  if(Hls.isSupported()) {
		  var video = document.getElementById('video');
		  video.volume = 1.0;
		  var hls = new Hls();
		  var m3u8Url = decodeURIComponent(m3u8)
		  hls.loadSource(m3u8Url);
		  hls.attachMedia(video);
		  hls.on(Hls.Events.MANIFEST_PARSED,function() {
			video.play();
		  });
		}
		
	doProgress = setInterval( showProgress, 5000 );
}

/*
 * FFmpeg Log
*/
function showProgress(){
	$.ajax({
		type:'POST',
		url:'./start.php',
		data: {
			log: true
		}
	})
		.done(function(content){
			$('.log').html(content);
		});
}

/*
 * Concat Videos
*/
function concatVideos(){
	$.ajax({
		type:'POST',
		url:'./concat.php'
	})
		.done(function(content){
			location.reload();
		});
}

$(document).ready(function(){
	/**
	 * Start Record Video
	 */
	$('#start').click(function(){
		var m3u8 = $('#url').val();
		var time = $('#time').val();
		var that = this;

		if(m3u8 === "") {
			return alert('Please enter m3u8 url');
		}

		$(that).addClass('disabled');

		$.ajax({
			type:'POST',
			url:'./start.php',
			data: {
				url: m3u8,
				time: time
			}
		})
			.done(function(result){
				if(result === 'error'){
					alert('ERROR: Invalid URL');
					$(that).removeClass('disabled');
				}
				else {
					var seconds = 0;
					setInterval(function () {
						$('#timer').html(seconds);
						seconds++;
					}, 1000);

					$('.log').show();
					$('.preview').show();
					$('.timer').show();
					$('#stop').removeClass('disabled');

					SetProgressStart(m3u8);
				}
			});
	});

	/**
	 * Stop Record Video
	 */
	$('#stop').click(function(){
		$.ajax({
			type:'POST',
			url:'./stop.php'
		})
			.done(function(result){
				
				var timer = parseInt($('#timer').html()),
					split = parseInt($('#time').val());
					
					calculate = parseInt(timer/split);
				
					if(calculate !== 0 && calculate >= 1){
						
					var q = confirm('Do you want to cancat videos?');
						if (q == true) {
							concatVideos();
						}
						else {
							location.reload();
						}
						
					}
					else {
							location.reload();
						}
			});
	});
});
