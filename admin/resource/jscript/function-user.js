$(function(){
	
	$('#dg_user').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			edit_user(row);
		}
	});
	
	$( "#exit" ).click(function() {
		window.location.href='./../index.php';
	});
	
});
/*************************************************************USER********************************************************************/
	var url;
	function new_user(){
		$('#form_user').dialog('open').dialog('setTitle','Nuevo Usuario');
		$('#f_user').form('clear');
		url = '../ajax/action.user.php?option=insert';
	}
	
	function edit_user_button(){
		var row = $('#dg_user').datagrid('getSelected');
		if (row){
			$('#form_user').dialog('open').dialog('setTitle','Editar Usuario');
			$('#f_user').form('load',row);
			url = '../ajax/action.user.php?option=update&codeuser='+row.codeuser		
		}
	}
	
	function edit_user(row){
		if (row){
			$('#form_user').dialog('open').dialog('setTitle','Editar Usuario');			
			$('#f_user').form('load',row);
			url = '../ajax/action.user.php?option=update&codeuser='+row.codeuser
		}
	}
	
	function save_user(){
		$('#f_user').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_user').dialog('close');		
						$('#dg_user').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_user(){
		var row = $('#dg_user').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar este Usuario?  '+row.username,function(r){
				if (r){
					$.post('../ajax/action.user.php?option=delete',{codeuser:row.codeuser},function(result){
						if (result.success){
							$('#dg_user').datagrid('reload');	
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
	
	function dosearch_user(value){
		$("#name_user").searchbox('setValue', '');
		$('#dg_user').datagrid('load',{
			nameuser: value,	
		});
	}
	
	function reload_user(){
		//$("#name_user").searchbox('setValue', '');
		$('#dg_user').datagrid('load',{
			nameuser: '',
		});
	}
/*************************************************************************************************************************************/	
