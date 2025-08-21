<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
			 	 	 	 	 	 	 	 	 	 	
		$categoryname = $_REQUEST['categoryname']; 
		
		if(db_exist("select * from category where categoryname = '$categoryname'")){
			echo json_encode(array('msg'=>'Ya existe la categoria '.$categoryname));
		}else{
			//if ($_FILES["categoryimg"]["error"] > 0){				
				$sql = "insert into category(categoryname, categoryimg) 
									 values('$categoryname', 'sin_img.png')";
			
				$result = db_query($sql);
				if ($result){
					echo json_encode(array('success'=>true));
				} else {
					echo json_encode(array('msg'=>'No se puede insertar.'));
				}
			/*} else {
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
				$limite_kb = 10000000;
				
				$partes_nombre = explode('.', $_FILES['categoryimg']['name']);
				$extension = end( $partes_nombre );
					
				if (in_array($_FILES['categoryimg']['type'], $permitidos) && $_FILES['categoryimg']['size'] <= $limite_kb * 1024){
					$nro = rand(1, 10000000);
					$imgname = "img_".$nro;
					$ruta = "../resource/images/category/" .$imgname.".".$extension;
					$resultado = @move_uploaded_file($_FILES["categoryimg"]["tmp_name"], $ruta);
					if ($resultado){
						$img = $imgname.".".$extension;
						$sql = "insert into category(categoryname, categoryimg) 
									 values('$categoryname', '$img')";
			
						$result = db_query($sql);
						if ($result){
							echo json_encode(array('success'=>true));
						} else {
							echo json_encode(array('msg'=>'No se puede insertar.'));
						}
					}else{
						echo json_encode(array('msg'=>'No se puede subir la imagen: '.$_FILES['categoryimg']['name'].''));
					}
				}
			}*/
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codecategory = $_GET['codecategory'];
			 	 	 	 	 	 	 	 	 	 	
		$categoryname = $_REQUEST['categoryname'];
		
		if(db_exist("select * from category where categoryname = '$categoryname' and codecategory <> '$codecategory'")){
			echo json_encode(array('msg'=>'Ya existe la category '.$categoryname));
		}else{
			//if ($_FILES["categoryimg"]["error"] > 0){				
				$sql = "update category set 
							categoryname='$categoryname'
						where codecategory='$codecategory'";
				$result = db_query($sql);
				if ($result){
					echo json_encode(array('success'=>true));
				} else {
					echo json_encode(array('msg'=>'No se puede actualizar.'));
				}
			/*} else {
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
				$limite_kb = 10000000;
				
				$partes_nombre = explode('.', $_FILES['categoryimg']['name']);
				$extension = end( $partes_nombre );
				
				if (in_array($_FILES['categoryimg']['type'], $permitidos) && $_FILES['categoryimg']['size'] <= $limite_kb * 1024){
					$nro = rand(1, 10000000);
					$imgname = "img_".$nro;
					$ruta = "../resource/images/category/" .$imgname.".".$extension;
					//
					$row = (mysqli_fetch_array(db_query("select categoryimg from category where codecategory='".$codecategory."'")));			
					if($row['categoryimg'] == "sin_img.png"){
						$img1 = "img".$img1;
						
					}else{
						$img1 = $row['categoryimg'];
					}
					$foto = "../resource/images/category/".$img1;
					if (file_exists($foto)){ unlink ($foto); }else{}
					//
					$resultado = @move_uploaded_file($_FILES["categoryimg"]["tmp_name"], $ruta);
					if ($resultado){
						$img = $imgname.".".$extension;
						$sql = "update category set 
									categoryname='$categoryname',
									categoryimg='$img'
								where codecategory='$codecategory'";
					
						$result = db_query($sql);
						if ($result){
							echo json_encode(array('success'=>true));
						} else {
							echo json_encode(array('msg'=>'No se puede actualizar.'));
						}
					}else{
						echo json_encode(array('msg'=>'Esta imagen ya existe: '.$_FILES['categoryimg']['name'].''));
					}
				}
			}*/
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codecategory = $_POST["codecategory"];
		/*
		$row = (mysqli_fetch_array(db_query("select categoryimg from category where codecategory='$codecategory'")));			
		$imagen1 = $row['categoryimg'];	
		if($row['categoryimg'] == "sin_img.png"){
			
		}else{
			$foto = "../resource/images/category/".$imagen1;
			unlink ($foto);
		}
		*/
		$sql = "delete from category where codecategory = '$codecategory'";
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar la categoria.'));
		}			
	}
	
	if($_GET["option"]=='show') {
		
		$codeuser = $_SESSION['codeuser'];
		
		$rs = db_query("select * from category where codecategory != '1' order by categoryname asc");
		
		$data = array ();
		
		while ($datos = mysqli_fetch_assoc($rs) ){
				 	 	 	 	 	
			$data[] = array (  	 	 	 	 	 	 	 	 	 	 	 		   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
				'codecategory' => $datos['codecategory'], 
				'categoryname' => $datos['categoryname'], 
				'categoryimg' => $datos['categoryimg']
			);

		}
		echo json_encode($data);
	}
	
?>