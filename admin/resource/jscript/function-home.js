$(function(){
	
	$('#dg_logo').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_edit_logo(row);
		}
	});
	
	$('#dg_banner').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_edit_banner(row);
		}
	});
	
	$('#dg_short').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_short(row);
		}
	});
	
	$('#dg_institutions').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_institutions(row);
		}
	});
	
	$('#dg_certification').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_certification(row);
		}
	});
	
	$('#dg_location').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_location(row);
		}
	});
	
	$( "#exit" ).click(function() {
		window.location.href='./../index.php';
	});
	
});
/*************************************************************LOGO**********************************************************/
	var url_logo;
	function new_logo(){
		$('#form_logo').dialog('open').dialog('setTitle','Nuevo Logo');
		$('#f_logo').form('clear');
		url_logo = '../ajax/action.logo.php?option=insert';
	}
	
	function edit_logo(){
		var row = $('#dg_logo').datagrid('getSelected');
		if (row){
			$('#form_logo').dialog('open').dialog('setTitle','Editar Logo');
			$('#f_logo').form('load',row);
			url_logo = '../ajax/action.logo.php?option=update&codelogo='+row.codelogo		
		}
	}
	
	function dbl_edit_logo(row){
		if (row){
			$('#form_logo').dialog('open').dialog('setTitle','Editar Logo');			
			$('#f_logo').form('load',row);
			url_logo = '../ajax/action.logo.php?option=update&codelogo='+row.codelogo
		}
	}
	
	function save_logo(){
		$('#f_logo').form('submit',{
			url: url_logo,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_logo').dialog('close');		
						$('#dg_logo').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_logo(){
		var row = $('#dg_logo').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar este Logo?  '+row.logoimg,function(r){
				if (r){
					$.post('../ajax/action.logo.php?option=delete',{codelogo:row.codelogo},function(result){
						if (result.success){
							$('#dg_logo').datagrid('reload');	
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
	
	function dosearch_logo(value){
		$("#name_logo").searchbox('setValue', '');
		$('#dg_logo').datagrid('load',{
			namelogo: value,	
		});
	}
	
	function reload_logo(){
		//$("#name_logo").searchbox('setValue', '');
		$('#dg_logo').datagrid('load',{
			namelogo: '',
		});
	}

/*************************************************************BANNER********************************************************/
	var url_banner;
	function new_banner(){
		$('#form_banner').dialog('open').dialog('setTitle','Nuevo Banner');
		$('#f_banner').form('clear');
		url_banner = '../ajax/action.banner.php?option=insert';
	}
	
	function edit_banner(){
		var row = $('#dg_banner').datagrid('getSelected');
		if (row){
			$('#form_banner').dialog('open').dialog('setTitle','Editar Banner');
			$('#f_banner').form('load',row);
			url_banner = '../ajax/action.banner.php?option=update&codebanner='+row.codebanner		
		}
	}
	
	function dbl_edit_banner(row){
		if (row){
			$('#form_banner').dialog('open').dialog('setTitle','Editar Banner');			
			$('#f_banner').form('load',row);
			url_banner = '../ajax/action.banner.php?option=update&codebanner='+row.codebanner
		}
	}
	
	function save_banner(){
		$('#f_banner').form('submit',{
			url: url_banner,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_banner').dialog('close');		
						$('#dg_banner').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_banner(){
		var row = $('#dg_banner').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar este banner?  '+row.bannerimg,function(r){
				if (r){
					$.post('../ajax/action.banner.php?option=delete',{codebanner:row.codebanner},function(result){
						if (result.success){
							$('#dg_banner').datagrid('reload');	
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
	
	function dosearch_banner(value){
		$("#name_banner").searchbox('setValue', '');
		$('#dg_banner').datagrid('load',{
			namebanner: value,	
		});
	}
	
	function reload_banner(){
		//$("#name_banner").searchbox('setValue', '');
		$('#dg_banner').datagrid('load',{
			namebanner: '',
		});
	}

/*************************************************************SHORT********************************************************/
	var url_short;
	function new_short(){
		$('#form_short').dialog('open').dialog('setTitle','Nuevo Banner Short');
		$('#f_short').form('clear');
		url_short = '../ajax/action.short.php?option=insert';
	}
	
	function edit_short(){
		var row = $('#dg_short').datagrid('getSelected');
		if (row){
			$('#form_short').dialog('open').dialog('setTitle','Editar Banner Short');
			$('#f_short').form('load',row);
			url_short = '../ajax/action.short.php?option=update&codeshort='+row.codeshort		
		}
	}
	
	function dbl_short(row){
		if (row){
			$('#form_short').dialog('open').dialog('setTitle','Editar Banner Short');			
			$('#f_short').form('load',row);
			url_short = '../ajax/action.short.php?option=update&codeshort='+row.codeshort
		}
	}
	
	function save_short(){
		$('#f_short').form('submit',{
			url: url_short,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_short').dialog('close');		
						$('#dg_short').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_short(){
		var row = $('#dg_short').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar este banner short?  '+row.shortimg,function(r){
				if (r){
					$.post('../ajax/action.short.php?option=delete',{codeshort:row.codeshort},function(result){
						if (result.success){
							$('#dg_short').datagrid('reload');	
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
	
	function dosearch_short(value){
		$("#name_short").searchbox('setValue', '');
		$('#dg_short').datagrid('load',{
			nameshort: value,	
		});
	}
	
	function reload_short(){
		//$("#name_short").searchbox('setValue', '');
		$('#dg_short').datagrid('load',{
			nameshort: '',
		});
	}
/*************************************************************INSTITUTIONS********************************************************/
	var url_institutions;
	function new_institutions(){
		$('#form_institutions').dialog('open').dialog('setTitle','Nueva Institucion');
		$('#f_institutions').form('clear');
		url_institutions = '../ajax/action.institutions.php?option=insert';
	}
	
	function edit_institutions(){
		var row = $('#dg_institutions').datagrid('getSelected');
		if (row){
			$('#form_institutions').dialog('open').dialog('setTitle','Editar Institucion');
			$('#f_institutions').form('load',row);
			url_institutions = '../ajax/action.institutions.php?option=update&codeinstitutions='+row.codeinstitutions	
		}
	}
	
	function dbl_institutions(row){
		if (row){
			$('#form_institutions').dialog('open').dialog('setTitle','Editar Institucion');			
			$('#f_institutions').form('load',row);
			url_institutions = '../ajax/action.institutions.php?option=update&codeinstitutions='+row.codeinstitutions
		}
	}
	
	function save_institutions(){
		$('#f_institutions').form('submit',{
			url: url_institutions,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#form_institutions').dialog('close');		
					$('#dg_institutions').datagrid('reload');	
				} else {
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
				}
			}
		});
	}
	
	function remove_institutions(){
		var row = $('#dg_institutions').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar esta Institucion?  '+row.institutionsimg,function(r){
				if (r){
					$.post('../ajax/action.institutions.php?option=delete',{codeinstitutions:row.codeinstitutions},function(result){
						if (result.success){
							$('#dg_institutions').datagrid('reload');	
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
	
	function dosearch_institutions(value){
		$("#name_institutions").searchbox('setValue', '');
		$('#dg_institutions').datagrid('load',{
			nameinstitutions: value,	
		});
	}
	
	function reload_institutions(){
		//$("#name_institutions").searchbox('setValue', '');
		$('#dg_institutions').datagrid('load',{
			nameinstitutions: '',
		});
	}
/*************************************************************CERTIFICATION********************************************************/
	var url_certification;
	function new_certification(){
		$('#form_certification').dialog('open').dialog('setTitle','Nueva Certificacion');
		$('#f_certification').form('clear');
		url_certification = '../ajax/action.certification.php?option=insert';
	}
	
	function edit_certification(){
		var row = $('#dg_certification').datagrid('getSelected');
		if (row){
			$('#form_certification').dialog('open').dialog('setTitle','Editar Certificacion');
			$('#f_certification').form('load',row);
			url_certification = '../ajax/action.certification.php?option=update&codecertification='+row.codecertification	
		}
	}
	
	function dbl_certification(row){
		if (row){
			$('#form_certification').dialog('open').dialog('setTitle','Editar Certificacion');			
			$('#f_certification').form('load',row);
			url_certification = '../ajax/action.certification.php?option=update&codecertification='+row.codecertification
		}
	}
	
	function save_certification(){
		$('#f_certification').form('submit',{
			url: url_certification,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#form_certification').dialog('close');		
					$('#dg_certification').datagrid('reload');	
				} else {
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
				}
			}
		});
	}
	
	function remove_certification(){
		var row = $('#dg_certification').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar esta Cetifiacion?  '+row.institutionsimg,function(r){
				if (r){
					$.post('../ajax/action.certification.php?option=delete',{codecertification:row.codecertification},function(result){
						if (result.success){
							$('#dg_certification').datagrid('reload');	
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
	
	function dosearch_certification(value){
		$("#name_certification").searchbox('setValue', '');
		$('#dg_certification').datagrid('load',{
			namecertification: value,	
		});
	}
	
	function reload_certification(){
		//$("#name_certification").searchbox('setValue', '');
		$('#dg_certification').datagrid('load',{
			namecertification: '',
		});
	}
/*************************************************************LOCATION********************************************************/
	var url_location;
	function new_location(){
		$('#form_location').dialog('open').dialog('setTitle','Nueva Ubicacion');
		$('#f_location').form('clear');
		url_location = '../ajax/action.location.php?option=insert';
	}
	
	function edit_location(){
		var row = $('#dg_location').datagrid('getSelected');
		if (row){
			$('#form_location').dialog('open').dialog('setTitle','Editar Ubicacion');
			$('#f_location').form('load',row);
			url_location = '../ajax/action.location.php?option=update&codelocation='+row.codelocation
		}
	}
	
	function dbl_location(row){
		if (row){
			$('#form_location').dialog('open').dialog('setTitle','Editar Ubicacion');			
			$('#f_location').form('load',row);
			url_location = '../ajax/action.location.php?option=update&codelocation='+row.codelocation
		}
	}
	
	function save_location(){
		$('#f_location').form('submit',{
			url: url_location,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#form_location').dialog('close');		
					$('#dg_location').datagrid('reload');	
				} else {
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
				}
			}
		});
	}
	
	function remove_location(){
		var row = $('#dg_location').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar esta Ubicacion?  '+row.locationurl,function(r){
				if (r){
					$.post('../ajax/action.location.php?option=delete',{codelocation:row.codelocation},function(result){
						if (result.success){
							$('#dg_location').datagrid('reload');	
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
	
	function dosearch_location(value){
		$("#name_location").searchbox('setValue', '');
		$('#dg_location').datagrid('load',{
			namelocation: value,	
		});
	}
	
	function reload_location(){
		//$("#name_location").searchbox('setValue', '');
		$('#dg_location').datagrid('load',{
			namelocation: '',
		});
	}