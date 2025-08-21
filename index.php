<?php session_start ();
date_default_timezone_set('America/La_Paz');

require_once (dirname (__FILE__) . "/admin/setup.php");
db_connect ();

if(isset($_SESSION['codeperson'])) {
	$codeperson = $_SESSION [ 'codeperson' ];
}else{
	$codeperson = 0;
}

//$codeperson = $_SESSION [ 'codeperson' ];
$_SESSION [ 'codeperson' ] = $codeperson ; 

$row_person = db_fetch_array (db_query("select personname, persontype from person where codeperson = '$codeperson'"));
list ($personname, $persontype) = $row_person;

$row_logowhite = db_fetch_array (db_query("select logoimg from logo where codelogo = '1'"));
list ($logowhite) = $row_logowhite;

$row_logoblack = db_fetch_array (db_query("select logoimg from logo where codelogo = '2'"));
list ($logoblack) = $row_logoblack;

$row_banner1 = db_fetch_array (db_query("select bannerimg from banner where codebanner = '1'"));
list ($banner_1) = $row_banner1;

$row_banner2 = db_fetch_array (db_query("select bannerimg from banner where codebanner = '2'"));
list ($banner_2) = $row_banner2;

$row_banner3 = db_fetch_array (db_query("select bannerimg from banner where codebanner = '3'"));
list ($banner_3) = $row_banner3;

$row_short1 = db_fetch_array (db_query("select codecourse, shortimg from short where codeshort = '1'"));
list ($shortcode_1, $short_1) = $row_short1;

$row_shortcourse1 = db_fetch_array (db_query("select coursename, coursedesc from course where codecourse = '$shortcode_1'"));
list ($coursename_1, $coursedesc_1) = $row_shortcourse1;

$row_short2 = db_fetch_array (db_query("select codecourse, shortimg from short where codeshort = '2'"));
list ($shortcode_2, $short_2) = $row_short2;

$row_shortcourse2 = db_fetch_array (db_query("select coursename, coursedesc from course where codecourse = '$shortcode_2'"));
list ($coursename_2, $coursedesc_2) = $row_shortcourse2;

$row_short3 = db_fetch_array (db_query("select codecourse, shortimg from short where codeshort = '3'"));
list ($shortcode_3, $short_3) = $row_short3;

$row_shortcourse3 = db_fetch_array (db_query("select coursename, coursedesc from course where codecourse = '$shortcode_3'"));
list ($shortcourse_3, $coursedesc_3) = $row_shortcourse3;

$row_short4 = db_fetch_array (db_query("select codecourse, shortimg from short where codeshort = '4'"));
list ($shortcode_4, $short_4) = $row_short4;

$row_shortcourse4 = db_fetch_array (db_query("select coursename, coursedesc from course where codecourse = '$shortcode_4'"));
list ($shortcourse_4, $coursedesc_4) = $row_shortcourse4;

$row_cant = db_fetch_array (db_query("select count(*) as cant from detail where codeperson = '$codeperson' and detailstate='EN PROCESO'"));
list ($cant) = $row_cant;

$row_cert1 = db_fetch_array (db_query("select certificationtitle, certificationdesc, certificationcolor, certificationimg from certification where codecertification = '1'"));
list ($certificationtitle_1, $certificationdesc_1, $certificationcolor_1, $certificationimg_1) = $row_cert1;

