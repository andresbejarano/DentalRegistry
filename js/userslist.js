$(document).ready(function(){
	$('input:button').button().click(function(){
		$('input:button').hide();
		$('#loader').show();
		$('#users').slideUp(1000,function(){
			var $formdata = $('form').serialize();
			$.post('modules/getuserslist.php',$formdata,function(data){
				$('#users').html(data);
				$('table').tablesorter();
				$('#users').slideDown(1000,function(){
					$('input:button').show();
					$('#loader').hide();
				});
			});
		});
	});
});