$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('#searchbutton').button().click(function(){
		var $formdata = $('#searchform').serialize();
		$('#searchbutton').hide();
		$('#searchloader').show();
		$('#modifycontainer').slideUp(1000,function(){
			$.post('modules/checkpaymenttype.php',$formdata,function(value){
				if(value == '1'){
					$.post('modules/getpaymenttypedata.php',$formdata,function(data){
						$(':text[name="id"]').val(data.id);
						$(':text[name="name"]').val(data.name);
						$('textarea[name="description"]').val(data.description);
					},'json');
					$('#modifycontainer').slideDown(1000,function(){
						$('#searchbutton').show();
						$('#searchloader').hide();
					});
				}
				else{
					$message.html('Los datos ingresados no corresponden a ninguna forma de pago');
					$message.dialog({
						title:'<img alt="warning" src="images/warning.png" /> Registro inv&aacute;lido',
						buttons:{'Aceptar':function(){$(this).dialog('close');}}
					});
					$message.dialog('open');
					$('#searchbutton').show();
					$('#searchloader').hide();
				}
			});
		});
	});
	$('#modifybutton').button().click(function(){
		var $formdata = $('#modifyform').serialize();
		$('#modifyloader').show();
		$('#modifybutton').hide();
		$.post('modules/checkpaymenttypedata.php',$formdata,function(value){
			if(value == '1'){
				$.post('modules/modifypaymenttype.php',$formdata,function(data){
					if(data == '1'){
						$message.html('<p>Forma de pago modificada satisfactoriamente</p>');
						$message.dialog({
							autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600,
							title:'<img alt="success" src="images/success.png" /> Modificaci&oacute;n satisfactoria',
							buttons:{
								'Modificar Forma de Pago':function(){window.location = 'modifypaymenttype.php';},
								'Menu Principal':function(){window.location = 'menu.php';}
							}
						});
						$message.dialog('open');
					}
					else{
						$message.html('<p>Error en la modificaci&oacute;n de la forma de pago</p>');
						$message.dialog({
							autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600,
							title:'<img alt="warning" src="images/warning.png" /> Error de modificaci&oacute;n',
							buttons:{'Aceptar':function(){$(this).dialog('close');}}
						});
						$message.dialog('open');
					}
				});
			}
			else{
				$message.html(value);
				$message.dialog({
					autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600,
					title:'<img alt="warning" src="images/warning.png" /> Error de datos',
					buttons:{'Aceptar':function(){$(this).dialog('close');}}
				});
				$message.dialog('open');
			}
		});
		$('#modifyloader').hide();
		$('#modifybutton').show();
	});
});