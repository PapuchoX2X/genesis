<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		$titlename = $_REQUEST['titlename'];
		
		if(db_exist("select * from title where titlename = '$titlename'")){
			echo json_encode(array('msg'=>'Ya existe el titulo: '.$titlename));
		}else{
			$sql = "insert into title(titlename) 
					values('$titlename')";
			
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede insertar.'));
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codetitle = $_GET['codetitle'];
		
		$titlename = $_REQUEST['titlename'];
		
		if(db_exist("select * from title where titlename = '$titlename' and codetitle <> '$codetitle'")){
			echo json_encode(array('msg'=>'Ya existe el titulo: '.$titlename));
		}else{
			$sql = "update title set 
						titlename='$titlename'
					where codetitle='$codetitle'";
		
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede actualizar.'));
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codetitle = $_POST["codetitle"];
	
		$sql = "delete from title where codetitle = $codetitle";
		$result = db_query($sql);
		
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar.'));
		}
			
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from title order by codetitle asc");
		
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array ( 	   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codetitle' => $datos['codetitle'], 
			'titlename' => $datos['titlename']
			);

		}
		echo json_encode($data);
		
	}
	
?>