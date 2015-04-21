$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('#birthdate').datepicker({changeMonth:true,changeYear:true});
	$('select[name="dentist"]').change(function(){
		if($('select[name="dentist"]').val() == 0){
			$('select[name="specialty"]').attr('disabled','disabled');
		}
		else{
			$('select[name="specialty"]').removeAttr('disabled');
		}
	});
	$('input:button').button().click(function(){
		var $formdata = $('form').serialize();
		$('input:button').hide();
		$('#loader').show();
		$.post('modules/checkuserdata.php',$formdata,function(value){
			if(value == '1'){
				$.post('modules/adduser.php',$formdata,function(data){
					if(data == '1'){
						$message.html('Nuevo usuario registrado satisfactoriamente');
						$message.dialog({
							title:'<img alt="success" src="images/success.png" /> Registro satisfactorio',
							buttons:{
								'Ingresar otro usuario':function(){window.location = 'adduser.php';},
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