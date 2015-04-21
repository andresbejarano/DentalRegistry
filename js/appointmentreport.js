$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('#date').datepicker();
	$('input:button').button().click(function(){
		$('input:button').hide();
		$('#loader').show();
		var $formdata = $('form').serialize();
		$('#data').slideUp(1000,function(){
			$.post('modules/checkappointmentreportdata.php',$formdata,function(value){
				if(value == '1'){
					$.post('modules/getappointmentreportdata.php',$formdata,function(data){
						$('#data').html(data).slideDown(1000,function(){
							$('input:button').show();
							$('#loader').hide();
						});
						$('table').tablesorter();
					});
				}
				else{
					$message.html(value);
					$message.dialog({
						title:'<img alt="warning" src="images/warning.png" /> Error en los datos ingresados',
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