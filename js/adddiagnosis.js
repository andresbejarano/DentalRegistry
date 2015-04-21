$(document).ready(function(){
	$('input:text[name=patient]').attr('readonly','readonly');
	$('input:text[name=user]').attr('readonly','readonly');
	$('input:text[name=username]').attr('readonly','readonly');
	$('input:text[name=date]').attr('readonly','readonly');
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	$('input:button').button().click(function(){
		var $formdata = $('form').serialize();
		alert($formdata);
	});
});