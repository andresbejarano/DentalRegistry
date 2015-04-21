$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('input:button').button().click(function(){
		var $formdata = $('form').serialize();
		$('#loader').show();
		$('input:button').hide();
		$.post('modules/modifyuserstate.php',$formdata,function(value){
			if(value == '1'){
				$message.html('Usuario modificado satisfactoriamente');
				$message.dialog({
					title:'<img alt="success" src="images/success.png" /> Modificaci&oacute;n satisfactoria',
					buttons:{
						'Volver al Usuario':function(){window.location = 'user.php?id=' + $('#id').val();},
						'Menu Principal':function(){window.location = 'menu.php';}
					}
				});
			}
			else{
				$message.html(value);
				$message.dialog({
					title:'<img alt="warning" src="images/warning.png" /> Error de datos',
					buttons:{'Aceptar':function(){$(this).dialog('close');}}
				});
			}
			$message.dialog('open');
		});
		$('#loader').hide();
		$('input:button').show();
	});
});