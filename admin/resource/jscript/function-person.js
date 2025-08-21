$(function(){
	
	$('#dg_person').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			edit_person(row);
		}
	});
	
	$( "#exit" ).click(function() {
		window.location.href='./../index.php';
	});
	
});
/*************************************************************USER********************************************************************/
	var url;
	function new_person(){
		$('#form_person').dialog('open').dialog('setTitle','Nuevo Estudiante');
		$('#f_person').form('clear');
		url = '../ajax/action.person.php?option=insert';
	}
	
	function edit_person(){
		var row = $('#dg_person').datagrid('getSelected');
		if (row){
			$('#form_person').dialog('open').dialog('setTitle','Editar Estudiante');
			$('#f_person').form('load',row);
			url = '../ajax/action.person.php?option=update&codeperson='+row.codeperson		
		}
	}
	
	function edit_person(row){
		if (row){
			$('#form_person').dialog('open').dialog('setTitle','Editar Estudiante');			
			$('#f_person').form('load',row);
			url = '../ajax/action.person.php?option=update&codeperson='+row.codeperson
		}
	}
	
	function save_person(){
		$('#f_person').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_person').dialog('close');		
						$('#dg_person').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_person(){
		var row = $('#dg_person').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar este Estudiante?  '+row.personname,function(r){
				if (r){
					$.post('../ajax/action.person.php?option=delete',{codeperson:row.codeperson},function(result){
						if (result.success){
							$('#dg_person').datagrid('reload');	
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
	
	function dosearch_person(value){
		$("#name_person").searchbox('setValue', '');
		$('#dg_person').datagrid('load',{
			nameperson: value,	
		});
	}
	
	function reload_person(){
		//$("#name_person").searchbox('setValue', '');
		$('#dg_person').datagrid('load',{
			nameperson: '',
		});
	}
/*************************************************************************************************************************************/	
