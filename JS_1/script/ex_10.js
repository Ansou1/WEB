window.onload = function(){

	buttons = document.getElementsByClassName("buttons");
	console.log(buttons);

	buttons = buttons[0];
	back = buttons.children[0];
	clear = buttons.children[1];
	modulo = buttons.children[2];
	divide = buttons.children[3];
	multiply = buttons.children[7];
	substract = buttons.children[11];
	add = buttons.children[15];
	execute = buttons.children[18];
	zero = buttons.children[16];
	one = buttons.children[12];
	two = buttons.children[13];
	three = buttons.children[14];
	four = buttons.children[8];
	five = buttons.children[9];
	six = buttons.children[10];
	seven = buttons.children[4];
	eight = buttons.children[5];
	nein = buttons.children[6];
	dot = buttons.children[17]

	var chiffres = "";
	var lastres = "";
	var operations = "";

	zero.onclick=function(){
		chiffres += "0";
	}
	one.onclick=function(){
		chiffres += "1";
	}
	two.onclick=function(){
		chiffres += "2";
	}
	three.onclick=function(){
		chiffres += "3";
	}
	four.onclick=function(){
		chiffres += "4";
	}
	five.onclick=function(){
		chiffres += "5";
	}
	six.onclick=function(){
		chiffres += "6";
	}
	seven.onclick=function(){
		chiffres += "7";
	}
	eight.onclick=function(){
		chiffres += "8";
	}
	nein.onclick=function(){
		chiffres += "9";
	}
	add.onclick=function(){
		chiffres += " ";
		operations += "+ ";
	}
	substract.onclick=function(){
		chiffres += " ";
		operations += "- ";
	}
	multiply.onclick=function(){
		chiffres += " ";
		operations += "* ";
	}
	divide.onclick=function(){
		chiffres += " ";
		operations += "/ ";
	}
	modulo.onclick=function(){
		chiffres += " ";
		operations += "% ";
	}
	dot.onclick=function(){
		chiffres += ".";
	}
	back.onclick=function(){
		var divResult = document.getElementsByClassName("result")[0];
		chiffres = chiffres.substr(0, chiffres.length - 1);
		divResult.innerHTML = chiffres;
	}
	clear.onclick=function(){
		var divResult = document.getElementsByClassName("result")[0];
		chiffres = "";
		operations = "";
		divResult.innerHTML = chiffres;
	}
	execute.onclick=function(){

		var divResult = document.getElementsByClassName("result")[0];
		var tabChiffres = chiffres.split(" ");
		var tabOperations = operations.split(" ")
		for (i = 0; i < tabChiffres.length; i++){
			switch (tabOperations[i]){
				case '+' :
					res = parseInt(tabChiffres[i]) + parseInt(tabChiffres[i + 1]);
					
					divResult.innerText = "test";
					// divResult.appendChild(document.createTextNode(res));
					console.log(divResult.innerHTML);
					break;

				case '-' :
					res = parseInt(tabChiffres[i]) - parseInt(tabChiffres[i + 1]);
					console.log(res);
					divResult.innerHTML = res;
					break;

				case '*' :
					res = parseInt(tabChiffres[i]) * parseInt(tabChiffres[i + 1]);
					console.log(res);
					divResult.innerHTML = res;
					break;

				case '/' :
					res = parseInt(tabChiffres[i]) / parseInt(tabChiffres[i + 1]);
					console.log(res);
					divResult.innerHTML = res;
					break;

				case '%' :
					res = parseInt(tabChiffres[i]) % parseInt(tabChiffres[i + 1]);
					console.log(res);
					divResult.innerHTML = res;
					break;
			}
		}
		chiffres = "";
	}
	buttons.onclick = function(){
		var divResult = document.getElementsByClassName("result")[0];
		divResult.innerHTML = chiffres;
	}
}