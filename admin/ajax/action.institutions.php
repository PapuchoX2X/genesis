<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		$institutionsname = $_REQUEST['institutionsname'];
		
		if(db_exist("select * from institutions where institutionsname = '$institutionsname'")){
			echo json_encode(array('msg'=>'Ya existe el instituto '.$institutionsname));
		}else{
			if ($_FILES["institutionsimg"]["error"] > 0){	
			
				$sql = "insert into institutions(institutionsname, institutionsimg) 
									 values('$institutionsname', 'sin_img.png')";
			
				$result = db_query($sql);
				if ($result){
					echo json_encode(array('success'=>true));
				} else {
					echo json_encode(array('msg'=>'No se puede insertar.'));
				}
			} else {
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
				$limite_kb = 10000000;
				
				$partes_nombre = explode('.', $_FILES['institutionsimg']['name']);
				$extension = end( $partes_nombre );
					
				if (in_array($_FILES['institutionsimg']['type'], $permitidos) && $_FILES['institutionsimg']['size'] <= $limite_kb * 1024){
					$nro = rand(1, 1000);
					$imgname = "institutions_".$nro;
					$ruta = "../resource/images/institutions/" .$imgname.".".$extension;
					$resultado = @move_uploaded_file($_FILES["institutionsimg"]["tmp_name"], $ruta);
					if ($resultado){
						$img = $imgname.".".$extension;
						$sql = "insert into institutions(institutionsname, institutionsimg) 
								values('$institutionsname', '$img')";
			
						$result = db_query($sql);
						if ($result){
							echo json_encode(array('success'=>true));
						} else {
							echo json_encode(array('msg'=>'No se puede insertar.'));
						}
					}else{
						echo json_encode(array('msg'=>'No se puede subir la imagen: '.$_FILES['institutionsimg']['name'].''));
					}
				}
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codeinstitutions = $_GET['codeinstitutions'];
		$institutionsname = $_REQUEST['institutionsname'];
		
		if(db_exist("select * from institutions where institutionsname = '$institutionsname' and codeinstitutions <> '$codeinstitutions'")){
			echo json_encode(array('msg'=>'Ya existe el instituto '.$institutionsname));
		}else{
			if ($_FILES["institutionsimg"]["error"] > 0){
				
				$sql = "update institutions set 
							institutionsname='$institutionsname'
						where codeinstitutions='$codeinstitutions'";
				$result = db_query($sql);
				if ($result){
					echo json_encode(array('success'=>true));
				} else {
					echo json_encode(array('msg'=>'No se puede actualizar.'));
				}
			}else{
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
				$limite_kb = 10000000;
				
				$partes_nombre = explode('.', $_FILES['institutionsimg']['name']);
				$extension = end( $partes_nombre );
				
				if (in_array($_FILES['institutionsimg']['type'], $permitidos) && $_FILES['institutionsimg']['size'] <= $limite_kb * 1024){
					$nro = rand(1, 10000000);
					$imgname = "institutions_".$nro;
					$ruta = "../resource/images/institutions/" .$imgname.".".$extension;
					//
					$row = (mysqli_fetch_array(db_query("select institutionsimg from institutions where codeinstitutions='".$codeinstitutions."'")));			
					if($row['institutionsimg'] == "sin_img.png"){
						$img1 = "img".$img1;
						
					}else{
						$img1 = $row['institutionsimg'];
					}
					$foto = "../resource/images/institutions/".$img1;
					if (file_exists($foto)){ unlink ($foto); }else{}
					//
					$resultado = @move_uploaded_file($_FILES["institutionsimg"]["tmp_name"], $ruta);
					if ($resultado){
						$img = $imgname.".".$extension;
						$sql = "update institutions set 
									institutionsname='$institutionsname',
									institutionsimg='$img'
						where codeinstitutions='$codeinstitutions'";
					
						$result = db_query($sql);
						if ($result){
								echo json_encode(array('success'=>true));
							} else {
								echo json_encode(array('msg'=>'No se puede insertar.'));
							}
					}else{
						echo json_encode(array('msg'=>'Esta imagen ya existe: '.$_FILES['institutionsimg']['name'].''));
					}
				}
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codeinstitutions = $_POST["codeinstitutions"];
		
		$row = (mysqli_fetch_array(db_query("select institutionsimg from institutions where codeinstitutions='".$codeinstitutions."'")));			
		$imagen1 = $row['institutionsimg'];	
		if($row['institutionsimg'] == "sin_img.png"){
			
		}else{
			$foto = "../resource/images/institutions/".$imagen1;
			unlink ($foto);
		}
			
		$sql = "delete from institutions where codeinstitutions = $codeinstitutions";
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar este institutions.'));
		}			
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from institutions order by codeinstitutions asc");
		
		$data = array ();
		
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array ( 	   	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codeinstitutions' => $datos['codeinstitutions'], 
			'institutionsname' => $datos['institutionsname'], 
			'institutionsimg' => $datos['institutionsimg']
			);

		}
		echo json_encode($data);	
	}
	
?>