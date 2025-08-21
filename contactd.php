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

	$row_location = db_fetch_array (db_query("select locationurl from location order by codelocation asc"));
	list ($locationurl) = $row_location;

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
								<span class='badge text-secondary border1 border-secondary rounded-circle1' style='padding-bottom: 2px;margin-left:5px;margin-right:5px;'>$personname</span>
								<i class='fas fa-user-times text-primary'></i>
							</a>
							";
						}
					?>
					
                </div>
				<div class="d-inline-flex align-items-center d-block d-lg-none" style="margin-left:30px;">
                    
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
                <a href="index.php">PASAR CLASES</a>
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
								<a href='' class='nav-link dropdown-toggle' data-toggle='dropdown'>$categoryname<i class='fa fa-angle-right float-right mt-1'></i></a>
								<div class='dropdown-menu position-absolute rounded-0 border-0 m-0'>";
								$contt = 0;
								$query_subcategory = "select * from subcategory where codecategory = '$codecategory' order by codesubcategory asc";
								$result_subcategory=db_query($query_subcategory);
								while($row_subcategory = mysqli_fetch_array($result_subcategory))
								{ 	 	 	 	 	 	 	 	 	 	 	 	
									$contt++;		 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
									$codesubcategory = $row_subcategory['codesubcategory'];
									$subcategoryname = $row_subcategory['subcategoryname'];
							
									echo"<a href='subcategory.php?codesubcategory=$codesubcategory' class='dropdown-item'>$subcategoryname</a>";
									
								}
								echo"
								</div>
							</div>
							";
						}else{
							echo"<a href='#' class='nav-item nav-link' style=''>$categoryname</a>";
						}
						
					}
					?>
					
				</div>
			</nav>
				
			
            <div class="col-lg-12">
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
								<a href="contact.php" class="nav-item nav-link active">Contacto</a>
								';
							}else{
								echo'
								<a href="coursed.php" class="nav-item nav-link">Mis Cursos</a>
								<a href="registerc.php" class="nav-item nav-link">Registrar</a>
								<a href="contactd.php" class="nav-item nav-link active">Contacto</a>
								';
							}
							?>
						</div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <?php
								if($personname == ''){
									echo"
									<!--<a href='cart.php' class='btn px-0'>
										<i class='fas fa-shopping-cart text-primary'></i>&nbsp;&nbsp;&nbsp;&nbsp;
										<!--<span class='badge text-secondary border border-secondary rounded-circle' style='padding-bottom: 2px;'>$cant</span>-->
									<!--</a>-->
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
									<!--<a href='cart.php' class='btn px-0'>
										<i class='fas fa-shopping-cart text-primary'></i>
										<span class='badge text-secondary border border-secondary rounded-circle' id='cant_carts' style='padding-bottom: 2px;'>$cant</span>
									</a>-->
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
                    <a class="breadcrumb-item text-primary" href="coursed.php">Mis Cursos</a>
                    <span class="breadcrumb-item active" style="color:#fff;">Contactos</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contactanos</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate" onsubmit="return false;">
                        <div class="control-group">
                            <input type="text" class="form-control" id="name" placeholder="Nombre"
                                required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" id="email" placeholder="Correo Electronico"
                                required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" id="subject" placeholder="Titulo"
                                required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="8" id="message" placeholder="Mensaje"
                                required="required"
                                data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" id="sendMessageButton" onclick="send_contact()">Enviar
                                Mensage</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
				<div class="bg-light p-30 mb-30">
					<div class="embed-responsive embed-responsive-16by9">
						<!--<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/67Sb3M8GQwQ" frameborder="0" allowfullscreen></iframe>-->
						<?php echo" <iframe class='embed-responsive-item' src='$locationurl' frameborder='0' allowfullscreen></iframe>"; ?>
					</div>
                </div>
                <div class="bg-light p-30 mb-30">
					<iframe style="width:100%; height:250px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3807.5455670064093!2d-66.15658958975534!3d-17.385586583432392!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93e37408af889f05%3A0x8c92bb66ee8199a7!2sC.%20Antezana%20%26%20Av%20Salamanca%2C%20Cochabamba!5e0!3m2!1ses!2sbo!4v1744941425300!5m2!1ses!2sbo"
                    frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Av. Salamanca entre Calle Antezana. Torre Millenium piso 4D , Cochabamba, Bolivia</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@genesis.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+591 78776857</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


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
                        <h5 class="text-secondary text-uppercase mb-4">Hoja Informativa</h5>
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