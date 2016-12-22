(function (){
	window.onload = function(){
		var cpt = 0;
		document.getElementsByTagName("footer")[0].firstElementChild.onclick = function() {click_counter()};
		function click_counter(){
			cpt++;
			document.getElementsByTagName("footer")[0].firstElementChild.innerHTML = cpt;
		}
	};
})();