$(function(){
	
	$('#dg_title').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_edit_title(row);
		}
	});
	
	$('#dg_text').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_edit_text(row);
		}
	});
	
	$('#dg_imgt').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_edit_imgt(row);
		}
	});
	
	$( "#exit" ).click(function() {
		window.location.href='./../index.php';
	});
	
});
/*************************************************************TITLE**********************************************************/
	var url_title;
	function new_title(){
		$('#form_title').dialog('open').dialog('setTitle','Nuevo Titulo');
		$('#f_title').form('clear');
		url_title = '../ajax/action.title.php?option=insert';
	}
	
	function edit_title(){
		var row = $('#dg_title').datagrid('getSelected');
		if (row){
			$('#form_title').dialog('open').dialog('setTitle','Editar Titulo');
			$('#f_title').form('load',row);
			url_title = '../ajax/action.title.php?option=update&codetitle='+row.codetitle		
		}
	}
	
	function dbl_edit_title(row){
		if (row){
			$('#form_title').dialog('open').dialog('setTitle','Editar Titulo');			
			$('#f_title').form('load',row);
			url_title = '../ajax/action.title.php?option=update&codetitle='+row.codetitle
		}
	}
	
	function save_title(){
		$('#f_title').form('submit',{
			url: url_title,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_title').dialog('close');		
						$('#dg_title').datagrid('reload');	
						$('#codetitlei').combobox('reload', '../ajax/action.title.php?option=show');
						$('#codetitlet').combobox('reload', '../ajax/action.title.php?option=show');
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_title(){
		var row = $('#dg_title').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar este Titulo?  '+row.titlename,function(r){
				if (r){
					$.post('../ajax/action.title.php?option=delete',{codetitle:row.codetitle},function(result){
						if (result.success){
							$('#dg_title').datagrid('reload');	
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
	
	function dosearch_title(value){
		$("#name_title").searchbox('setValue', '');
		$('#dg_title').datagrid('load',{
			nametitle: value,	
		});
	}
	
	function reload_title(){
		//$("#name_title").searchbox('setValue', '');
		$('#dg_title').datagrid('load',{
			nametitle: '',
		});
	}
/*************************************************************TITLE**********************************************************/
	var url_text;
	function new_text(){
		$('#form_text').dialog('open').dialog('setTitle','Nuevo Parrafo');
		$('#f_text').form('clear');
		url_text = '../ajax/action.text.php?option=insert';
	}
	
	function edit_text(){
		var row = $('#dg_text').datagrid('getSelected');
		if (row){
			$('#form_text').dialog('open').dialog('setTitle','Editar Parrafo');
			$('#f_text').form('load',row);
			url_text = '../ajax/action.text.php?option=update&codetext='+row.codetext		
		}
	}
	
	function dbl_edit_text(row){
		if (row){
			$('#form_text').dialog('open').dialog('setTitle','Editar Parrafo');			
			$('#f_text').form('load',row);
			url_text = '../ajax/action.text.php?option=update&codetext='+row.codetext
		}
	}
	
	function save_text(){
		$('#f_text').form('submit',{
			url: url_text,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_text').dialog('close');		
						$('#dg_text').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_text(){
		var row = $('#dg_text').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar este Parrafo?  '+row.textsection,function(r){
				if (r){
					$.post('../ajax/action.text.php?option=delete',{codetext:row.codetext},function(result){
						if (result.success){
							$('#dg_text').datagrid('reload');	
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
	
	function dosearch_text(value){
		$("#name_text").searchbox('setValue', '');
		$('#dg_text').datagrid('load',{
			nametext: value,	
		});
	}
	
	function reload_text(){
		//$("#name_text").searchbox('setValue', '');
		$('#dg_text').datagrid('load',{
			nametext: '',
		});
	}

/*************************************************************IMGT********************************************************/
	var url_imgt;
	function new_imgt(){
		$('#form_imgt').dialog('open').dialog('setTitle','Nueva Imagen');
		$('#f_imgt').form('clear');
		url_imgt = '../ajax/action.imgt.php?option=insert';
	}
	
	function edit_imgt(){
		var row = $('#dg_imgt').datagrid('getSelected');
		if (row){
			$('#form_imgt').dialog('open').dialog('setTitle','Editar Imagen');
			$('#f_imgt').form('load',row);
			url_imgt = '../ajax/action.imgt.php?option=update&codeimgt='+row.codeimgt		
		}
	}
	
	function dbl_edit_imgt(row){
		if (row){
			$('#form_imgt').dialog('open').dialog('setTitle','Editar Imagen');			
			$('#f_imgt').form('load',row);
			url_imgt = '../ajax/action.imgt.php?option=update&codeimgt='+row.codeimgt
		}
	}
	
	function save_imgt(){
		$('#f_imgt').form('submit',{
			url: url_imgt,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_imgt').dialog('close');
						$('#dg_imgt').datagrid('reload');						
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_imgt(){
		var row = $('#dg_imgt').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar esta imagen?  '+row.imgtname,function(r){
				if (r){
					$.post('../ajax/action.imgt.php?option=delete',{codeimgt:row.codeimgt},function(result){
						if (result.success){
							$('#dg_imgt').datagrid('reload');	
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
	
	function dosearch_imgt(value){
		$("#name_imgt").searchbox('setValue', '');
		$('#dg_imgt').datagrid('load',{
			nameimgt: value,	
		});
	}
	
	function reload_imgt(){
		//$("#name_imgt").searchbox('setValue', '');
		$('#dg_imgt').datagrid('load',{
			nameimgt: '',
		});
	}