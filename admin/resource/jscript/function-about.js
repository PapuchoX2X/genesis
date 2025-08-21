$(function(){
	
	$('#dg_about').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_about(row);
		}
	});
	
	$( "#exit" ).click(function() {
		window.location.href='./../index.php';
	});
	
});
/*************************************************************about**********************************************************/
	var url_about;
	function new_about(){
		$('#form_about').dialog('open').dialog('setTitle','Nuevo');
		$('#f_about').form('clear');
		url_about = '../ajax/action.about.php?option=insert';
	}
	
	function edit_about(){
		var row = $('#dg_about').datagrid('getSelected');
		if (row){
			$('#form_about').dialog('open').dialog('setTitle','Editar '+row.abouttype);
			$('#f_about').form('load',row);
			url_about = '../ajax/action.about.php?option=update&codeabout='+row.codeabout		
		}
	}
	
	function dbl_about(row){
		if (row){
			$('#form_about').dialog('open').dialog('setTitle','Editar '+row.abouttype);			
			$('#f_about').form('load',row);
			url_about = '../ajax/action.about.php?option=update&codeabout='+row.codeabout
		}
	}
	
	function save_about(){
		$('#f_about').form('submit',{
			url: url_about,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_about').dialog('close');		
						$('#dg_about').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_about(){
		var row = $('#dg_about').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar este tipo?  '+row.abouttype,function(r){
				if (r){
					$.post('../ajax/action.about.php?option=delete',{codeabout:row.codeabout},function(result){
						if (result.success){
							$('#dg_about').datagrid('reload');	
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
	
	function dosearch_about(value){
		$("#name_about").searchbox('setValue', '');
		$('#dg_about').datagrid('load',{
			nameabout: value,	
		});
	}
	
	function reload_about(){
		//$("#name_about").searchbox('setValue', '');
		$('#dg_about').datagrid('load',{
			nameabout: '',
		});
	}
	
/***********************************************************************************************************************/