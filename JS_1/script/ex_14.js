window.onload = function(){
	var input = document.getElementsByTagName("input")[0];
	input.setAttribute("oninput", "getInput()");
}

function getInput(){
	var input = document.getElementsByTagName("input")[0];
	var output = document.getElementsByTagName("footer")[0].lastElementChild;
	var open = "";
	var close = "";
	var str = input.value;
	str = str.replace("<", "&lt;");
	var colorValue = "";
	var closeColor = "";
	var openURL = "";

	for (var i = 0; i < str.length; i++){
		open = str[i - 2] + str[i - 1] + str[i];
		switch(open){
			case '[B]' :
				tab = str.split("[B]");
				tab[0] += "<b>";
				str = tab[0] + tab[1];
				break;

			case '[U]' : 
				tab = str.split("[U]");
				tab[0] += "<u>";
				str = tab[0] + tab[1];
				break;

			case '[S]' : 
				tab = str.split("[S]");
				tab[0] += "<s>";
				str = tab[0] + tab[1];
				break;
		}
		close = str[i - 3] + str[i - 2] + str[i - 1] + str[i];
		switch(close){
			case '[/B]' :
				tab = str.split("[/B]");
				tab[0] += "</b>";
				str = tab[0] + tab[1];
				break;

			case '[/U]' :
				tab = str.split("[/U]");
				tab[0] += "</u>";
				str = tab[0] + tab[1];
				break;

			case '[/S]' :
				tab = str.split("[/S]");
				tab[0] += "</s>";
				str = tab[0] + tab[1];
				break;
		}
		color = str[i - 6] + str[i - 5] + str[i - 4] + str[i - 3] + str[i - 2] + str[i - 1] + str[i];
		if (color == "[color="){
			tab = str.split('color=');
			tab2 = tab[1].split(']');
			if (typeof(tab2[1]) != 'undefined'){
				colorValue = tab2[0];
				tabColor = str.split("[color=" + colorValue + "]");
				// console.log(colorValue);
				tabColor[0] += '<span style="color:' + colorValue + '">';
				// console.log(tabColor);
				str = tabColor[0] + tabColor[1];
			}
		}
		closeColor = str[i - 7] + str[i - 6] + str[i - 5] + str[i - 4] + str[i - 3] + str[i - 2] + str[i - 1] + str[i];
		if (closeColor == "[/color]"){
			tab = str.split("[/color]");
			tab[0] += '</span>';
			str = tab[0] += tab[1];
		}
		openURL = str[i - 4] + str[i - 3] + str[i - 2] + str[i - 1] + str[i];
		if (openURL == "[url="){
			tab = str.split('[url=');
			tab2 = tab[1].split("]");
			if (typeof(tab2[1]) != 'undefined'){
				urlValue = tab2[0];
				tabUrl = str.split("[url=" + urlValue + "]");
				tabUrl[0] += '<a href ="' + urlValue + '">';
				str = tabUrl[0] + tabUrl[1];
			}
		}
		closeUrl = str[i - 5] + str[i - 4] + str[i - 3] + str[i - 2] + str[i - 1] + str[i];
		if (closeUrl == "[/url]"){
			tab = str.split('[/url]');
			tab[0] += '</a>';
			str = tab[0] + tab[1];
		}
	}
	output.innerHTML = str;
}
