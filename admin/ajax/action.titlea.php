<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		$titleaname = $_REQUEST['titleaname'];
		
		if(db_exist("select * from titlea where titleaname = '$titleaname'")){
			echo json_encode(array('msg'=>'Ya existe el titulo: '.$titleaname));
		}else{
			$sql = "insert into titlea(titleaname) 
					values('$titleaname')";
			
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede insertar.'));
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codetitlea = $_GET['codetitlea'];
		
		$titleaname = $_REQUEST['titleaname'];
		
		if(db_exist("select * from titlea where titleaname = '$titleaname' and codetitlea <> '$codetitlea'")){
			echo json_encode(array('msg'=>'Ya existe el titulo: '.$titleaname));
		}else{
			$sql = "update titlea set 
						titleaname='$titleaname'
					where codetitlea='$codetitlea'";
		
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede actualizar.'));
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codetitlea = $_POST["codetitlea"];
	
		$sql = "delete from titlea where codetitlea = $codetitlea";
		$result = db_query($sql);
		
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar.'));
		}
			
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from titlea order by codetitlea asc");
		
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array ( 	   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codetitlea' => $datos['codetitlea'], 
			'titleaname' => $datos['titleaname']
			);

		}
		echo json_encode($data);
		
	}
	
?>