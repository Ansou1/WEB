(function(){
	window.onload = function(){
		var div = document.getElementsByTagName("footer")[0].firstElementChild;
		var Hero = function(name, type, intelligence, strength){
			this.name = name;
			this.type = type;
			this.intelligence = intelligence;
			this.strength = strength;

			var firstLetter = this.name[0];
			firstLetter = firstLetter.toUpperCase();
			this.name = this.name.substr(1);
			this.name = firstLetter + this.name;
			var ret = 'Je suis ' + this.name + ' le ' + this.type + ', j\'ai ' + this.intelligence;
			if (this.intelligence > 1){
				ret += ' points d\'intelligence et ';
			}
			else {
				ret += ' point d\'intelligence et ';
			}
			ret += this.strength;
			if (this.strength > 1){
				ret += ' points de force !<br/>';
			}
			else {
				ret += ' point de force !<br/>';
			}
  			div.innerHTML += ret;
		}
		var mage = new Hero("amadeus", "mage", 10, 1);
        var guerrier = new Hero("pontius", "guerrier", 1, 1);
        mage.toString();
        guerrier.toString();
	}
})();