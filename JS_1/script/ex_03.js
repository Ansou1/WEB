(function (){
	window.onload = function(){
		var div = document.getElementsByTagName("footer")[0].firstElementChild
		div.onclick = function() {ask_name()};
		function ask_name(){
			var answer = prompt("Quel est votre nom ?");
			if (answer){
				if (confirm("Etes vous sûr que " + answer + " est votre nom ?")){
					alert("Bonjour " + answer + " !");
					div.innerHTML = "Bonjour " + answer + " !";
				}
			}
			else {
				ask_name();
			}
		}
	};
})();