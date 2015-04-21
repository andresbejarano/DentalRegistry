$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('#birthdate').datepicker({changeMonth:true,changeYear:true});
	
	$('input:button').button().click(function(){
		var $formdata = $('form').serialize();
		$('#loader').show();
		$('input:button').hide();
		$.post('modules/checkpatientdata.php',$formdata,function(value){
			if(value == '1'){
				$.post('modules/modifypatient.php',$formdata,function(data){
					if(data == '1'){
						$message.html('Paciente modificado satisfactoriamente');
						$message.dialog({
							title:'<img alt="success" src="images/success.png" /> Modificaci&oacute;n satisfactoria',
							buttons:{
								'Volver al Paciente':function(){window.location = 'patient.php?id=' + $('#id').val();},
								'Menu Principal':function(){window.location = 'menu.php';}
							}
						});
					}
					else{
						$message.html(data);
						$message.dialog({
							title:'<img alt="warning" src="images/warning.png" /> Error de modificaci&oacute;n',
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
		});
		$('#loader').hide();
		$('input:button').show();
	});
});