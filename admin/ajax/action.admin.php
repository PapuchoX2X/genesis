<?php session_start ();
date_default_timezone_set('America/La_Paz');

require_once (dirname (__FILE__) . "/../setup.php");
db_connect ();

/**
 * GET
 */
	if($_GET["option"] == "about") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$nameabout = isset($_POST['nameabout']) ? mysqli_real_escape_string($connection, $_POST['nameabout']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "aboutdesc like '%$nameabout%'";
		$rs = db_query("select count(*) from about where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from about where " . $where . " order by codeabout asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$img = $datos['aboutimg'];
			$ruta = './../resource/images/'.$img;

			$data[] = array (  											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codeabout' => $datos['codeabout'], 
				'abouttype' => $datos['abouttype'],
				'aboutdesc' => $datos['aboutdesc'],
				//'aboutimg' => $datos['aboutimg'],
				'aboutimage' => '<div style="padding:5px;">'
							.'<img src='.$ruta.' width="200" height="200"/>'
							."</div>",
			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "category") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$namecategory = isset($_POST['namecategory']) ? mysqli_real_escape_string($connection, $_POST['namecategory']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "categoryname like '%$namecategory%' and codecategory != '1'";
		$rs = db_query("select count(*) from category where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from category where " . $where . " order by codecategory asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$img = $datos['categoryimg'];
			$ruta = './../resource/images/category/'.$img;

			$data[] = array (  											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codecategory' => $datos['codecategory'], 
				'categoryname' => $datos['categoryname'],
				'categoryimg' => $datos['categoryimg']/*,
				'categoryimage' => '<div style="padding:5px;">'
							.'<img src='.$ruta.' width="100" height="100"/>'
							."</div>",*/
			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "sub") {
		
		$codecategory = $_GET['codecategory'];
			
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$namesub = isset($_POST['namesub']) ? mysqli_real_escape_string($connection, $_POST['namesub']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "subcategoryname like '%$namesub%' and codecategory = '$codecategory'";
		$rs = db_query("select count(*) from subcategory where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from subcategory where " . $where . " order by subcategoryname asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array (    	 	 	 	 	 	 		 	 	 	 	 	 	 	  	 	 	 	 	 											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codesubcategory' => $datos['codesubcategory'],
				'codecategory' => $datos['codecategory'],
				'subcategoryname' => $datos['subcategoryname']
				
			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "course") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$namecourse = isset($_POST['namecourse']) ? mysqli_real_escape_string($connection, $_POST['namecourse']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "coursename like '%$namecourse%' and coursecode = '0'";
		$rs = db_query("select count(*) from course where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from course where " . $where . " order by codecourse asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$codecourse = $datos['codecourse'];
			$row_url = db_fetch_array (db_query("select urlname from url where codecourse = '$codecourse'"));
			list ($urlname) = $row_url;
			
			$codesubcategory = $datos['codesubcategory'];
			$row_sub = db_fetch_array (db_query("select codecategory from subcategory where codesubcategory = '$codesubcategory'"));
			list ($codecategory) = $row_sub;
			
			$img = $datos['courseimg'];
			$ruta = './../resource/images/course/'.$img;

			$data[] = array ( 	 	 	 	 	 	 	 	 	 	 	 	  											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codecourse' => $datos['codecourse'], 
				'codecategory' => $codecategory, 
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
				
				'urlname' => $urlname,
				
				//'courseimg' => $datos['courseimg'],
				'courseimage' => '<div style="padding:5px;">'
							.'<img src='.$ruta.' width="100" height="100"/>'
							."</div>",
				'courseinfo1' => '<div  style="margin-top:10px;margin-bottom:10px;">'
								."&nbsp;<b>NOMBRE: </b><span style='margin-left:5px;'>".$datos['coursename']
								."</span><br/>&nbsp;<b>FECHA INICIO: </b><span style='margin-left:5px;'>".$datos['coursedateinit']
								."</span><br/>&nbsp;<b>FECHA FIN: </b><span style='margin-left:5px;'>".$datos['coursedateend']
								."</span><br/>&nbsp;<b>HORA INICIO: </b><span style='margin-left:5px;'>".$datos['coursetimeinit']
								."</span><br/>&nbsp;<b>HORA FIN: </b><span style='margin-left:5px;'>".$datos['coursetimeend']
								."</span><br/>&nbsp;<b>ESTRELLAS: </b><span style='margin-left:5px;'>".$datos['coursestar']
								."</span><br/>&nbsp;<b>URL: </b><span style='margin-left:5px;'>".$urlname								
								."</span></div>",
								
				'courseinfo2' => '<div  style="margin-top:10px;margin-bottom:10px;">'
								."&nbsp;<b>DESCRIPCION: </b><span style='margin-left:5px;'>".$datos['coursedesc']
								."</span></div>",
								
				'courseinfo3' => '<div  style="margin-top:10px;margin-bottom:10px;">'
								."&nbsp;<b>INICIO: </b><span style='margin-left:5px;'>".$datos['courseinit']
								."</span><br/>&nbsp;<b>DIAS: </b><span style='margin-left:5px;'>".$datos['courseday']								
								."</span><br/>&nbsp;<b>HORA: </b><span style='margin-left:5px;'>".$datos['coursetime']								
								."</span><br/>&nbsp;<b>MODALIDAD: </b><span style='margin-left:5px;'>".$datos['coursemode']								
								."</span><br/>&nbsp;<b>TELF/CEL: </b><span style='margin-left:5px;'>".$datos['coursephone']								
								."</span><br/>&nbsp;<b>PRECIO: </b><span style='margin-left:5px;'>".$datos['courseprice']	
								."</span><br/>&nbsp;<b>DSCTO: </b><span style='margin-left:5px;'>".$datos['coursedscto']								
								."</span><br/>&nbsp;<b>INSTITUTOS: </b><span style='margin-left:5px;'>".$datos['courseinstitute']								
								."</span><br/>&nbsp;<b>FOOTER: </b><span style='margin-left:5px;'>".$datos['coursefooter']									
								."</span></div>"/*,
				'courseinfo3' => '<div  style="margin-top:10px;margin-bottom:10px;">'
								."&nbsp;PRECIO: <span style='margin-left:5px;'>".$datos['courseprice']
								."</span><br/>&nbsp;DSCTO: <span style='margin-left:5px;'>".$datos['coursedscto']								
								."</span><br/>&nbsp;INSTITUTOS: <span style='margin-left:5px;'>".$datos['courseinstitute']								
								."</span><br/>&nbsp;FOOTER: <span style='margin-left:5px;'>".$datos['coursefooter']								
								."</span></div>"*/
			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "coursed") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$namecourse = isset($_POST['namecourse']) ? mysqli_real_escape_string($connection, $_POST['namecourse']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "coursename like '%$namecourse%' and coursecode != '0'";
		$rs = db_query("select count(*) from course where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from course where " . $where . " order by codecourse asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$codecourse = $datos['codecourse'];
			$row_url = db_fetch_array (db_query("select urlname from url where codecourse = '$codecourse'"));
			list ($urlname) = $row_url;
			
			$img = $datos['courseimg'];
			$ruta = './../resource/images/course/'.$img;

			$data[] = array ( 	 	 	 	 	 	 	 	 	 	 	 	  											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codecourse' => $datos['codecourse'], 
				'codesubcategory' => $datos['codesubcategory'], 
				'coursename' => $datos['coursename'], 
				'coursedesc' => $datos['coursedesc'], 
				'courseinit' => $datos['courseinit'], 
				'courseday' => $datos['courseday'], 
				'coursetime' => $datos['coursetime'], 
				'coursemode' => $datos['coursemode'], 
				'coursephone' => $datos['coursephone'], 
				'courseprice' => $datos['courseprice'], 
				'coursedscto' => $datos['coursedscto'], 
				'courseinstitute' => $datos['courseinstitute'], 
				'coursefooter' => $datos['coursefooter'],
				
				'urlname' => $urlname,
				
				//'courseimg' => $datos['courseimg'],
				'courseimage' => '<div style="padding:5px;">'
							.'<img src='.$ruta.' width="100" height="100"/>'
							."</div>",
				'courseinfo1' => '<div  style="margin-top:10px;margin-bottom:10px;">'
								."&nbsp;<b>NOMBRE: </b><span style='margin-left:5px;'>".$datos['coursename']
								."</span><br/>&nbsp;<b>URL: </b><span style='margin-left:5px;'>".$urlname								
								."</span></div>",
								
				'courseinfo2' => '<div  style="margin-top:10px;margin-bottom:10px;">'
								."&nbsp;<b>DESCRIPCION: </b><span style='margin-left:5px;'>".$datos['coursedesc']
								."</span></div>",
								
				'courseinfo3' => '<div  style="margin-top:10px;margin-bottom:10px;">'
								."&nbsp;<b>INICIO: </b><span style='margin-left:5px;'>".$datos['courseinit']
								."</span><br/>&nbsp;<b>DIAS: </b><span style='margin-left:5px;'>".$datos['courseday']								
								."</span><br/>&nbsp;<b>HORA: </b><span style='margin-left:5px;'>".$datos['coursetime']								
								."</span><br/>&nbsp;<b>MODALIDAD: </b><span style='margin-left:5px;'>".$datos['coursemode']								
								."</span><br/>&nbsp;<b>TELF/CEL: </b><span style='margin-left:5px;'>".$datos['coursephone']								
								."</span><br/>&nbsp;<b>PRECIO: </b><span style='margin-left:5px;'>".$datos['courseprice']	
								."</span><br/>&nbsp;<b>DSCTO: </b><span style='margin-left:5px;'>".$datos['coursedscto']								
								."</span><br/>&nbsp;<b>INSTITUTOS: </b><span style='margin-left:5px;'>".$datos['courseinstitute']								
								."</span><br/>&nbsp;<b>FOOTER: </b><span style='margin-left:5px;'>".$datos['coursefooter']									
								."</span></div>"/*,
				'courseinfo3' => '<div  style="margin-top:10px;margin-bottom:10px;">'
								."&nbsp;PRECIO: <span style='margin-left:5px;'>".$datos['courseprice']
								."</span><br/>&nbsp;DSCTO: <span style='margin-left:5px;'>".$datos['coursedscto']								
								."</span><br/>&nbsp;INSTITUTOS: <span style='margin-left:5px;'>".$datos['courseinstitute']								
								."</span><br/>&nbsp;FOOTER: <span style='margin-left:5px;'>".$datos['coursefooter']								
								."</span></div>"*/
			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "person") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$nameperson = isset($_POST['nameperson']) ? mysqli_real_escape_string($connection, $_POST['nameperson']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "personname like '%$nameperson%' and persontype = 'Estudiante'";
		$rs = db_query("select count(*) from person where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from person where " . $where . " order by codeperson asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array (  	  	 	 	 	 	 											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codeperson' => $datos['codeperson'], 
				'personname' => $datos['personname'],
				'personphone' => $datos['personphone'],
				'personmail' => $datos['personmail'],
				'personpassword' => $datos['personpassword'],
				'password' => password($datos['personpassword']),
				'persontype' => $datos['persontype']
				
			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "persond") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$nameperson = isset($_POST['nameperson']) ? mysqli_real_escape_string($connection, $_POST['nameperson']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "personname like '%$nameperson%' and persontype = 'Docente'";
		$rs = db_query("select count(*) from person where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from person where " . $where . " order by codeperson asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array (  	  	 	 	 	 	 											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codeperson' => $datos['codeperson'], 
				'personname' => $datos['personname'],
				'personphone' => $datos['personphone'],
				'personmail' => $datos['personmail'],
				'personpassword' => $datos['personpassword'],
				'password' => password($datos['personpassword']),
				'persontype' => $datos['persontype']
				
			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "paid") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$namepaid = isset($_POST['namepaid']) ? mysqli_real_escape_string($connection, $_POST['namepaid']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "detailname like '%$namepaid%'";
		$rs = db_query("select count(*) from detail where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from detail where " . $where . " order by codedetail asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$detailstate = $datos['detailstate'];
			if($detailstate == 'EN PROCESO'){
				$states = 'POR PAGAR';
			}
			if($detailstate == 'EN PROCESO'){$states = 'POR PAGAR';}
			if($detailstate == 'FINALIZADO'){$states = 'EN PROCESO DE VERIFICACION';}
			if($detailstate == 'PAGADO'){$states = 'PAGADO';}
			if($detailstate == 'ANULADO'){$states = 'RECHAZADO';}
			
			$data[] = array (   	 	 	 	 	 	 	 	  	 	 	 	 	 											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codedetail' => $datos['codedetail'], 
				'codecourse' => $datos['codecourse'],
				'codeperson' => $datos['codeperson'],
				'detailname' => $datos['detailname'],
				'detailcourse' => $datos['detailcourse'],
				'detailprice' => $datos['detailprice'],
				'detailtype' => $datos['detailtype'],
				'detailstate' => $datos['detailstate'],
				'detailstates' => $states,
				'detaildate' => $datos['detaildate']
				
			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "lesson") {
		
		$codecourse = $_GET['codecourse'];
		$row_url = db_fetch_array (db_query("select urlname from url where codecourse = '$codecourse'"));
		list ($urlname) = $row_url;
			
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$namelesson = isset($_POST['namelesson']) ? mysqli_real_escape_string($connection, $_POST['namelesson']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "lessonname like '%$namelesson%' and codecourse = '$codecourse'";
		$rs = db_query("select count(*) from lesson where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from lesson where " . $where . " order by codelesson asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array (    	 	 	 	 	 	 		 	 	 	 	 	 	 	  	 	 	 	 	 											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codelesson' => $datos['codelesson'], 
				'codecourse' => $datos['codecourse'],
				'lessoncourse' => $datos['lessoncourse'],
				'lessonnro' => $datos['lessonnro'],
				'lessonname' => $datos['lessonname'],
				'lessondesc' => $datos['lessondesc'],
				'lessonurl' => $datos['lessonurl'],
				'lessonurldoc' => $datos['lessonurldoc']
				
			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "logo") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$namelogo = isset($_POST['namelogo']) ? mysqli_real_escape_string($connection, $_POST['namelogo']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "logoimg like '$namelogo%'";
		$rs = db_query("select count(*) from logo where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		$cont=0;
		$rs = db_query("select * from logo where " . $where . " order by codelogo asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			$img = $datos['logoimg'];
			$ruta = './../resource/images/'.$img;
			$cont++;
			if($cont==1){
				$color = '#000000';
			}else{
				$color = '#ffffff';
			}
			$data[] = array (  											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codelogo' => $datos['codelogo'], 
				//'logoimg' => $datos['logoimg'],
				
				'infoimg' => "<div style='background:$color;padding:10px;'>"
								.'<img src='.$ruta.' width="212" height="90"/>'
								."</div>"


			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "banner") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$namebanner = isset($_POST['namebanner']) ? mysqli_real_escape_string($connection, $_POST['namebanner']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "bannerimg like '$namebanner%'";
		$rs = db_query("select count(*) from banner where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from banner where " . $where . " order by codebanner asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			$img = $datos['bannerimg'];
			$ruta = './../resource/images/'.$img;
	
			$data[] = array (  											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codebanner' => $datos['codebanner'], 
				//'bannerimg' => $datos['bannerimg'],
				
				'infoimg' => '<div style="padding:5px;">'
								.'<img src='.$ruta.' width="500" height="215"/>'
								."</div>"


			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "short") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$nameshort = isset($_POST['nameshort']) ? mysqli_real_escape_string($connection, $_POST['nameshort']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "shortimg like '$nameshort%'";
		$rs = db_query("select count(*) from short where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from short where " . $where . " order by codeshort asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			$img = $datos['shortimg'];
			$ruta = './../resource/images/'.$img;
			
			$codecourse = $datos['codecourse'];			
			$row_course = db_fetch_array (db_query("select coursename from course where codecourse = '$codecourse'"));
			list ($coursename) = $row_course;

			$data[] = array (  											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codeshort' => $datos['codeshort'], 
				'codecourse' => $datos['codecourse'], 
				'shortname' => $coursename, 
				//'shortimg' => $datos['shortimg'],
				
				'infoimg' => '<div style="padding:5px;">'
								.'<img src='.$ruta.' width="500" height="215"/>'
								."</div>"


			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "institutions") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$nameinstitutions = isset($_POST['nameinstitutions']) ? mysqli_real_escape_string($connection, $_POST['nameinstitutions']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "institutionsimg like '$nameinstitutions%'";
		$rs = db_query("select count(*) from institutions where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from institutions where " . $where . " order by codeinstitutions asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			$img = $datos['institutionsimg'];
			$ruta = './../resource/images/institutions/'.$img;
	
			$data[] = array (  											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codeinstitutions' => $datos['codeinstitutions'], 
				'institutionsname' => $datos['institutionsname'],
				//'institutionsimg' => $datos['institutionsimg'],
				
				'infoimg' => '<div style="padding:5px;">'
								.'<img src='.$ruta.' width="150" height="150"/>'
								."</div>"


			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "certification") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$namecertification = isset($_POST['namecertification']) ? mysqli_real_escape_string($connection, $_POST['namecertification']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "certificationtitle like '$namecertification%'";
		$rs = db_query("select count(*) from certification where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from certification where " . $where . " order by codecertification asc limit $offset,$rows");
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
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "title") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$nametitle = isset($_POST['nametitle']) ? mysqli_real_escape_string($connection, $_POST['nametitle']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "titlename like '$nametitle%'";
		$rs = db_query("select count(*) from title where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from title where " . $where . " order by codetitle asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array (  	   	 	 	 	 		 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
			'codetitle' => $datos['codetitle'], 
			'titlename' => $datos['titlename']
			);
		}
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "location") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$namelocation = isset($_POST['namelocation']) ? mysqli_real_escape_string($connection, $_POST['namelocation']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "locationurl like '$namelocation%'";
		$rs = db_query("select count(*) from location where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from location where " . $where . " order by codelocation asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array (  											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codelocation' => $datos['codelocation'], 
				'locationurl' => $datos['locationurl']
			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "text") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$nametext = isset($_POST['nametext']) ? mysqli_real_escape_string($connection, $_POST['nametext']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "textsection like '$nametext%'";
		$rs = db_query("select count(*) from text where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from text where " . $where . " order by codetext asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$codetitle = $datos['codetitle'];
			$row_title = db_fetch_array (db_query("select titlename from title where codetitle = '$codetitle'"));
			list ($titlename) = $row_title;
			
			$data[] = array (  	   	 	 	 	 		 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
			'codetext' => $datos['codetext'], 
			'codetitle' => $datos['codetitle'], 
			'texttitle' => $titlename, 
			'textsection' => $datos['textsection']
			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "imgt") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$nameimgt = isset($_POST['nameimgt']) ? mysqli_real_escape_string($connection, $_POST['nameimgt']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "imgtname like '$nameimgt%'";
		$rs = db_query("select count(*) from imgt where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from imgt where " . $where . " order by codetitle asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			$img = $datos['imgtname'];
			$ruta = './../resource/images/'.$img;
			$codetitle = $datos['codetitle'];
			$row_title = db_fetch_array (db_query("select titlename from title where codetitle = '$codetitle'"));
			list ($titlename) = $row_title;
			$data[] = array (  											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codeimgt' => $datos['codeimgt'], 
				'codetitle' => $datos['codetitle'], 
				'imgttitle' => $titlename, 
				//'imgtname' => $datos['imgtname'],
				
				'infoimgt' => '<div style="">'
								.'<img src='.$ruta.' width="100" height="100"/>'
								."</div>"


			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "titlea") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$nametitlea = isset($_POST['nametitlea']) ? mysqli_real_escape_string($connection, $_POST['nametitlea']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "titleaname like '$nametitlea%'";
		$rs = db_query("select count(*) from titlea where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from titlea where " . $where . " order by codetitlea asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array (  	   	 	 	 	 		 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
			'codetitlea' => $datos['codetitlea'], 
			'titleaname' => $datos['titleaname']
			);
		}
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "texta") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$nametexta = isset($_POST['nametexta']) ? mysqli_real_escape_string($connection, $_POST['nametexta']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "textasection like '$nametexta%'";
		$rs = db_query("select count(*) from texta where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from texta where " . $where . " order by codetexta asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$codetitlea = $datos['codetitlea'];
			$row_titlea = db_fetch_array (db_query("select titleaname from titlea where codetitlea = '$codetitlea'"));
			list ($titleaname) = $row_titlea;
			
			$data[] = array (  	   	 	 	 	 		 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
			'codetexta' => $datos['codetexta'], 
			'codetitlea' => $datos['codetitlea'], 
			'textatitle' => $titleaname, 
			'textasection' => $datos['textasection']
			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "imga") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$nameimga = isset($_POST['nameimga']) ? mysqli_real_escape_string($connection, $_POST['nameimga']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "imganame like '$nameimga%'";
		$rs = db_query("select count(*) from imga where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from imga where " . $where . " order by codetitlea asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			$img = $datos['imganame'];
			$ruta = './../resource/images/'.$img;
			$codetitlea = $datos['codetitlea'];
			$row_titlea = db_fetch_array (db_query("select titleaname from titlea where codetitlea = '$codetitlea'"));
			list ($titleaname) = $row_titlea;
			$data[] = array (  											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codeimga' => $datos['codeimga'], 
				'codetitlea' => $datos['codetitlea'], 
				'imgatitle' => $titleaname, 
				//'imganame' => $datos['imganame'],
				
				'infoimga' => '<div style="">'
								.'<img src='.$ruta.' width="100" height="100"/>'
								."</div>"
			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "titleg") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$nametitleg = isset($_POST['nametitleg']) ? mysqli_real_escape_string($connection, $_POST['nametitleg']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "titlegname like '$nametitleg%'";
		$rs = db_query("select count(*) from titleg where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from titleg where " . $where . " order by codetitleg asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array (  	   	 	 	 	 		 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
			'codetitleg' => $datos['codetitleg'], 
			'titlegname' => $datos['titlegname']
			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "imgg") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$nameimgg = isset($_POST['nameimgg']) ? mysqli_real_escape_string($connection, $_POST['nameimgg']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "imggname like '$nameimgg%'";
		$rs = db_query("select count(*) from imgg where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from imgg where " . $where . " order by codetitleg asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			$img = $datos['imggname'];
			$ruta = './../resource/images/'.$img;
			$codetitleg = $datos['codetitleg'];
			$row_titleg = db_fetch_array (db_query("select titlegname from titleg where codetitleg = '$codetitleg'"));
			list ($titlegname) = $row_titleg;
			$data[] = array (  											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codeimgg' => $datos['codeimgg'], 
				'codetitleg' => $datos['codetitleg'], 
				'titlegname' => $titlegname, 
				//'imggname' => $datos['imggname'],
				
				'infoimg' => '<div style="">'
								.'<img src='.$ruta.' width="100" height="100"/>'
								."</div>"


			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "ambience") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$nameambience = isset($_POST['nameambience']) ? mysqli_real_escape_string($connection, $_POST['nameambience']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "ambiencename like '$nameambience%'";
		$rs = db_query("select count(*) from ambience where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from ambience where " . $where . " order by codeambience asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			$img = $datos['ambienceimg'];
			$ruta = './../resource/images/'.$img;
			$data[] = array (  											 	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
				'codeambience' => $datos['codeambience'], 
				'ambiencename' => $datos['ambiencename'], 
				//'ambienceimg' => $datos['ambienceimg'],
				
				'infoimg' => '<div style="">'
								.'<img src='.$ruta.' width="100" height="100"/>'
								."</div>"


			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}
	
	if($_GET["option"] == "contact") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$namecontact = isset($_POST['namecontact']) ? mysqli_real_escape_string($connection, $_POST['namecontact']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "contactaddress like '$namecontact%'";
		$rs = db_query("select count(*) from contact where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from contact where " . $where . " order by codecontact asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array (  	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
			'codecontact' => $datos['codecontact'], 
			'contactaddress' => $datos['contactaddress'], 
			'contactphone' => $datos['contactphone'], 
			'contactcel' => $datos['contactcel'],
			'contactline' => $datos['contactline'],
			'contactlocation' => $datos['contactlocation'],
			'infolocation' => $datos['contactlocation']
			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}

	if($_GET["option"] == "user") {
	
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		
		$nameuser = isset($_POST['nameuser']) ? mysqli_real_escape_string($connection, $_POST['nameuser']) : '';
		
		$offset = ($page-1)*$rows;
		
		$result = array();
		
		$where = "username like '$nameuser%'";
		$rs = db_query("select count(*) from user where " . $where);
		$row = mysqli_fetch_row($rs);
		$result["total"] = $row[0];
		
		$rs = db_query("select * from user where " . $where . " order by username asc limit $offset,$rows");
		$data = array ();
		while ($datos = mysqli_fetch_assoc($rs) ){
			
			$data[] = array (  	  	 	 	 	 	 	 	 	 	 	 	  	 	 	 	 	 	 		  	 	 	 	 	 		 	 	 	 
			'codeuser' => $datos['codeuser'], 
			'username' => $datos['username'], 
			'usertype' => $datos['usertype'], 
			'userlogin' => $datos['userlogin'], 
			'userpassword' => $datos['userpassword'],
			'password' => password($datos['userpassword'])
			);
		}
		
		$result["rows"] = $data;
		echo json_encode($result);
	}

	function password($cadena){
		
		$characters = strlen($cadena);
		$str = '';
		
		for($i = 0; $i < $characters; $i++){
			$str .= '*';
		}
		return $str;
		//echo $str;
	}
	
	function countFilesIn ( $path, $extensionArchivo ) {
		$matches = glob ( $path . "*." . $extensionArchivo );
		$numDirectories = 0;
	 
		if( $matches ) {
			$numDirectories = count( $matches );
		}
	 
		return $numDirectories;
	}

?>