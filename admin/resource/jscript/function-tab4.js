$(function(){
	
	$('#dg_ambience').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_edit_ambience(row);
		}
	});
	
	$( "#exit" ).click(function() {
		window.location.href='./../index.php';
	});
	
});
/*************************************************************AMBIENCE**********************************************************/
	var url_ambience;
	function new_ambience(){
		$('#form_ambience').dialog('open').dialog('setTitle','Nuevo Ambiente');
		$('#f_ambience').form('clear');
		url_ambience = '../ajax/action.ambience.php?option=insert';
	}
	
	function edit_ambience(){
		var row = $('#dg_ambience').datagrid('getSelected');
		if (row){
			$('#form_ambience').dialog('open').dialog('setTitle','Editar Ambiente');
			$('#f_ambience').form('load',row);
			url_ambience = '../ajax/action.ambience.php?option=update&codeambience='+row.codeambience		
		}
	}
	
	function dbl_edit_ambience(row){
		if (row){
			$('#form_ambience').dialog('open').dialog('setTitle','Editar Ambiente');			
			$('#f_ambience').form('load',row);
			url_ambience = '../ajax/action.ambience.php?option=update&codeambience='+row.codeambience
		}
	}
	
	function save_ambience(){
		$('#f_ambience').form('submit',{
			url: url_ambience,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_ambience').dialog('close');		
						$('#dg_ambience').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_ambience(){
		var row = $('#dg_ambience').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar este Ambiente?  '+row.ambiencename,function(r){
				if (r){
					$.post('../ajax/action.ambience.php?option=delete',{codeambience:row.codeambience},function(result){
						if (result.success){
							$('#dg_ambience').datagrid('reload');	
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
	
	function dosearch_ambience(value){
		$("#name_ambience").searchbox('setValue', '');
		$('#dg_ambience').datagrid('load',{
			nameambience: value,	
		});
	}
	
	function reload_ambience(){
		//$("#name_ambience").searchbox('setValue', '');
		$('#dg_ambience').datagrid('load',{
			nameambience: '',
		});
	}
