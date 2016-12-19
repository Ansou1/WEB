<?php
class images
{
	protected $argv;
	protected $row_heights;
	protected $options;

	public function __construct($argv, $options){
		$this->argv = $argv;
		$tab = array();
		$this->row_heights = $tab;
		$this->options = $options;
	}

//creates new images at the diresed size, change the name in paths_tab and returns it
	public function resize_img(&$paths_tab, $max_size){
		if (isset($this->options["v"]) || isset($this->options["verbose"])){
			echo "Resizing images...\n";
		}
		static $beacon = 0;
		foreach ($paths_tab as &$file){
			$size = $this->get_img_size($file);
			if ($size[1] > $max_size){
				$percent = $max_size * (100 / $size[1]);
				$lm = $size[0] - $size[0] * ((100 - $percent) / 100);
				$copy = imagecreatetruecolor($lm, $max_size);
				$output = fopen("./$file.tmp.png", 'w+');
				$src = imagecreatefrompng($file);
				imagecopyresampled($copy, $src, 0, 0, 0, 0, $lm, $max_size, $size[0], $size[1]);
				imagepng($copy, $output);
			}
			if ($size[0] > $max_size){
				$percent = $max_size * (100 / $size[0]);
				$hm = $size[1] - $size[1] * ((100 - $percent) / 100);
				$copy = imagecreatetruecolor($max_size, $hm);
				$output = fopen("./$file.tmp.png", 'w+');
				$src = imagecreatefrompng($file);
				imagecopyresampled($copy, $src, 0, 0, 0, 0, $max_size, $hm, $size[0], $size[1]);
				imagepng($copy, $output);
			}
			else {
				$copy = imagecreatetruecolor($size[0], $size[1]);
				$output = fopen("./$file.tmp.png", 'w+');
				$src = imagecreatefrompng($file);
				imagecopyresampled($copy, $src, 0, 0, 0, 0, $size[0], $size[1], $size[0], $size[1]);
				imagepng($copy, $output);
			}
		$file .= ".tmp.png";
		}
	}

	//return an iterative array with png's paths only
	public function get_files(){
		$options = $this->options;
		if (isset($this->options["v"]) || isset($this->options["verbose"])){
			echo "Looking for png files...\n";
		}
		$cpt = 0;
		$resource_dir = opendir($this->argv[count($this->argv) - 1]);
		while (false !== ($file = readdir($resource_dir))){
			if ($file[0] != "."){
				$dir[$cpt] = $file;
			}
			$cpt++;
		}
		$dir_path = $this->argv[count($this->argv) - 1];
		if (isset($options["r"]) || isset($options["recursive"])){
			$paths_tab = $this->get_recursive_files($dir, $dir_path);
		}
		else {
			$paths_tab = array();
			$cpt = 0;
			foreach($dir as $value){
				if (is_file("./$dir_path/$value")){
					$fopen = finfo_open(FILEINFO_MIME);
					$data = finfo_file($fopen, "./$dir_path/$value");
					$data = explode("/", $data);
					$data = $data[1];
					$data = explode(";", $data);
					$data = $data[0];
					if ($data = "png"){
						$paths_tab[$cpt] = "./$dir_path/$value";
						$cpt++;
					}
				}
			}
		}
		return $paths_tab;
	}

//same as above but recursive
	public function get_recursive_files($dir, $dir_path){
		global $paths_tab;
		static $cpt = 0;
		foreach($dir as $value){
			if (is_file("$dir_path/$value")){
				$fopen = finfo_open(FILEINFO_MIME);
				$data = finfo_file($fopen, "./$dir_path/$value");
				$data = explode("/", $data);
				$data = $data[1];
				$data = explode(";", $data);
				$data = $data[0];
				if ($data = "png"){
					$paths_tab[$cpt] = "./$dir_path/$value";
					$cpt++;
				}
			}
			elseif (is_dir("$dir_path/$value")){
				$cpt = 0;
				$resource_dir = opendir("$dir_path/$value");
					while (false !== ($file = readdir($resource_dir))){
						if ($file[0] != "."){
							$tab[$cpt] = $file;
							$cpt++;
						}
					}
				foreach ($tab as &$value2){
					$value2 = "$value/$value2";
				}
				$this->get_recursive_files($tab, $dir_path);
			}
		}
		return $paths_tab;
	}

//Return the width/height size of the output_image
	public function get_output_size($paths_tab, $padding, $column){
		if (isset($this->options["v"]) || isset($this->options["verbose"])){
			echo "Calculatin the sprite size...\n";
		}
		$output_width = 0;
		$output_height = array ();
		$cpt = 0;
		foreach($paths_tab as $value){
			$size = getimagesize($value);
			$output_width += $size[0];
			$output_width += $padding;
			$output_height[$cpt] = $size[1];
			$cpt++;
		}
		rsort($output_height);
		$output_size = array($output_width, $output_height[0]);
		if ($column == 1000){
			return $output_size;
		}
		$output_size[1] = 0;
		$tmp_tab = array();
		$cpt_tab = 0;
		$cpt = 0;
		foreach($paths_tab as $value){
			if ($cpt % $column === 0 && $cpt != 0){
				$cpt_tab++;
			}
			$tmp_tab[$cpt_tab][$cpt] = $value;
			$cpt++;
		}
		$cpt = 0;
		foreach($tmp_tab as &$value){
			foreach ($value as &$value2) {
				$size = $this->get_img_size($value2);
				$value2 = $size[1];
			}
		}
		$cpt = 0;
		foreach ($tmp_tab as &$value) {
			rsort($value);
			$output_size[1] += $value[0];
			$output_size[1] += $padding;
			$this->row_heights[$cpt] = $value[0];
			$this->row_heights[$cpt] += $padding;
			$cpt++;
		}
		return $output_size;
	}
	//Return a width/height array of the size of an image
	public function get_img_size($path){
		$size = getimagesize($path);
		return $size;
	}

//Final function that create the sprite.png
	public function create_img($output_size, $paths_tab, $name, $padding, $column){
		if (isset($this->options["v"]) || isset($this->options["verbose"])){
			echo "Creating the sprite...\n";
		}
		if (file_exists("./$name")){
			echo "There already is a file named $name ! Do you want to erase it ? (e) or rename your sprite ? (r)\n";
			$bool = false;
			while ($bool == false){
				$input = trim(fgets(STDIN));
				if ($input == "e" || $input == "r"){
					$bool = true;
				}
				else {
					echo "Please enter a valid answer (e) or (r)\n";
				}
			}
			if ($input == "r"){
				echo "Please enter a new name for your sprite\n";
				$input = trim(fgets(STDIN));
				$name = $input;
			}
		}
		$height_cale = 0;
		$cpt = 0;
		$cpt_cales = 0;
		$img = imagecreatetruecolor($output_size[0], $output_size[1]);
		$output = fopen("./$name", 'w+');
		$cale = 0;
		foreach ($paths_tab as $value){
			if ($column != 1000){
				if ($cpt % $column === 0 && $cpt != 0){
					$height_cale += $this->row_heights[$cpt_cales];
					$cpt_cales++;
					$cale = 0;
				}
			}
			$cpt++;
			$src = imagecreatefrompng($value);
			$size = $this->get_img_size($value);
			imagecopy($img, $src, $cale, $height_cale, 0, 0, $size[0], $size[1]);
			$cale += $size[0];
			$cale += $padding;
		}
		imagepng($img, $output);
	}

