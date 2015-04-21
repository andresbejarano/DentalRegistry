$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('input:button').button().click(function(){
		var $formdata = $('#searchform').serialize();
		$('input:button').hide();
		$('#loader').show();	
		$('#modifyform').slideUp(1000,function(){
			$.post('modules/checkspecialty.php',$formdata,function(value){
				if(value == '1'){
					$.post('modules/getspecialtydata.php',$formdata,function(data){
						$(':text[name="id"]').val(data.id);
						$(':text[name="name"]').val(data.name);
						$(':text[name="fee"]').val(data.fee);
						$('textarea[name="description"]').val(data.description);
					},'json');
					$('#modifyform').slideDown(1000,function(){
						$('input:button').show();
						$('#loader').hide();
					});
				}
				else{
					$message.html('Los datos ingresados no corresponden a ninguna especialidad');
					$message.dialog({
						title:'<img alt="warning" src="images/warning.png" /> Registro inv&aacute;lido',
						buttons:{'Aceptar':function(){$(this).dialog('close');}}
					});
					$message.dialog('open');
					$('input:button').show();
					$('#loader').hide();
				}
			});
		});
	});
});