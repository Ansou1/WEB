<?php
class getopt
{
	public function __construct($argv){
		$this->argv = $argv;
	}
//Returns an array with options and default values;
	public function get_opt(){
		$shortops = "i:s:p:c:o:e:";
		$shortops .= "rvhb";
		$longopts = array("output-image:", "output-style:", "recursive", "verbose", "padding:", "columns_number:", "override-size:", "help", "bounce", "effect:");
		$options = getopt($shortops, $longopts);
		if (!array_key_exists("i", $options)){
			if (isset($options["output-image"])){
				$options["i"] = $options["output-image"];
			}
			else {
				$options["i"] = "sprite.png";
			}
		}
		if (!array_key_exists("p", $options)){
			if (isset($options["padding"])){
				$options["p"] = $options["padding"];
			}
			else {
				$options["p"] = 0;
			}
		}
		if (!array_key_exists("s", $options)){
			if (isset($options["output-style"])){
				$options["s"] = $options["output-style"];
			}
			else {
				$options["s"] = "style.css";
			}
		}
		if (!array_key_exists("c", $options)){
			if (isset($options["columns_number"])){
				$options["c"] = $options["columns_number"];
			}
			else {
				$options["c"] = 1000;
			}
		}
		if (!array_key_exists("o", $options)){
			if (isset($options["override-size"])){
				$options["o"] = $options["override-size"];
			}
			else {
				$options["o"] = 4000;
			}
		}
		if (!array_key_exists("e", $options)){
			if (isset($options["effect"])){
				$options["e"] = $options["effect"];
			}
			else {
				$options["e"] = "none";
			}
		}
		if (!is_numeric($options["p"])){
			echo "Please enter a valid value for option padding.\n";
			return false;
		}
		if (!is_numeric($options["c"])){
			echo "Please enter a valid value for option column.\n";
			return false;
		}
		if (!is_numeric($options["o"])){
			echo "Please enter a valid value for option override-size.\n";
			return false;
		}
		foreach($options as $value){
			if (is_array($value)){
				echo "Please enter only one value for the each option.\n";
				return false;
			}
		}
		$this->options = $options;
		return $options;
	}

//check options. returns false if something went wrong, else returns true.
	public function check_options(){
		if (isset($this->options["v"]) || isset($this->options["verbose"])){
			echo "Checking options...\n";
		}
		$argv = $this->argv;
		$options = $this->options;
		foreach ($argv as $value){
			if ($value[0] == "-" && $value[1] != "-" && $value != $argv[count($argv) - 1]){
				for ($cpt = 1; $cpt < (strlen($value)); $cpt++){
					if (!array_key_exists($value[$cpt], $options)){
						if ($value[$cpt] == "="){
							break;
						}
						else {
							echo "css_generator : invalid option: $value[$cpt]\nTry css_generator --help for more options.\n";
							return false;
						}
					}
				}
			}
			if ($value[0] == "-" && $value[1] == "-" && $value != $argv[count($argv) -1]){
				$option_name = "";
				for ($cpt = 2; $cpt < strlen($value); $cpt++){
					$option_name .= $value[$cpt];
					if ($value[$cpt] == "="){
						$option_name = substr($option_name, 0, strlen($option_name) - 1);
						break;
					}
				}
				if (!array_key_exists($option_name, $options)){
					echo "css_generator : invalid option: $option_name\nTry css_generator --help for more options.\n";
					return false;
				}
			}
		}
		return true;
	}
}