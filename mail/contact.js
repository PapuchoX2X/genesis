$(function () {
	
});

	function send_contact(){
		var name = $("#name").val();
		var email = $("#email").val();
		var subject = $("#subject").val();
		var message = $("#message").val();
		
		var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		
		if(name == '' || email == '' || subject == '' || message == ''){
			alertify.error('Ningun capo debe ser vacio');
		}else{
			if (emailPattern.test(email)) {
				$.post("./mail/contact.php",{name:name, email:email, subject:subject, message:message}, function(result){
					var result = eval('('+result+')');
					if (result.success){
						alertify.success('Mensaje enviado');
						$("#name").val('');
						$("#email").val('');
						$("#subject").val('');
						$("#message").val('');
					} else {
						alertify.error(result.msg);
					}
				});
			}else{
				alertify.error('Correo electronico no valido');
			}
		}
	}
	
	

