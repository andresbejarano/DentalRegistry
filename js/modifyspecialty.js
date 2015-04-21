$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('#searchbutton').button().click(function(){
		var $formdata = $('#searchform').serialize();
		$('#searchloader').show();
		$('#searchbutton').hide();
		$('#modifycontainer').slideUp(1000,function(){
			$.post('modules/checkspecialty.php',$formdata,function(value){
				if(value == '1'){
					$.post('modules/getspecialtydata.php',$formdata,function(data){
						$(':text[name="id"]').val(data.id);
						$(':text[name="name"]').val(data.name);
						$(':text[name="fee"]').val(data.fee);
						$('textarea[name="description"]').val(data.description);
					
					},'json');
					$('#modifycontainer').slideDown(1000,function(){
						$('#searchbutton').show();
						$('#searchloader').hide();
					});
				}
				else{
					$message.html('Los datos ingresados no corresponden a ninguna especialidad');
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
		$('#modifybutton').hide();
		$('#modifyloader').show();
		$.post('modules/checkspecialtydata.php',$formdata,function(value){
			if(value == '1'){
				$.post('modules/modifyspecialty.php',$formdata,function(data){
					if(data == '1'){
						$message.html('Especialidad modificada satisfactoriamente');
						$message.dialog({
							title:'<img alt="success" src="images/success.png" /> Modificaci&oacute;n satisfactoria',
							buttons:{
								'Modificar otra especialidad':function(){window.location = 'modifyspecialty.php';},
								'Menu Principal':function(){window.location = 'menu.php';}
							}
						});
						$message.dialog('open');
					}
					else{
						$message.html(data);
						$message.dialog({
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
					title:'<img alt="warning" src="images/warning.png" /> Error de datos',
					buttons:{'Aceptar':function(){$(this).dialog('close');}}
				});
				$message.dialog('open');
			}
		});
		$('#modifybutton').show();
		$('#modifyloader').hide();
	});
});