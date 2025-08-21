<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		$ambiencename = $_REQUEST['ambiencename'];
		
		if ($_FILES["ambienceimg"]["error"] > 0){							
			echo json_encode(array('msg'=>'Seleccione una imagen.'));
		} else {
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			$limite_kb = 10000000;
			
			$partes_nombre = explode('.', $_FILES['ambienceimg']['name']);
			$extension = end( $partes_nombre );
				
			if (in_array($_FILES['ambienceimg']['type'], $permitidos) && $_FILES['ambienceimg']['size'] <= $limite_kb * 1024){
				$nro = rand(1, 1000);
				$imgname = "am_".$nro;
				$ruta = "../resource/images/" .$imgname.".".$extension;
				$resultado = @move_uploaded_file($_FILES["ambienceimg"]["tmp_name"], $ruta);
				if ($resultado){
					$img = $imgname.".".$extension;
					$sql = "insert into ambience(ambiencename, ambienceimg) 
							values('$ambiencename', '$img')";
		
					$result = db_query($sql);
					if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede insertar.'));
					}
				}else{
					echo json_encode(array('msg'=>'No se puede subir la imagen: '.$_FILES['ambienceimg']['name'].''));
				}
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codeambience = $_GET['codeambience'];
		$ambiencename = $_REQUEST['ambiencename'];
		
		$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
		$limite_kb = 10000000;
		
		$partes_nombre = explode('.', $_FILES['ambienceimg']['name']);
		$extension = end( $partes_nombre );
		
		if (in_array($_FILES['ambienceimg']['type'], $permitidos) && $_FILES['ambienceimg']['size'] <= $limite_kb * 1024){
			$nro = rand(1, 10000000);
			$imgname = "am_".$nro;
			$ruta = "../resource/images/" .$imgname.".".$extension;
			//
			$row = (mysqli_fetch_array(db_query("select ambienceimg from ambience where codeambience='".$codeambience."'")));			
			if($row['ambienceimg'] == "sin_img.png"){
				$img1 = "img".$img1;
				
			}else{
				$img1 = $row['ambienceimg'];
			}
			$foto = "../resource/images/".$img1;
			if (file_exists($foto)){ unlink ($foto); }else{}
			//
			$resultado = @move_uploaded_file($_FILES["ambienceimg"]["tmp_name"], $ruta);
			if ($resultado){
				$img = $imgname.".".$extension;
				$sql = "update ambience set 
							ambiencename='$ambiencename',
							ambienceimg='$img'
				where codeambience='$codeambience'";
			
				$result = db_query($sql);
				if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede insertar.'));
					}
			}else{
				echo json_encode(array('msg'=>'Esta imagen ya existe: '.$_FILES['ambienceimg']['name'].''));
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codeambience = $_POST["codeambience"];
		
		$row = (mysqli_fetch_array(db_query("select ambienceimg from ambience where codeambience='".$codeambience."'")));			
		$imagen1 = $row['ambienceimg'];	
		if($row['ambienceimg'] == "sin_img.png"){
			
		}else{
			$foto = "../resource/images/".$imagen1;
			unlink ($foto);
		}
			
		$sql = "delete from ambience where codeambience = $codeambience";
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar este ambience.'));
		}			
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from ambience order by codeambience asc");
		
		$data = array ();
		
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array ( 	   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codeambience' => $datos['codeambience'], 
			'ambiencename' => $datos['ambiencename'], 
			'ambienceimg' => $datos['ambienceimg']
			);

		}
		echo json_encode($data);	
	}
	
?>