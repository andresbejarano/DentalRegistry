$(document).ready(function(){
	$('input:button').button().click(function(){
		$('input:button').hide();
		$('#loader').show();
		$('#patients').slideUp(1000,function(){
			var $formdata = $('form').serialize();
			$.post('modules/getpatientslist.php',$formdata,function(data){
				$('#patients').html(data);
				$('table').tablesorter();
				$('#patients').slideDown(1000,function(){
					$('input:button').show();
					$('#loader').hide();
				});
			});
		});
	});
});