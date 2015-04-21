$(document).ready(function(){
	$('input:text').attr('readonly','readonly');
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('input:button').button().click(function(){
		var $formdata = $('form').serialize();
		$('input:button').hide();
		$('#loader').show();
		$.post('modules/activatebudget.php',$formdata,function(value){
			if(value == '1'){
				$message.html('Presupuesto activado satisfactoriamente');
				$message.dialog({
					title:'<img alt="success" src="images/success.png" /> Registro satisfactorio',
					buttons:{
						'Volver al Paciente':function(){window.location = 'patient.php?id=' + $('#patient').val();},
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
			$('input:button').show();
			$('#loader').hide();
		});
	});
});