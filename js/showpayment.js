$(document).ready(function(){
	$('input:button').button().click(function(){
		$('input:button').hide();
		window.print();
	});
});