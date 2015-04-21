$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('#date').datepicker();
	$('input:button').button().click(function(){
		var $formdata = $('form').serialize();
		$.post('modules/checkhistorydata.php',$formdata,function(value){
			if(value == '1'){
				
				//
				$.post('modules/addhistory.php',$formdata,function(data){
					if(data == '1'){
						$message.html('Historia clinica ingresada satisfactoriamente');
						$message.dialog({
							title:'<img alt="success" src="images/success.png" /> Registro satisfactorio',
							buttons:{
								'Volver a la historia clinica':function(){window.location = 'medicalrecord.php?id=' + $('#patient').val();},
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
				//
				
				
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
	});
});