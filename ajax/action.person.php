<?php session_start ();
date_default_timezone_set('America/La_Paz');

require_once (dirname (__FILE__) . "/../admin/setup.php");

db_connect ();
//
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'email/vendor/autoload.php';

//

/**
 * GET
 */
	if($_GET["option"]=='register') {
		
		$personname = $_POST['personname'];
		$personphone = $_POST['personphone'];
		$personmail = $_POST['personmail'];
		$personpassword = $_POST['personpassword'];
		$persontype = $_POST['persontype'];
		
		$personcode = generateRandomString2();
		
		if(db_exist("select * from person where personmail = '$personmail'")){
			echo json_encode(array('msg'=>'Ya existe el correo electronico: '.$personmail.' registrado'));
		}else{
			$mail = new PHPMailer(true);
			try {
				$sql = "insert into person(personname, personphone, personmail, personpassword, persontype, personcode, personstate) 
					values('$personname', '$personphone', '$personmail', '$personpassword', '$persontype', '$personcode', 'INACTIVO')";
			
				$result = db_query($sql);
				
				$row = db_fetch_array (db_query("select codeperson from person where personmail = '$personmail' order by codeperson desc"));
				list ($codeperson) = $row;
				
				//Server settings
				//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
				$mail->isSMTP();                                            
				$mail->Host       = 'mail.siawebsoft.com';                     
				$mail->SMTPAuth   = true;                                   
				$mail->Username   = 'info@siawebsoft.com';                 
				$mail->Password   = 'siainfo2025';                         
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
				$mail->Port       = 465;                                    
				
				$mail->setFrom('info@siawebsoft.com', 'GENESIS');
				$mail->addAddress($personmail, 'Codigo de Verificacion');
				$mail->isHTML(true); 
				$mail->Subject = "Envio Codigo de Verificacion GENESIS";
				$mail->Body    = "<p>Hola $personname te enviamos el codigo de verificacion</p><center><h2>$personcode</h2></center>";
				
				$mail->send();
				
				if ($result){
					echo json_encode(array('success'=>true));
					$_SESSION [ 'codeperson' ] = $codeperson ; 
				} else {
					echo json_encode(array('msg'=>'No se puede insertar.'));
				}
			} catch (Exception $e) {
				echo json_encode(array('msg'=>" Mailer Error: {$mail->ErrorInfo} no se registro"));
			}
		}
	}
	
	if($_GET["option"]=='validate') {
		
		$codeperson = $_SESSION [ 'codeperson' ];
		$personcode = $_POST['personcode'];
		
		if(db_exist("select * from person where codeperson = '$codeperson'")){
			$row_person = db_fetch_array (db_query("select * from person where codeperson = '$codeperson'"));
			list ($codeperson, $personname, $personphone, $personmail, $personpassword, $persontype, $personcode, $personstate) = $row_person;
			
			if(db_exist("select * from person where codeperson='$codeperson' and personcode = '$personcode'")){
				$sql = "update person set 
							personstate='ACTIVO'
						where codeperson='$codeperson' and personcode = '$personcode'";
			
				$result = db_query($sql);
				if ($result){
					echo json_encode(array('success'=>true, 'type'=>$persontype));
				} else {
					echo json_encode(array('msg'=>'No se puede conectar con el servidor'));
				}
			}else{
				echo json_encode(array('msg'=>'Codigo Incorrecto'));
			}
		}else{
			echo json_encode(array('msg'=>'registrese para validar su cuenta'));
		}
	}
	
	if($_GET["option"]=='recover') {
		
		$personmail = $_POST['personmail'];
				
		if(db_exist("select * from person where personmail = '$personmail'")){
			$mail = new PHPMailer(true);
			try {
				
				$row = db_fetch_array (db_query("select codeperson, personname, personpassword from person where personmail = '$personmail' order by codeperson desc"));
				list ($codeperson, $personname, $personpassword) = $row;
				
				//Server settings
				$mail->isSMTP();                                            
				$mail->Host       = 'mail.siawebsoft.com';                     
				$mail->SMTPAuth   = true;                                   
				$mail->Username   = 'info@siawebsoft.com';                 
				$mail->Password   = 'siainfo2025';                         
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
				$mail->Port       = 465;                                    
				
				$mail->setFrom('info@siawebsoft.com', 'GENESIS');
				$mail->addAddress($personmail, 'Recuperacion Contraseña');
				$mail->isHTML(true); 
				$mail->Subject = "Recuperacion Contraseña";
				$mail->Body    = "<p>Hola $personname te enviamos tu Contraseña</p><center><h2>$personpassword</h2></center>";
				
				$mail->send();
				
				if (db_exist("select * from person where personmail = '$personmail'")){
					echo json_encode(array('success'=>true));
					$_SESSION [ 'codeperson' ] = $codeperson ; 
				} else {
					echo json_encode(array('msg'=>'No existe el usuario con ese correo electronico.'));
				}
			} catch (Exception $e) {
				echo json_encode(array('msg'=>" Mailer Error: {$mail->ErrorInfo} no se envio"));
			}
			
		}else{
			echo json_encode(array('msg'=>'No existe usuario con ese correo electronico: '.$personmail));
		}
	}
	
	if($_GET["option"]=='close_session') {
		unset($_SESSION['codeperson']);
		if (isset($_SESSION['codeperson'])){
			echo 'No se puede cerrar la session';
		}else{
			echo '1';
			$_SESSION [ 'codeperson' ] = 0; 
		}
	}
	
	if($_GET["option"]=='add_course') {
		
		$codeperson = $_SESSION [ 'codeperson' ];
		$codecourse = $_GET['codecourse'];
		
		if(db_exist("select * from person where codeperson = '$codeperson'")){
			$row_person = db_fetch_array (db_query("select * from person where codeperson = '$codeperson'"));
			list ($codeperson, $personname, $personphone, $personmail, $personpassword, $persontype, $personcode, $personstate) = $row_person;
			
			$row_course = db_fetch_array (db_query("select codecourse, coursename, courseprice from course where codecourse = '$codecourse'"));
			list ($codecourse, $coursename, $courseprice) = $row_course;
				
			if(db_exist("select * from detail where codecourse = '$codecourse' and codeperson = '$codeperson'")){
				//echo 'El curso '.$coursename.' ya fue tomado';
				$row_detail = db_fetch_array (db_query("select detailstate from detail where codecourse = '$codecourse' and codeperson = '$codeperson'"));
				list ($detailstate) = $row_detail;
				if($detailstate == 'EN PROCESO'){
					echo json_encode(array('msg'=>'El curso '.$coursename.' esta en carrito de compras'));
				}else{
					echo json_encode(array('msg'=>'El curso '.$coursename.' ya fue tomado'));
				}
			}else{
				$sql = "insert into detail(codecourse, codeperson, detailname, detailcourse, detailprice, detailtype, detailstate, detaildate) 
						values('$codecourse', '$codeperson', '$personname', '$coursename', '$courseprice', 'Estudiante', 'EN PROCESO', '')";
				
				$result = db_query($sql);
				
				$row_deta = db_fetch_array (db_query("select count(*) as cant from detail where codeperson = '$codeperson' and detailstate='EN PROCESO'"));
				list ($cant) = $row_deta;
				
				if ($result){
					echo json_encode(array('success'=>true, 'cant'=>$cant));
				} else {
					echo json_encode(array('msg'=>'No se puede añadir al carrito'));
				}
			}
		}else{
			echo json_encode(array('msg'=>'Inicie Sesion o registrese para adquirir los cursos'));
		}
	}
	
	if($_GET["option"]=='delete_detail') {
		
		$codeperson = $_SESSION [ 'codeperson' ];
		$codedetail = $_GET['codedetail'];
	
		$sql = "delete from detail where codedetail = $codedetail";
		$result = db_query($sql);

		$row_deta = db_fetch_array (db_query("select count(*) as cant from detail where codeperson = '$codeperson' and detailstate='EN PROCESO'"));
		list ($cant) = $row_deta;
		
		if ($result){
			echo json_encode(array('success'=>true, 'cant'=>$cant));
		} else {
			echo json_encode(array('msg'=>'No se puede eliminar del carrito'));
		}
	}
	
	if($_GET["option"]=='paid') {
	
		$codeperson = $_GET['codeperson'];
		$selectedCheckboxes = @$_POST['selectedCheckboxes'];
	
		$date = date("d-m-Y H:i:s");
		
		if(db_exist("select * from detail where codeperson='$codeperson' and detailstate = 'EN PROCESO'")){
			$cont = 0;
			foreach ($selectedCheckboxes as $value) {
				$cont++;
				$sql = "update detail set 
							detailstate='FINALIZADO',
							detaildate='$date'
						where  codedetail = '$value' and codeperson = '$codeperson' and detailstate = 'EN PROCESO'";
			
				$result = db_query($sql);
			}
			if ($cont > 0){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se pudo realizar el pago.'));
			}
		}else{
			echo json_encode(array('msg'=>'No existe cursos en el carrito de compras'));
		}
	}
	
	if($_GET["option"]=='total') {
	
		$codeperson = $_GET['codeperson'];
		$selectedCheckboxes = @$_POST['selectedCheckboxes'];
	
		if(db_exist("select * from detail where codeperson='$codeperson' and detailstate = 'EN PROCESO'")){
			$cont = 0;
			$total = 0;
			foreach ($selectedCheckboxes as $value) {
				$cont++;				
				$row_de = db_fetch_array (db_query("select detailprice from detail where  codedetail = '$value' and codeperson = '$codeperson' and detailstate = 'EN PROCESO'"));
				list ($detailprice) = $row_de;
				$total = $total + $detailprice;
			}
			if ($total > 0){
				echo json_encode(array('success'=>true, 'total'=>$total));
			} else {
				echo json_encode(array('total'=>'0'));
			}
		}else{
			echo json_encode(array('msg'=>'No hay cursos en proceso'));
		}
	}
	
	if($_GET["option"]=='pay_detail') {
	
		$codedetail = $_GET['codedetail'];
		
		$sql = "update detail set 
					detailstate='FINALIZADO'
				where codedetail='$codedetail'";
	
		$result = db_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'No se pudo realizar el pago.'));
		}
	
	}
	
	if($_GET["option"]=='new_course') {
		
		$codeperson = $_SESSION [ 'codeperson' ];
		$coursename = $_POST['coursename'];
		$coursemode = $_POST['coursemode'];
		$coursedesc = $_POST['coursedesc'];
		
		if(db_exist("select * from person where codeperson = '$codeperson'")){
			
			$row_person = db_fetch_array (db_query("select * from person where codeperson = '$codeperson'"));
			list ($codeperson, $personname, $personphone, $personmail, $personpassword, $persontype, $personcode, $personstate) = $row_person;
			
			$sql = "insert into course(codesubcategory, coursename, coursedesc, courseinit, coursedateinit, coursedateend, courseday, coursetime, coursetimeinit, coursetimeend, coursemode, coursephone, courseprice, coursedscto, courseinstitute, coursefooter, coursestar, coursecode, courseimg) 
					values('1', '$coursename', '$coursedesc', '', '', '', '', '', '', '', '$coursemode', '', '', '', '', '', '', '$codeperson', 'work.png')";
			
			$result = db_query($sql);
			
			$row_course = db_fetch_array (db_query("select codecourse from course where coursename = '$coursename' and coursedesc = '$coursedesc' order by codecourse desc"));
			list ($codecourse) = $row_course;
			
			$sql_detail = "insert into detail(codecourse, codeperson, detailname, detailcourse, detailprice, detailtype, detailstate, detaildate) 
						values('$codecourse', '$codeperson', '$personname', '$coursename', '0.00', 'Docente', 'FINALIZADO', '')";
			
			$result_detail = db_query($sql_detail);
			
			if ($result){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'No se puede registrar el Curso'));
			}
		}else{
			echo json_encode(array('msg'=>'Inicie Sesion o registrese para registrar los cursos'));
		}
	}
	
	function generateRandomString2($length = 5) { 
		return substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
	}
	
?>