$row_cert2 = db_fetch_array (db_query("select certificationtitle, certificationdesc, certificationcolor, certificationimg from certification where codecertification = '2'"));
list ($certificationtitle_2, $certificationdesc_2, $certificationcolor_2, $certificationimg_2) = $row_cert2;


	function obtenerFechaEnLetra($fecha){
		$dia= conocerDiaSemanaFecha($fecha);
		$num = date("j", strtotime($fecha));
		$anno = date("Y", strtotime($fecha));
		$mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
		$mes = $mes[(date('m', strtotime($fecha))*1)-1];
		//return $dia.', '.$num.' de '.$mes.' del '.$anno;
		return strtoupper($dia);
	}

	function conocerDiaSemanaFecha($fecha) {
		//$dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
		$dias = array('DOMINGO', 'LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO');
		$dia = $dias[date('w', strtotime($fecha))];
		return $dia;
	}
	

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GENESIS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free php Templates" name="keywords">
    <meta content="Free php Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  
	<!--
	<link href="admin/resource/style/themes/gray/easyui.css" rel="stylesheet">
	-->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
	
	<link rel="stylesheet" href="lib/alertify/themes/alertify.core.css" />
	<link rel="stylesheet" href="lib/alertify/themes/alertify.default.css" />
	
	<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css" rel="stylesheet" >
		
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css?v=1.6" rel="stylesheet">
	
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
		<!-- -->
		<div class="row bg-secondary py-1 px-xl-5">
            
            <div class="col-lg-6 text-center text-lg-right">
                
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <?php
						if($personname == ''){
							echo"
							<a href='cart.php' class='btn px-0'>
								<i class='fas fa-shopping-cart text-primary'></i>&nbsp;&nbsp;&nbsp;&nbsp;
								<!--<span class='badge text-secondary border border-secondary rounded-circle' style='padding-bottom: 2px;'>$cant</span>-->
							</a>
							<a href='login.php' class='btn px-0'>
								<i class='fas fa-user text-primary'></i>
								<span class='badge text-secondary border1 border-secondary rounded-circle1' style='padding-bottom: 2px;'>Iniciar Sesión</span>
							</a>
							<a href='register.php' class='btn px-0 ml-3'>
								<i class='fas fa-user-plus text-primary'></i>
								<span class='badge text-secondary border1 border-secondary rounded-circle1' style='padding-bottom: 2px;'>Registrate</span>
							</a>";
							
						}else{
							echo"
							<a href='cart.php' class='btn px-0'>
								<i class='fas fa-shopping-cart text-primary'></i>
								<span class='badge text-secondary border border-secondary rounded-circle' id='cant_cart' style='padding-bottom: 2px;'>$cant</span>
							</a>
							<a href='#' id='btn_close' class='btn px-0'>
								<span class='badge text-secondary border1 border-secondary rounded-circle1' style='padding-bottom: 2px;margin-right:10px;'>$personname</span>
								<i class='fas fa-user-times text-primary'></i>
							</a>
							";
						}
					?>
					
                </div>
				
            </div>
			
			<div class="col-lg-6 text-center text-lg-right">
             
				<div class="d-inline-flex align-items-center d-block d-lg-none">
                    
					<div class='row'>
						<div class='input-group'>
							<input type='text' class='form-control' placeholder='Buscar Cursos' id='skill_inputs'>
							<div class='input-group-append'>
								<span class='input-group-text bg-transparent text-primary'>
									<i class='fa fa-search'></i>
								</span>
							</div>
						</div>
					</div>
						
                </div>
				
            </div>
        </div>
		<!-- -->
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="#" class="text-decoration-none">
                    <?php echo"<img src='admin/resource/images/$logowhite' alt='Logo' style='width:150px;'>";?>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action=""  onsubmit="return false;">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar Cursos" id="skill_input">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>						
					</div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Atención al Cliente</p>
                <h5 class="m-0">+591 63994357</h5>
				<?php
				if($codeperson != 0){
					echo"
					<a href='registerc.php'>DICTAR CLASES</a>
					";
				}
                
				?>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start 134f84-->
	<?php 
		if($personname == ''){
			echo'<div class="container-fluid bg-dark mb-30">';
		}else{
			echo'<div class="container-fluid bg-dark mb-30"  style="background:#2E8B57 !important;">';
		}
		
	?>
	<!--<div class="container-fluid bg-dark mb-30">-->
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categorias</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100" style="background:#fff;">
						<?php
						$cont = 0;
						$query_category = "select * from category where codecategory != '1' order by codecategory asc";
						$result_category=db_query($query_category);
						while($row_category = mysqli_fetch_array($result_category))
						{ 	 	 	 	 	 	 	 	 	 	 	 	
							$cont++;		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
							$codecategory = $row_category['codecategory'];
							$categoryname = $row_category['categoryname'];
							if(db_exist("select * from subcategory where codecategory = '$codecategory'")){
								echo"
								<div class='nav-item dropdown dropright'>
									<a href='category.php?codecategory=$codecategory' class='nav-link dropdown-toggle' data-toggle='dropdown'>$categoryname<i class='fa fa-angle-right float-right mt-1'></i></a>
									<div class='dropdown-menu position-absolute rounded-0 border-0 m-0'>";
									$conts = 0;
									$query_sub = "select * from subcategory where codecategory = '$codecategory' order by codesubcategory asc";
									$result_sub=db_query($query_sub);
									while($row_sub = mysqli_fetch_array($result_sub))
									{ 	 	 	 	 	 	 	 	 	 	 	 	
										$conts++;		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
										$codesubcategory = $row_sub['codesubcategory'];
										$subcategoryname = $row_sub['subcategoryname'];
										
										echo"<a href='subcategory.php?codesubcategory=$codesubcategory' class='dropdown-item'>$subcategoryname</a>";
									}
									echo"
									</div>
								</div>
								";
							}else{
								echo"<a href='category.php?codecategory=$codecategory' class='nav-item nav-link' style=''>$categoryname</a>";
							}
						}
						?>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
				<?php 
					if($personname == ''){
						echo'<nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">';
					}else{
						echo'<nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0" style="background:#2E8B57 !important;">';
					}
					
				?>
                <!--<nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0" style="background:#2E8B57 !important;">-->
                    <a href="" class="text-decoration-none d-block d-lg-none">
						<?php echo"<img src='admin/resource/images/$logoblack' alt='Logo' style='width:150px;'>";?>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
							<?php
							if($personname == ''){
								echo'
								<a href="index.php" class="nav-item nav-link active">Inicio</a>
								<a href="about.php" class="nav-item nav-link">Acerca De</a>
								<a href="shop.php" class="nav-item nav-link">Cursos</a>
								<!--<a href="course.php" class="nav-item nav-link">Mis Cursos</a>
								<a href="cart.php" class="nav-item nav-link">Carrito Compras</a>-->
								<a href="contact.php" class="nav-item nav-link">Contacto</a>
								
								';
							}else{
								if($persontype == 'Estudiante'){
									echo'
									<a href="index.php" class="nav-item nav-link active">Inicio</a>
									<a href="about.php" class="nav-item nav-link">Acerca De</a>
									<a href="shop.php" class="nav-item nav-link">Cursos</a>
									<a href="course.php" class="nav-item nav-link">Mis Cursos</a>
									<a href="contact.php" class="nav-item nav-link">Contacto</a>
									';
								}else{
									echo'
									<a href="index.php" class="nav-item nav-link active">Inicio</a>
									<a href="about.php" class="nav-item nav-link">Acerca De</a>
									<a href="shop.php" class="nav-item nav-link">Cursos</a>
									<a href="course.php" class="nav-item nav-link">Mis Cursos</a>
									<a href="contact.php" class="nav-item nav-link">Contacto</a>
									';
								}
								
							}
							?>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
							<?php
								if($personname == ''){
									echo"
									<a href='cart.php' class='btn px-0'>
										<i class='fas fa-shopping-cart text-primary'></i>&nbsp;&nbsp;&nbsp;&nbsp;
										<!--<span class='badge text-secondary border border-secondary rounded-circle' style='padding-bottom: 2px;'>$cant</span>-->
									</a>
									<a href='login.php' class='btn px-0'>
										<i class='fas fa-user text-primary'></i>
										<span class='badge text-secondary border1 border-secondary rounded-circle1' style='padding-bottom: 2px;'>Iniciar Sesión</span>
									</a>
									<a href='register.php' class='btn px-0 ml-3'>
										<i class='fas fa-user-plus text-primary'></i>
										<span class='badge text-secondary border1 border-secondary rounded-circle1' style='padding-bottom: 2px;'>Registrate</span>
									</a>";
								}else{
									if($persontype == 'Estudiante'){
										echo"
										<a href='cart.php' class='btn px-0'>
											<i class='fas fa-shopping-cart text-primary'></i>
											<span class='badge text-secondary border border-secondary rounded-circle' id='cant_carts' style='padding-bottom: 2px;'>$cant</span>
										</a>
										<a href='#' id='btn_closes' class='btn px-0'>
											<span class='badge text-secondary border1 border-secondary rounded-circle1' style='padding-bottom: 2px;margin-right:10px;'>$personname</span>
											<i class='fas fa-user-times text-primary'></i>
										</a>
										";
									}else{
										echo"
										<a href='#' id='btn_closes' class='btn px-0'>
											<span class='badge text-secondary border1 border-secondary rounded-circle1' style='padding-bottom: 2px;margin-right:10px;'>$personname</span>
											<i class='fas fa-user-times text-primary'></i>
										</a>
										";
									}
								}
							?>
							
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
	
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <?php echo"<img class='position-absolute w-100 h-100' src='admin/resource/images/$banner_1' style='object-fit: cover;'>"?>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <?php echo"<img class='position-absolute w-100 h-100' src='admin/resource/images/$banner_2' style='object-fit: cover;'>"?>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <?php echo"<img class='position-absolute w-100 h-100' src='admin/resource/images/$banner_3' style='object-fit: cover;'>"?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;" id='popoverShort_1'>
                    <div id="header-carousel4" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
						<!--<ol class="carousel-indicators">
							<?php
							$contsh = 0;
							$query_short = "select * from short order by codeshort desc";
							$result_short=db_query($query_short);
							while($row_short = mysqli_fetch_array($result_short))
							{ 	 	 	 	 	 	 	 	 	 	 	 	
								$contsh++;	  	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
								if($contsh == 1){
									echo"<li data-target='#header-carousel4' data-slide-to='0' class='active'></li>";
								}else{
									echo"<li data-target='#header-carousel4' data-slide-to='$contsh'></li>";
								}
							}
							
							?>
						</ol>-->
						<div class="carousel-inner">
							<?php
							$contshor = 0;
							$query_shortsr = "select * from short order by codeshort desc";
							$result_shortsr=db_query($query_shortsr);
							while($row_shortsr = mysqli_fetch_array($result_shortsr))
							{ 	 	 	 	 	 	 	 	 	 	 	 	
								$contshor++;	
								$codeshortsr = $row_shortsr['codeshort'];								
								$shortcodesr = $row_shortsr['codecourse'];								
								$shortimgsr = $row_shortsr['shortimg'];								
								if($contshor == 1){
									echo"<div class='carousel-item position-relative active' style='height: 200px;'>
										<img class='position-absolute w-100 h-100' src='admin/resource/images/$shortimgsr' style='object-fit: cover;'>
										<div class='offer-text'>
											<h6 class='text-white text-uppercase'> &nbsp; </h6>
											<a href='#' class='btn btn-primary' onclick='add_course($shortcodesr)'>Comprar</a>
										</div>
									</div>";
								}else{
									echo"<div class='carousel-item position-relative' style='height: 200px;'>
											<img class='position-absolute w-100 h-100' src='admin/resource/images/$shortimgsr' style='object-fit: cover;'>
											<div class='offer-text'>
												<h6 class='text-white text-uppercase'> &nbsp; </h6>
												<a href='#' class='btn btn-primary' onclick='add_course($shortcodesr)'>Comprar</a>
											</div>
										</div>";
								}
							}
							
							?>
							
						</div>
					</div>
                </div>
                <!--<div class="product-offer mb-30" style="height: 200px;" id='popoverShort_1' data-toggle='popover' data-placement="auto" data-html='true' data-content='<?php echo $coursedesc_1;?>' rel='popover' data-original-title='<?php echo $coursename_1;?>' data-trigger='hover'>
                    <?php echo"<img class='img-fluid' src='admin/resource/images/$short_1' alt='short'>";?>
                 
					<div class="offer-text">
						<h6 class="text-white text-uppercase"> &nbsp; </h6>
                        <h3 class="text-white mb-3"> &nbsp; </h3>
                        <?php echo "<a href='#' class='btn btn-primary' onclick='add_course($shortcode_1)'>Comprar</a>";?>
                    </div>
                </div>
				
                <div class="product-offer mb-30" style="height: 200px;" id='popoverShort_2' data-toggle='popover' data-placement="auto" data-html='true' data-content='<?php echo $coursedesc_2;?>' rel='popover' data-original-title='<?php echo $coursename_2;?>' data-trigger='hover'>
                    <?php echo"<img class='img-fluid' src='admin/resource/images/$short_2' alt='short'>";?>
					<div class="offer-text">
						<h6 class="text-white text-uppercase"> &nbsp; </h6>
                        <h3 class="text-white mb-3"> &nbsp; </h3>
                        <?php echo "<a href='#' class='btn btn-primary' onclick='add_course($shortcode_2)'>Comprar</a>";?>
                    </div>
                </div>
				-->
				<div class="product-offer mb-30" style="height: 200px;" id='popoverShort_2' data-toggle='popover' data-placement="auto" data-html='true' data-content='<?php echo $coursedesc_2;?>' rel='popover' data-original-title='<?php echo $coursename_2;?>' data-trigger='hover'>
                    <div id="header-carousel4" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
						<!--<ol class="carousel-indicators">
							<?php
							$contsh = 0;
							$query_short = "select * from short order by codeshort asc";
							$result_short=db_query($query_short);
							while($row_short = mysqli_fetch_array($result_short))
							{ 	 	 	 	 	 	 	 	 	 	 	 	
								$contsh++;	  	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
								if($contsh == 1){
									echo"<li data-target='#header-carousel4' data-slide-to='0' class='active'></li>";
								}else{
									echo"<li data-target='#header-carousel4' data-slide-to='$contsh'></li>";
								}
							}
							
							?>
						</ol>-->
						<div class="carousel-inner">
							<?php
							$contsho = 0;
							$query_shorts = "select * from short order by codeshort asc";
							$result_shorts=db_query($query_shorts);
							while($row_shorts = mysqli_fetch_array($result_shorts))
							{ 	 	 	 	 	 	 	 	 	 	 	 	
								$contsho++;	
								$codeshorts = $row_shorts['codeshort'];								
								$shortcodes = $row_shorts['codecourse'];								
								$shortimgs = $row_shorts['shortimg'];								
								if($contsho == 1){
									echo"<div class='carousel-item position-relative active' style='height: 200px;'>
										<img class='position-absolute w-100 h-100' src='admin/resource/images/$shortimgs' style='object-fit: cover;'>
										<div class='offer-text'>
											<h6 class='text-white text-uppercase'> &nbsp; </h6>
											<a href='#' class='btn btn-primary' onclick='add_course($shortcodes)'>Comprar</a>
										</div>
									</div>";
								}else{
									echo"<div class='carousel-item position-relative' style='height: 200px;'>
											<img class='position-absolute w-100 h-100' src='admin/resource/images/$shortimgs' style='object-fit: cover;'>
											<div class='offer-text'>
												<h6 class='text-white text-uppercase'> &nbsp; </h6>
												<a href='#' class='btn btn-primary' onclick='add_course($shortcodes)'>Comprar</a>
											</div>
										</div>";
								}
							}
							
							?>
							
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->
	<?php
	//$date = date("Y-m-d");
	$date = date("d-m-Y");
	$time = date("H:i");
	$day = obtenerFechaEnLetra($date);
	if(db_exist("select * from course where coursedateend >= '$date' and coursedateinit <= '$date' and coursetimeend >= '$time' and coursetimeinit <= '$time'")){
	?>

    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4 blink_me"><span class="bg-danger pr-3"> &nbsp;Cursos En Vivo </span></h2>
        <div class="row px-xl-5">
			<?php
			$contc = 0;
			$query_course = "select * from course where coursedateend >= '$date' and coursedateinit <= '$date' and coursetimeend >= '$time' and coursetimeinit <= '$time'";
			$result_course=db_query($query_course);
			while($row_course = mysqli_fetch_array($result_course))
			{ 	 	 	 	 	 	 	 	 	 	 	 	
				$contc++;		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
				$codecourse = $row_course['codecourse'];
				$coursename = $row_course['coursename'];
				$coursedesc = $row_course['coursedesc'];
				$courseday = $row_course['courseday'];
				$courseprice = $row_course['courseprice'];
				$coursestar = $row_course['coursestar'];
				$coursetimeinit = $row_course['coursetimeinit'];
				$coursetimeend = $row_course['coursetimeend'];
				$courseimg = $row_course['courseimg'];
				
				$coursestars = ($coursestar * 200)/10;
				
				$desc = substr($coursedesc, 0, 400) . "...";
				
				if (strpos($courseday, $day) !== false) {
				//if (str_contains($courseday, $day)) {
				echo"
				<div class='col-lg-3 col-md-4 col-sm-6 pb-1'>
					<div class='product-item bg-light mb-4'>
						<div class='product-img position-relative overflow-hidden'>
							<img class='img-fluid w-100' src='admin/resource/images/course/$courseimg' alt=''>
								
							<div class='product-action' onclick='ref_detail($codecourse)' style='cursor: pointer;'>
									
								<div class='img-text' href='#' style='color:red;'>
									<p style='font-size:12px;color:#000000;font-weight:bold;text-align: justify;'>$coursename</p>
									<p style='font-size:12px;color:#000000;margin-top:-20px;text-align: justify;'>$desc</p>
									
									<div style='text-align:center;margin-top:-10px;'>
										<!--<a class='btn btn-outline-dark btn-square' href='#' onclick='add_course($codecourse)' style=''><i class='fa fa-shopping-cart'></i></a>-->
										<a href='javascript:void(0)' class='btn btn-secondary' onclick='add_course($codecourse)' style='background:#000000;color:#ffffff;border-color: #000000;'><i class='fa fa-shopping-cart'></i> &nbsp;&nbsp; Comprar</a>
									</div>
									
								</div>
							</div>
							
						</div>
						<div class='text-center py-4'>
							<a class='h6 text-decoration-none text-truncate' href='detail.php?codecourse=$codecourse'>".wordwrap($coursename, 25, "<br />\n")."</a>
							<div class='d-flex align-items-center justify-content-center mt-2'>
								<h5>Bs. $courseprice</h5><!--<h6 class='text-muted ml-2'><del>$123.00</del></h6>-->
							</div>
							<div class='d-flex align-items-center justify-content-center mb-1'>
							";	
							if($coursestar == '0.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '0.50'){
								echo"
								<small class='fa fa-star-half-alt text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '1.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '1.50'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star-half-alt text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '2.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '2.50'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star-half-alt text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '3.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '3.50'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star-half-alt text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '4.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '4.50'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star-half-alt text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '5.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							echo"
							</div>
						</div>
						
					</div>
				</div>
				";
				}
			}
			?>
			
        </div>
    </div>

	<?php
	}
	?>

    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Cursos Destacados</span></h2>

		<div class="row px-xl-5">
			<?php
			$contc = 0;
			$query_course = "select * from course where codesubcategory != '1' order by rand() limit 4";
			$result_course=db_query($query_course);
			while($row_course = mysqli_fetch_array($result_course))
			{ 	 	 	 	 	 	 	 	 	 	 	 	
				$contc++;		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
				$codecourse = $row_course['codecourse'];
				$coursename = $row_course['coursename'];
				$coursedesc = $row_course['coursedesc'];
				$courseprice = $row_course['courseprice'];
				$coursestar = $row_course['coursestar'];
				$courseimg = $row_course['courseimg'];
				
				$coursestars = ($coursestar * 200)/10;
				
				$desc = substr($coursedesc, 0, 400) . "...";
				echo"
				<div class='col-lg-3 col-md-4 col-sm-6 pb-1'>
					<div class='product-item bg-light mb-4'>
						<div class='product-img position-relative overflow-hidden'>
							<img class='img-fluid w-100' src='admin/resource/images/course/$courseimg' alt=''>
								
							<div class='product-action' onclick='ref_detail($codecourse)' style='cursor: pointer;'>
									
								<div class='img-text' href='#' style='color:red;'>
									<p style='font-size:12px;color:#000000;font-weight:bold;text-align: justify;'>$coursename</p>
									<p style='font-size:12px;color:#000000;margin-top:-20px;text-align: justify;'>$desc</p>
									
									<div style='text-align:center;margin-top:-10px;'>
										<!--<a class='btn btn-outline-dark btn-square' href='#' onclick='add_course($codecourse)' style=''><i class='fa fa-shopping-cart'></i></a>-->
										<a href='#' class='btn btn-secondary' onclick='add_course($codecourse)' style='background:#000000;color:#ffffff;border-color: #000000;'><i class='fa fa-shopping-cart'></i> &nbsp;&nbsp; Comprar</a>
									</div>
									
								</div>
							</div>
							
						</div>
						<div class='text-center py-4'>
							<a class='h6 text-decoration-none text-truncate' href='detail.php?codecourse=$codecourse'>".wordwrap($coursename, 25, "<br />\n")."</a>
							<div class='d-flex align-items-center justify-content-center mt-2'>
								<h5>Bs. $courseprice</h5><!--<h6 class='text-muted ml-2'><del>$123.00</del></h6>-->
							</div>
							<div class='d-flex align-items-center justify-content-center mb-1'>
								";	
							if($coursestar == '0.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '0.50'){
								echo"
								<small class='fa fa-star-half-alt text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '1.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '1.50'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star-half-alt text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '2.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '2.50'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star-half-alt text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '3.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '3.50'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star-half-alt text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '4.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '4.50'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star-half-alt text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '5.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							echo"
							</div>
						</div>
						
					</div>
				</div>
				";
			}
			?>
			
        </div>
    </div>
    
    <!-- Categories Start -->
	
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categorias</span></h2>
        <div class="row px-xl-5 pb-3">
            <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-pills mb-4">
						<?php
									
						$row_total = db_fetch_array (db_query("select count(*) as categorycant from category where codecategory != '1'"));
						list ($categorycant) = $row_total;
						
						$tabs = "";
						$content_tabs = "<div class='tab-content'>";
						$conti = 0;
						$query_categorysi = "select * from category where codecategory != '1' order by codecategory asc";
						$result_categorysi=db_query($query_categorysi);
						while($row_categorysi = mysqli_fetch_array($result_categorysi))
						{ 	 	 	 	 	 	 	 	 	 	 	 	
							$conti++;		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
							$codecategoryi = $row_categorysi['codecategory'];
							$categorynamei = $row_categorysi['categoryname'];
							$categoryimgi = $row_categorysi['categoryimg'];
							
							$row_counti = db_fetch_array (db_query("select count(*) as subcategorycant from subcategory where codecategory = '$codecategoryi'"));
							list ($subcategorycanti) = $row_counti;
							
							if($subcategorycanti > 0){
								if($conti == 1){
									//$tabs .= "<a class='nav-item nav-link text-white active' data-toggle='tab' href='#tab-pane-$conti'>$categorynamei ($subcategorycanti)</a>";
									$tabs .= "<a class='nav-item nav-link text-white ' id='tab-$conti' data-toggle='tab' href='#tab-pane-$conti'>$categorynamei ($subcategorycanti)</a>";
								}else{
									if($conti == $categorycant){
										$tabs .= "<a class='nav-item nav-link text-white' id='tab-$conti' data-toggle='tab' href='#tab-pane-$conti'>$categorynamei ($subcategorycanti)</a></div>";
									}else{
										$tabs .= "<a class='nav-item nav-link text-white' id='tab-$conti' data-toggle='tab' href='#tab-pane-$conti'>$categorynamei ($subcategorycanti)</a>";
									}
								}
							}else{
								if($conti == 1){
									//$tabs .= "<a class='nav-item nav-link text-white active' data-toggle='tab' href='#tab-pane-0'>$categorynamei ($subcategorycanti)</a>";
									$tabs .= "<a class='nav-item nav-link text-white' data-toggle='tab' href='#tab-pane-0'>$categorynamei ($subcategorycanti)</a>";
								}else{
									if($conti == $categorycant){
										$tabs .= "<a class='nav-item nav-link text-white' data-toggle='tab' href='#tab-pane-0'>$categorynamei ($subcategorycanti)</a></div>";
									}else{
										$tabs .= "<a class='nav-item nav-link text-white' data-toggle='tab' href='#tab-pane-0'>$categorynamei ($subcategorycanti)</a>";
									}
								}
							}
							/*if($conti == 1){
								$tabs .= "<a class='nav-item nav-link text-white active' data-toggle='tab' href='#tab-pane-$conti'>$categorynamei ($subcategorycanti)</a>";
							}else{
								if($conti == $categorycant){
									$tabs .= "<a class='nav-item nav-link text-white' data-toggle='tab' href='#tab-pane-$conti'>$categorynamei ($subcategorycanti)</a></div>";
								}else{
									$tabs .= "<a class='nav-item nav-link text-white' data-toggle='tab' href='#tab-pane-$conti'>$categorynamei ($subcategorycanti)</a>";
								}
							}*/
							
							$contic = 0;
							$query_categorysic = "select * from subcategory where codecategory = '$codecategoryi' order by codesubcategory asc";
							$result_categorysic=db_query($query_categorysic);
							while($row_categorysic = mysqli_fetch_array($result_categorysic))
							{ 	 	 	 	 	 	 	 	 	 	 	 	
								$contic++;		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
								$codesubcategoryic = $row_categorysic['codesubcategory'];
								$codecategoryic = $row_categorysic['codecategory'];
								$subategorynameic = $row_categorysic['subcategoryname'];
									
								$row_count = db_fetch_array (db_query("select count(*) as subcategorycant from subcategory where codecategory = '$codecategoryic'"));
								list ($subcategorycant) = $row_count;
								
								$row_countc = db_fetch_array (db_query("select count(*) as coursecant from course where codesubcategory = '$codesubcategoryic'"));
								list ($coursecant) = $row_countc;
								
								if($conti == 1){
									//$active = 'active';
									$active = '';
								}else{
									$active = '';
								}
								
								if($contic == 1){
									if($subcategorycant > 1){
										$content_tabs .= "<div class='tab-pane fade show $active' id='tab-pane-$conti'>
											<div class='row'>
											<div class='col-lg-3 col-md-4 col-sm-6 pb-1'>
												<a class='text-decoration-none' href='subcategory.php?codesubcategory=$codesubcategoryic'>
													<div class='cat-item d-flex align-items-center mb-4'>
														<div class='overflow-hidden' style='width:1px; height:100px;'>
															
														</div>
														<div class='flex-fill pl-3'>
															<h6 style='color:#000000;'>$subategorynameic</h6>
															<small class='text-body'>$coursecant Cursos</small>
														</div>
													</div>
												</a>
											</div>";
									}else{
										$content_tabs .= "<div class='tab-pane fade show $active' id='tab-pane-$conti'>
											<div class='row'>
											<div class='col-lg-3 col-md-4 col-sm-6 pb-1'>
												<a class='text-decoration-none' href='subcategory.php?codesubcategory=$codesubcategoryic'>
													<div class='cat-item d-flex align-items-center mb-4'>
														<div class='overflow-hidden' style='width:1px; height:100px;'>
															
														</div>
														<div class='flex-fill pl-3'>
															<h6 style='color:#000000;'>$subategorynameic</h6>
															<small class='text-body'>$coursecant Cursos</small>
														</div>
													</div>
												</a>
											</div>
										   </div>
										 </div>
											";
									}
									
								}else{
									if($contic == $subcategorycant){
										$content_tabs .= "<div class='col-lg-3 col-md-4 col-sm-6 pb-1'>
											<a class='text-decoration-none' href='subcategory.php?codesubcategory=$codesubcategoryic'>
												<div class='cat-item d-flex align-items-center mb-4'>
													<div class='overflow-hidden' style='width:0px; height:100px;'>
														
													</div>
													<div class='flex-fill pl-3' style='width:500px;'>
														<h6 style='color:#000000;'>$subategorynameic</h6>
														<small class='text-body'>$coursecant Cursos</small>
													</div>
												</div>
											</a>
										</div>
									   </div>
									  </div>";
									}else{
										$content_tabs .= "<div class='col-lg-3 col-md-4 col-sm-6 pb-1'>
											<a class='text-decoration-none' href='subcategory.php?codesubcategory=$codesubcategoryic'>
												<div class='cat-item d-flex align-items-center mb-4'>
													<div class='overflow-hidden' style='width:0px; height:100px;'>

													</div>
													<div class='flex-fill pl-3'>
														<h6 style='color:#000000;'>$subategorynameic</h6>
														<small class='text-body'>$coursecant Cursos</small>
													</div>
												</div>
											</a>
										</div>";
									}
								}
							}
						}
						$content_tabs .= "<div class='tab-pane fade show' id='tab-pane-0'>
											<div class='row'>
											<div class='col-lg-3 col-md-4 col-sm-6 pb-1'>
												
											</div>
										   </div>
										 </div>
											";
						echo $tabs;
						echo $content_tabs;
						?>
                    </div>
                    
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- Categories End -->
	
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-md-6">
                <div class="product-offer-1 mb-30" style="height: 300px;" id='popoverOffer_1' data-toggle='popover' data-placement='auto' data-html='true' data-content='<?php echo $coursedesc_3;?>' rel='popover' data-original-title='<?php echo $shortcourse_3;?>' data-trigger='hover'>
                    <?php echo"<img class='img-fluid' src='admin/resource/images/$short_3' alt=''>"; ?>
                    <div class="offer-text" style="text-align:center;padding:10px;">
                        <h3 class="text-white mb-3"> <?php echo $shortcourse_3; ?> </h3>
						<?php echo "<a href='#' class='btn btn-primary' onclick='add_course($shortcode_3)'>Comprar</a>";?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-offer-1 mb-30" style="height: 300px;" id='popoverOffer_2' data-toggle='popover' data-placement='auto' data-html='true' data-content='<?php echo $coursedesc_4;?>' rel='popover' data-original-title='<?php echo $shortcourse_4;?>' data-trigger='hover'>
                    <?php echo"<img class='img-fluid' src='admin/resource/images/$short_4' alt=''>"; ?>
                    <div class="offer-text" style="text-align:center;padding:10px;">
                        <h3 class="text-white mb-3"> <?php echo $shortcourse_4; ?> </h3>
						<?php echo "<a href='#' class='btn btn-primary' onclick='add_course($shortcode_4)'>Comprar</a>";?>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Los estudiantes están viendo</span></h2>
        <div class="row px-xl-5">
			<?php
			$contc = 0;
			$query_course = "select * from course where codesubcategory != '1' order by rand() limit 8";
			$result_course=db_query($query_course);
			while($row_course = mysqli_fetch_array($result_course))
			{ 	 	 	 	 	 	 	 	 	 	 	 	
				$contc++;		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
				$codecourse = $row_course['codecourse'];
				$coursename = $row_course['coursename'];
				$coursedesc = $row_course['coursedesc'];
				$courseprice = $row_course['courseprice'];
				$coursestar = $row_course['coursestar'];
				$courseimg = $row_course['courseimg'];
				
				$coursestars = ($coursestar * 200)/10;
				
				$desc = substr($coursedesc, 0, 400) . "...";
				echo"
				<div class='col-lg-3 col-md-4 col-sm-6 pb-1'>
					<div class='product-item bg-light mb-4'>
						<div class='product-img position-relative overflow-hidden' onclick='ref_detail($codecourse)' style='cursor: pointer;'>
							<img class='img-fluid w-100' src='admin/resource/images/course/$courseimg' alt=''>
							<div class='product-action' id='popoverRecent_$contc' data-toggle='popover' data-placement='auto' data-html='true' data-content='$coursedesc' rel='popover' data-original-title='$coursename' data-trigger='hover'>
									
								<div class='img-text' href='#' style='color:red;'>
									<p style='font-size:12px;color:#000000;font-weight:bold;text-align: justify;'>$coursename</p>
									<p style='font-size:12px;color:#000000;margin-top:-20px;text-align: justify;'>$desc</p>
									
									<div style='text-align:center;margin-top:-10px;'>
										<!--<a class='btn btn-outline-dark btn-square' href='#' onclick='add_course($codecourse)' style=''><i class='fa fa-shopping-cart'></i></a>-->
										<a href='#' class='btn btn-secondary' onclick='add_course($codecourse)' style='background:#000000;color:#ffffff;border-color: #000000;'><i class='fa fa-shopping-cart'></i> &nbsp;&nbsp; Comprar</a>
									</div>
									
								</div>
							</div>
						</div>
						<div class='ext-center py-4' style='text-align:center;'>
							<a class='h6 text-decoration-none text-truncate' href='detail.php?codecourse=$codecourse'>".wordwrap($coursename, 25, "<br />\n")."</a>
							<div class='d-flex align-items-center justify-content-center mt-2'>
								<h5>Bs. $courseprice</h5> <!--<h6 class='text-muted ml-2'<del>$123.00</del></h6>-->
								
							</div>
							<div class='d-flex align-items-center justify-content-center mb-1'>
								";	
							if($coursestar == '0.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '0.50'){
								echo"
								<small class='fa fa-star-half-alt text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '1.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '1.50'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star-half-alt text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '2.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '2.50'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star-half-alt text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '3.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '3.50'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star-half-alt text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '4.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='far fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '4.50'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star-half-alt text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							if($coursestar == '5.00'){
								echo"
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small class='fa fa-star text-primary mr-1'></small>
								<small>($coursestars)</small>
								";
							}
							echo"
							</div>
						</div>
						
					</div>
				</div>
				";
				
			}
			?>
        </div>
    </div>
	
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Cursos Autorizados y Avalados Por </span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
					<?php
					$conti = 0;
					$query_institutions = "select * from institutions order by codeinstitutions asc";
					$result_institutions=db_query($query_institutions);
					while($row_institutions = mysqli_fetch_array($result_institutions))
					{ 	 	 	 	 	 	 	 	 	 	 	 	
						$conti++;		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
						$codeinstitutions = $row_institutions['codeinstitutions'];
						$institutionsimg = $row_institutions['institutionsimg'];
						
						echo"
						<div class='bg-light p-4'>
							<img src='admin/resource/images/institutions/$institutionsimg' alt=''>
						</div>
						";
						
					}
					?>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
			<?php
			if($certificationimg_1 == 'sin_img.png'){
				echo"
				<div class='col-md-6'>
					<div class='product-offer-1 mb-30' style='background:#$certificationcolor_1;height: 300px;' id='popoverOffer_1' data-toggle='popover' data-placement='auto' data-html='true' data-content='$coursedesc_3;' rel='popover' data-original-title='$shortcourse_3' data-trigger='hover'>
						<div class='offer-text' style='text-align:center;padding:10px;'>
							<h6 class='text-white text-uppercase'>$certificationtitle_1</h6>
							<p>$certificationdesc_1</p>
						</div>
					</div>
				</div>
				";
			}else{
				echo"
				<div class='col-md-6'>
					<div class='product-offer-1 mb-30' style='height:300px;' id='popoverOffer_1' data-toggle='popover' data-placement='auto' data-html='true' data-content='$coursedesc_3;' rel='popover' data-original-title='$shortcourse_3' data-trigger='hover'>
						<img class='img-fluid' src='admin/resource/images/$certificationimg_1' alt=''>
					</div>
				</div>
				";
			}
			if($certificationimg_2 == 'sin_img.png'){
				echo"
				<div class='col-md-6'>
					<div class='product-offer-1 mb-30' style='background:#$certificationcolor_2;height: 300px;' id='popoverOffer_2' data-toggle='popover' data-placement='auto' data-html='true' data-content='$coursedesc_4' rel='popover' data-original-title='$shortcourse_4' data-trigger='hover'>
						<div class='offer-text' style='text-align:center;padding:10px;'>
							<h6 class='text-white text-uppercase'>$certificationtitle_2</h6>
							<p>$certificationdesc_2</p>
						</div>
					</div>
				</div>
				";
			}else{
				echo"
				<div class='col-md-6'>
					<div class='product-offer-1 mb-30' style='height:300px;'>
						<img class='img-fluid' src='admin/resource/images/$certificationimg_2' alt=''>
					</div>
				</div>
				";
			}
			
			?>
        </div>
    </div>
	
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Ponte en Contacto</h5>
                <p class="mb-4">Empresa especializada en cursos de formación continua virtual y presencial a nivel nacional e internacional.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Av. Salamanca entre Calle Antezana. Torre Millenium piso 4D , Cochabamba, Bolivia</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@genesis.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+591 78776857</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Tienda Rápida</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Inicio</a>
                            <a class="text-secondary mb-2" href="about.php"><i class="fa fa-angle-right mr-2"></i>Acerca De</a>
                            <a class="text-secondary mb-2" href="shop.php"><i class="fa fa-angle-right mr-2"></i>Cursos</a>
                            <a class="text-secondary" href="contact.php"><i class="fa fa-angle-right mr-2"></i>Contactos</a>
                        </div>
                    </div>
					
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Mi Cuenta</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="login.php"><i class="fa fa-angle-right mr-2"></i>Iniciar Sesión</a>
                            <a class="text-secondary mb-2" href="register.php"><i class="fa fa-angle-right mr-2"></i>Registrate</a>
                            <a class="text-secondary" href="cart.php"><i class="fa fa-angle-right mr-2"></i>Carrito De Compras</a>
                        </div>
                    </div>
					
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">A Que Correo Te Enviamos La Oferta</h5>
                        <p>Sitio web de educacion</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Correo Electronico">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Inscribirse</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Síganos</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!--
	<script src="admin/resource/jscript/ui/jquery.easyui.min.js"></script>
	-->
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>    
	<script src="lib/owlcarousel/owl.carousel.min.js"></script>
	
	<!--<script src="dist/js/bootstrap-autocomplete.js"></script>-->
	
	<script type="text/javascript" src="lib/alertify/lib/alertify.js"></script>
	
	<!-- jQuery UI library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
	
    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</php>