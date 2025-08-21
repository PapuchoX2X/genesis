$(function(){
	
	$('#dg_category').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_category(row);
		}
	});
	
	$('#dg_sub').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_sub(row);
		}
	});
	
	$( "#exit" ).click(function() {
		window.location.href='./../index.php';
	});
	
});
/*************************************************************category**********************************************************/
	var url_category;
	function new_category(){
		$('#form_category').dialog('open').dialog('setTitle','Nueva Categoria');
		$('#f_category').form('clear');
		url_category = '../ajax/action.category.php?option=insert';
	}
	
	function edit_category(){
		var row = $('#dg_category').datagrid('getSelected');
		if (row){
			$('#form_category').dialog('open').dialog('setTitle','Editar Categoria');
			$('#f_category').form('load',row);
			url_category = '../ajax/action.category.php?option=update&codecategory='+row.codecategory		
		}
	}
	
	function dbl_category(row){
		if (row){
			$('#form_category').dialog('open').dialog('setTitle','Editar Categoria');			
			$('#f_category').form('load',row);
			url_category = '../ajax/action.category.php?option=update&codecategory='+row.codecategory
		}
	}
	
	function save_category(){
		$('#f_category').form('submit',{
			url: url_category,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_category').dialog('close');		
						$('#dg_category').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_category(){
		var row = $('#dg_category').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar esta categoria?  '+row.categoryname,function(r){
				if (r){
					$.post('../ajax/action.category.php?option=delete',{codecategory:row.codecategory},function(result){
						if (result.success){
							$('#dg_category').datagrid('reload');	
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
	
	function dosearch_category(value){
		$("#name_category").searchbox('setValue', '');
		$('#dg_category').datagrid('load',{
			namecategory: value,	
		});
	}
	
	function reload_category(){
		//$("#name_category").searchbox('setValue', '');
		$('#dg_category').datagrid('load',{
			namecategory: '',
		});
	}
/*************************************************************sub-category**********************************************************/
	var url_sub;
	
	function show_sub(){
		var row = $('#dg_category').datagrid('getSelected');
		if (row){
			$('#form_showsub').dialog('open').dialog('setTitle','GESTION SUBCATEGORIAS');
			$('#dg_sub').datagrid({
				url: './../ajax/action.admin.php?option=sub&codecategory='+row.codecategory
			});
		}else{
			$.messager.show({
				title: 'Info',
				msg: 'Seleccione una Categoria'
			});
		}
	}
	
	function new_sub(){
		var row = $('#dg_category').datagrid('getSelected');
		if (row){
			$('#form_sub').dialog('open').dialog('setTitle','Nueva Sub Categoria');
			$('#f_sub').form('clear');
			url_sub = '../ajax/action.sub.php?option=insert&codecategory='+row.codecategory;
		}else{
			$.messager.show({
				title: 'Info',
				msg: 'Seleccione una Categoria'
			});
		}	
	}
	
	function edit_sub(){
		var row = $('#dg_sub').datagrid('getSelected');
		if (row){
			$('#form_sub').dialog('open').dialog('setTitle','Editar Sub Categoria');
			$('#f_sub').form('load',row);
			url_sub = '../ajax/action.sub.php?option=update&codesubcategory='+row.codesubcategory+'&codecategory='+row.codecategory		
		}
	}
	
	function dbl_sub(row){
		if (row){
			$('#form_sub').dialog('open').dialog('setTitle','Editar Sub Categoria');			
			$('#f_sub').form('load',row);
			url_sub = '../ajax/action.sub.php?option=update&codesubcategory='+row.codesubcategory+'&codecategory='+row.codecategory
		}
	}
	
	function save_sub(){
		$('#f_sub').form('submit',{
			url: url_sub,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_sub').dialog('close');		
						$('#dg_sub').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_sub(){
		var row = $('#dg_sub').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar esta subcategoria?  '+row.subcategoryname,function(r){
				if (r){
					$.post('../ajax/action.sub.php?option=delete',{codesubcategory:row.codesubcategory},function(result){
						if (result.success){
							$('#dg_sub').datagrid('reload');	
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
	
	function dosearch_sub(value){
		$("#name_sub").searchbox('setValue', '');
		$('#dg_sub').datagrid('load',{
			namesub: value,	
		});
	}
	
	function reload_sub(){
		//$("#name_sub").searchbox('setValue', '');
		$('#dg_sub').datagrid('load',{
			namesub: '',
		});
	}
/*****************************************************************************************************************/