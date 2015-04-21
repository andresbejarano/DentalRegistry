$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('#searchbutton').button().click(function(){
		var $searchdata = $('#searchform').serialize();
		$('#searchloader').show();
		$('#searchbutton').hide();
		$('#modifycontainer').slideUp(1000,function(){
			$.post('modules/checksubprocedure.php',$searchdata,function(value){
				if(value == '1'){
					$.post('modules/getsubproceduredata.php',$searchdata,function(data){
						$('select[name="procedure"]').removeAttr('disabled');
						$(':text[name="id"]').val(data.id);
						$(':text[name="code"]').val(data.code);
						$(':text[name="name"]').val(data.name);
						$(':text[name="price"]').val(data.price);
						$('select[name="procedure"]').val(data.procedure);
						$('textarea[name="description"]').val(data.description);
						$('select[name="procedure"]').attr('disabled','disabled');
					},'json');
					$('#modifycontainer').slideDown(1000);
				}
				else{
					$message.html('Los datos ingresados no corresponden a ning&uacute;n subprocedimiento');
					$message.dialog({
						title:'<img alt="warning" src="images/warning.png" /> Registro inv&aacute;lido',
						buttons:{'Aceptar':function(){$(this).dialog('close');}}
					});
					$message.dialog('open');
				}
				$('#searchloader').hide();
				$('#searchbutton').show();
			});
		});
	});
});