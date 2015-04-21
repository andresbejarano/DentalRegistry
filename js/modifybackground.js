$(document).ready(function(){
	var $patient = 'patient=' + $('#patient').val();
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	
	$.post('modules/getbackground.php',$patient,function(data){
		//Informacion inicial
		$('input:text[name="id"]').val(data.id);
		$('input:text[name="user"]').val(data.user);
		$('input:text[name="date"]').val(data.date);
		$('input:text[name="username"]').val(data.username);
		//Antecedentes familiares
		$('select[name="familiar1"]').val(data.familiar.charAt(0));
		$('select[name="familiar2"]').val(data.familiar.charAt(1));
		$('select[name="familiar3"]').val(data.familiar.charAt(2));
		$('select[name="familiar4"]').val(data.familiar.charAt(3));
		$('select[name="familiar5"]').val(data.familiar.charAt(4));
		$('select[name="familiar6"]').val(data.familiar.charAt(5));
		$('textarea[name="familiardescription"]').val(data.familiardescription);
		//Antecedentes patologicos
		$('select[name="pathological1"]').val(data.pathological.charAt(0));
		$('select[name="pathological2"]').val(data.pathological.charAt(1));
		$('select[name="pathological3"]').val(data.pathological.charAt(2));
		$('select[name="pathological4"]').val(data.pathological.charAt(3));
		$('select[name="pathological5"]').val(data.pathological.charAt(4));
		$('select[name="pathological6"]').val(data.pathological.charAt(5));
		$('select[name="pathological7"]').val(data.pathological.charAt(6));
		$('select[name="pathological8"]').val(data.pathological.charAt(7));
		$('select[name="pathological9"]').val(data.pathological.charAt(8));
		$('select[name="pathological10"]').val(data.pathological.charAt(9));
		$('select[name="pathological11"]').val(data.pathological.charAt(10));
		$('select[name="pathological12"]').val(data.pathological.charAt(11));
		$('select[name="pathological13"]').val(data.pathological.charAt(12));
		$('select[name="pathological14"]').val(data.pathological.charAt(13));
		$('select[name="pathological15"]').val(data.pathological.charAt(14));
		$('select[name="pathological16"]').val(data.pathological.charAt(15));
		$('textarea[name="allergies"]').val(data.allergies);
		$('textarea[name="pathologicaldescription"]').val(data.pathologicaldescription);
		//Antecedentes toxicologicos
		$('select[name="toxicological1"]').val(data.toxicological.charAt(0));
		$('select[name="toxicological2"]').val(data.toxicological.charAt(1));
		$('select[name="toxicological3"]').val(data.toxicological.charAt(2));
		$('select[name="toxicological4"]').val(data.toxicological.charAt(3));
		$('select[name="toxicological5"]').val(data.toxicological.charAt(4));
		$('select[name="toxicological6"]').val(data.toxicological.charAt(5));
		$('textarea[name="currentmedication"]').val(data.currentmedication);
		$('textarea[name="allergicmedication"]').val(data.allergicmedication);
		$('textarea[name="toxicologicaldescription"]').val(data.toxicologicaldescription);
		//Antecedentes ginecobstetricos
		$('select[name="gynecoobstetrical1"]').val(data.gynecoobstetrical.charAt(0));
		$('select[name="gynecoobstetrical2"]').val(data.gynecoobstetrical.charAt(1));
		$('select[name="gynecoobstetrical3"]').val(data.gynecoobstetrical.charAt(2));
		$('select[name="gynecoobstetrical4"]').val(data.gynecoobstetrical.charAt(3));
		$('select[name="months"]').val(data.months);
		$('textarea[name="gynecoobstetricaldescription"]').val(data.gynecoobstetricaldescription);
		//Antecedentes hospitalarios
		$('select[name="hospital1"]').val(data.hospital.charAt(0));
		$('select[name="hospital2"]').val(data.hospital.charAt(1));
		$('textarea[name="hospitaldescription"]').val(data.hospitaldescription);
		//Antecedentes estomatologicos
		$('select[name="stomatological1"]').val(data.stomatological.charAt(0));
		$('select[name="stomatological2"]').val(data.stomatological.charAt(1));
		$('select[name="stomatological3"]').val(data.stomatological.charAt(2));
		$('select[name="stomatological4"]').val(data.stomatological.charAt(3));
		$('select[name="stomatological5"]').val(data.stomatological.charAt(4));
		$('select[name="stomatological6"]').val(data.stomatological.charAt(5));
		$('textarea[name="stomatologicaldescription"]').val(data.stomatologicaldescription);
		//Antecedentes odontologicos
		$('select[name="odontological1"]').val(data.odontological.charAt(0));
		$('select[name="odontological2"]').val(data.odontological.charAt(1));
		$('select[name="odontological3"]').val(data.odontological.charAt(2));
		$('select[name="odontological4"]').val(data.odontological.charAt(3));
		$('select[name="odontological5"]').val(data.odontological.charAt(4));
		$('select[name="odontological6"]').val(data.odontological.charAt(5));
		$('select[name="odontological7"]').val(data.odontological.charAt(6));
		$('textarea[name="odontologicaldescription"]').val(data.odontologicaldescription);
		//Motivo de la consulta
		$('input:text[name="lastvisit"]').val(data.lastvisit);
		$('select[name="origin"]').val(data.origin);
		$('textarea[name="originhistory"]').val(data.originhistory);
		$('textarea[name="background"]').val(data.background);
		//Solo lectura
		$('input:text[name="id"]').attr('readonly','readonly');
		$('input:text[name="patient"]').attr('readonly','readonly');
		$('input:text[name="user"]').attr('readonly','readonly');
		$('input:text[name="username"]').attr('readonly','readonly');
		$('input:text[name="date"]').attr('readonly','readonly');
	},'json');
	
	$('input:button').button().click(function(){
		var $formdata = $('form').serialize();
		$.post('modules/checkbackgrounddata.php',$formdata,function(data){
			if(data == '1'){
				$.post('modules/modifybackground.php',$formdata,function(value){
					if(value == '1'){
						$message.html('<p>Antecedentes modificados satisfactoriamente</p>');
						$message.dialog({
							title:'<img alt="success" src="images/success.png" /> Registro satisfactorio',
							buttons:{
								'Volver a la historia clinica':function(){window.location = 'medicalrecord.php?id=' + $('#patient').val();},
								'Menu Principal':function(){window.location = 'menu.php';}
							}
						});
						$message.dialog('open');
					}
					else{
						$message.html(value);
						$message.dialog({
							title:'<img alt="warning" src="images/warning.png" /> Error en el registro',
							buttons:{'Aceptar':function(){$(this).dialog('close');}}
						});
						$message.dialog('open');
					}
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
		});
	});
});