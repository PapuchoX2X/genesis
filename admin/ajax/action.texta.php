<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		$codetitlea = $_REQUEST['codetitlea'];
		$textasection = $_REQUEST['textasection'];
		
		if(db_exist("select * from texta where textasection = '$textasection'")){
			echo json_encode(array('msg'=>'Ya existe un parrafo con ese texto: '.$textasection));
		}else{
			$sql = "insert into texta(codetitlea, textasection) 
					values('$codetitlea', '$textasection')";
			
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede insertar.'));
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codetexta = $_GET['codetexta'];
		
		$codetitlea = $_REQUEST['codetitlea'];
		$textasection = $_REQUEST['textasection'];
		
		if(db_exist("select * from texta where textasection = '$textasection' and codetexta <> '$codetexta'")){
			echo json_encode(array('msg'=>'Ya existe el parrafo con ese texto: '.$textasection));
		}else{
			$sql = "update texta set 
						codetitlea='$codetitlea',
						textasection='$textasection'
					where codetexta='$codetexta'";
		
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede actualizar.'));
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codetexta = $_POST["codetexta"];
		$sql = "delete from texta where codetexta = $codetexta";
		$result = db_query($sql);
		
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar.'));
		}
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from texta order by codetexta asc");
		
		while ($datos = mysql_fetch_assoc($rs) ){
			
			$data[] = array ( 	   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codetexta' => $datos['codetexta'], 
			'codetitlea' => $datos['codetitlea'], 
			'textasection' => $datos['textasection']
			);

		}
		echo json_encode($data);
		
	}
	
?>