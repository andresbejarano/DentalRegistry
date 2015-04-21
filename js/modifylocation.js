$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});

	$('#searchbutton').button().click(function(){
		var $formdata = $('#searchform').serialize();
		$('#searchbutton').hide();
		$('#searchloader').show();
		$('#modifycontainer').slideUp(1000,function(){
			$.post('modules/checklocation.php',$formdata,function(value){
				if(value == '1'){
					$.post('modules/getlocationdata.php',$formdata,function(data){
						$(':text[name="id"]').val(data.id);
						$(':text[name="code"]').val(data.code);
						$(':text[name="name"]').val(data.name);
						$('textarea[name="description"]').val(data.description);
					},'json');
					$('#modifycontainer').slideDown(1000,function(){
						$('#searchbutton').show();
						$('#searchloader').hide();
					});
				}
				else{
					$message.html('Los datos ingresados no corresponden a ninguna ubicaci&oacute;n oral');
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
		$.post('modules/checklocationdata.php',$formdata,function(value){
			if(value == '1'){
				$.post('modules/modifylocation.php',$formdata,function(data){
					if(data == '1'){
						$message.html('Ubicaci&oacute;n Oral modificado satisfactoriamente');
						$message.dialog({
							title:'<img alt="success" src="images/success.png" /> Modificaci&oacute;n satisfactoria',
							buttons:{
								'Modificar Ubicacion Oral':function(){window.location = 'modifylocation.php';},
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
		$('#modifyloader').hide();
		$('#modifybutton').show();
	});

});