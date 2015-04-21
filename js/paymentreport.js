$(document).ready(function(){
	$('#dateinit,#dateend').datepicker();
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});

	$('input:button').button().click(function(){
		$('input:button').hide();
		$('#loader').show();
		var $formdata = $('form').serialize();
		$('div#data').slideUp(1000,function(){
			$.post('modules/checkpaymentreportdata.php',$formdata,function(value){
				if(value == '1'){
					$.post('modules/getpaymentreport.php',$formdata,function(data){
						$('div#data').html(data).slideDown(1000,function(){
							$('table').tablesorter();
							$('input:button').show();
							$('#loader').hide();
						});
					});
				}
				else{
					$message.html(data);
					$message.dialog({
						title:'<img alt="warning" src="images/warning.png" /> Error en el registro',
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