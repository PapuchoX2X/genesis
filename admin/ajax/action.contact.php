<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		$contactaddress = $_REQUEST['contactaddress'];
		$contactphone = $_REQUEST['contactphone'];
		$contactcel = $_REQUEST['contactcel'];
		$contactline = $_REQUEST['contactline'];
		$contactlocation = $_REQUEST['contactlocation'];
		
		$sql = "insert into contact(contactaddress, contactphone, contactcel, contactline, contactlocation) 
				values('$contactaddress', '$contactphone', '$contactcel', '$contactline' , '$contactlocation')";
		
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede insertar.'));
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codecontact = $_GET['codecontact'];
		
		$contactaddress = $_REQUEST['contactaddress'];
		$contactphone = $_REQUEST['contactphone'];
		$contactcel = $_REQUEST['contactcel'];
		$contactline = $_REQUEST['contactline'];
		$contactlocation = $_REQUEST['contactlocation'];
		
		$sql = "update contact set 
					contactaddress='$contactaddress',
					contactphone='$contactphone',
					contactcel='$contactcel',
					contactline='$contactline',
					contactlocation='$contactlocation'
				where codecontact='$codecontact'";
	
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede actualizar.'));
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codecontact = $_POST["codecontact"];
	
		$sql = "delete from contact where codecontact = $codecontact";
		$result = db_query($sql);
		
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar.'));
		}
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from contact order by codecontact asc");
		
		$data = array ();
		
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array ( 	   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codecontact' => $datos['codecontact'], 
			'contactaddress' => $datos['contactaddress'], 
			'contactphone' => $datos['contactphone'], 
			'contactcel' => $datos['contactcel'], 
			'contactline' => $datos['contactline'], 
			'contactlocation' => $datos['contactlocation']
			);

		}
		echo json_encode($data);
		
	}
	
?>