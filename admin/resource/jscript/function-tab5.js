$(function(){
	
	$('#dg_contact').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_edit_contact(row);
		}
	});
	
	$( "#exit" ).click(function() {
		window.location.href='./../index.php';
	});
	
});
/*************************************************************CONTACT***************************************************/
	var url_contact;
	function new_contact(){
		$('#form_contact').dialog('open').dialog('setTitle','Nuevo Datos Contacto');
		$('#f_contact').form('clear');
		url_contact = '../ajax/action.contact.php?option=insert';
	}
	
	function edit_contact(){
		var row = $('#dg_contact').datagrid('getSelected');
		if (row){
			$('#form_contact').dialog('open').dialog('setTitle','Editar  Datos Contacto');
			$('#f_contact').form('load',row);
			url_contact = '../ajax/action.contact.php?option=update&codecontact='+row.codecontact		
		}
	}
	
	function dbl_edit_contact(row){
		if (row){
			$('#form_contact').dialog('open').dialog('setTitle','Editar  Datos Contacto');			
			$('#f_contact').form('load',row);
			url_contact = '../ajax/action.contact.php?option=update&codecontact='+row.codecontact
		}
	}
	
	function save_contact(){
		$('#f_contact').form('submit',{
			url: url_contact,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_contact').dialog('close');		
						$('#dg_contact').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_contact(){
		var row = $('#dg_contact').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar este Contacto?  ',function(r){
				if (r){
					$.post('../ajax/action.contact.php?option=delete',{codecontact:row.codecontact},function(result){
						if (result.success){
							$('#dg_contact').datagrid('reload');	
						} else {
							$.messager.show({	
								title: 'Error',
								msg: result.msg
							});
						}
					},'json');
				}
			});
		}
	}
	
	function dosearch_contact(value){
		$("#name_contact").searchbox('setValue', '');
		$('#dg_contact').datagrid('load',{
			namecontact: value,	
		});
	}
	
	function reload_contact(){
		//$("#name_contact").searchbox('setValue', '');
		$('#dg_contact').datagrid('load',{
			namecontact: '',
		});
	}
