$(function(){
	
	$('#dg_paid').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			edit_paid(row);
		}
	});
	
	$( "#exit" ).click(function() {
		window.location.href='./../index.php';
	});
	
});
/*************************************************************USER********************************************************************/
	var url;
	function new_paid(){
		$('#form_paid').dialog('open').dialog('setTitle','Nuevo Pago');
		$('#f_paid').form('clear');
		url = '../ajax/action.paid.php?option=insert';
	}
	
	function edit_paid(){
		var row = $('#dg_paid').datagrid('getSelected');
		if (row){
			$('#form_paid').dialog('open').dialog('setTitle','Editar Pagos');
			$('#f_paid').form('load',row);
			url = '../ajax/action.paid.php?option=update&codedetail='+row.codedetail		
		}
	}
	
	function edit_paid(row){
		if (row){
			$('#form_paid').dialog('open').dialog('setTitle','Editar Pagos');			
			$('#f_paid').form('load',row);
			url = '../ajax/action.paid.php?option=update&codedetail='+row.codedetail
		}
	}
	
	function save_paid(){
		$('#f_paid').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_paid').dialog('close');		
						$('#dg_paid').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_paid(){
		var row = $('#dg_paid').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar este Pago?  '+row.personname,function(r){
				if (r){
					$.post('../ajax/action.paid.php?option=delete',{codedetail:row.codedetail},function(result){
						if (result.success){
							$('#dg_paid').datagrid('reload');	
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
	
	function pay(){
		var row = $('#dg_paid').datagrid('getSelected');
		if (row){
			if(row.detailstate == 'PAGADO'){
				$.messager.show({	
					title: 'Info',
					msg: 'El curso esta pagado'
				});
			}else{
				if(row.detailstate == 'EN PROCESO'){
					$.messager.show({	
						title: 'Info',
						msg: 'El cliente no realizo el pago'
					});
				}else{
					if(row.detailstate == 'ANULADO'){
						$.messager.show({	
							title: 'Info',
							msg: 'El detalle compra esta anulado'
						});
					}else{
						$.messager.confirm('Confirmacion','Esta seguro de que el pago de '+row.detailname+' fue recibido y validado con exito? ',function(r){
							if (r){
								$.post('../ajax/action.paid.php?option=pay',{codedetail:row.codedetail},function(result){
									if (result.success){
										$('#dg_paid').datagrid('reload');	
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
			}
		}else{
			$.messager.show({	
				title: 'Info',
				msg: 'Seleccione para realizar el Pago'
			});
		}
	}
	
	function cancel(){
		var row = $('#dg_paid').datagrid('getSelected');
		if (row){
			if(row.detailstate == 'PAGADO'){
				$.messager.show({	
					title: 'Info',
					msg: 'No se puede anular, El curso esta pagado'
				});
			}else{
				$.messager.confirm('Confirmacion','Esta seguro de anular ? ',function(r){
					if (r){
						$.post('../ajax/action.paid.php?option=cancel',{codedetail:row.codedetail},function(result){
							if (result.success){
								$('#dg_paid').datagrid('reload');	
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
		}else{
			$.messager.show({	
				title: 'Info',
				msg: 'Seleccione para anular'
			});
		}
	}
	
	function dosearch_paid(value){
		$("#name_paid").searchbox('setValue', '');
		$('#dg_paid').datagrid('load',{
			namepaid: value,	
		});
	}
	
	function reload_paid(){
		//$("#name_paid").searchbox('setValue', '');
		$('#dg_paid').datagrid('load',{
			namepaid: '',
		});
	}
/*************************************************************************************************************************************/	
