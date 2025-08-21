<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		if ($_FILES["logoimg"]["error"] > 0){							
			echo json_encode(array('msg'=>'Seleccione una imagen.'));
		} else {
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			$limite_kb = 10000000;
			
			$partes_nombre = explode('.', $_FILES['logoimg']['name']);
			$extension = end( $partes_nombre );
				
			if (in_array($_FILES['logoimg']['type'], $permitidos) && $_FILES['logoimg']['size'] <= $limite_kb * 1024){
				$nro = rand(1, 1000);
				$imgname = "logo_".$nro;
				$ruta = "../resource/images/" .$imgname.".".$extension;
				$resultado = @move_uploaded_file($_FILES["logoimg"]["tmp_name"], $ruta);
				if ($resultado){
					$img = $imgname.".".$extension;
					$sql = "insert into logo(logoimg) 
							values('$img')";
		
					$result = db_query($sql);
					if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede insertar.'));
					}
				}else{
					echo json_encode(array('msg'=>'No se puede subir la imagen: '.$_FILES['logoimg']['name'].''));
				}
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codelogo = $_GET['codelogo'];
	
		$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
		$limite_kb = 10000000;
		
		$partes_nombre = explode('.', $_FILES['logoimg']['name']);
		$extension = end( $partes_nombre );
		
		if (in_array($_FILES['logoimg']['type'], $permitidos) && $_FILES['logoimg']['size'] <= $limite_kb * 1024){
			$nro = rand(1, 10000000);
			$imgname = "logo_".$nro;
			$ruta = "../resource/images/" .$imgname.".".$extension;
			//
			$row = (mysqli_fetch_array(db_query("select logoimg from logo where codelogo='".$codelogo."'")));			
			if($row['logoimg'] == "sin_img.png"){
				$img1 = "img".$img1;
				
			}else{
				$img1 = $row['logoimg'];
			}
			$foto = "../resource/images/".$img1;
			if (file_exists($foto)){ unlink ($foto); }else{}
			//
			$resultado = @move_uploaded_file($_FILES["logoimg"]["tmp_name"], $ruta);
			if ($resultado){
				$img = $imgname.".".$extension;
				$sql = "update logo set 
							logoimg='$img'
				where codelogo='$codelogo'";
			
				$result = db_query($sql);
				if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede insertar.'));
					}
			}else{
				echo json_encode(array('msg'=>'Esta imagen ya existe: '.$_FILES['logoimg']['name'].''));
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codelogo = $_POST["codelogo"];
		
		$row = (mysqli_fetch_array(db_query("select logoimg from logo where codelogo='".$codelogo."'")));			
		$imagen1 = $row['logoimg'];	
		if($row['logoimg'] == "sin_img.png"){
			
		}else{
			$foto = "../resource/images/".$imagen1;
			unlink ($foto);
		}
			
		$sql = "delete from logo where codelogo = $codelogo";
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar este logo.'));
		}			
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from logo order by codelogo asc");
		
		$data = array ();
		
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array ( 	   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codelogo' => $datos['codelogo'], 
			'logoimg' => $datos['logoimg']
			);

		}
		echo json_encode($data);	
	}
	
?>