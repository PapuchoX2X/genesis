<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		$titlegname = $_REQUEST['titlegname'];
		
		if(db_exist("select * from titleg where titlegname = '$titlegname'")){
			echo json_encode(array('msg'=>'Ya existe el titulo: '.$titlegname));
		}else{
			$sql = "insert into titleg(titlegname) 
					values('$titlegname')";
			
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede insertar.'));
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codetitleg = $_GET['codetitleg'];
		
		$titlegname = $_REQUEST['titlegname'];
		
		if(db_exist("select * from titleg where titlegname = '$titlegname' and codetitleg <> '$codetitleg'")){
			echo json_encode(array('msg'=>'Ya existe el titulo0: '.$titlegname));
		}else{
			$sql = "update titleg set 
						titlegname='$titlegname'
					where codetitleg='$codetitleg'";
		
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede actualizar.'));
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codetitleg = $_POST["codetitleg"];
	
		$sql = "delete from titleg where codetitleg = $codetitleg";
		$result = db_query($sql);
		
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar.'));
		}
			
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from titleg order by codetitleg asc");
		
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array ( 	   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codetitleg' => $datos['codetitleg'], 
			'titlegname' => $datos['titlegname']
			);

		}
		echo json_encode($data);
		
	}
	
?>