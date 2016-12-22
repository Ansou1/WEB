(function(){
	window.onload = function(){
		var body = document.getElementsByTagName("body")[0];
		var button1 = document.getElementsByTagName("button")[0];
		var button2 = document.getElementsByTagName("button")[1];
		var select = document.getElementsByTagName("select")[0];
		select.onclick = function() {
			body.style.backgroundColor = document.getElementsByTagName("select")[0].value;
		}
		var font_size = window.getComputedStyle(body, null).getPropertyValue('font-size');
		font_size = font_size.substr(0, 2);
		button1.onclick = function(){
			font_size++;
			body.style.fontSize = font_size + "px";
		}
		button2.onclick = function(){
			font_size--;
			body.style.fontSize = font_size + "px";
		}
	}
})();