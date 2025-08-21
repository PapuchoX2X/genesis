<?php session_start ();
require_once (dirname (__FILE__) . "/../setup.php");
db_connect ();

/**
 * GET
 */
	if($_GET["option"] == 'valid') {
	
		$_SESSION [ 'index' ] = 1 ; 
		
		$userlogin = $_POST['userlogin'];
		$userpassword = $_POST['userpassword'];
				
		$sql_valid ="select * from user where userlogin = '$userlogin' and userpassword = '$userpassword'";
	
		if (db_exist($sql_valid)){
			$row = db_fetch_array (db_query($sql_valid));
			list ($codeuser, $username, $usertype, $userlogin, $userpassword) = $row;
			
			echo json_encode(array('success'=>true, 'type'=>$usertype));
			
			$_SESSION [ 'codeuser' ] = $codeuser ; 
			
		}
		else{
			
			echo json_encode(array('msg'=>'No Existe el Usuario.'));
			
		}
		
	}

?>