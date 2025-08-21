<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		$codecourse = $_GET['codecourse'];
		$row_course = db_fetch_array (db_query("select coursename from course where codecourse = '$codecourse'"));
		list ($coursename) = $row_course;
		
		$lessonnro = $_REQUEST['lessonnro'];
		$lessonname = $_REQUEST['lessonname'];
		$lessondesc = $_REQUEST['lessondesc'];
		$lessonurl = $_REQUEST['lessonurl'];
		$lessonurldoc = $_REQUEST['lessonurldoc'];
			
		$sql = "insert into lesson(codecourse, lessoncourse, lessonnro, lessonname, lessondesc, lessonurl, lessonurldoc) 
				values('$codecourse', '$coursename', '$lessonnro', '$lessonname', '$lessondesc', '$lessonurl', '$lessonurldoc')";
				
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede insertar.'));
		}
	
	}
	
	if($_GET["option"]=='update') {
	
		$codelesson = $_GET['codelesson'];
		
		$lessonnro = $_REQUEST['lessonnro'];
		$lessonname = $_REQUEST['lessonname'];
		$lessondesc = $_REQUEST['lessondesc'];
		$lessonurl = $_REQUEST['lessonurl'];
		$lessonurldoc = $_REQUEST['lessonurldoc'];
				
		$sql = "update lesson set 
				lessonnro='$lessonnro',
				lessonname='$lessonname',
				lessondesc='$lessondesc',
				lessonurl='$lessonurl',
				lessonurldoc='$lessonurldoc'
			where codelesson='$codelesson'";

		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede actualizar.'));
		}	
	}
	
	if($_GET["option"]=='delete') {
	
		$codelesson = $_POST["codelesson"];
		
		$sql = "delete from lesson where codelesson = $codelesson";
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar la clase.'));
		}	
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from lesson order by codelesson asc");
		
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array (  	 	 	 	 	 	 		  	 	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codelesson' => $datos['codelesson'], 
			'codecourse' => $datos['codecourse'], 
			'lessoncourse' => $datos['lessoncourse'], 
			'lessonnro' => $datos['lessonnro'], 
			'lessonname' => $datos['lessonname'], 
			'lessondesc' => $datos['lessondesc'], 
			'lessonurl' => $datos['lessonurl'],
			'lessonurldoc' => $datos['lessonurldoc']
			);

		}
		echo json_encode($data);
		
	}
	
?>