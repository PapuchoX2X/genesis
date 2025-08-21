<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");
db_connect ();

$html = new HTML();
$html -> setContentType ('text/html; charset=utf-8');
$html -> setIcon ('./../resource/images/logotipo.png');
$html -> init();
		
	$html -> style('./../resource/style/themes/gray/easyui.css');
	
	//$html -> style('./../resource/style/themes/mobile.css');
	
	$html -> style('./../resource/style/themes/icon.css');
	$html -> style('./../resource/style/themes/color.css');
	
	$html -> style('./../resource/style/font/css/font-awesome.min.css');
	
	$html -> style('./../resource/style/style.css');
	
	$html -> javaScript('./../resource/jscript/ui/jquery.min.js');
	
	$html -> javaScript('./../resource/jscript/ui/jquery.easyui.min.js');
	
	//$html -> javaScript('./../resource/jscript/ui/jquery.easyui.mobile.js');
	
	$html -> javaScript('./../resource/jscript/ui/easyui-lang-es.js');
	
	$html -> jscript('./../resource/jscript/function-tab4.js?v=1.8');
	
$html -> endInit();
	
	$index = $_SESSION [ 'index' ]; 
	$codeuser = $_SESSION [ 'codeuser' ];
	$_SESSION [ 'codeuser' ] = $codeuser ; 
	
	$row = db_fetch_array (db_query("select username from user where codeuser = '$codeuser'"));
	list ($username) = $row;
	
	if($index == 0){
		echo"<div><p style='text-align:center;margin-top:300px;font-size:16px;'>Volver a la Pagina Principal <a href='../index.php' style='color:blue;'>Volver</a></p></div>";
	}else{
		
		echo Temp:: form_ambience();
		
		echo Temp:: content_tab4($username);
	}
	
$html -> end();

?>
