<?php

class HTML{
	// atributos de html
	public $title = "ADMINISTRACION WEB";
	public $icon = "resource/images/title_icons.png";
	
	public $contentType = 'text/html; charset=UTF-8';
	
	public function __construct () {}
	
	//funcion para modificar titulo
	public function setTitle ($title) {
		$this -> title = $title;
	}
	//funcion para modificar icono
	public function setIcon ($icon) {
		$this -> icon = $icon;
	}
	//tipo del contenido del html
	public function setContentType ($contentType) {
		$this -> contentType = $contentType;
	}
	//inicio del html
	public function init(){
		echo "\n<html>\n<head>";
		echo "\t<meta http-equiv=\"Content-Type\" content=\"" . $this -> contentType . "\" />\n";
		
		echo "\t<meta name=\"author\" content=\"JAZC Development\" />\n";
		echo "\t<meta name=\"copyright\" content=\"JAZC Development\" />\n\n";

		echo "\t<title>" . $this -> title . "</title>\n";
		
		echo "\t<link rel=\"icon\" href=\"". $this -> icon ."\" type=\"image/x-icon\" />\n";
		echo "\t<link rel=\"shortcut icon\" href=\"". $this -> icon ."\" type=\"image/x-icon\" />\n\n";
	
	}
	//java script => ya sea Ejm:jquery o extjs-> $path==ruta
	public function javaScript($path){
		echo "\n<script src=\"". $path ."\"></script>";
	}
	//java script =>metodos o funciones java script
	public function jscript($path){
		echo "\n<script language=\"javascript\" type=\"text/javascript\" src=\"$path\" ></script>";
	}
	//style =>para los stilos de la pagina .css
	public function style($path){
		echo "<link type=\"text/css\" rel=\"stylesheet\" href=\"$path\" />";
	}
	//fin de la cabecera y inicio del body
	public function endInit(){
		echo "\n<head>\n<body>";
	}
	
	//termina el html
	public function end () {
		echo "\n</body>\n</html>";
	}
	//derechos reserbados
	public function copyright () {
		echo "All Right Reserved &copy; 2014 by JAZC-SIA Development";
	}
	
	
}

?>