	//Create a css stylesheet for the sprite;
	public function create_sheet($output_size, $paths_tab, $name, $padding, $sprite, $column){
		if (isset($this->options["v"]) || isset($this->options["verbose"])){
			echo "Creating the stylesheet...\n";
		}
		if (file_exists("./$name")){
			echo "There already is a file named $name ! Do you want to erase it ? (e) or rename your stylesheet ? (r)\n";
			$bool = false;
			while ($bool == false){
				$input = trim(fgets(STDIN));
				if ($input == "e" || $input == "r"){
					$bool = true;
				}
				else {
					echo "Please enter a valid answer (e) or (r)\n";
				}
			}
			if ($input == "r"){
				echo "Please enter a new name for your stylesheet\n";
				$input = trim(fgets(STDIN));
				$name = $input;
			}
		}
		$output = fopen("./$name", 'w+');
		$css_sprite = "";
		$cale = 0;
		$height_cale = 0;
		$cpt = 0;
		$cpt_cales = 0;
		foreach ($paths_tab as $value) {
			if ($column != 1000){
				if ($cpt % $column === 0 && $cpt != 0){
					$height_cale += $this->row_heights[$cpt_cales];
					$cpt_cales++;
					$cale = 0;
				}
			}
			$cpt++;
			$size = $this->get_img_size($value);
			$filename = explode("/", $value);
			$filename = $filename[count($filename) - 1];
			$filename = explode(".", "$filename");
			$filename = $filename[0];
			$css_sprite .= "#$filename {
	background : url(\"./$sprite\") no-repeat;
	background-position : -$cale -$height_cale;
	width : $size[0]"."px;
	height : $size[1]"."px;
";
			if (isset($this->options["b"]) || isset($this->options["bounce"])){
				$css_sprite .= "	animation : move 2s;
	position : relative;\n";
			}
			$css_sprite .= "}\n";
		$cale += $size[0];
		$cale += $padding;
		}
		if (isset($this->options["b"]) || isset($this->options["bounce"])){
			$css_sprite .= file_get_contents("./.css");
		}
		fwrite($output, $css_sprite);
		$this->output = $output;
	}

//destroy the tmp files
	public function destroy_tmp($paths_tab){
		if (isset($this->options["v"]) || isset($this->options["verbose"])){
			echo "Destroying temporary files...\n";
		}
		foreach($paths_tab as $value){
			unlink($value);
		}
	}

//apply a filter to the outcoming sprite
	public function effect($effect, $outputName, $outputSize){
		if (isset($this->options["v"]) || isset($this->options["verbose"])){
			echo "Applying effect...\n";
		}
		$img = imagecreatefrompng("./$outputName");
		switch ($effect) {
			case 'negate':
				imagefilter($img, IMG_FILTER_NEGATE);
				break;
			
			case 'grayscale':
				imagefilter($img, IMG_FILTER_GRAYSCALE);
				break;

			case 'emboss' :
				imagefilter($img, IMG_FILTER_EMBOSS);
				break;

			case 'blur' :
				imagefilter($img, IMG_FILTER_GAUSSIAN_BLUR);
				break;

			case 'sketchy' :
				imagefilter($img, IMG_FILTER_MEAN_REMOVAL);
				break;

			default:
				echo "Please enter a valid effect name (negate, grayscale, emboss, blur, sketchy).\n";
				return false;
				break;
		}
		imagepng($img, $outputName);
	}
}