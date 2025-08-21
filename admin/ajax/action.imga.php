<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		$codetitlea = $_REQUEST['codetitlea'];
		
		if ($_FILES["imganame"]["error"] > 0){							
			echo json_encode(array('msg'=>'Seleccione una imagen.'));
		} else {
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			$limite_kb = 10000000;
			
			$partes_nombre = explode('.', $_FILES['imganame']['name']);
			$extension = end( $partes_nombre );
				
			if (in_array($_FILES['imganame']['type'], $permitidos) && $_FILES['imganame']['size'] <= $limite_kb * 1024){
				$nro = rand(1, 1000);
				$imgname = "sn_".$nro;
				$ruta = "../resource/images/" .$imgname.".".$extension;
				$resultado = @move_uploaded_file($_FILES["imganame"]["tmp_name"], $ruta);
				if ($resultado){
					$img = $imgname.".".$extension;
					$sql = "insert into imga(codetitlea, imganame) 
							values('$codetitlea', '$img')";
		
					$result = db_query($sql);
					if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede insertar.'));
					}
				}else{
					echo json_encode(array('msg'=>'No se puede subir la imagen: '.$_FILES['imganame']['name'].''));
				}
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codeimga = $_GET['codeimga'];
		$codetitlea = $_REQUEST['codetitlea'];
		
		$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
		$limite_kb = 10000000;
		
		$partes_nombre = explode('.', $_FILES['imganame']['name']);
		$extension = end( $partes_nombre );
		
		if (in_array($_FILES['imganame']['type'], $permitidos) && $_FILES['imganame']['size'] <= $limite_kb * 1024){
			$nro = rand(1, 1000);
			$imgname = "sn_".$nro;
			$ruta = "../resource/images/" .$imgname.".".$extension;
			//
			$row = (mysqli_fetch_array(db_query("select imganame from imga where codeimga='".$codeimga."'")));			
			if($row['imganame'] == "sin_img.png"){
				$img1 = "img".$img1;
				
			}else{
				$img1 = $row['imganame'];
			}
			$foto = "../resource/images/".$img1;
			if (file_exists($foto)){ unlink ($foto); }else{}
			//
			$resultado = @move_uploaded_file($_FILES["imganame"]["tmp_name"], $ruta);
			if ($resultado){
				$img = $imgname.".".$extension;
				$sql = "update imga set 
							codetitlea='$codetitlea',
							imganame='$img'
				where codeimga='$codeimga'";
			
				$result = db_query($sql);
				if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede insertar.'));
					}
			}else{
				echo json_encode(array('msg'=>'Esta imagen ya existe: '.$_FILES['imganame']['name'].''));
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codeimga = $_POST["codeimga"];
		
		$row = (mysqli_fetch_array(db_query("select imganame from imga where codeimga='".$codeimga."'")));			
		$imagen1 = $row['imganame'];	
		if($row['imganame'] == "sin_img.png"){
			
		}else{
			$foto = "../resource/images/".$imagen1;
			unlink ($foto);
		}
			
		$sql = "delete from imga where codeimga = $codeimga";
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar este imga.'));
		}			
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from imga order by codeimga asc");
		
		$data = array ();
		
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array ( 	   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codeimga' => $datos['codeimga'], 
			'codetitlea' => $datos['codetitlea'], 
			'imganame' => $datos['imganame']
			);

		}
		echo json_encode($data);	
	}
	
?>