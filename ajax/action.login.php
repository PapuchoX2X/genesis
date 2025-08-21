<?php session_start ();
require_once (dirname (__FILE__) . "/../admin/setup.php");
db_connect ();

/**
 * GET
 */
	if($_GET["option"] == 'valid') {
		
		$personmail = $_POST['personmail'];
		$personpassword = $_POST['personpassword'];
				
		$sql_valid ="select * from person where personmail = '$personmail' and personpassword = '$personpassword'";
	
		if (db_exist($sql_valid)){
			$row = db_fetch_array (db_query($sql_valid));
			list ($codeperson, $personname, $personphone, $personmail, $personpassword, $persontype, $personcode, $personstate) = $row;
			echo json_encode(array('success'=>true, 'type'=>$persontype));
			
			$_SESSION [ 'codeperson' ] = $codeperson ; 
			
		}
		else{
			echo json_encode(array('msg'=>'No existe el usuario con ese email y contraseña.'));
		}
		
	}

?>