$(function(){
	
	$('#dg_titlea').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_edit_titlea(row);
		}
	});
	
	$('#dg_texta').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_edit_text(row);
		}
	});
	
	$('#dg_imga').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_edit_imgt(row);
		}
	});
	
	$( "#exit" ).click(function() {
		window.location.href='./../index.php';
	});
	
});
/*************************************************************TITLEA**********************************************************/
	var url_titlea;
	function new_titlea(){
		$('#form_titlea').dialog('open').dialog('setTitle','Nuevo Titulo');
		$('#f_titlea').form('clear');
		url_titlea = '../ajax/action.titlea.php?option=insert';
	}
	
	function edit_titlea(){
		var row = $('#dg_titlea').datagrid('getSelected');
		if (row){
			$('#form_titlea').dialog('open').dialog('setTitle','Editar Titulo');
			$('#f_titlea').form('load',row);
			url_titlea = '../ajax/action.titlea.php?option=update&codetitlea='+row.codetitlea		
		}
	}
	
	function dbl_edit_titlea(row){
		if (row){
			$('#form_titlea').dialog('open').dialog('setTitle','Editar Titulo');			
			$('#f_titlea').form('load',row);
			url_titlea = '../ajax/action.titlea.php?option=update&codetitlea='+row.codetitlea
		}
	}
	
	function save_titlea(){
		$('#f_titlea').form('submit',{
			url: url_titlea,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_titlea').dialog('close');		
						$('#dg_titlea').datagrid('reload');	
						$('#codetitleai').combobox('reload', '../ajax/action.titlea.php?option=show');
						$('#codetitleat').combobox('reload', '../ajax/action.titlea.php?option=show');
					} else {
						$.messager.show({
							titlea: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_titlea(){
		var row = $('#dg_titlea').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar este Titulo?  '+row.titleaname,function(r){
				if (r){
					$.post('../ajax/action.titlea.php?option=delete',{codetitlea:row.codetitlea},function(result){
						if (result.success){
							$('#dg_titlea').datagrid('reload');	
						} else {
							$.messager.show({	
								titlea: 'Error',
								msg: result.msg
							});
						}
					},'json');
				}
			});
		}
	}
	
	function dosearch_titlea(value){
		$("#name_titlea").searchbox('setValue', '');
		$('#dg_titlea').datagrid('load',{
			nametitlea: value,	
		});
	}
	
	function reload_titlea(){
		//$("#name_titlea").searchbox('setValue', '');
		$('#dg_titlea').datagrid('load',{
			nametitlea: '',
		});
	}
/*************************************************************TEXTA**********************************************************/
	var url_texta;
	function new_texta(){
		$('#form_texta').dialog('open').dialog('setTitle','Nuevo Parrafo');
		$('#f_texta').form('clear');
		url_texta = '../ajax/action.texta.php?option=insert';
	}
	
	function edit_texta(){
		var row = $('#dg_texta').datagrid('getSelected');
		if (row){
			$('#form_texta').dialog('open').dialog('setTitle','Editar Parrafo');
			$('#f_texta').form('load',row);
			url_texta = '../ajax/action.texta.php?option=update&codetexta='+row.codetexta		
		}
	}
	
	function dbl_edit_texta(row){
		if (row){
			$('#form_texta').dialog('open').dialog('setTitle','Editar Parrafo');			
			$('#f_texta').form('load',row);
			url_texta = '../ajax/action.texta.php?option=update&codetexta='+row.codetexta
		}
	}
	
	function save_texta(){
		$('#f_texta').form('submit',{
			url: url_texta,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#form_texta').dialog('close');		
					$('#dg_texta').datagrid('reload');	
				} else {
					$.messager.show({
						titlea: 'Error',
						msg: result.msg
					});
				}
			}
		});
	}
	
	function remove_texta(){
		var row = $('#dg_texta').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar este Parrafo?  '+row.textasection,function(r){
				if (r){
					$.post('../ajax/action.texta.php?option=delete',{codetexta:row.codetexta},function(result){
						if (result.success){
							$('#dg_texta').datagrid('reload');	
						} else {
							$.messager.show({	
								titlea: 'Error',
								msg: result.msg
							});
						}
					},'json');
				}
			});
		}
	}
	
	function dosearch_texta(value){
		$("#name_texta").searchbox('setValue', '');
		$('#dg_texta').datagrid('load',{
			nametexta: value,	
		});
	}
	
	function reload_texta(){
		//$("#name_texta").searchbox('setValue', '');
		$('#dg_texta').datagrid('load',{
			nametexta: '',
		});
	}

/*************************************************************IMGA********************************************************/
	var url_imga;
	function new_imga(){
		$('#form_imga').dialog('open').dialog('setTitle','Nueva Imagen');
		$('#f_imga').form('clear');
		url_imga = '../ajax/action.imga.php?option=insert';
	}
	
	function edit_imga(){
		var row = $('#dg_imga').datagrid('getSelected');
		if (row){
			$('#form_imga').dialog('open').dialog('setTitle','Editar Imagen');
			$('#f_imga').form('load',row);
			url_imga = '../ajax/action.imga.php?option=update&codeimga='+row.codeimga		
		}
	}
	
	function dbl_edit_imga(row){
		if (row){
			$('#form_imga').dialog('open').dialog('setTitle','Editar Imagen');			
			$('#f_imga').form('load',row);
			url_imga = '../ajax/action.imga.php?option=update&codeimga='+row.codeimga
		}
	}
	
	function save_imga(){
		$('#f_imga').form('submit',{
			url: url_imga,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#form_imga').dialog('close');
					$('#dg_imga').datagrid('reload');						
				} else {
					$.messager.show({
						titlea: 'Error',
						msg: result.msg
					});
				}
			}
		});
	}
	
	function remove_imga(){
		var row = $('#dg_imga').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar esta imagen?  '+row.imganame,function(r){
				if (r){
					$.post('../ajax/action.imga.php?option=delete',{codeimga:row.codeimga},function(result){
						if (result.success){
							$('#dg_imga').datagrid('reload');	
						} else {
							$.messager.show({	
								titlea: 'Error',
								msg: result.msg
							});
						}
					},'json');
				}
			});
		}
	}
	
	function dosearch_imga(value){
		$("#name_imga").searchbox('setValue', '');
		$('#dg_imga').datagrid('load',{
			nameimga: value,	
		});
	}
	
	function reload_imga(){
		//$("#name_imga").searchbox('setValue', '');
		$('#dg_imga').datagrid('load',{
			nameimga: '',
		});
	}