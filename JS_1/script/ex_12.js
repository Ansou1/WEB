window.onload = function(){
	div = document.getElementsByTagName("footer")[0].firstElementChild;
	img = document.createElement("img");
	div.appendChild(img);
	img.setAttribute("src", "pangolin.jpg");
	img.style.display = "none";

	function getBase64Image(img){
		var canvas = document.createElement('canvas');
		canvas.width = img.width;
		canvas.height = img.height;

		var ctx = canvas.getContext('2d');
		ctx.drawImage(img, 0, 0);

		var dataURL = canvas.toDataURL("image/jpg");

		return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
	}

	if (typeof(localStorage) == 'object'){
		if (typeof(localStorage.getItem('pangolin')) === 'string'){
			img.style.display = "block";
			img.style.margin = "auto";
		}
		else {
			imgData = getBase64Image(img);
			localStorage.setItem("pangolin", imgData);
		}
	}
}