<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		if ($_FILES["bannerimg"]["error"] > 0){							
			echo json_encode(array('msg'=>'Seleccione una imagen.'));
		} else {
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			$limite_kb = 10000000;
			
			$partes_nombre = explode('.', $_FILES['bannerimg']['name']);
			$extension = end( $partes_nombre );
				
			if (in_array($_FILES['bannerimg']['type'], $permitidos) && $_FILES['bannerimg']['size'] <= $limite_kb * 1024){
				$nro = rand(1, 1000);
				$imgname = "banner_".$nro;
				$ruta = "../resource/images/" .$imgname.".".$extension;
				$resultado = @move_uploaded_file($_FILES["bannerimg"]["tmp_name"], $ruta);
				if ($resultado){
					$img = $imgname.".".$extension;
					$sql = "insert into banner(bannerimg) 
							values('$img')";
		
					$result = db_query($sql);
					if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede insertar.'));
					}
				}else{
					echo json_encode(array('msg'=>'No se puede subir la imagen: '.$_FILES['bannerimg']['name'].''));
				}
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codebanner = $_GET['codebanner'];
	
		$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
		$limite_kb = 10000000;
		
		$partes_nombre = explode('.', $_FILES['bannerimg']['name']);
		$extension = end( $partes_nombre );
		
		if (in_array($_FILES['bannerimg']['type'], $permitidos) && $_FILES['bannerimg']['size'] <= $limite_kb * 1024){
			$nro = rand(1, 10000000);
			$imgname = "banner_".$nro;
			$ruta = "../resource/images/" .$imgname.".".$extension;
			//
			$row = (mysqli_fetch_array(db_query("select bannerimg from banner where codebanner='".$codebanner."'")));			
			if($row['bannerimg'] == "sin_img.png"){
				$img1 = "img".$img1;
				
			}else{
				$img1 = $row['bannerimg'];
			}
			$foto = "../resource/images/".$img1;
			if (file_exists($foto)){ unlink ($foto); }else{}
			//
			$resultado = @move_uploaded_file($_FILES["bannerimg"]["tmp_name"], $ruta);
			if ($resultado){
				$img = $imgname.".".$extension;
				$sql = "update banner set 
							bannerimg='$img'
				where codebanner='$codebanner'";
			
				$result = db_query($sql);
				if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede insertar.'));
					}
			}else{
				echo json_encode(array('msg'=>'Esta imagen ya existe: '.$_FILES['bannerimg']['name'].''));
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codebanner = $_POST["codebanner"];
		
		$row = (mysqli_fetch_array(db_query("select bannerimg from banner where codebanner='".$codebanner."'")));			
		$imagen1 = $row['bannerimg'];	
		if($row['bannerimg'] == "sin_img.png"){
			
		}else{
			$foto = "../resource/images/".$imagen1;
			unlink ($foto);
		}
			
		$sql = "delete from banner where codebanner = $codebanner";
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar este banner.'));
		}			
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from banner order by codebanner asc");
		
		$data = array ();
		
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array ( 	   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codebanner' => $datos['codebanner'], 
			'bannerimg' => $datos['bannerimg']
			);

		}
		echo json_encode($data);	
	}
	
?>