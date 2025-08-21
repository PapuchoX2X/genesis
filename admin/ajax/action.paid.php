<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	
	if($_GET["option"]=='pay') {
	
		
		$codedetail = $_POST['codedetail'];
		
		$sql = "update detail set 
				detailstate='PAGADO'
		where codedetail='$codedetail'";
	
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede realizar el pago.'));
		}
					
	}
	
	if($_GET["option"]=='cancel') {
	
		
		$codedetail = $_POST['codedetail'];
		
		$sql = "update detail set 
				detailstate='ANULADO'
		where codedetail='$codedetail'";
	
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede anular.'));
		}
					
	}
	
	if($_GET["option"]=='delete') {
	
		$codecourse = $_POST["codecourse"];
		
		$row = (mysqli_fetch_array(db_query("select courseimg from course where codecourse='$codecourse'")));			
		$imagen1 = $row['courseimg'];	
		if($row['courseimg'] == "sin_img.png"){
			
		}else{
			$foto = "../resource/images/course/".$imagen1;
			unlink ($foto);
		}
			
		$sql = "delete from course where codecourse = $codecourse";
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar el curso.'));
		}	
	}
	
	if($_GET["option"]=='url') {
	
		$codecourse = $_GET['codecourse'];
		
		$urlname = $_REQUEST['urlname'];
		
		if(db_exist("select * from url where codecourse = '$codecourse'")){
			$sql = "update url set 
						urlname='$urlname'
					where codecourse='$codecourse'";
		
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede actualizar.'));
			}
		}else{
			$sql = "insert into url(codecourse, urlname) 
						values('$codecourse', '$urlname')";
				
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se registrar la url.'));
			}
		}
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from course order by codecourse asc");
		
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array ( 	  	 	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codecourse' => $datos['codecourse'], 
			'codecategory' => $datos['codecategory'], 
			'coursename' => $datos['coursename'], 
			'coursedesc' => $datos['coursedesc'], 
			'courseinit' => $datos['courseinit'], 
			'courseday' => $datos['courseday'], 
			'coursetime' => $datos['coursetime'], 
			'coursemode' => $datos['coursemode'], 
			'coursephone' => $datos['coursephone'], 
			'courseprice' => $datos['courseprice'], 
			'coursedscto' => $datos['coursedscto'], 
			'courseinstitute' => $datos['courseinstitute'], 
			'coursefooter' => $datos['coursefooter'],
			'courseimg' => $datos['courseimg']
			);

		}
		echo json_encode($data);
		
	}
	
?>