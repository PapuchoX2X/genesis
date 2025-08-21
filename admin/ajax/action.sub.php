<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
			 	 	 	 	 	 	 	 	 	 	
		$codecategory = $_GET['codecategory']; 
		$subcategoryname = $_REQUEST['subcategoryname']; 
		
		if(db_exist("select * from subcategory where codecategory = '$codecategory' and subcategoryname = '$subcategoryname'")){
			echo json_encode(array('msg'=>'Ya existe la subcategoria '.$subcategoryname.' en la categoria'));
		}else{
					
			$sql = "insert into subcategory(codecategory, subcategoryname) 
								 values('$codecategory', '$subcategoryname')";
		
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede insertar.'));
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codesubcategory = $_GET['codesubcategory'];
		$codecategory = $_GET['codecategory'];
			 	 	 	 	 	 	 	 	 	 	
		$subcategoryname = $_REQUEST['subcategoryname'];
		
		if(db_exist("select * from subcategory where codecategory = '$codecategory' and subcategoryname = '$subcategoryname' and codesubcategory <> '$codesubcategory'")){
			echo json_encode(array('msg'=>'Ya existe la subcategory '.$categoryname.' en la categoria'));
		}else{
			$sql = "update subcategory set 
						subcategoryname='$subcategoryname'
					where codesubcategory='$codesubcategory'";
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede actualizar.'));
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codesubcategory = $_POST["codesubcategory"];
		
		$sql = "delete from subcategory where codesubcategory = '$codesubcategory'";
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar la subcategoria.'));
		}			
	}
	
	if($_GET["option"]=='show') {
		
		$codeuser = $_SESSION['codeuser'];
		
		$rs = db_query("select * from subcategory where codesubcategory != '1' order by subcategoryname asc");
		
		$data = array ();
		
		while ($datos = mysqli_fetch_assoc($rs) ){
				 	 	 	 	 	
			$data[] = array (  	 	 	 	 	 	 	 	 	 	 	 		   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
				'codesubcategory' => $datos['codesubcategory'], 
				'codecategory' => $datos['codecategory'], 
				'subcategoryname' => $datos['subcategoryname']
			);

		}
		echo json_encode($data);
	}
	
	if($_GET["option"]=='show_code') {
		
		$codeuser = $_SESSION['codeuser'];
		$codecategory = $_GET['codecategory'];
		
		//$rs = db_query("select * from subcategory where codesubcategory != '1' order by subcategoryname asc");
		$rs = db_query("select * from subcategory where codesubcategory != '1' and codecategory = '$codecategory' order by subcategoryname asc");
		
		$data = array ();
		
		while ($datos = mysqli_fetch_assoc($rs) ){
				 	 	 	 	 	
			$data[] = array (  	 	 	 	 	 	 	 	 	 	 	 		   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
				'codesubcategory' => $datos['codesubcategory'], 
				'codecategory' => $datos['codecategory'], 
				'subcategoryname' => $datos['subcategoryname']
			);

		}
		echo json_encode($data);
	}
	
?>