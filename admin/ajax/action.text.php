<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		$codetitle = $_REQUEST['codetitle'];
		$textsection = $_REQUEST['textsection'];
		
		if(db_exist("select * from text where textsection = '$textsection'")){
			echo json_encode(array('msg'=>'Ya existe un parrafo con ese texto: '.$textsection));
		}else{
			$sql = "insert into text(codetitle, textsection) 
					values('$codetitle', '$textsection')";
			
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede insertar.'));
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codetext = $_GET['codetext'];
		
		$codetitle = $_REQUEST['codetitle'];
		$textsection = $_REQUEST['textsection'];
		
		if(db_exist("select * from text where textsection = '$textsection' and codetext <> '$codetext'")){
			echo json_encode(array('msg'=>'Ya existe el parrafo con ese texto: '.$textsection));
		}else{
			$sql = "update text set 
						codetitle='$codetitle',
						textsection='$textsection'
					where codetext='$codetext'";
		
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede actualizar.'));
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codetext = $_POST["codetext"];
		$sql = "delete from text where codetext = $codetext";
		$result = db_query($sql);
		
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar.'));
		}
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from text order by codetext asc");
		
		while ($datos = mysql_fetch_assoc($rs) ){
			
			$data[] = array ( 	   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codetext' => $datos['codetext'], 
			'codetitle' => $datos['codetitle'], 
			'textsection' => $datos['textsection']
			);

		}
		echo json_encode($data);
		
	}
	
?>