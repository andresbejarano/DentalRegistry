$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('input:button').button().click(function(){
		var $formdata = $('#searchform').serialize();
		$('input:button').hide();
		$('#loader').show();
		$('#modifycontainer').slideUp(1000,function(){
			$.post('modules/checkprocedure.php',$formdata,function(value){
				if(value == '1'){
					$.post('modules/getproceduredata.php',$formdata,function(data){
						$('select[name="proceduretype"]').removeAttr('disabled');
						$(':text[name="id"]').val(data.id);
						$(':text[name="code"]').val(data.code);
						$(':text[name="name"]').val(data.name);
						$(':text[name="price"]').val(data.price);
						$('select[name="proceduretype"]').val(data.proceduretype);
						$('textarea[name="description"]').val(data.description);
						$('select[name="proceduretype"]').attr('disabled','disabled');
					},'json');
					$('#modifycontainer').slideDown(1000,function(){
						$('input:button').show();
						$('#loader').hide();
					});
				}
				else{
					$message.html('Los datos ingresados no corresponden a ning&uacute;n procedimiento');
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