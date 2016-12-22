window.onload=function(){
	okButton = document.getElementsByTagName("div")[2];
	okButton.setAttribute("onclick", "createcookie()");
	div2 = document.createElement("div");
	document.getElementsByTagName("footer")[0].appendChild(div2);
	div2.setAttribute("id", "div2");
	div2.innerHTML = "Supprimer le cookie";
	div2.className = "btn";
	div2.style.display = "none";
	div2.setAttribute("onclick", "deleteCookie()");
	checkCookie();

}

function createcookie(){
		var date = new Date();
		var time = date.getTime();
		time += 24*3600*1000;
		date.setTime(time);
		document.cookie = "acceptsCookie=true; expires=" + date.toUTCString() + "domain=127.0.0.1;";
		checkCookie();
	}

	function checkCookie(){
		tab = getcookies();
		if (tab[0][0] === "acceptsCookie" && tab[0][1] === "true"){
			div2 = document.getElementById("div2");
			div2.style.display = "block";
			div1 = document.getElementsByTagName("div")[2];
			div1.innerHTML = "";
		}
		else {
			div1 = document.getElementsByTagName("div")[2];
			div2 = document.getElementById("div2");
			div2.style.display = "none";
			div1.innerHTML = "Ce site utilise les cookies, cliquez sur OK si vous acceptez leur utilisation. <a href=\"#\">OK</a>"
		}
	}

		function getcookies(){
		var allCookies = document.cookie;
		var tab = allCookies.split(";");
		for (var i = 0; i < tab.length; i++){
			tab[i] = tab[i].split("=");
		}
		return tab;
	}

function deleteCookie(){
	document.cookie = "acceptsCookie =; expires=Thu, 01 Jan 1970 00:00:01 GMT";
	checkCookie();
}