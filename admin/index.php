<?php session_start ();
require_once (dirname (__FILE__) . "/setup.php");
db_connect ();

$html = new HTML();
$html -> setContentType ('text/html; charset=UTF-8');
$html -> setIcon ('resource/images/logotipo.png');
$html -> init();
	
	$html -> style('./resource/style/themes/gray/easyui.css');
	
	$html -> style('./resource/style/themes/icon.css');
	$html -> style('./resource/style/themes/color.css');
	
	$html -> style('./resource/style/style.css');
	$html -> style('./resource/style/normalize.css');
	$html -> style('./resource/style/style_login.css?v=1.1');
	
	$html -> javaScript('./resource/jscript/ui/jquery.min.js');
	
	$html -> javaScript('./resource/jscript/ui/jquery.easyui.min.js');
	$html -> javaScript('./resource/jscript/ui/easyui-lang-es.js');
	
	$html -> jscript('./resource/jscript/function-login.js?v=1.0');
	
	
$html -> endInit();
	
	$_SESSION['index'] = 0;
	
	echo Temp:: content_login ();
	
$html -> end();
?>
