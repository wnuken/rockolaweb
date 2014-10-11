<?php
class rockola {

var $paths = array();

public function dirList($params){
	$ruta = $params;
	$artist = 0;
	$gender = 0;
	$paths = array();
if (is_dir($ruta)) {
	if ($dh = opendir($ruta)) {
		while (($file = readdir($dh)) !== false) {
			if (is_dir($ruta . $file) && $file!="." && $file!=".."){
				//$this->paths[$ruta][] = $file;
				//echo  $ruta . $file;
				$this->dirList($ruta . $file . "/");
			}else if($file!="." && $file!=".."){
				//$this->paths[$ruta] = $file;
				//$conv = $ruta;
				//$lent = strlen($ruta);
				//$conv = substr($ruta, 0, ($lent-4));
				$artistarray = explode('/', $ruta);
				if(isset($artistarray[3])){
					$gender = $artistarray[2];
					$artist = $artistarray[3];
				}
				
				$this->paths[$gender]['gender'] = $gender;
				$this->paths[$gender][$artist]['artist'] = $artist;
				$this->paths[$gender][$artist][] = $ruta . $file;
			}
		}
		closedir($dh);
	}
}else{
	//echo "<br>No es ruta valida";
}

	$result[] = $this->paths;


return $result;

} 



}