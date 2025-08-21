$(function(){
	
	$("#userpassword").keypress(function(e) {
		if(e.which == 13) {
			var userlogin = $("#userlogin").val();
			var userpassword = $(this).val();
			
			$.post('ajax/action.login.php?option=valid',{userlogin:userlogin, userpassword:userpassword},function(result){
				if (result.success){
					if(result.type == "ADMINISTRADOR"){
						window.location.href='./class/category.php';
					}else{
						if(result.type == "CAJERO"){
							window.location.href='./class/paids.php';
						}
					}
				} else {
					$.messager.show({	
						title: 'Error',
						msg: result.msg
					});
				}
			},'json');
		}
	});
	$( "#button-login" ).click(function() {
		
		var userlogin = $("#userlogin").val();
		var userpassword = $("#userpassword").val();
		
		$.post('ajax/action.login.php?option=valid',{userlogin:userlogin, userpassword:userpassword},function(result){
			if (result.success){
				if(result.type == "ADMINISTRADOR"){
					window.location.href='./class/category.php';
				}else{
					if(result.type == "CAJERO"){
						window.location.href='./class/paids.php';
					}
				}
			} else {
				$.messager.show({	
					title: 'Error',
					msg: result.msg
				});
			}
		},'json');
	});
	
});
