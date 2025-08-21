<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		$codetitleg = $_REQUEST['codetitleg'];
		
		if ($_FILES["imggname"]["error"] > 0){							
			echo json_encode(array('msg'=>'Seleccione una imagen.'));
		} else {
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			$limite_kb = 10000000;
			
			$partes_nombre = explode('.', $_FILES['imggname']['name']);
			$extension = end( $partes_nombre );
				
			if (in_array($_FILES['imggname']['type'], $permitidos) && $_FILES['imggname']['size'] <= $limite_kb * 1024){
				$nro = rand(1, 1000);
				$imgname = "ga_".$nro;
				$ruta = "../resource/images/" .$imgname.".".$extension;
				$resultado = @move_uploaded_file($_FILES["imggname"]["tmp_name"], $ruta);
				if ($resultado){
					$img = $imgname.".".$extension;
					$sql = "insert into imgg(codetitleg, imggname) 
							values('$codetitleg', '$img')";
		
					$result = db_query($sql);
					if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede insertar.'));
					}
				}else{
					echo json_encode(array('msg'=>'No se puede subir la imagen: '.$_FILES['imggname']['name'].''));
				}
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codeimgg = $_GET['codeimgg'];
		$codetitleg = $_REQUEST['codetitleg'];
		
		$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
		$limite_kb = 10000000;
		
		$partes_nombre = explode('.', $_FILES['imggname']['name']);
		$extension = end( $partes_nombre );
		
		if (in_array($_FILES['imggname']['type'], $permitidos) && $_FILES['imggname']['size'] <= $limite_kb * 1024){
			$nro = rand(1, 10000000);
			$imgname = "ga_".$nro;
			$ruta = "../resource/images/" .$imgname.".".$extension;
			//
			$row = (mysqli_fetch_array(db_query("select imggname from imgg where codeimgg='".$codeimgg."'")));			
			if($row['imggname'] == "sin_img.png"){
				$img1 = "img".$img1;
				
			}else{
				$img1 = $row['imggname'];
			}
			$foto = "../resource/images/".$img1;
			if (file_exists($foto)){ unlink ($foto); }else{}
			//
			$resultado = @move_uploaded_file($_FILES["imggname"]["tmp_name"], $ruta);
			if ($resultado){
				$img = $imgname.".".$extension;
				$sql = "update imgg set 
							codetitleg='$codetitleg',
							imggname='$img'
				where codeimgg='$codeimgg'";
			
				$result = db_query($sql);
				if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede insertar.'));
					}
			}else{
				echo json_encode(array('msg'=>'Esta imagen ya existe: '.$_FILES['imggname']['name'].''));
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codeimgg = $_POST["codeimgg"];
		
		$row = (mysqli_fetch_array(db_query("select imggname from imgg where codeimgg='".$codeimgg."'")));			
		$imagen1 = $row['imggname'];	
		if($row['imggname'] == "sin_img.png"){
			
		}else{
			$foto = "../resource/images/".$imagen1;
			unlink ($foto);
		}
			
		$sql = "delete from imgg where codeimgg = $codeimgg";
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar este imgg.'));
		}			
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from imgg order by codeimgg asc");
		
		$data = array ();
		
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array ( 	   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codeimgg' => $datos['codeimgg'], 
			'codetitleg' => $datos['codetitleg'], 
			'imggname' => $datos['imggname']
			);

		}
		echo json_encode($data);	
	}
	
?>