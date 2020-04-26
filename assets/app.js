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
		} else alert('Stream play not supported in your browser.');
		
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
		$('.log').scrollTop(999999999999);
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
			setTimeout(function(){
				location.reload();
			  }, 2000);
		});
}

/*
 * Convert seconds to time
*/
function timeFormat(totalSeconds) {
    hours = Math.floor(totalSeconds / 3600);
    totalSeconds %= 3600;
    minutes = Math.floor(totalSeconds / 60);
    seconds = totalSeconds % 60;
    return hours + ':' + minutes + ':' + seconds;
}

$(document).ready(function(){
	/**
	 * Start Record Video
	 */
	$('#start').click(function(){
		var m3u8 = $('#url').val();
		var time = $('#time').val();
		var proxy = $('#proxy').val();
		var that = this;

		if(m3u8 === "") {
			return alert('Please enter m3u8 url');
		}

		$(that).attr('disabled', true);

			$.ajax({
				type:'POST',
				url:'./start.php',
				data: {
					url: m3u8,
					time: time,
					proxy: proxy
				}
			})
			.done(function(result){
				if(result === 'error'){
					alert('ERROR: Invalid URL');
					$(that).attr('disabled', false);
				}
				else {
					var seconds = 0;
					setInterval(function () {
						$('#timer').html(timeFormat(seconds));
						$('#el').val(seconds);
						seconds++;
					}, 1000);

					$('.log').show();
					$('.preview').show();
					$('.timer').show();
					$('#stop').attr('disabled', false);

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
			.done(function(){
				
				var timer = parseInt($('#el').val()),
					split = parseInt($('#time').val());
					
					calculate = parseInt(timer/split);
				
					if(calculate !== 0 && calculate > 1){
						
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

	/**
	 * Force Concat Video
	 */
	$('#concat').click(function(){
		concatVideos();
	});

	/**
	 * Screenshot Generator
	 */
	$('.file_list button').click(function(){
		$(this).html('Wait...');
		$.ajax({
			type:'POST',
			url:'./screenshot.php',
			data: {
				video: $(this).data('file')
			}
		})
		.done(function(content){
			setTimeout(function(){
				location.reload();
			  }, 1200);
		});
	});

	/**
	 * Rapid Saver TS Videos
	 */
	$('#rapid').click(function(){
		var that = this;
		
		if(!$('#s').val()) return;
		if(!$('#e').val()) return;
		if(!$('#ts').val()) return;
		
		$.ajax({
			type:'POST',
			url:'./rapid.php',
			data: {
				start: $('#s').val(),
				end: $('#e').val(),
				ts: $('#ts').val(),
			},
			beforeSend:function(){
				$('.rapid_log').show();
				$('.rapid_log').html('Downloading Video, Please Wait...');
				$(that).attr('disabled', true);
			},
			success:function(result){
				$(that).attr('disabled', false);
				
				if(result !== '')
					$('.rapid_log').html(result);
			},
		});
	});
});
