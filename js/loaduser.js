$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('input:button').button().click(function(){
		var $formdata = $('form').serialize();
		$('input:button').hide();
		$('#loader').show();
		$.post('modules/checkuser.php',$formdata,function(value){
			if(value == '-1'){
				$message.html('Los datos ingresados no corresponden a ning&uacute;n usuario');
				$message.dialog({
					title:'<img alt="warning" src="images/warning.png" /> Registro inv&aacute;lido',
					buttons:{'Aceptar':function(){$(this).dialog('close');}}
				});
				$message.dialog('open');
			}
			else{
				$.post('modules/getuserdata.php',$formdata,function(data){
					window.location = 'user.php?id=' + data.id;
				},'json');
			}
			$('input:button').show();
			$('#loader').hide();
		});
	});
});