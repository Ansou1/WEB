<?PHP
require('./class.images.php');
require('./class.getopt.php');
function spritemake($argv){
	$getopt = new getopt($argv);
	$options = $getopt->get_opt();
	if ($options === false){
		return false;
	}
	if (isset($options["h"]) || isset($options["help"])){
		$man = file_get_contents("./.man");
		echo $man;
		return false;
	}
	if ($getopt->check_options() == false){
		return false;
	}
	if (!is_dir($argv[count($argv) - 1])){
			echo "Please enter a valid path.\n";
			return false;
	}
	$spritemake = new images($argv, $options);
	$paths_tab = $spritemake->get_files($options);
	if ($options["o"] != 4000){
		$spritemake->resize_img($paths_tab, $options["o"]);
	}
	$output_size = $spritemake->get_output_size($paths_tab, $options["p"], $options["c"]);
	$spritemake->create_img($output_size, $paths_tab, $options["i"], $options["p"], $options["c"]);
	$spritemake->create_sheet($output_size, $paths_tab, $options["s"], $options["p"], $options["i"], $options["c"]);
	if ($options["o"] != 4000){
		$spritemake->destroy_tmp($paths_tab);
	}
	if ($options["e"] != "none"){
		$spritemake->effect($options["e"], $options["i"], $output_size);
	}
	if (isset($options["v"]) || isset($options["verbose"])){
			echo "\033[1;32m";
			echo "All done !\n";
			echo "\033[1;37m";
		}
}

spritemake($argv);