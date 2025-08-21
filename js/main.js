(function ($) {
    "use strict";
	
    // Dropdown on mouse hover
    $(document).ready(function () {
		
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
		
		
		$(document).click(function(event) {
		  // Si el clic no es dentro del menú o del botón que lo abre,
		  if (!$(event.target).closest('.navbar-vertical').length && !$(event.target).closest('.navbar-toggler').length) {
			// Colapsa el menú
			$('.navbar-vertical').collapse('hide');
		  }
		});
	
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:2
            },
            576:{
                items:3
            },
            768:{
                items:4
            },
            992:{
                items:5
            },
            1200:{
                items:6
            }
        }
    });
	// Vendor carousel 2
    $('.vendor-carousel2').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
		autoWidth:true,
        responsive: {
            0:{
                items:2
            },
            576:{
                items:3
            },
            768:{
                items:4
            },
            992:{
                items:5
            },
            1200:{
                items:6
            }
        }
    });

    // Related carousel
    $('.related-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:4
            }
        }
    });
	
	(function blink() { 
	  $('.blink_me').fadeOut(200).fadeIn(2000, blink); 
	})();

    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });
	
	//Register
	$( "#btn_register" ).on( "click", function() {
		var name = $('#personname').val();
		var phone = $('#personphone').val();
		var mail = $('#personmail').val();
		var pass = $('#personpassword').val();
		var type = $('#persontype').val();
		if(name == '' || phone == '' || mail == '' || pass == ''){
			alertify.error('Ningun capo debe ser vacio');
		}else{
			$.post("./ajax/action.person.php?option=register", {personname:name, personphone:phone, personmail:mail, personpassword:pass, persontype:type}, function(result){
				var result = eval('('+result+')');
				if (result.success){
					alertify.success('Registro exitoso');
					$('#personname').val('');
					$('#personphone').val('');
					$('#personmail').val('');
					$('#personpassword').val('');
					window.location.href = "./validate.php";
				} else {
					alertify.error(result.msg);
				}
			});
		}
	} );
	
	//validate
	$( "#btn_validate" ).on( "click", function() {
		var code = $('#personcode').val();
		if(code == ''){
			alertify.error('Ningun campo debe ser vacio');
		}else{
			$.post("./ajax/action.person.php?option=validate", {personcode:code}, function(result){
				var result = eval('('+result+')');
				if (result.success){
					alertify.success('Validacion exitosa');
					$('#personcode').val('');
					if(result.type == 'Estudiante'){
						window.location.href = "./index.php";
					}else{
						window.location.href = "./registerc.php";
					}
				} else {
					alertify.error(result);
				}
			});
		}
	} );
	
	//Recover
	$( "#btn_recover" ).on( "click", function() {
		var mail = $('#personmail').val();
		if(mail == ''){
			alertify.error('Correo Electronico no debe ser vacio');
		}else{
			$.post("./ajax/action.person.php?option=recover", {personmail:mail}, function(result){
				var result = eval('('+result+')');
				if (result.success){
					alertify.success('Se Envio Correctamente');
					$('#personmail').val('');
					window.location.href = "./login.php";
				} else {
					alertify.error(result.msg);
				}
			});
		}
	} );
	
	//Login
	$( "#btn_login" ).on( "click", function() {
		var mail = $('#personmail').val();
		var pass = $('#personpassword').val();
		if(mail == '' || pass == ''){
			alertify.error('Ningun capo debe ser vacio');
		}else{
			$.post("./ajax/action.login.php?option=valid", {personmail:mail, personpassword:pass}, function(result){
				var result = eval('('+result+')');
				if (result.success){
					alertify.success('Logueo exitoso');
					if(result.type == 'Estudiante'){
						window.location.href = "index.php";
					}else{
						window.location.href = "coursed.php";
					}
				} else {
					alertify.error(result.msg);
				}
			});
		}
	} );
	//Close
	$( "#btn_close" ).on( "click", function() {
		$.post("./ajax/action.person.php?option=close_session", function(result){
			if (result == '1'){
				window.location.href = "index.php";
			} else {
				alertify.error(result);
			}
		});
	} );
	
	$( "#btn_closes" ).on( "click", function() {
		$.post("./ajax/action.person.php?option=close_session", function(result){
			if (result == '1'){
				window.location.href = "index.php";
			} else {
				alertify.error(result);
			}
		});
	} );
	
	$("#skill_input").autocomplete({
		source: "./ajax/action.search.php?option=search",
        select: function( event, ui ) {
            event.preventDefault();
			window.location.href = "./detail.php?codecourse="+ui.item.id;
        }
	});
	
	$("#skill_inputs").autocomplete({
		source: "./ajax/action.search.php?option=search",
        select: function( event, ui ) {
            event.preventDefault();
			window.location.href = "./detail.php?codecourse="+ui.item.id;
        }
	});
	 
})(jQuery);

	function new_course(){
		var name = $('#coursename').val();
		var desc = $('#coursedesc').val();
		var mode = $('#coursemode').val();
		
		if(name == '' || desc == '' || mode == ''){
			alertify.error('Ningun capo debe ser vacio');
		}else{
			$.post("./ajax/action.person.php?option=new_course",{coursename:name, coursedesc:desc, coursemode:mode}, function(result){
				var result = eval('('+result+')');
				if (result.success){
					alertify.success('Se Añadio Correctamente');
					window.location.href = "coursed.php";
				} else {
					alertify.error(result.msg);
				}
			});
		}
	}
	
	function add_course(code){
		event.stopPropagation();
		$.post("./ajax/action.person.php?option=add_course&codecourse="+code, function(result){
			var result = eval('('+result+')');
			if (result.success){
				alertify.success('Se Añadio Correctamente');
				$("#cant_cart").html(result.cant);	
				$("#cant_carts").html(result.cant);	
			} else {
				alertify.error(result.msg);
			}
		});
	}
	
	function delete_detail(code){
		alertify.confirm(
		  'Confirmar', // Título
		  '¿Estás seguro de que va realizar el pago del curso?', // Mensaje
		  function() { // Función a ejecutar si se acepta
			  $.post("./ajax/action.person.php?option=delete_detail&codedetail="+code, function(result){
				var result = eval('('+result+')');
				if (result.success){
					alertify.success('Se Elimino Correctamente');
					setTimeout(function() {
					  window.location.reload();
					}, 3000);
				} else {
					alertify.error(result.msg);
				}
			});
		  },
		  function() { // Función a ejecutar si se cancela
			alertify.error('Pago cancelado');
		  }
		);
	}
	
	function paid(code){
		var selectedValues = [];
		$('input:checkbox:checked').each(function() {
		  selectedValues.push($(this).val());
		});
		if ($(selectedValues).length > 0) {
			$.post("./ajax/action.person.php?option=paid&codeperson="+code,{selectedCheckboxes: selectedValues}, function(result){
				var result = eval('('+result+')');
				if (result.success){
					alertify.success('pago realizado');
					window.open("https://wa.me/59163994357?text=Curso%20Pagado", "", "", "");
					window.location.reload();
					
				} else {
					alertify.error(result.msg);
				}
			});
		}else{
			alertify.error("Seleccione el curso que desea pagar");
		}
	}
	
	function pay_detail(code){
		alertify.confirm(
		  'Confirmar', 
		  '¿Estás seguro de que va realizar el pago del curso?', 
		  function() { 
			  $.post("./ajax/action.person.php?option=pay_detail&codedetail="+code, function(result){
				var result = eval('('+result+')');
				if (result.success){
					alertify.success('pago realizado');
					window.open("https://wa.me/59163994357?text=Curso%20Pagado", "", "", "");
					window.location.reload();
					
				} else {
					alertify.error(result.msg);
				}
			});
		  },
		  function() { 
			alertify.error('Pago cancelado');
		  }
		);
	}
	
	function show_lesson(url) {
		window.open(url, "", "", "");
			
	}
	
	function show_lessondoc(url) {
		window.open(url, "", "", "");
			
	}
	
	
	function filter_category(code) {
		 window.location.href = "./shop.php?codecategory="+code+'&page=1';
	}
	
	function filter_all() {
		 window.location.href = "./shop.php?codecategory=0&page=1";
	}
	
	function mostrarPassword(){
		var cambio = document.getElementById("personpassword");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 
	
	function ref_detail(code){
		window.location.href = "detail.php?codecourse="+code;
	}
	
	
	function ref_detailp(code){
		window.location.href = "detailp.php?codecourse="+code;
	}
	
	function check_box(code){
		var selectedValues = [];
		$('input:checkbox:checked').each(function() {
		  selectedValues.push($(this).val());
		});
		if ($(selectedValues).length > 0) {
			$.post("./ajax/action.person.php?option=total&codeperson="+code,{selectedCheckboxes: selectedValues}, function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#totalcart').html(result.total);
					
				} else {
					alertify.error(result.msg);
				}
			});
		}else{
			$('#totalcart').html('0');
		}
	}
	
	