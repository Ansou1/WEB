var idBig = null;
var idSmall = null;

window.onload = function(){
	if (localStorage.getItem('pangolin')){
		var div = document.getElementsByTagName("footer")[0].firstElementChild;
		var imgData = localStorage.getItem('pangolin');
		img = document.createElement('img');
		div.appendChild(img);
		img.src = "data:image/jpg;base64," + imgData;
		img.setAttribute("onmouseenter", "justSmallIt(this)");
		img.setAttribute("onmouseout", "justBigIt(this)");
		img.onclick = function(){
			localStorage.removeItem("pangolin");
		}
	}
}

function justSmallIt(img){
	clearInterval(idBig);
	idSmall = setInterval(small, 1000);
}

function small(){
	var img = document.getElementsByTagName("img")[0];
	var imgWidth = img.width;
	var imgHeight = img.height;
	img.width = imgWidth - (imgWidth * 1/100);
	img.height = imgHeight - (imgHeight * 1/100);
	if (img.height < 0){
		clearInterval(idSmall);
	}
}


function justBigIt(){
	clearInterval(idSmall);
	idBig = setInterval(big, 1000);
}


function big(){
	var img = document.getElementsByTagName("img")[0];
	var imgWidth = img.width;
	var imgHeight = img.height;
	img.width = imgWidth + (imgWidth * 1/100);
	img.height = imgHeight + (imgHeight * 1/100);
	if (img.height >= 386){
		clearInterval(idBig);
	}
}