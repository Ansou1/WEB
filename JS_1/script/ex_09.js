window.onload = function(){

canvas = document.getElementsByTagName("canvas")[0];
div = document.getElementsByTagName("footer")[0].firstElementChild;
div2 = document.getElementsByTagName("footer")[0].lastElementChild;

div.setAttribute('ondragover', "allowDrop(event)");
div.setAttribute('ondrop', "drop(event)");
canvas.setAttribute('draggable', true);
canvas.setAttribute('ondragstart', "drag(event)");
canvas.setAttribute('id', "drag");
canvas.setAttribute('top', '00px');
canvas.setAttribute('left', '00px');
div2.innerHTML = "Nouvelles coordonnées => {x,380 y:38}";
};

function drag(event) {
    event.dataTransfer.setData("text", event.target.id);
    coordXbefore = event.pageX;
    coordYbefore = event.pageY;
}
function allowDrop(event){
	event.preventDefault();
}
function drop(event){
	//NE PAS TOUCHER A CA
	event.preventDefault();
	var canvas = document.getElementById("drag");
	var coordX = event.pageX;
	var coordY = event.pageY;
	var oldX = canvas.style.left || 0 + "px";
	var oldY = canvas.style.top || 0 + "px";
	oldX = oldX.substr(0, (oldX.length - 2));
	oldY = oldY.substr(0, (oldY.length - 2));
	diffX = coordXbefore - coordX;
	diffY = coordYbefore - coordY;
	var newX = parseInt(oldX) - diffX;
	var newY = parseInt(oldY) - diffY;
	canvas.style.position = "relative";
	canvas.style.top = newY + "px";
	canvas.style.left = newX + "px";
	div2.innerHTML = "Nouvelles coordonnées => {x:" + (newX + 380) + ", y:" + (newY + 38) + "}";
}