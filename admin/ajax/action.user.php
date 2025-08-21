<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		$username = $_REQUEST['username'];
		$usertype = $_REQUEST['usertype'];
		$userlogin = $_REQUEST['userlogin'];
		$userpassword = $_REQUEST['userpassword'];
		
		if(db_exist("select * from user where userlogin = '$userlogin'")){
			echo json_encode(array('msg'=>'Ya existe el usuario con ese login: '.$userlogin));
		}else{
			$sql = "insert into user(username, usertype, userlogin, userpassword ) 
					values('$username', '$usertype', '$userlogin', '$userpassword')";
			
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede insertar.'));
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codeuser = $_GET['codeuser'];
		
		$username = $_REQUEST['username'];
		$usertype = $_REQUEST['usertype'];
		$userlogin = $_REQUEST['userlogin'];
		$userpassword = $_REQUEST['userpassword'];
		
		if(db_exist("select * from user where userlogin = '$userlogin' and codeuser <> '$codeuser'")){
			echo json_encode(array('msg'=>'Ya existe el usuario con ese login: '.$userlogin));
		}else{
			$sql = "update user set 
						username='$username',
						usertype='$usertype',
						userlogin='$userlogin',
						userpassword='$userpassword'
					where codeuser='$codeuser'";
		
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede actualizar.'));
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codeuser = $_POST["codeuser"];
		if($codeuser == 1){
			echo json_encode(array('msg'=>'No se puede eliminar a este usuario.'));
		}else{
			$sql = "delete from user where codeuser = $codeuser";
			$result = db_query($sql);
			
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede eliminar.'));
			}
		}
			
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from user order by codeuser asc");
		
		while ($datos = mysql_fetch_assoc($rs) ){
			
			$data[] = array ( 	   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codeuser' => $datos['codeuser'], 
			'username' => $datos['username'], 
			'usertype' => $datos['usertype'], 
			'userlogin' => $datos['userlogin'], 
			'userpassword' => $datos['userpassword'] 
			);

		}
		echo json_encode($data);
		
	}
	
?>