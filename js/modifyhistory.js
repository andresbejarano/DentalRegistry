$(document).ready(function(){
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	var $id = 'id=' + $('#id').val();
	$.post('modules/gethistory.php',$id,function(data){
		
		//Informacion inicial
		$('input:text[name="id"]').val(data.id);
		$('input:text[name="user"]').val(data.user);
		$('input:text[name="date"]').val(data.date);
		$('input:text[name="username"]').val(data.username);
		
		//Antecedentes
		$('select[name="history1"]').val(data.history.charAt(0));
		$('select[name="history2"]').val(data.history.charAt(1));
		$('select[name="history3"]').val(data.history.charAt(2));
		$('select[name="history4"]').val(data.history.charAt(3));
		$('select[name="history5"]').val(data.history.charAt(4));
		$('select[name="history6"]').val(data.history.charAt(5));
		$('select[name="history7"]').val(data.history.charAt(6));
		$('select[name="history8"]').val(data.history.charAt(7));
		$('select[name="history9"]').val(data.history.charAt(8));
		$('select[name="history10"]').val(data.history.charAt(9));
		$('select[name="history11"]').val(data.history.charAt(10));
		$('select[name="history12"]').val(data.history.charAt(11));
		$('select[name="history13"]').val(data.history.charAt(12));
		$('select[name="history14"]').val(data.history.charAt(13));
		$('select[name="history15"]').val(data.history.charAt(14));
		$('select[name="history16"]').val(data.history.charAt(15));
		$('select[name="history17"]').val(data.history.charAt(16));
		$('select[name="history18"]').val(data.history.charAt(17));
		$('select[name="history19"]').val(data.history.charAt(18));
		$('input:text[name="historydesc1"]').val(data.historydesc1);
		$('input:text[name="historydesc2"]').val(data.historydesc2);
		$('input:text[name="historydesc3"]').val(data.historydesc3);
		$('input:text[name="historydesc4"]').val(data.historydesc4);
		$('input:text[name="historydesc5"]').val(data.historydesc5);
		$('input:text[name="historydesc6"]').val(data.historydesc6);
		$('input:text[name="historydesc7"]').val(data.historydesc7);
		$('input:text[name="historydesc8"]').val(data.historydesc8);
		$('input:text[name="historydesc9"]').val(data.historydesc9);
		$('input:text[name="historydesc10"]').val(data.historydesc10);
		$('input:text[name="historydesc11"]').val(data.historydesc11);
		$('input:text[name="historydesc12"]').val(data.historydesc12);
		$('input:text[name="historydesc13"]').val(data.historydesc13);
		$('input:text[name="historydesc14"]').val(data.historydesc14);
		$('input:text[name="historydesc15"]').val(data.historydesc15);
		$('input:text[name="historydesc16"]').val(data.historydesc16);
		$('input:text[name="historydesc17"]').val(data.historydesc17);
		$('input:text[name="historydesc18"]').val(data.historydesc18);
		$('input:text[name="historydesc19"]').val(data.historydesc19);
		
		//Examenes
		$('select[name="test1"]').val(data.test.charAt(0));
		$('select[name="test2"]').val(data.test.charAt(1));
		$('select[name="test3"]').val(data.test.charAt(2));
		$('select[name="test4"]').val(data.test.charAt(3));
		$('select[name="test5"]').val(data.test.charAt(4));
		$('select[name="test6"]').val(data.test.charAt(5));
		$('select[name="test7"]').val(data.test.charAt(6));
		$('select[name="test8"]').val(data.test.charAt(7));
		$('select[name="test9"]').val(data.test.charAt(8));
		$('select[name="test10"]').val(data.test.charAt(9));
		$('select[name="test11"]').val(data.test.charAt(10));
		$('select[name="test12"]').val(data.test.charAt(11));
		$('select[name="test13"]').val(data.test.charAt(12));
		$('select[name="test14"]').val(data.test.charAt(13));
		$('select[name="test15"]').val(data.test.charAt(14));
		$('select[name="test16"]').val(data.test.charAt(15));
		$('select[name="test17"]').val(data.test.charAt(16));
		$('select[name="test18"]').val(data.test.charAt(17));
		$('select[name="test19"]').val(data.test.charAt(18));
		$('select[name="test20"]').val(data.test.charAt(19));
		$('select[name="test21"]').val(data.test.charAt(20));
		$('input:text[name="testdesc1"]').val(data.testdesc1);
		$('input:text[name="testdesc2"]').val(data.testdesc2);
		$('input:text[name="testdesc3"]').val(data.testdesc3);
		$('input:text[name="testdesc4"]').val(data.testdesc4);
		$('input:text[name="testdesc5"]').val(data.testdesc5);
		$('input:text[name="testdesc6"]').val(data.testdesc6);
		$('input:text[name="testdesc7"]').val(data.testdesc7);
		$('input:text[name="testdesc8"]').val(data.testdesc8);
		$('input:text[name="testdesc9"]').val(data.testdesc9);
		$('input:text[name="testdesc10"]').val(data.testdesc10);
		$('input:text[name="testdesc11"]').val(data.testdesc11);
		$('input:text[name="testdesc12"]').val(data.testdesc12);
		$('input:text[name="testdesc13"]').val(data.testdesc13);
		$('input:text[name="testdesc14"]').val(data.testdesc14);
		$('input:text[name="testdesc15"]').val(data.testdesc15);
		$('input:text[name="testdesc16"]').val(data.testdesc16);
		$('input:text[name="testdesc17"]').val(data.testdesc17);
		$('input:text[name="testdesc18"]').val(data.testdesc18);
		$('input:text[name="testdesc19"]').val(data.testdesc19);
		$('input:text[name="testdesc20"]').val(data.testdesc20);
		$('input:text[name="testdesc21"]').val(data.testdesc21);
		
		//Motivo de la consulta
		$('select[name="plaque"]').val(data.plaque);
		$('input:text[name="lastvisit"]').val(data.lastvisit);
		$('select[name="origin"]').val(data.origin);
		$('textarea[name="originhistory"]').val(data.originhistory);
		$('textarea[name="background"]').val(data.background);
		
	},'json');
	
	$('input:button').button().click(function(){
		var $formdata = $('form').serialize();
		$('input:button').hide();
		$('#loader').show();
		$.post('modules/checkhistorydata.php',$formdata,function(value){
			if(value == '1'){
				$.post('modules/modifyhistory.php',$formdata,function(data){
					$message.html('Historia clinica modificada satisfactoriamente');
					$message.dialog({
						title:'<img alt="success" src="images/success.png" /> Registro satisfactorio',
						buttons:{
							'Volver a la historia clinica':function(){window.location = 'medicalrecord.php?id=' + $('#patient').val();},
							'Menu Principal':function(){window.location = 'menu.php';}
						}
					});
					$message.dialog('open');
				});
			}
			else{
				$message.html(data);
				$message.dialog({
					title:'<img alt="warning" src="images/warning.png" /> Error en el registro',
					buttons:{'Aceptar':function(){$(this).dialog('close');}}
				});
				$message.dialog('open');
			}
			$('input:button').show();
			$('#loader').hide();
		});
	});
	
});