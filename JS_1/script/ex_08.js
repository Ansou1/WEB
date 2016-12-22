(function (){
	window.onload = function(){
		canvas = document.getElementsByTagName("canvas");
		var tab = new Array();
		for (var cpt = 0; cpt < canvas.length; cpt++){
			var value = window.getComputedStyle(canvas[cpt], null).getPropertyValue('background-color');
			if (value == "rgb(255, 165, 0)"){
				tab.push(value);
			}
		}
		for (var cpt = 0; cpt < canvas.length; cpt++){
			var value = window.getComputedStyle(canvas[cpt], null).getPropertyValue('background-color');
			if (value == "rgb(128, 0, 128)"){
				tab.push(value);
			}
		}
		for (var cpt = 0; cpt < canvas.length; cpt++){
			var value = window.getComputedStyle(canvas[cpt], null).getPropertyValue('background-color');
			if (value == "rgb(0, 0, 0)"){
				tab.push(value);
			}
		}
		for (var cpt = 0; cpt < canvas.length; cpt++){
			var value = window.getComputedStyle(canvas[cpt], null).getPropertyValue('background-color');
			if (value == "rgb(128, 128, 0)"){
				tab.push(value);
			}
		}
		for (var i = 0; i < canvas.length; i++){
			canvas[i].style.backgroundColor = tab[i];
		}
	};
})();