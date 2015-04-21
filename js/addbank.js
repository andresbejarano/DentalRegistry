$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('input:button').button().click(function(){
		var $formdata = $('form').serialize();
		$('input:button').hide();
		$('#loader').show();
		$.post('modules/checkbankdata.php',$formdata,function(value){
			if(value == '1'){
				$.post('modules/addbank.php',$formdata,function(data){
					if(data == '1'){
						$message.html('Nuevo banco registrado satisfactoriamente');
						$message.dialog({
							title:'<img alt="success" src="images/success.png" /> Registro satisfactorio',
							buttons:{
								'Ingresar Banco':function(){window.location = 'addbank.php';},
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
					title:'<img alt="warning" src="images/warning.png" /> Error en los datos ingresados',
					buttons:{'Aceptar':function(){$(this).dialog('close');}}
				});
				$message.dialog('open');
			}
		});
		$('input:button').show();
		$('#loader').hide();
	});
});