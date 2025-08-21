<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		$codecourse = $_REQUEST['codecourse'];
		
		if ($_FILES["shortimg"]["error"] > 0){							
			echo json_encode(array('msg'=>'Seleccione una imagen.'));
		} else {
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			$limite_kb = 10000000;
			
			$partes_nombre = explode('.', $_FILES['shortimg']['name']);
			$extension = end( $partes_nombre );
				
			if (in_array($_FILES['shortimg']['type'], $permitidos) && $_FILES['shortimg']['size'] <= $limite_kb * 1024){
				$nro = rand(1, 1000);
				$imgname = "short_".$nro;
				$ruta = "../resource/images/" .$imgname.".".$extension;
				$resultado = @move_uploaded_file($_FILES["shortimg"]["tmp_name"], $ruta);
				if ($resultado){
					$img = $imgname.".".$extension;
					$sql = "insert into short(codecourse, shortimg) 
							values('$codecourse', '$img')";
		
					$result = db_query($sql);
					if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede insertar.'));
					}
				}else{
					echo json_encode(array('msg'=>'No se puede subir la imagen: '.$_FILES['shortimg']['name'].''));
				}
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codeshort = $_GET['codeshort'];
		$codecourse = $_REQUEST['codecourse'];
		if ($_FILES["shortimg"]["error"] > 0){							
			$sql = "update short set 
						codecourse='$codecourse'
					where codeshort='$codeshort'";
		
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede insertar.'));
			}
		} else {
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			$limite_kb = 10000000;
			
			$partes_nombre = explode('.', $_FILES['shortimg']['name']);
			$extension = end( $partes_nombre );
			
			if (in_array($_FILES['shortimg']['type'], $permitidos) && $_FILES['shortimg']['size'] <= $limite_kb * 1024){
				$nro = rand(1, 10000000);
				$imgname = "short_".$nro;
				$ruta = "../resource/images/" .$imgname.".".$extension;
				//
				$row = (mysqli_fetch_array(db_query("select shortimg from short where codeshort='".$codeshort."'")));			
				if($row['shortimg'] == "sin_img.png"){
					$img1 = "img".$img1;
					
				}else{
					$img1 = $row['shortimg'];
				}
				$foto = "../resource/images/".$img1;
				if (file_exists($foto)){ unlink ($foto); }else{}
				//
				$resultado = @move_uploaded_file($_FILES["shortimg"]["tmp_name"], $ruta);
				if ($resultado){
					$img = $imgname.".".$extension;
					$sql = "update short set 
								codecourse='$codecourse',
								shortimg='$img'
					where codeshort='$codeshort'";
				
					$result = db_query($sql);
					if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede insertar.'));
					}
				}else{
					echo json_encode(array('msg'=>'Esta imagen ya existe: '.$_FILES['shortimg']['name'].''));
				}
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codeshort = $_POST["codeshort"];
		
		$row = (mysqli_fetch_array(db_query("select shortimg from short where codeshort='".$codeshort."'")));			
		$imagen1 = $row['shortimg'];	
		if($row['shortimg'] == "sin_img.png"){
			
		}else{
			$foto = "../resource/images/".$imagen1;
			unlink ($foto);
		}
			
		$sql = "delete from short where codeshort = $codeshort";
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar este short.'));
		}			
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from short order by codeshort asc");
		
		$data = array ();
		
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array ( 	   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codeshort' => $datos['codeshort'], 
			'codecourse' => $datos['codecourse'], 
			'shortimg' => $datos['shortimg']
			);

		}
		echo json_encode($data);	
	}
	
?>