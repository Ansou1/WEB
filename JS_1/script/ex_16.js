
window.onload = function(){
	var div = document.getElementsByTagName("footer")[0].firstElementChild;
	var char = "";
	var cpt = 0;
	var konami = ["37", "37", "39", "40", "38", "40", "37", "39", "39", "65", "66"];

	if(typeof InstallTrigger !== 'undefined'){
		document.onkeypress = function(onpress){
			char = onpress.keyCode;
			if (char == konami[cpt]){
				cpt++;
			}
			if (cpt > 8){
				char = onpress.charCode;
				if (char == konami[cpt]){
					cpt ++;
				}
				if (cpt >= 11){
				div.innerHTML = "Hey! That's my Konami code!";
				}
			}
		}
	}
	else {
		document.onkeydown = function(onpress){
			char = onpress.keyCode;
			if (char == konami[cpt]){
				cpt++;
			}
			if (cpt > 8){
				char = onpress.charCode;
				if (char == konami[cpt]){
					cpt ++;
				}
				if (cpt >= 11){
				div.innerHTML = "Hey! That's my Konami code!";
				}
			}
		}
	}
}