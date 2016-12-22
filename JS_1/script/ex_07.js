(function (){
	window.onload = function(){
		var canvas = document.getElementsByTagName("canvas")[0];
		var pause = document.getElementsByTagName("button")[0];
		var stop = document.getElementsByTagName("button")[1];
		var mute = document.getElementsByTagName("button")[2];

		canvas.height = 20;
		canvas.width = 20;
		var ctx = canvas.getContext('2d');
		ctx.beginPath();
		ctx.fillStyle="#FFFFFF"
		ctx.moveTo(6, 6);
		ctx.lineTo(14, 10);
		ctx.lineTo(6, 14);
		ctx.closePath();
		ctx.fill();

		canvas.innerHTML += "<audio src =\"https://wac.epitech.eu/www/racingjs/pony_song.ogg\" type=\"audio/mp3\" id=\"audio\"></audio>";
		canvas.onclick = function(){
			document.getElementById('audio').play();
		}
		pause.onclick = function(){
			document.getElementById('audio').pause();
		}
		stop.onclick = function(){
			document.getElementById('audio').pause();
			document.getElementById('audio').currentTime = 0;
		}
		mute.onclick = function(){
			mute = document.getElementById('audio').muted;
			if (mute == false)
				document.getElementById('audio').muted = true;
			else
				document.getElementById('audio').muted = false;
		}
	};
})();