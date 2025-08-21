$(function(){
	
	$('#dg_course').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_course(row);
		}
	});
	
	$('#dg_lesson').datagrid({
		striped:true,
		onDblClickRow:function(index, row){
			dbl_lesson(row);
		}
	});
	
	$( "#exit" ).click(function() {
		window.location.href='./../index.php';
	});
	
});
/*************************************************************FORMAT******************************************************/
	function myformatter(date){
		var y = date.getFullYear();
		var m = date.getMonth()+1;
		var d = date.getDate();
		//return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
		return (d<10?('0'+d):d)+'-'+(m<10?('0'+m):m)+'-'+y;
	}
	function myparser(s){
		if (!s) return new Date();
		var ss = (s.split('-'));
		var y = parseInt(ss[0],10);
		var m = parseInt(ss[1],10);
		var d = parseInt(ss[2],10);
		if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
			return new Date(d,m-1,y);
		} else {
			return new Date();
		}
	}
/*************************************************************course**********************************************************/
	var url_course;
	function new_course(){
		$('#form_course').dialog('open').dialog('setTitle','Nuevo Curso');
		$('#f_course').form('clear');
		url_course = '../ajax/action.course.php?option=insert';
	}
	
	function edit_course(){
		var row = $('#dg_course').datagrid('getSelected');
		if (row){
			$('#form_course').dialog('open').dialog('setTitle','Editar Curso');
			$('#f_course').form('load',row);
			var _comboarrayday = row.courseday.split(",");
			$('#courseday').combobox('setValues', _comboarrayday);
			var _comboarrayins = row.courseinstitute.split(",");
			$('#courseinstitute').combobox('setValues', _comboarrayins);
			url_course = '../ajax/action.course.php?option=update&codecourse='+row.codecourse		
		}
	}
	
	function dbl_course(row){
		if (row){
			$('#form_course').dialog('open').dialog('setTitle','Editar Curso');			
			$('#f_course').form('load',row);
			var _comboarrayday = row.courseday.split(",");
			$('#courseday').combobox('setValues', _comboarrayday);
			var _comboarrayins = row.courseinstitute.split(",");
			$('#courseinstitute').combobox('setValues', _comboarrayins);
			url_course = '../ajax/action.course.php?option=update&codecourse='+row.codecourse
		}
	}
	
	function save_course(){
		$('#f_course').form('submit',{
			url: url_course,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_course').dialog('close');		
						$('#dg_course').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_course(){
		var row = $('#dg_course').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar este curso?  '+row.coursename,function(r){
				if (r){
					$.post('../ajax/action.course.php?option=delete',{codecourse:row.codecourse},function(result){
						if (result.success){
							$('#dg_course').datagrid('reload');	
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
	
	function dosearch_course(value){
		$("#name_course").searchbox('setValue', '');
		$('#dg_course').datagrid('load',{
			namecourse: value,	
		});
	}
	
	function reload_course(){
		//$("#name_course").searchbox('setValue', '');
		$('#dg_course').datagrid('load',{
			namecourse: '',
		});
	}
/*****************************************************LESSON*********************************************************/
	var url_lesson;
	
	function show_lesson(){
		var row = $('#dg_course').datagrid('getSelected');
		if (row){
			$('#form_showlesson').dialog('open').dialog('setTitle','GESTION CLASES');
			$('#dg_lesson').datagrid({
				url: './../ajax/action.admin.php?option=lesson&codecourse='+row.codecourse
			});
		}else{
			$.messager.show({
				title: 'Info',
				msg: 'Seleccione un curso'
			});
		}
	}
	
	function new_lesson(){
		var row = $('#dg_course').datagrid('getSelected');
		if (row){
			$('#form_lesson').dialog('open').dialog('setTitle','Nueva Clase');
			$('#f_lesson').form('clear');
			url_lesson = '../ajax/action.lesson.php?option=insert&codecourse='+row.codecourse;
		}else{
			$.messager.show({
				title: 'Info',
				msg: 'No se selecciono un curso'
			});
		}
	}
	
	function edit_lesson(){
		var row = $('#dg_lesson').datagrid('getSelected');
		if (row){
			$('#form_lesson').dialog('open').dialog('setTitle','Editar Clase');
			$('#f_lesson').form('load',row);
			url_lesson = '../ajax/action.lesson.php?option=update&codelesson='+row.codelesson		
		}
	}
	
	function dbl_lesson(row){
		if (row){
			$('#form_lesson').dialog('open').dialog('setTitle','Editar Clase');			
			$('#f_lesson').form('load',row);
			url_lesson = '../ajax/action.lesson.php?option=update&codelesson='+row.codelesson
		}
	}
	
	function save_lesson(){
		$('#f_lesson').form('submit',{
			url: url_lesson,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_lesson').dialog('close');		
						$('#dg_lesson').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
	function remove_lesson(){
		var row = $('#dg_lesson').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirmacion','Esta seguro de eliminar esta clase ?  '+row.lessonname,function(r){
				if (r){
					$.post('../ajax/action.lesson.php?option=delete',{codelesson:row.codelesson},function(result){
						if (result.success){
							$('#dg_lesson').datagrid('reload');	
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
	
	function dosearch_lesson(value){
		$("#name_lesson").searchbox('setValue', '');
		$('#dg_lesson').datagrid('load',{
			namelesson: value,	
		});
	}
	
	function reload_lesson(){
		//$("#name_lesson").searchbox('setValue', '');
		$('#dg_lesson').datagrid('load',{
			namelesson: '',
		});
	}
/*****************************************************URL*********************************************************/
	var url_url;
	function url_course(){
		var row = $('#dg_course').datagrid('getSelected');
		if (row){
			$('#form_url').dialog('open').dialog('setTitle','Url Del Curso');
			$('#f_url').form('load',row);
			url_url = '../ajax/action.course.php?option=url&codecourse='+row.codecourse		
		}
	}
	
	function save_url(){
		$('#f_url').form('submit',{
			url: url_url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
						$('#form_url').dialog('close');		
						$('#dg_course').datagrid('reload');	
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
			}
		});
	}
	
/*****************************************************************************************************************/