<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
			 	 	 	 	 	 	 	 	 	 	
		$abouttype = $_REQUEST['abouttype']; 
		$aboutdesc = $_REQUEST['aboutdesc']; 
		
		if ($_FILES["aboutimg"]["error"] > 0){				
			$sql = "insert into about(abouttype, aboutdesc, aboutimg) 
								 values('$abouttype', '$aboutdesc', 'sin_img.png')";
		
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede insertar.'));
			}
		} else {
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			$limite_kb = 10000000;
			
			$partes_nombre = explode('.', $_FILES['aboutimg']['name']);
			$extension = end( $partes_nombre );
				
			if (in_array($_FILES['aboutimg']['type'], $permitidos) && $_FILES['aboutimg']['size'] <= $limite_kb * 1024){
				$nro = rand(1, 10000000);
				$imgname = "img_".$nro;
				$ruta = "../resource/images/" .$imgname.".".$extension;
				$resultado = @move_uploaded_file($_FILES["aboutimg"]["tmp_name"], $ruta);
				if ($resultado){
					$img = $imgname.".".$extension;
					$sql = "insert into about(abouttype, aboutdesc, aboutimg) 
								 values('$abouttype', '$aboutdesc', '$img')";
		
					$result = db_query($sql);
					if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede insertar.'));
					}
				}else{
					echo json_encode(array('msg'=>'No se puede subir la imagen: '.$_FILES['aboutimg']['name'].''));
				}
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codeabout = $_GET['codeabout'];
			 	 	 	 	 	 	 	 	 	 	
		$aboutdesc = $_REQUEST['aboutdesc'];
		
		if ($_FILES["aboutimg"]["error"] > 0){	
		
			$sql = "update about set 
						aboutdesc='$aboutdesc'
					where codeabout='$codeabout'";
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede actualizar.'));
			}
		} else {
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			$limite_kb = 10000000;
			
			$partes_nombre = explode('.', $_FILES['aboutimg']['name']);
			$extension = end( $partes_nombre );
			
			if (in_array($_FILES['aboutimg']['type'], $permitidos) && $_FILES['aboutimg']['size'] <= $limite_kb * 1024){
				$nro = rand(1, 10000000);
				$imgname = "img_".$nro;
				$ruta = "../resource/images/" .$imgname.".".$extension;
				//
				$row = (mysqli_fetch_array(db_query("select aboutimg from about where codeabout='".$codeabout."'")));			
				if($row['aboutimg'] == "sin_img.png"){
					$img1 = "img".$img1;
					
				}else{
					$img1 = $row['aboutimg'];
				}
				$foto = "../resource/images/".$img1;
				if (file_exists($foto)){ unlink ($foto); }else{}
				//
				$resultado = @move_uploaded_file($_FILES["aboutimg"]["tmp_name"], $ruta);
				if ($resultado){
					$img = $imgname.".".$extension;
					$sql = "update about set 
								aboutdesc='$aboutdesc',
								aboutimg='$img'
							where codeabout='$codeabout'";
				
					$result = db_query($sql);
					if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede actualizar.'));
					}
				}else{
					echo json_encode(array('msg'=>'Esta imagen ya existe: '.$_FILES['aboutimg']['name'].''));
				}
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codeabout = $_POST["codeabout"];
		
		$row = (mysqli_fetch_array(db_query("select aboutimg from about where codeabout='$codeabout'")));			
		$imagen1 = $row['aboutimg'];	
		if($row['aboutimg'] == "sin_img.png"){
			
		}else{
			$foto = "../resource/images/".$imagen1;
			unlink ($foto);
		}
			
		$sql = "delete from about where codeabout = '$codeabout'";
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar la categoria.'));
		}			
	}
	
	if($_GET["option"]=='show') {
		
		$codeuser = $_SESSION['codeuser'];
		
		$rs = db_query("select * from about order by aboutdesc asc");
		
		$data = array ();
		
		while ($datos = mysqli_fetch_assoc($rs) ){
				 	 	 	 	 	
			$data[] = array (  	 	 	 	 	 	 	 	 	 	 	 		   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
				'codeabout' => $datos['codeabout'], 
				'abouttype' => $datos['abouttype'], 
				'aboutdesc' => $datos['aboutdesc'], 
				'aboutimg' => $datos['aboutimg']
			);

		}
		echo json_encode($data);
	}
	
?>