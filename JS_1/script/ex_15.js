window.onload = function(){
	var event = new Event('build');
	document.addEventListener("build", pango());
	document.dispatchEvent(event);
	var cpt = 0;
	var div = document.getElementsByTagName("footer")[0].firstElementChild;
	div.setAttribute("onclick", 'pango()');
	console.log(div);

	function pango(){
		cpt++;
		if (cpt == 1){
			div.style.backgroundColor = "red";
			cpt++;
		}
		if (cpt == 2){
			div.style.backgroundColor = "purple";
			cpt++;
		}
		if (cpt == 3){
			div.style.backgroundColor = "yellow";
			cpt++;
		}
		if (cpt == 4){
			div.style.backgroundColor = "white";
			cpt++;
		}
		if (cpt == 5){
			div.style.backgroundColor = "blue";
			cpt++;
		}
		if (cpt == 6){
			div.style.backgroundColor = "orange";
			cpt++;
		}
		if (cpt == 7){
			div.style.backgroundColor = "black";
			cpt = 0;
		}
	}
}