<?php session_start ();

require_once (dirname (__FILE__) . "/../setup.php");

db_connect ();

/**
 * GET
 */
	if($_GET["option"]=='insert') {
		
		$codesubcategory = $_REQUEST['codesubcategory'];
		$coursename = strtoupper($_REQUEST['coursename']);
		$coursedesc = $_REQUEST['coursedesc'];
		$courseinit = strtoupper($_REQUEST['courseinit']);
		$coursedateinit = $_REQUEST['coursedateinit'];
		$coursedateend = $_REQUEST['coursedateend'];
		$coursedays =  $_REQUEST['courseday'];
		$coursetime = strtoupper($_REQUEST['coursetime']);
		$coursetimeinit = $_REQUEST['coursetimeinit'];
		$coursetimeend = $_REQUEST['coursetimeend'];
		$coursemode = $_REQUEST['coursemode'];
		$coursephone = $_REQUEST['coursephone'];
		$courseprice = @$_REQUEST['courseprice'];
		$coursedscto = $_REQUEST['coursedscto'];
		$courseinstitutes = $_REQUEST['courseinstitute'];
		$coursefooter = strtoupper(@$_REQUEST['coursefooter']);
		$coursestar = @$_REQUEST['coursestar'];
		
		
		$coursename= preg_replace ("/ñ/", "Ñ", $coursename);
		$coursename= preg_replace ("/á/", "Á", $coursename);
		$coursename= preg_replace ("/é/", "É", $coursename);
		$coursename= preg_replace ("/í/", "Í", $coursename);
		$coursename= preg_replace ("/ó/", "Ó", $coursename);
		$coursename= preg_replace ("/ú/", "Ú", $coursename);
		
		/*
		$courseday = '';
		$cont = 0;
		foreach($coursedays as $day){
			$cont++;
			if($cont == 1){
				$courseday .= $day;
			}else{
				$courseday .= ','.$day;
			}
			
		}
		*/
		$courseday = implode(",", $coursedays);
		$courseinstitute = implode(",", $courseinstitutes);
		
		if(db_exist("select * from course where coursename = '$coursename'")){
			echo json_encode(array('msg'=>'Ya existe el curso: '.$coursename));
		}else{
			if ($_FILES["courseimg"]["error"] > 0){				
				$sql = "insert into course(codesubcategory, coursename, coursedesc, courseinit, coursedateinit, coursedateend, courseday, coursetime, coursetimeinit, coursetimeend,  coursemode, coursephone, courseprice, coursedscto, courseinstitute, coursefooter, coursestar, coursecode, courseimg) 
						values('$codesubcategory', '$coursename', '$coursedesc', '$courseinit', '$coursedateinit', '$coursedateend', '$courseday', '$coursetime', '$coursetimeinit', '$coursetimeend', '$coursemode', '$coursephone', '$courseprice', '$coursedscto', '$courseinstitute', '$coursefooter', '$coursestar', '0', 'sin_img.png')";
						
				$result = db_query($sql);
				if ($result){
					echo json_encode(array('success'=>true, 'day'=>$coursedays));
				} else {
					echo json_encode(array('msg'=>'No se puede insertar.'.$courseprice));
				}
			}else{
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
				$limite_kb = 10000000;
				
				$partes_nombre = explode('.', $_FILES['courseimg']['name']);
				$extension = end( $partes_nombre );
					
				if (in_array($_FILES['courseimg']['type'], $permitidos) && $_FILES['courseimg']['size'] <= $limite_kb * 1024){
					$nro = rand(1, 10000000);
					$imgname = "img_".$nro;
					$ruta = "../resource/images/course/" .$imgname.".".$extension;
					$resultado = @move_uploaded_file($_FILES["courseimg"]["tmp_name"], $ruta);
					if ($resultado){
						$img = $imgname.".".$extension;
						$sql = "insert into course(codesubcategory, coursename, coursedesc, courseinit, coursedateinit, coursedateend, courseday, coursetime, coursetimeinit, coursetimeend, coursemode, coursephone, courseprice, coursedscto, courseinstitute, coursefooter, coursestar, coursecode, courseimg) 
								values('$codesubcategory', '$coursename', '$coursedesc', '$courseinit', '$coursedateinit', '$coursedateend', '$courseday', '$coursetime', '$coursetimeinit', '$coursetimeend', '$coursemode', '$coursephone', '$courseprice', '$coursedscto', '$courseinstitute', '$coursefooter', '$coursestar', '0', '$img')";
						
						$result = db_query($sql);
						if ($result){
							echo json_encode(array('success'=>true));
						} else {
							echo json_encode(array('msg'=>'No se puede insertar.'));
						}
					}else{
						echo json_encode(array('msg'=>'No se puede subir la imagen: '.$_FILES['courseimg']['name'].''));
					}
				}
			}
		}
	}
	
	if($_GET["option"]=='update') {
	
		$codecourse = $_GET['codecourse'];
		
		$codesubcategory = $_REQUEST['codesubcategory'];
		$coursename = $_REQUEST['coursename'];
		$coursedesc = $_REQUEST['coursedesc'];
		$courseinit = $_REQUEST['courseinit'];
		$coursedateinit = $_REQUEST['coursedateinit'];
		$coursedateend = $_REQUEST['coursedateend'];
		$coursedays = $_REQUEST['courseday'];
		$coursetime = $_REQUEST['coursetime'];
		$coursetimeinit = $_REQUEST['coursetimeinit'];
		$coursetimeend = $_REQUEST['coursetimeend'];
		$coursemode = $_REQUEST['coursemode'];
		$coursephone = $_REQUEST['coursephone'];
		$courseprice = $_REQUEST['courseprice'];
		$coursedscto = $_REQUEST['coursedscto'];
		$courseinstitutes = $_REQUEST['courseinstitute'];
		$coursefooter = @$_REQUEST['coursefooter'];
		$coursestar = @$_REQUEST['coursestar'];
		/*
		$courseday = '';
		$cont = 0;
		foreach($coursedays as $day){
			$cont++;
			if($cont == 1){
				$courseday .= $day;
			}else{
				$courseday .= ','.$day;
			}
			
		}
		*/
		$courseday = implode(",", $coursedays);
		$courseinstitute = implode(",", $courseinstitutes);
		
		if(db_exist("select * from course where coursename = '$coursename' and codecourse <> '$codecourse'")){
			echo json_encode(array('msg'=>'Ya existe el curso: '.$coursename));
		}else{
			if ($_FILES["courseimg"]["error"] > 0){				
				$sql = "update course set 
						codesubcategory='$codesubcategory',
						coursename='$coursename',
						coursedesc='$coursedesc',
						courseinit='$courseinit',
						coursedateinit='$coursedateinit',
						coursedateend='$coursedateend',
						courseday='$courseday',
						coursetime='$coursetime',
						coursetimeinit='$coursetimeinit',
						coursetimeend='$coursetimeend',
						coursemode='$coursemode',
						coursephone='$coursephone',
						courseprice='$courseprice',
						coursedscto='$coursedscto',
						courseinstitute='$courseinstitute',
						coursefooter='$coursefooter',
						coursestar='$coursestar'
					where codecourse='$codecourse'";
		
				$result = db_query($sql);
				if ($result){
					echo json_encode(array('success'=>true));
				} else {
					echo json_encode(array('msg'=>'No se puede actualizar.'));
				}
			} else {
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
				$limite_kb = 10000000;
				
				$partes_nombre = explode('.', $_FILES['courseimg']['name']);
				$extension = end( $partes_nombre );
				
				if (in_array($_FILES['courseimg']['type'], $permitidos) && $_FILES['courseimg']['size'] <= $limite_kb * 1024){
					$nro = rand(1, 10000000);
					$imgname = "img_".$nro;
					$ruta = "../resource/images/course/" .$imgname.".".$extension;
					//
					$row = (mysqli_fetch_array(db_query("select courseimg from course where codecourse='$codecourse'")));			
					if($row['courseimg'] == "sin_img.png"){
						$img1 = "img".$img1;
						
					}else{
						$img1 = $row['courseimg'];
					}
					$foto = "../resource/images/course/".$img1;
					if (file_exists($foto)){ unlink ($foto); }else{}
					//
					$resultado = @move_uploaded_file($_FILES["courseimg"]["tmp_name"], $ruta);
					if ($resultado){
						$img = $imgname.".".$extension;
						$sql = "update course set 
							codesubcategory='$codesubcategory',
							coursename='$coursename',
							coursedesc='$coursedesc',
							courseinit='$courseinit',
							coursedateinit='$coursedateinit',
							coursedateend='$coursedateend',
							courseday='$courseday',
							coursetime='$coursetime',
							coursetimeinit='$coursetimeinit',
							coursetimeend='$coursetimeend',
							coursemode='$coursemode',
							coursephone='$coursephone',
							courseprice='$courseprice',
							coursedscto='$coursedscto',
							courseinstitute='$courseinstitute',
							coursefooter='$coursefooter',
							coursestar='$coursestar',
							courseimg='$img'
						where codecourse='$codecourse'";
					
						$result = db_query($sql);
						if ($result){
							echo json_encode(array('success'=>true));
						} else {
							echo json_encode(array('msg'=>'No se puede actualizar.'));
						}
					}else{
						echo json_encode(array('msg'=>'Esta imagen ya existe: '.$_FILES['courseimg']['name'].''));
					}
				}
			}
		}
	}
	
	if($_GET["option"]=='delete') {
	
		$codecourse = $_POST["codecourse"];
		
		$row = (mysqli_fetch_array(db_query("select courseimg from course where codecourse='$codecourse'")));			
		$imagen1 = $row['courseimg'];	
		if($row['courseimg'] == "sin_img.png"){
			
		}else{
			$foto = "../resource/images/course/".$imagen1;
			unlink ($foto);
		}
			
		$sql = "delete from course where codecourse = $codecourse";
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar el curso.'));
		}	
	}
	
	if($_GET["option"]=='url') {
	
		$codecourse = $_GET['codecourse'];
		
		$urlname = $_REQUEST['urlname'];
		
		if(db_exist("select * from url where codecourse = '$codecourse'")){
			$sql = "update url set 
						urlname='$urlname'
					where codecourse='$codecourse'";
		
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede actualizar.'));
			}
		}else{
			$sql = "insert into url(codecourse, urlname) 
						values('$codecourse', '$urlname')";
				
			$result = db_query($sql);
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se registrar la url.'));
			}
		}
	}
	
	if($_GET["option"]=='show') {
		
		$rs = db_query("select * from course order by codecourse asc");
		
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array ( 	  	 	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 
			'codecourse' => $datos['codecourse'], 
			'codesubcategory' => $datos['codesubcategory'], 
			'coursename' => $datos['coursename'], 
			'coursedesc' => $datos['coursedesc'], 
			'courseinit' => $datos['courseinit'], 
			'coursedateinit' => $datos['coursedateinit'], 
			'coursedateend' => $datos['coursedateend'], 
			'courseday' => $datos['courseday'], 
			'coursetime' => $datos['coursetime'], 
			'coursetimeinit' => $datos['coursetimeinit'], 
			'coursetimeend' => $datos['coursetimeend'], 
			'coursemode' => $datos['coursemode'], 
			'coursephone' => $datos['coursephone'], 
			'courseprice' => $datos['courseprice'], 
			'coursedscto' => $datos['coursedscto'], 
			'courseinstitute' => $datos['courseinstitute'], 
			'coursefooter' => $datos['coursefooter'],
			'coursestar' => $datos['coursestar'],
			'coursecode' => $datos['coursecode'],
			'courseimg' => $datos['courseimg']
			);

		}
		echo json_encode($data);
		
	}
	
?>