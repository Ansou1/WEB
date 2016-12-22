window.onload = function(){
	var bloc = document.getElementsByTagName("footer")[0].lastElementChild;
	var idInterval = setInterval(calculateArchimede, 500, idInterval);
	bloc.setAttribute("onclick", "incrementePoids(this)");
}

function getImmergedSize(bloc, water){
	var divToTop = water.offsetTop;
	var blocToTop = bloc.offsetTop;
	var EmergedSize = divToTop - blocToTop;
	var ImmergedSize = 50 - EmergedSize;

	return ImmergedSize;
}

function incrementePoids(bloc){
	poids = bloc.innerHTML;
	poids++;
	bloc.innerHTML = poids;
}

function calculateArchimede(idInterval){
	var bloc = document.getElementsByTagName("footer")[0].lastElementChild;
	var water = document.getElementsByTagName("footer")[0].children[1];
	var poids = bloc.innerHTML;
	var volume = getImmergedSize(bloc, water);
	var masse = poids / getImmergedSize(bloc, water);
	var graviteConstante = 9.80665;
	var archimede = volume * masse * graviteConstante;
	var forceGravite = graviteConstante * poids;
	var top = 360
	speed = getSpeed(poids, volume, graviteConstante);
	if (speed != 0){
	top += speed / 100;
	}
	if (poids != 10){
		bloc.style.top = top + "px";
	}
	if (bloc.offsetTop > 1150){
		clearInterval(4);
		bloc.style.top = 1150 + "px";
		console.log("CLEAR INTERVAL");
	}
}

function getSpeed(poids, volume, graviteConstante){
	speed = (poids * volume * graviteConstante) - (1 * volume * graviteConstante);
	return speed;
}