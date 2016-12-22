(function (){
	window.onload = function(){
		var div = document.getElementsByTagName("footer")[0].firstElementChild;
		var str = "";
		var cpt = 0;
		document.onkeypress= function(onpress){
			if (navigator.userAgent.indexOf('Firefox')){
				if (cpt >= 42){
					str = str.substr(1);
				}
				str += String.fromCharCode(onpress.charCode);
				div.innerHTML = str;
				cpt++;
			}
			else {
				if (cpt >= 42){
					str = str.substr(1);
				}
				str += String.fromCharCode(onpress.keyCode);
				div.innerHTML = str;
				cpt++;
			}
		}
	};
})();