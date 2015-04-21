$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('input:button').button().click(function(){
		var $formdata = $('form').serialize();
		$('input:button').hide();
		$('#loader').show();
		$.post('modules/checkuserlogin.php',$formdata,function(data){
			switch(data){
			
				case '-1':
				$message.html('Usuario y/o Contrase&ntilde;a no v&aacute;lidos');
				$message.dialog({
					title:'<img alt="warning" src="images/warning.png" /> Registro inv&aacute;lido',
					buttons:{'Aceptar':function(){$(this).dialog('close');}}
				});
				$message.dialog('open');
				break;
				
				case '0':
				$message.html('El usuario no se encuentra activo<br />Consulte a gerencia para el proceso de activaci&oacute;n');
				$message.dialog({
					title:'<img alt="warning" src="images/warning.png" /> Usuario no activo',
					buttons:{'Aceptar':function(){$(this).dialog('close');}}
				});
				$message.dialog('open');
				break;

				case '1':
				$.post('modules/startsession.php',$formdata,function(){location.href = 'menu.php';});
				break;
			}
			$('input:button').show();
			$('#loader').hide();
		});
	});
});