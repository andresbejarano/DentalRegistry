$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('#date').datepicker({changeMonth:true,changeYear:true});
	$('select[name="pregnant"]').change(function(){
		if($('select[name="pregnant"]').val() == 0){
			$('select[name="months"]').attr('disabled','disabled');
		}
		else{
			$('select[name="months"]').removeAttr('disabled');
		}
	});
	
	$('input:button').button().click(function(){
		var $formdata = $('form').serialize();
		$.post('modules/checkdevelopmentdata.php',$formdata,function(data){
			if(data == '1'){
				$.post('modules/adddevelopment.php',$formdata,function(value){
					if(value == '1'){
						$message.html('Nueva evoluci&oacute;n registrada satisfactoriamente');
						$message.dialog({
							title:'<img alt="success" src="images/success.png" /> Registro satisfactorio',
							buttons:{
								'Historia Clinica':function(){window.location = 'medicalrecord.php?id=' + $('#patient').val();},
								'Datos Paciente':function(){window.location = 'patient.php?id=' + $('#patient').val();},
								'Menu Principal':function(){window.location = 'menu.php';}
							}
						});
						$message.dialog('open');
					}
					else{
						$message.html(value);
						$message.dialog({
							title:'<img alt="warning" src="images/warning.png" /> Error en el registro',
							buttons:{'Aceptar':function(){$(this).dialog('close');}}
						});
						$message.dialog('open');
					}
				});
			}
			else{
				$message.html(data);
				$message.dialog({
					title:'<img alt="warning" src="images/warning.png" /> Error en los datos ingresados',
					buttons:{'Aceptar':function(){$(this).dialog('close');}}
				});
				$message.dialog('open');
			}
		});
	});
});