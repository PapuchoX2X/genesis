<?php session_start ();
require_once (dirname (__FILE__) . "/admin/setup.php");
db_connect ();

$codeperson = $_SESSION [ 'codeperson' ];
$_SESSION [ 'codeperson' ] = $codeperson ; 

	$row_person = db_fetch_array (db_query("select personname from person where codeperson = '$codeperson'"));
	list ($personname) = $row_person;

	$row_logowhite = db_fetch_array (db_query("select logoimg from logo where codelogo = '1'"));
	list ($logowhite) = $row_logowhite;

	$row_logoblack = db_fetch_array (db_query("select logoimg from logo where codelogo = '2'"));
	list ($logoblack) = $row_logoblack;

	$row_cant = db_fetch_array (db_query("select count(*) as cant from detail where codeperson = '$codeperson' and detailstate='EN PROCESO'"));
	list ($cant) = $row_cant;
	
	if(isset($_GET['page'])){
		$page = $_GET['page'];
		$rows = 18;
		$offset = ($page-1)*$rows;
	}else{
		$page = 1;
		$rows = 18;
		$offset = ($page-1)*$rows;
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
								
										echo"<a href='subcategory.php?codecourse=$codesubcategoryd' class='dropdown-item'>$subcategorynamed</a>";
										
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
								<a href="shop.php" class="nav-item nav-link active">Cursos</a>
								<!--<a href="course.php" class="nav-item nav-link">Mis Cursos</a>
								<a href="cart.php" class="nav-item nav-link">Carrito Compras</a>-->
								<a href="contact.php" class="nav-item nav-link">Contacto</a>
								';
							}else{
								echo'
								<a href="index.php" class="nav-item nav-link">Inicio</a>
								<a href="about.php" class="nav-item nav-link">Acerca De</a>
								<a href="shop.php" class="nav-item nav-link active">Cursos</a>
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
                    <a class="breadcrumb-item text-primary" href="index.php">Inicio</a>
                    <!--<a class="breadcrumb-item text-dark" href="#shop.php">Cursos</a>-->
                    <span class="breadcrumb-item active" style="color:#ffffff;">Lista de Cursos</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filtrar por Categoria</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
						<?php
					
						$row_total = db_fetch_array (db_query("select count(*) as coursetotal from course where codesubcategory != '1'"));
						list ($coursetotal) = $row_total;
						
						if(isset($_GET["codecategory"])) {
							if($_GET["codecategory"] == 0){
								echo'
								<div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
									<input type="checkbox" class="custom-control-input" checked id="category-all" onclick="filter_all()">
									<label class="custom-control-label" for="category-all">Todas las Categorias</label>
									<span class="badge border font-weight-normal">'.$coursetotal.'</span>
								</div>
								';
								$query_course = "select * from course where codesubcategory != '1' order by codecourse asc limit $offset,$rows";
								
								$codecat = 0;		
								$row_cantcourse = db_fetch_array (db_query("select count(*) as coursetotal from course where codesubcategory != '1'"));
								list ($cantcourse) = $row_cantcourse;
								
							}else{
								echo'
								<div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
									<input type="checkbox" class="custom-control-input" id="category-all" onclick="filter_all()">
									<label class="custom-control-label" for="category-all">Todas las Categorias</label>
									<span class="badge border font-weight-normal">'.$coursetotal.'</span>
								</div>
								';
								$codecat = $_GET["codecategory"];
								
								$query_course = "select * from subcategory s, course c where s.codesubcategory = c.codesubcategory and s.codecategory = '$codecat' order by c.codecourse asc limit $offset,$rows";
										
								$row_cantcourse = db_fetch_array (db_query("select count(*) as coursetotal from subcategory s, course c where s.codesubcategory = c.codesubcategory and codecategory = '$codecat'"));
								list ($cantcourse) = $row_cantcourse;
								
							}
						}else{
							echo'
							<div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
								<input type="checkbox" class="custom-control-input" checked id="category-all onclick="filter_all()"">
								<label class="custom-control-label" for="category-all">Todas las Categorias</label>
								<span class="badge border font-weight-normal">'.$coursetotal.'</span>
							</div>
							';
							$query_course = "select * from course where codesubcategory != '1' order by codecourse asc limit $offset,$rows";
							
							$codecat = 0;	
							$row_cantcourse = db_fetch_array (db_query("select count(*) as coursetotal from course where codesubcategory != '1'"));
							list ($cantcourse) = $row_cantcourse;
							
						}
						?>
                        
						<?php
						$contb = 0;
						$query_categoryb = "select * from category where codecategory != '1' order by codecategory asc";
						$result_categoryb=db_query($query_categoryb);
						while($row_categoryb = mysqli_fetch_array($result_categoryb))
						{ 	 	 	 	 	 	 	 	 	 	 	 	
							$contb++;		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
							$codecategoryb = $row_categoryb['codecategory'];
							$categorynameb = $row_categoryb['categoryname'];
							
							$row_cant = db_fetch_array (db_query("select count(*) as coursecant from subcategory s, course c where s.codesubcategory = c.codesubcategory and s.codecategory = '$codecategoryb'"));
							list ($coursecant) = $row_cant;
							
							if(isset($_GET["codecategory"])) {
								if($_GET["codecategory"] == $codecategoryb){
									echo"
								<div class='custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3'>
									<input type='checkbox' class='custom-control-input' checked id='category-$codecategoryb' onclick='filter_category($codecategoryb)'>
									<label class='custom-control-label' for='category-$codecategoryb'>$categorynameb</label>
									<span class='badge border font-weight-normal'>$coursecant</span>
								</div>
								";
								}else{
									echo"
								<div class='custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3'>
									<input type='checkbox' class='custom-control-input' id='category-$codecategoryb' onclick='filter_category($codecategoryb)'>
									<label class='custom-control-label' for='category-$codecategoryb'>$categorynameb</label>
									<span class='badge border font-weight-normal'>$coursecant</span>
								</div>
								";
								}
								
							}else{
								echo"
								<div class='custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3'>
									<input type='checkbox' class='custom-control-input' id='category-$codecategoryb' onclick='filter_category($codecategoryb)'>
									<label class='custom-control-label' for='category-$codecategoryb'>$categorynameb</label>
									<span class='badge border font-weight-normal'>$coursecant</span>
								</div>
								";
							}
						}
						?>
                        
                    </form>
                </div>
            </div>
            <!-- Shop Sidebar End -->


            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            
                        </div>
                    </div>
					<?php
					$contc = 0;
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
						<div class='col-lg-4 col-md-6 col-sm-6 pb-1'>
							<div class='product-item bg-light mb-4'>
								<div class='product-img position-relative overflow-hidden' onclick='ref_detail($codecourse)' style='cursor: pointer;'>
									<img class='img-fluid w-100' src='admin/resource/images/course/$courseimg' alt=''>
									<div class='product-action' id='popoverCourse_$contc' data-toggle='popover' data-html='true' data-content='$coursedesc' rel='popover' data-original-title='$coursename' data-trigger='hover'>
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
					
					$numpage = $cantcourse / 18;
					if($cantcourse % 18 == 0){
						$num = $cantcourse / 18;
					}else{
						if($cantcourse < 18){
							$num = 1;
						}else{
							$div = $cantcourse / 18;
							$num = ceil($div);
						}
					}
					//$num = 4;
					echo"
					<div class='col-12'>
                        <nav>
                          <ul class='pagination justify-content-center'>
						  ";
							 
							if($page == 1){
								echo "<li class='page-item disabled'><a class='page-link' href='#'><i class='fa fa-arrow-left' aria-hidden='true'></i></span></a></li>";
							}else{
								$pags = $page - 1;
								echo "<li class='page-item'><a class='page-link' href='./shop.php?codecategory=$codecat&page=$pags'><i class='fa fa-arrow-left' aria-hidden='true'></i></span></a></li>";
							}
                            $pag = 0;
							for ($i = 0; $i < $num; $i++) {
								$pag++;
								if($pag == $page){
									echo "<li class='page-item active'><a class='page-link' href='./shop.php?codecategory=$codecat&page=$pag'>$pag</a></li>";
								}else{
									echo "<li class='page-item'><a class='page-link' href='./shop.php?codecategory=$codecat&page=$pag'>$pag</a></li>";
								}
							}
                            
							if($page == $num){
								echo "<li class='page-item disabled'><a class='page-link' href='#'><i class='fa fa-arrow-right' aria-hidden='true'></i></a></li>";
							}else{
								$pags = $page + 1;
								echo "<li class='page-item'><a class='page-link' href='./shop.php?codecategory=$codecat&page=$pags'><i class='fa fa-arrow-right' aria-hidden='true'></i></a></li>";
							}
                            
                            echo"
                          </ul>
                        </nav>
                    </div>
					";
					?>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Shop End -->


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