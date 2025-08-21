<?php session_start ();
require_once (dirname (__FILE__) . "/admin/setup.php");
db_connect ();

$codeperson = $_SESSION [ 'codeperson' ];
$_SESSION [ 'codeperson' ] = $codeperson ; 

$row_person = db_fetch_array (db_query("select personname from person where codeperson = '$codeperson'"));
list ($personname) = $row_person;

	$codecourse = $_GET['codecourse'];
	
	$row_course = db_fetch_array (db_query("select * from course where codecourse = '$codecourse'"));
	list ($codecourse, $codesubcategory, $coursename, $coursedesc, $courseinit, $coursedateinit, $coursedateend, $courseday, $coursetime, $coursetimeinit, $coursetimeend, $coursemode, $coursephone, $courseprice, $coursedscto, $courseinstitute, $coursefooter, $coursestar, $coursecode, $courseimg) = $row_course;

	$coursestars = ($coursestar * 200)/10;

	$row_logowhite = db_fetch_array (db_query("select logoimg from logo where codelogo = '1'"));
	list ($logowhite) = $row_logowhite;

	$row_logoblack = db_fetch_array (db_query("select logoimg from logo where codelogo = '2'"));
	list ($logoblack) = $row_logoblack;

	$row_cant = db_fetch_array (db_query("select count(*) as cant from detail where codeperson = '$codeperson' and detailstate='EN PROCESO'"));
	list ($cant) = $row_cant;

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

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
	
	<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css" rel="stylesheet" >
	
	<link rel="stylesheet" href="lib/alertify/themes/alertify.core.css" />
	<link rel="stylesheet" href="lib/alertify/themes/alertify.default.css" />
		
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css?v=1.2" rel="stylesheet">
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
				<div class="d-inline-flex align-items-center d-block d-lg-none">
                    
					<div class="row">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Buscar Cursos" id="skill_inputs">
							<div class='input-group-append'>
								<span class="input-group-text bg-transparent text-primary">
									<i class="fa fa-search"></i>
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
                <a href="" class="text-decoration-none">
                    <?php echo"<img src='admin/resource/images/$logowhite' alt='Logo' style='width:150px;'>";?>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="">
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
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
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
						$contd = 0;
						$query_categoryd = "select * from category where codecategory != '1' order by codecategory asc";
						$result_categoryd=db_query($query_categoryd);
						while($row_categoryd = mysqli_fetch_array($result_categoryd))
						{ 	 	 	 	 	 	 	 	 	 	 	 	
							$contd++;		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
							$codecategoryd = $row_categoryd['codecategory'];
							$categorynamed = $row_categoryd['categoryname'];
							if(db_exist("select * from subcategory where codecategory = '$codecategoryd'")){
								echo"
								<div class='nav-item dropdown dropright'>
									<a href='' class='nav-link dropdown-toggle' data-toggle='dropdown'>$categorynamed<i class='fa fa-angle-right float-right mt-1'></i></a>
									<div class='dropdown-menu position-absolute rounded-0 border-0 m-0'>";
									$contt = 0;
									$query_subcategoryd = "select * from subcategory where codecategory = '$codecategoryd' order by codesubcategory asc";
									$result_subcategoryd=db_query($query_subcategoryd);
									while($row_subcategoryd = mysqli_fetch_array($result_subcategoryd))
									{ 	 	 	 	 	 	 	 	 	 	 	 	
										$contt++;		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
										$codesubcategoryd = $row_subcategoryd['codesubcategory'];
										$subcategorynamed = $row_subcategoryd['subcategoryname'];
								
										echo"<a href='subcategory.php?codesubcategory=$codesubcategory' class='dropdown-item'>$subcategorynamed</a>";
										
									}
									echo"
									</div>
								</div>
								";
							}else{
								echo"<a href='#' class='nav-item nav-link' style=''>$categorynamed</a>";
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
								<a href="index.php" class="nav-item nav-link">Inicio</a>
								<a href="about.php" class="nav-item nav-link">Acerca De</a>
								<a href="shop.php" class="nav-item nav-link">Cursos</a>
								<!--<a href="course.php" class="nav-item nav-link">Mis Cursos</a>
								<a href="cart.php" class="nav-item nav-link">Carrito Compras</a>-->
								<a href="contact.php" class="nav-item nav-link">Contacto</a>
								';
							}else{
								echo'
								<a href="index.php" class="nav-item nav-link">Inicio</a>
								<a href="about.php" class="nav-item nav-link">Acerca De</a>
								<a href="shop.php" class="nav-item nav-link">Cursos</a>
								<a href="course.php" class="nav-item nav-link">Mis Cursos</a>
								<a href="contact.php" class="nav-item nav-link">Contacto</a>
								';
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
								}
							?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <!--<a class="breadcrumb-item text-dark" href="index.php">Inicio</a>-->
                    <a class="breadcrumb-item text-primary" href="shop.php">Cursos</a>
                    <span class="breadcrumb-item active" style="color:#fff;">Detalle de Curso</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <?php echo"<img class='w-100 h-100' src='admin/resource/images/course/$courseimg' alt='Image'>"; ?>
                        </div>
						<!--
                        <div class="carousel-item">
                            <?php echo"<img class='w-100 h-100' src='admin/resource/images/course/$courseimg' alt='Image'>"; ?>
                        </div>
                        <div class="carousel-item">
                            <?php echo"<img class='w-100 h-100' src='admin/resource/images/course/$courseimg' alt='Image'>"; ?>
                        </div>
                        <div class="carousel-item">
                            <?php echo"<img class='w-100 h-100' src='admin/resource/images/course/$courseimg' alt='Image'>"; ?>
                        </div>
						-->
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <?php echo"<h3>$coursename</h3>"; ?>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <?php	
						if($coursestar == '0.00'){
							echo"
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							";
						}
						if($coursestar == '0.50'){
							echo"
							<small class='fa fa-star-half-alt text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							";
						}
						if($coursestar == '1.00'){
							echo"
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							";
						}
						if($coursestar == '1.50'){
							echo"
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star-half-alt text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							";
						}
						if($coursestar == '2.00'){
							echo"
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							";
						}
						if($coursestar == '2.50'){
							echo"
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star-half-alt text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							";
						}
						if($coursestar == '3.00'){
							echo"
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							";
						}
						if($coursestar == '3.50'){
							echo"
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star-half-alt text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							";
						}
						if($coursestar == '4.00'){
							echo"
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='far fa-star text-primary mr-1'></small>
							";
						}
						if($coursestar == '4.50'){
							echo"
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star-half-alt text-primary mr-1'></small>
							";
						}
						if($coursestar == '5.00'){
							echo"
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							<small class='fa fa-star text-primary mr-1'></small>
							";
						}
						?>
                        </div>
                        <small class="pt-1">(<?php echo $coursestars; ?> Calificacion)</small>

                    </div>
                    <h3 class="font-weight-semi-bold mb-4"><?php echo $courseprice;?> BS.</h3>
                    <p class="mb-4"> <?php echo $coursedesc; ?> </p>
					
                    <div class="d-flex align-items-center mb-4 pt-2">
                        
                    </div>
					
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1" style="color:red !important;">Clases</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2"  style="color:red !important;">Informacion</a>
                    </div>
                    <div class="tab-content">
						
                        <div class="tab-pane fade" id="tab-pane-2">
						<!--<div class="tab-pane fade show active" id="tab-pane-1">-->
                            <h4 class="mb-3">Descripción del Curso</h4>
							<p> INICIO :  <?php echo $courseinit; ?> </p>
							<p> DIAS :  <?php echo $courseday; ?> </p>
							<p> HORA :  <?php echo $coursetime; ?> </p>
							<p> MODALIDAD :  <?php echo $coursemode; ?> </p>
							<p> TELF / CEL :  <?php echo $coursephone; ?> </p>
							<p> DESCUENTO :  <?php echo $coursedscto; ?> </p>
							<p> INSTITUTOS :  <?php echo $courseinstitute; ?> </p>
							<p> CERTIFICADO :  <?php echo $coursefooter; ?> </p>
						</div>
								
						
                        <!--div class="tab-pane fade" id="tab-pane-2">-->
						<div class="tab-pane fade show active" id="tab-pane-1">
                            
							<?php
								$row_total = db_fetch_array (db_query("select count(*) as total from lesson where codecourse = '$codecourse'"));
								list ($total) = $row_total;
				
								$contdo = 0;
								$query_detaildo = "select * from lesson where codecourse = '$codecourse' order by codelesson asc";
								$result_detaildo=db_query($query_detaildo);
								while($row_detaildo = mysqli_fetch_array($result_detaildo))
								{ 	 	 	 	 	 	 	 	 	 	 	 	
									$contdo++;	 	 	 	 	 	 	 		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
									$codelesson = $row_detaildo['codelesson'];
									$codecourse = $row_detaildo['codecourse'];
									$lessoncourse = $row_detaildo['lessoncourse'];
									$lessonnro = $row_detaildo['lessonnro'];
									$lessonname = $row_detaildo['lessonname'];
									$lessondesc = $row_detaildo['lessondesc'];
									$lessonurl = $row_detaildo['lessonurl'];
									$lessonurldoc = $row_detaildo['lessonurldoc'];
									
									if($contdo == 1 || $contdo == 3 || $contdo == 5 || $contdo == 7 || $contdo == 9 || $contdo == 11 || $contdo == 13 || $contdo == 15){
										echo'
										<div class="row">
										';
									}
									echo'
									<div class="col-md-6">
										<ul class="list-group list-group-flush" style="color:black;">
											<li class="list-group-item px-0" style="text-align:center;font-weight:bold;">
												&nbsp;&nbsp;'.$lessonnro.'
											</li>
											<li class="list-group-item px-0">
												&nbsp;&nbsp;'.$lessonname.'
											</li>
											<li class="list-group-item px-0">
												&nbsp;&nbsp;'.$lessondesc.'
											</li>
											<li class="list-group-item px-0">';
												echo"&nbsp;&nbsp;<a href='#' onclick=\"show_lesson('$lessonurl')\">VER CLASE</a>";
											echo'
											</li>
											<li class="list-group-item px-0">';
												echo"&nbsp;&nbsp;<a href='#' onclick=\"show_lessondoc('$lessonurldoc')\">VER DOCUMENTOS</a>";
											echo'
											</li>
										  </ul> 
									</div>
									';
									if($contdo == 2 || $contdo == 4 || $contdo == 6 || $contdo == 8 || $contdo == 10 || $contdo == 12 || $contdo == 14 || $contdo == 16){
										echo'
										</div>
										<br/>
										';
									}else{
										if($contdo == $total){
											echo'
											</div>
											';
										}
									}
									
								}
								?>
							
                        </div>
						
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">También te puede gustar</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
					<?php
					$contc = 0;
					$query_coursec = "select * from course where codesubcategory != '1' order by rand() limit 8";
					$result_coursec=db_query($query_coursec);
					while($row_coursec = mysqli_fetch_array($result_coursec))
					{ 	 	 	 	 	 	 	 	 	 	 	 	
						$contc++;		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
						$codecoursec = $row_coursec['codecourse'];
						$coursenamec = $row_coursec['coursename'];
						$coursedescc = $row_coursec['coursedesc'];
						$coursepricec = $row_coursec['courseprice'];
						$coursestarc = $row_coursec['coursestar'];
						$courseimgc = $row_coursec['courseimg'];
								
						$coursestarsc = ($coursestarc * 200)/10;
						
						$descc = substr($coursedescc, 0, 400) . "...";
						echo"
						<div class='product-item bg-light'>
							<div class='product-img position-relative overflow-hidden'>
								<img class='img-fluid w-100' src='admin/resource/images/course/$courseimgc' alt=''>
								<div class='product-action' onclick='ref_detail($codecoursec)' style='cursor: pointer;'>
									<div class='img-text' href='#' style='color:red;'>
										<p style='font-size:12px;color:#000000;font-weight:bold;text-align: justify;'>$coursenamec</p>
										<p style='font-size:12px;color:#000000;margin-top:-20px;text-align: justify;'>$descc</p>
										
										<div style='text-align:center;margin-top:-10px;'>
											<!--<a class='btn btn-outline-dark btn-square' href='#' onclick='add_course($codecoursec)' style=''><i class='fa fa-shopping-cart'></i></a>-->
											<a href='#' class='btn btn-secondary' onclick='add_course($codecoursec)' style='background:#000000;color:#ffffff;border-color: #000000;'><i class='fa fa-shopping-cart'></i> &nbsp;&nbsp; Comprar</a>
										</div>
										
									</div>
								</div>
							</div>
							<div class='text-center py-4'>
								<a class='h6 text-decoration-none text-truncate' href='detail.php?codecourse=$codecoursec'>".wordwrap($coursenamec, 25, "<br />\n")."</a>
								<div class='d-flex align-items-center justify-content-center mt-2'>
									<h5>Bs. $coursepricec</h5><!--<h6 class='text-muted ml-2'><del>$123.00</del></h6>-->
								</div>
								<div class='d-flex align-items-center justify-content-center mb-1'>
								";	
								if($coursestarc == '0.00'){
									echo"
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small>($coursestarsc)</small>
									";
								}
								if($coursestarc == '0.50'){
									echo"
									<small class='fa fa-star-half-alt text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small>($coursestarsc)</small>
									";
								}
								if($coursestarc == '1.00'){
									echo"
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small>($coursestarsc)</small>
									";
								}
								if($coursestarc == '1.50'){
									echo"
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star-half-alt text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small>($coursestarsc)</small>
									";
								}
								if($coursestarc == '2.00'){
									echo"
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small>($coursestarsc)</small>
									";
								}
								if($coursestarc == '2.50'){
									echo"
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star-half-alt text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small>($coursestarsc)</small>
									";
								}
								if($coursestarc == '3.00'){
									echo"
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small>($coursestarsc)</small>
									";
								}
								if($coursestarc == '3.50'){
									echo"
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star-half-alt text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small>($coursestarsc)</small>
									";
								}
								if($coursestarc == '4.00'){
									echo"
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='far fa-star text-primary mr-1'></small>
									<small>($coursestarsc)</small>
									";
								}
								if($coursestarc == '4.50'){
									echo"
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star-half-alt text-primary mr-1'></small>
									<small>($coursestarsc)</small>
									";
								}
								if($coursestarc == '5.00'){
									echo"
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small class='fa fa-star text-primary mr-1'></small>
									<small>($coursestarsc)</small>
									";
								}
								echo"
								</div>
							</div>
						</div>
						";
						
					}
					?>
                    
                    </div>
                </div>
            </div>
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
	
	<!-- jQuery UI library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
	
	<script type="text/javascript" src="lib/alertify/lib/alertify.js"></script>
	
    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</php>