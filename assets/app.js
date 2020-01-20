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
function SetProgressStart() {
	doProgress = setInterval( showProgress, 5000 );
}

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

$(document).ready(function(){
	/**
	 * Start Record Video
	 */
	$('#start').click(function(){
		var m3u8 = $('#url').val();
		var that = this;

		if(m3u8 === "") {
			return alert('Please enter m3u8 url');
		}

		$(that).addClass('disabled');

		$.ajax({
			type:'POST',
			url:'./start.php',
			data: {
				url: m3u8
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
					$('#stop').removeClass('disabled');

					SetProgressStart();
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
				location.reload();
			});
	});
});