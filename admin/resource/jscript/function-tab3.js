$(function(){
	
	$('#dg_titleg').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_edit_titleg(row);
		}
	});
	
	$('#dg_imgg').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_edit_imgg(row);
		}
	});
	
	$( "#exit" ).click(function() {
		window.location.href='./../index.php';
	});
	
});
/*************************************************************TITLEG**********************************************************/
	var url_titleg;
	function new_titleg(){
		$('#form_titleg').dialog('open').dialog('setTitle','Nuevo Titulo Galeria');
		$('#f_titleg').form('clear');
		url_titleg = '../ajax/action.titleg.php?option=insert';
	}
	
	function edit_titleg(){
		var row = $('#dg_titleg').datagrid('getSelected');
		if (row){
			$('#form_titleg').dialog('open').dialog('setTitle','Editar Galeria');
			$('#f_titleg').form('load',row);
			url_titleg = '../ajax/action.titleg.php?option=update&codetitleg='+row.codetitleg		
		}
	}
	
	function dbl_edit_titleg(row){
		if (row){
			$('#form_titleg').dialog('open').dialog('setTitle','Editar Galeria');			
			$('#f_titleg').form('load',row);
			url_titleg = '../ajax/action.titleg.php?option=update&codetitleg='+row.codetitleg
		}
	}
	
	function save_titleg(){
		$('#f_titleg').form('submit',{
			url: url_titleg,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_titleg').dialog('close');		
						$('#dg_titleg').datagrid('reload');	
						$('#codetitleg').combobox('reload', '../ajax/action.titleg.php?option=show');
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_titleg(){
		var row = $('#dg_titleg').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar este Titulo?  '+row.titlegname,function(r){
				if (r){
					$.post('../ajax/action.titleg.php?option=delete',{codetitleg:row.codetitleg},function(result){
						if (result.success){
							$('#dg_titleg').datagrid('reload');	
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
	
	function dosearch_titleg(value){
		$("#name_titleg").searchbox('setValue', '');
		$('#dg_titleg').datagrid('load',{
			nametitleg: value,	
		});
	}
	
	function reload_titleg(){
		//$("#name_titleg").searchbox('setValue', '');
		$('#dg_titleg').datagrid('load',{
			nametitleg: '',
		});
	}

/*************************************************************IMGG********************************************************/
	var url_imgg;
	function new_imgg(){
		$('#form_imgg').dialog('open').dialog('setTitle','Nueva Imagen');
		$('#f_imgg').form('clear');
		url_imgg = '../ajax/action.imgg.php?option=insert';
	}
	
	function edit_imgg(){
		var row = $('#dg_imgg').datagrid('getSelected');
		if (row){
			$('#form_imgg').dialog('open').dialog('setTitle','Editar Imagen');
			$('#f_imgg').form('load',row);
			url_imgg = '../ajax/action.imgg.php?option=update&codeimgg='+row.codeimgg		
		}
	}
	
	function dbl_edit_imgg(row){
		if (row){
			$('#form_imgg').dialog('open').dialog('setTitle','Editar Imagen');			
			$('#f_imgg').form('load',row);
			url_imgg = '../ajax/action.imgg.php?option=update&codeimgg='+row.codeimgg
		}
	}
	
	function save_imgg(){
		$('#f_imgg').form('submit',{
			url: url_imgg,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_imgg').dialog('close');
						$('#dg_imgg').datagrid('reload');						
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_imgg(){
		var row = $('#dg_imgg').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar esta imagen?  '+row.imggname,function(r){
				if (r){
					$.post('../ajax/action.imgg.php?option=delete',{codeimgg:row.codeimgg},function(result){
						if (result.success){
							$('#dg_imgg').datagrid('reload');	
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
	
	function dosearch_imgg(value){
		$("#name_imgg").searchbox('setValue', '');
		$('#dg_imgg').datagrid('load',{
			nameimgg: value,	
		});
	}
	
	function reload_imgg(){
		//$("#name_imgg").searchbox('setValue', '');
		$('#dg_imgg').datagrid('load',{
			nameimgg: '',
		});
	}