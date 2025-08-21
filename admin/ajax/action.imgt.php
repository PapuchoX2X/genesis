<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		$codetitle = $_REQUEST['codetitle'];
		
		if ($_FILES["imgtname"]["error"] > 0){							
			echo json_encode(array('msg'=>'Seleccione una imagen.'));
		} else {
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			$limite_kb = 10000000;
			
			$partes_nombre = explode('.', $_FILES['imgtname']['name']);
			$extension = end( $partes_nombre );
				
			if (in_array($_FILES['imgtname']['type'], $permitidos) && $_FILES['imgtname']['size'] <= $limite_kb * 1024){
				$nro = rand(1, 1000);
				$imgname = "h_".$nro;
				$ruta = "../resource/images/" .$imgname.".".$extension;
				$resultado = @move_uploaded_file($_FILES["imgtname"]["tmp_name"], $ruta);
				if ($resultado){
					$img = $imgname.".".$extension;
					$sql = "insert into imgt(codetitle, imgtname) 
							values('$codetitle', '$img')";
		
					$result = db_query($sql);
					if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede insertar.'));
					}
				}else{
					echo json_encode(array('msg'=>'No se puede subir la imagen: '.$_FILES['imgtname']['name'].''));
				}
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codeimgt = $_GET['codeimgt'];
		$codetitle = $_REQUEST['codetitle'];
		
		$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
		$limite_kb = 10000000;
		
		$partes_nombre = explode('.', $_FILES['imgtname']['name']);
		$extension = end( $partes_nombre );
		
		if (in_array($_FILES['imgtname']['type'], $permitidos) && $_FILES['imgtname']['size'] <= $limite_kb * 1024){
			$nro = rand(1, 10000000);
			$imgname = "h_".$nro;
			$ruta = "../resource/images/" .$imgname.".".$extension;
			//
			$row = (mysqli_fetch_array(db_query("select imgtname from imgt where codeimgt='".$codeimgt."'")));			
			if($row['imgtname'] == "sin_img.png"){
				$img1 = "img".$img1;
				
			}else{
				$img1 = $row['imgtname'];
			}
			$foto = "../resource/images/".$img1;
			if (file_exists($foto)){ unlink ($foto); }else{}
			//
			$resultado = @move_uploaded_file($_FILES["imgtname"]["tmp_name"], $ruta);
			if ($resultado){
				$img = $imgname.".".$extension;
				$sql = "update imgt set 
							codetitle='$codetitle',
							imgtname='$img'
				where codeimgt='$codeimgt'";
			
				$result = db_query($sql);
				if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede insertar.'));
					}
			}else{
				echo json_encode(array('msg'=>'Esta imagen ya existe: '.$_FILES['imgtname']['name'].''));
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codeimgt = $_POST["codeimgt"];
		
		$row = (mysqli_fetch_array(db_query("select imgtname from imgt where codeimgt='".$codeimgt."'")));			
		$imagen1 = $row['imgtname'];	
		if($row['imgtname'] == "sin_img.png"){
			
		}else{
			$foto = "../resource/images/".$imagen1;
			unlink ($foto);
		}
			
		$sql = "delete from imgt where codeimgt = $codeimgt";
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar este imgt.'));
		}			
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from imgt order by codeimgt asc");
		
		$data = array ();
		
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array ( 	   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codeimgt' => $datos['codeimgt'], 
			'codetitle' => $datos['codetitle'], 
			'imgtname' => $datos['imgtname']
			);

		}
		echo json_encode($data);	
	}
	
?>