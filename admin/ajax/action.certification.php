<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
			 	 	 	 	 	 	 	 	 	 	
		$certificationtitle = $_REQUEST['certificationtitle']; 
		$certificationdesc = $_REQUEST['certificationdesc']; 
		$certificationcolor = $_REQUEST['certificationcolor']; 
		//if ($_FILES["certificationimg"]["error"] > 0){				
			$sql = "insert into certification(certificationtitle, certificationdesc, certificationcolor, certificationimg) 
					values('$certificationtitle', '$certificationdesc', '$certificationcolor', 'sin_img.png')";
					
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede insertar.'));
			}
		/*}else{
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			$limite_kb = 10000000;
			
			$partes_nombre = explode('.', $_FILES['certificationimg']['name']);
			$extension = end( $partes_nombre );
				
			if (in_array($_FILES['certificationimg']['type'], $permitidos) && $_FILES['certificationimg']['size'] <= $limite_kb * 1024){
				$nro = rand(1, 10000000);
				$imgname = "img_".$nro;
				$ruta = "../resource/images/" .$imgname.".".$extension;
				$resultado = @move_uploaded_file($_FILES["certificationimg"]["tmp_name"], $ruta);
				if ($resultado){
					$img = $imgname.".".$extension;
					$sql = "insert into certification(certificationtitle, certificationdesc, certificationcolor, certificationimg) 
					values('$certificationtitle', '$certificationdesc', '$certificationcolor', '$img')";
			
					$result = db_query($sql);
					if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede insertar.'));
					}
				}else{
					echo json_encode(array('msg'=>'No se puede subir la imagen: '.$_FILES['certificationimg']['name'].''));
				}
			}
		}*/
	}
	
	if($_GET["option"]=='update') {
	
		$codecertification = $_GET['codecertification'];
			 	 	 	 	 	 	 	 	 	 	
		$certificationtitle = $_REQUEST['certificationtitle'];
		$certificationdesc = $_REQUEST['certificationdesc'];
		$certificationcolor = $_REQUEST['certificationcolor']; 
		//if ($_FILES["certificationimg"]["error"] > 0){	
		
			$sql = "update certification set 
					certificationtitle='$certificationtitle',
					certificationdesc='$certificationdesc',
					certificationcolor='$certificationcolor'
				where codecertification='$codecertification'";
		
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede actualizar.'));
			}
		/*} else {
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			$limite_kb = 10000000;
			
			$partes_nombre = explode('.', $_FILES['certificationimg']['name']);
			$extension = end( $partes_nombre );
			
			if (in_array($_FILES['certificationimg']['type'], $permitidos) && $_FILES['certificationimg']['size'] <= $limite_kb * 1024){
				$nro = rand(1, 10000000);
				$imgname = "img_".$nro;
				$ruta = "../resource/images/" .$imgname.".".$extension;
				//
				$row = (mysqli_fetch_array(db_query("select certificationimg from certification where codecertification='$codecertification'")));			
				if($row['certificationimg'] == "sin_img.png"){
					$img1 = "img".$img1;
					
				}else{
					$img1 = $row['certificationimg'];
				}
				$foto = "../resource/images/".$img1;
				if (file_exists($foto)){ unlink ($foto); }else{}
				//
				$resultado = @move_uploaded_file($_FILES["certificationimg"]["tmp_name"], $ruta);
				if ($resultado){
					$img = $imgname.".".$extension;
					$sql = "update certification set 
						certificationtitle='$certificationtitle',
						certificationdesc='$certificationdesc',
						certificationcolor='$certificationcolor',
						certificationimg='$img'
					where codecertification='$codecertification'";
				
					$result = db_query($sql);
					if ($result){
						echo json_encode(array('success'=>true));
					} else {
						echo json_encode(array('msg'=>'No se puede actualizar.'));
					}
				}else{
					echo json_encode(array('msg'=>'Esta imagen ya existe: '.$_FILES['certificationimg']['name'].''));
				}
			}
		}*/
	}
	
	if($_GET["option"]=='delete') {
	
		$codecertification = $_POST["codecertification"];
		
		$sql = "delete from certification where codecertification = '$codecertification'";
		$result = db_query($sql);
		
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar la certificacion.'));
		}			
	}
	
	if($_GET["option"]=='show') {
		
		$codeuser = $_SESSION['codeuser'];
		
		$rs = db_query("select * from certification order by codecertification asc");
		
		$data = array ();
		
		while ($datos = mysqli_fetch_assoc($rs) ){
				 	 	 	 	 	
			$data[] = array (  	 	 	 	 	 	 	 	 	 	 	 		   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
				'codecertification' => $datos['codecertification'], 
				'certificationtitle' => $datos['certificationtitle'], 
				'certificationdesc' => $datos['certificationdesc'],
				'certificationcolor' => $datos['certificationcolor'],
				'certificationimg' => $datos['certificationimg']
			);

		}
		echo json_encode($data);
	}
	
?>