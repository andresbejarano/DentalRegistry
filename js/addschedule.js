$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('#dateinit').datepicker();
	
	$('select[name="monday"]').change(function(){
		if($('select[name="monday"]').val() == 0){
			$('select[name="mondayinit"]').attr('disabled','disabled');
			$('select[name="mondayend"]').attr('disabled','disabled');
		}
		else{
			$('select[name="mondayinit"]').removeAttr('disabled');
			$('select[name="mondayend"]').removeAttr('disabled');
		}
	});
	
	$('select[name="tuesday"]').change(function(){
		if($('select[name="tuesday"]').val() == 0){
			$('select[name="tuesdayinit"]').attr('disabled','disabled');
			$('select[name="tuesdayend"]').attr('disabled','disabled');
		}
		else{
			$('select[name="tuesdayinit"]').removeAttr('disabled');
			$('select[name="tuesdayend"]').removeAttr('disabled');
		}
	});
	
	$('select[name="wednesday"]').change(function(){
		if($('select[name="wednesday"]').val() == 0){
			$('select[name="wednesdayinit"]').attr('disabled','disabled');
			$('select[name="wednesdayend"]').attr('disabled','disabled');
		}
		else{
			$('select[name="wednesdayinit"]').removeAttr('disabled');
			$('select[name="wednesdayend"]').removeAttr('disabled');
		}
	});
	
	$('select[name="thursday"]').change(function(){
		if($('select[name="thursday"]').val() == 0){
			$('select[name="thursdayinit"]').attr('disabled','disabled');
			$('select[name="thursdayend"]').attr('disabled','disabled');
		}
		else{
			$('select[name="thursdayinit"]').removeAttr('disabled');
			$('select[name="thursdayend"]').removeAttr('disabled');
		}
	});
	
	$('select[name="friday"]').change(function(){
		if($('select[name="friday"]').val() == 0){
			$('select[name="fridayinit"]').attr('disabled','disabled');
			$('select[name="fridayend"]').attr('disabled','disabled');
		}
		else{
			$('select[name="fridayinit"]').removeAttr('disabled');
			$('select[name="fridayend"]').removeAttr('disabled');
		}
	});
	
	$('select[name="saturday"]').change(function(){
		if($('select[name="saturday"]').val() == 0){
			$('select[name="saturdayinit"]').attr('disabled','disabled');
			$('select[name="saturdayend"]').attr('disabled','disabled');
		}
		else{
			$('select[name="saturdayinit"]').removeAttr('disabled');
			$('select[name="saturdayend"]').removeAttr('disabled');
		}
	});
	
	$('select[name="sunday"]').change(function(){
		if($('select[name="sunday"]').val() == 0){
			$('select[name="sundayinit"]').attr('disabled','disabled');
			$('select[name="sundayend"]').attr('disabled','disabled');
		}
		else{
			$('select[name="sundayinit"]').removeAttr('disabled');
			$('select[name="sundayend"]').removeAttr('disabled');
		}
	});
	
	$('input:button').button().click(function(){
		$('#loader').show();
		$('input:button').hide();
		var $formdata = $('form').serialize();
		$.post('modules/checkscheduledata.php',$formdata,function(value){
			if(value == '1'){
				$.post('modules/addschedule.php',$formdata,function(data){
					if(data == '1'){
						$message.html('Nuevo horario registrado satisfactoriamente');
						$message.dialog({
							title:'<img alt="success" src="images/success.png" /> Registro satisfactorio',
							buttons:{
								'Volver al Usuario':function(){window.location = 'user.php?id=' + $('#dentist').val();},
								'Menu Principal':function(){window.location = 'menu.php';}
							}
						});
					}
					else{
						$message.html(data);
						$message.dialog({
							title:'<img alt="warning" src="images/warning.png" /> Error en el registro',
							buttons:{'Aceptar':function(){$(this).dialog('close');}}
						});
					}
					$message.dialog('open');
				});
			}
			else{
				$message.html(value);
				$message.dialog({
					title:'<img alt="warning" src="images/warning.png" /> Error de datos',
					buttons:{'Aceptar':function(){$(this).dialog('close');}}
				});
				$message.dialog('open');
			}
			$('#loader').hide();
			$('input:button').show();
		});
	});
});