<?php session_start ();

require_once (dirname (__FILE__) . "/../admin/setup.php");

db_connect ();

/**
 * GET
 */
	
	if($_GET["option"]=='search') {
		
		$coursename = $_GET['term'];
		$rs = db_query("select * from course where codesubcategory != '1' and coursename like '%$coursename%' order by coursename asc");
		
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			$datas['id'] = $datos['codecourse']; 
			$datas['value'] = $datos['coursename']; 
			array_push($data, $datas); 
		}
		echo json_encode($data);
		
	}
	
?>