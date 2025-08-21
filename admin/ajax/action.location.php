<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
			 	 	 	 	 	 	 	 	 	 	
		$locationurl = $_REQUEST['locationurl']; 
		
		$sql = "insert into location(locationurl) 
							 values('$locationurl')";
	
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede insertar.'));
		}
		
	}
	
	if($_GET["option"]=='update') {
	
		$codelocation = $_GET['codelocation'];
			 	 	 	 	 	 	 	 	 	 	
		$locationurl = $_REQUEST['locationurl'];
		
		$sql = "update location set 
					locationurl='$locationurl'
				where codelocation='$codelocation'";
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede actualizar.'));
		}
		
	}
	
	if($_GET["option"]=='delete') {
	
		$codelocation = $_POST["codelocation"];
		
		$sql = "delete from location where codelocation = '$codelocation'";
		$result = db_query($sql);
		
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar la certificacion.'));
		}			
	}
	
	if($_GET["option"]=='show') {
		
		$codeuser = $_SESSION['codeuser'];
		
		$rs = db_query("select * from location order by codelocation asc");
		
		$data = array ();
		
		while ($datos = mysqli_fetch_assoc($rs) ){
				 	 	 	 	 	
			$data[] = array (  	 	 	 	 	 	 	 	 	 	 	 		   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
				'codelocation' => $datos['codelocation'], 
				'locationurl' => $datos['locationurl']
			);

		}
		echo json_encode($data);
	}
	
?>