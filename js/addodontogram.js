$(document).ready(function(){
	var $currentParent = '';
	var $message = $('#message');
	$message.dialog({autoOpen:false,closeOnEscape:false,modal:true,resizable:false,width:600});
	
	function getValue($code){
		var $value = -1;
		if($code == 'r') $value = 1;
		if($code == 'b') $value = 2;
		if($code == 'l') $value = 3;
		if($code == 'p') $value = 4;
		if($code == 'pe') $value = 5;
		if($code == 'se') $value = 6;
		if($code == 'x') $value = 7;
		if($code == 'sl') $value = 8;
		if($code == 'g') $value = 9;
		if($code == 'pr') $value = 10;
		if($code == 'di') $value = 11;
		if($code == 'sn') $value = 12;
		if($code == 'o') $value = 13;
		return $value;
	}
	
	function getHexValue($code){
		var $value = 'N';
		if($code == 'r') $value = '1';
		if($code == 'b') $value = '2';
		if($code == 'l') $value = '3';
		if($code == 'p') $value = '4';
		if($code == 'pe') $value = '5';
		if($code == 'se') $value = '6';
		if($code == 'x') $value = '7';
		if($code == 'sl') $value = '8';
		if($code == 'g') $value = '9';
		if($code == 'pr') $value = 'A';
		if($code == 'di') $value = 'B';
		if($code == 'sn') $value = 'C';
		if($code == 'o') $value = 'D';
		if($code == 'bk') $value = 'E';
		return $value;
	}
	
	function getTeethJSONCode(){
		var $string1 = '', $string2 = '', $string3 = '', $string4 = '';
		var $string5 = '', $string6 = '', $string7 = '', $string8 = '';
		var $id = '';
		for($i = 8;$i >= 1;$i -= 1){
			$idt = '#d1' + $i + 't';
			$idl = '#d1' + $i + 'l';
			$idb = '#d1' + $i + 'b';
			$idr = '#d1' + $i + 'r';
			$idc = '#d1' + $i + 'c';
			$ids = '#d1' + $i + 's';
			$string1 += '&d1' + $i + '=' + getHexValue($($idt).attr('alt')) + getHexValue($($idl).attr('alt')) + 
										getHexValue($($idb).attr('alt')) + getHexValue($($idr).attr('alt')) + 
										getHexValue($($idc).attr('alt')) + getHexValue($($ids).attr('alt'));
			$idt = '#d4' + $i + 't';
			$idl = '#d4' + $i + 'l';
			$idb = '#d4' + $i + 'b';
			$idr = '#d4' + $i + 'r';
			$idc = '#d4' + $i + 'c';
			$ids = '#d4' + $i + 's';
			$string4 += '&d4' + $i + '=' + getHexValue($($idt).attr('alt')) + getHexValue($($idl).attr('alt')) + 
										getHexValue($($idb).attr('alt')) + getHexValue($($idr).attr('alt')) + 
										getHexValue($($idc).attr('alt')) + getHexValue($($ids).attr('alt'));
		}
		for($i = 1;$i <= 8;$i += 1){
			$idt = '#d2' + $i + 't';
			$idl = '#d2' + $i + 'l';
			$idb = '#d2' + $i + 'b';
			$idr = '#d2' + $i + 'r';
			$idc = '#d2' + $i + 'c';
			$ids = '#d2' + $i + 's';
			$string2 += '&d2' + $i + '=' + getHexValue($($idt).attr('alt')) + getHexValue($($idl).attr('alt')) + 
										getHexValue($($idb).attr('alt')) + getHexValue($($idr).attr('alt')) + 
										getHexValue($($idc).attr('alt')) + getHexValue($($ids).attr('alt'));
			$idt = '#d3' + $i + 't';
			$idl = '#d3' + $i + 'l';
			$idb = '#d3' + $i + 'b';
			$idr = '#d3' + $i + 'r';
			$idc = '#d3' + $i + 'c';
			$ids = '#d3' + $i + 's';
			$string3 += '&d3' + $i + '=' + getHexValue($($idt).attr('alt')) + getHexValue($($idl).attr('alt')) + 
										getHexValue($($idb).attr('alt')) + getHexValue($($idr).attr('alt')) + 
										getHexValue($($idc).attr('alt')) + getHexValue($($ids).attr('alt'));
		}
		for($i = 5;$i >= 1;$i -= 1){
			$idt = '#d5' + $i + 't';
			$idl = '#d5' + $i + 'l';
			$idb = '#d5' + $i + 'b';
			$idr = '#d5' + $i + 'r';
			$idc = '#d5' + $i + 'c';
			$ids = '#d5' + $i + 's';
			$string5 += '&d5' + $i + '=' + getHexValue($($idt).attr('alt')) + getHexValue($($idl).attr('alt')) + 
										getHexValue($($idb).attr('alt')) + getHexValue($($idr).attr('alt')) + 
										getHexValue($($idc).attr('alt')) + getHexValue($($ids).attr('alt'));
			$idt = '#d8' + $i + 't';
			$idl = '#d8' + $i + 'l';
			$idb = '#d8' + $i + 'b';
			$idr = '#d8' + $i + 'r';
			$idc = '#d8' + $i + 'c';
			$ids = '#d8' + $i + 's';
			$string8 += '&d8' + $i + '=' + getHexValue($($idt).attr('alt')) + getHexValue($($idl).attr('alt')) + 
										getHexValue($($idb).attr('alt')) + getHexValue($($idr).attr('alt')) + 
										getHexValue($($idc).attr('alt')) + getHexValue($($ids).attr('alt'));
		}
		for($i = 1;$i <= 5;$i += 1){
			$idt = '#d6' + $i + 't';
			$idl = '#d6' + $i + 'l';
			$idb = '#d6' + $i + 'b';
			$idr = '#d6' + $i + 'r';
			$idc = '#d6' + $i + 'c';
			$ids = '#d6' + $i + 's';
			$string6 += '&d6' + $i + '=' + getHexValue($($idt).attr('alt')) + getHexValue($($idl).attr('alt')) + 
										getHexValue($($idb).attr('alt')) + getHexValue($($idr).attr('alt')) + 
										getHexValue($($idc).attr('alt')) + getHexValue($($ids).attr('alt'));
			$idt = '#d7' + $i + 't';
			$idl = '#d7' + $i + 'l';
			$idb = '#d7' + $i + 'b';
			$idr = '#d7' + $i + 'r';
			$idc = '#d7' + $i + 'c';
			$ids = '#d7' + $i + 's';
			$string7 += '&d7' + $i + '=' + getHexValue($($idt).attr('alt')) + getHexValue($($idl).attr('alt')) + 
										getHexValue($($idb).attr('alt')) + getHexValue($($idr).attr('alt')) + 
										getHexValue($($idc).attr('alt')) + getHexValue($($ids).attr('alt'));
		}
		return 'patient=' + $('#patient').val() + '&user=' + $('#user').val() + '&date=' + $('#date').val() + $string1 + $string2 + $string5 + $string6 + $string8 + $string7 + $string4 + $string3 + '&description=' + $('#description').val();
	}
	
	$('input:button').button().click(function(){
		$('input:button').hide();
		$('#loader').show();
		$querystring = getTeethJSONCode();
		$.post('modules/checkodontogramdata.php',$querystring,function(value){
			if(value == '1'){
				$.post('modules/addodontogram.php',$querystring,function(data){
					if(data == '1'){
						$message.html('Odontograma ingresado satisfactoriamente');
						$message.dialog({
							title:'<img alt="success" src="images/success.png" /> Registro satisfactorio',
							buttons:{
								'Volver a la historia clinica':function(){window.location = 'medicalrecord.php?id=' + $('#patient').val();},
								'Menu Principal':function(){window.location = 'menu.php';}
							}
						});
					}
					else{
						$message.html(data);
						$message.dialog({
							title:'<img alt="warning" src="images/warning.png" /> Error de procedimiento',
							buttons:{'Aceptar':function(){$(this).dialog('close');}}
						});
					}
					$message.dialog('open');
					$('input:button').show();
					$('#loader').hide();
				});
			}
			else{
				$message.html(value);
				$message.dialog({
					title:'<img alt="warning" src="images/warning.png" /> Error de procedimiento',
					buttons:{'Aceptar':function(){$(this).dialog('close');}}
				});
				$message.dialog('open');
				$('input:button').show();
				$('#loader').hide();
			}
		});
	});
	
	$('a.option').click(function(){
		$('#selection').val($(this).attr('title'));
		if($currentParent != '') $($currentParent).css('background-color','#ffffff');
		$(this).parent().css('background-color','#a5e0f8');
		$currentParent = $(this).parent();
	});
	
	$('area').click(function(){
		var $selection = $('#selection').val();
		if($selection != ''){
			var $option = getValue($selection);	//El codigo numerico que corresponde a la opcion seleccionada
			var $id = $(this).attr('id');		//El id del area donde se hizo clic
			var $location = $id.substr(3);		//La ubicacion seleccionada en el diente (t,l,b,r,c)
			var $img = '#d' + $id.substr(1);	//El id de la imagen que corresponde a la ubicacion seleccionada
			var $tooth = '#d' + $id.substr(1,2);
			switch($option){
				case 1://Caries
					if($($img).attr('src') == 'images/odontogram/' + $location + 'r.png'){
						$($img).attr('src','images/odontogram/n.png');
						$($img).attr('alt','n');
					}
					else{
						$($img).attr('src','images/odontogram/' + $location + 'r.png');
						$($img).attr('alt','r');
						if(	$($tooth + 'c').attr('src') == 'images/odontogram/pe.png' || 
							$($tooth + 'c').attr('src') == 'images/odontogram/di.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/pr.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/se.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/x.png'){
								$($tooth + 'c').attr('src','images/odontogram/n.png');
								$($tooth + 'c').attr('alt','n');
							}
					}
				break;
				
				case 2://Amalgamas
					if($($img).attr('src') == 'images/odontogram/' + $location + 'b.png'){
						$($img).attr('src','images/odontogram/n.png');
						$($img).attr('alt','n');
					}
					else{
						$($img).attr('src','images/odontogram/' + $location + 'b.png');
						$($img).attr('alt','b');
						if(	$($tooth + 'c').attr('src') == 'images/odontogram/pe.png' || 
							$($tooth + 'c').attr('src') == 'images/odontogram/di.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/pr.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/se.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/x.png'){
								$($tooth + 'c').attr('src','images/odontogram/n.png');
								$($tooth + 'c').attr('alt','n');
							}
					}
				break;
				
				case 3://Resinas
					if($($img).attr('src') == 'images/odontogram/' + $location + 'l.png'){
						$($img).attr('src','images/odontogram/n.png');
						$($img).attr('alt','n');
					}
					else{
						$($img).attr('src','images/odontogram/' + $location + 'l.png');
						$($img).attr('alt','l');
						if(	$($tooth + 'c').attr('src') == 'images/odontogram/pe.png' || 
							$($tooth + 'c').attr('src') == 'images/odontogram/di.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/pr.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/se.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/x.png'){
								$($tooth + 'c').attr('src','images/odontogram/n.png');
								$($tooth + 'c').attr('alt','n');
							}
					}
				break;
				
				case 4://Para sellante
					if($($img).attr('src') == 'images/odontogram/' + $location + 'p.png'){
						$($img).attr('src','images/odontogram/n.png');
						$($img).attr('alt','p');
					}
					else{
						$($img).attr('src','images/odontogram/' + $location + 'p.png');
						$($img).attr('alt','p');
						if(	$($tooth + 'c').attr('src') == 'images/odontogram/pe.png' || 
							$($tooth + 'c').attr('src') == 'images/odontogram/di.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/pr.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/se.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/x.png'){
								$($tooth + 'c').attr('src','images/odontogram/n.png');
								$($tooth + 'c').attr('alt','n');
							}
					}
				break;
				
				case 5://Perdido
					if($($tooth + 'c').attr('src') == 'images/odontogram/pe.png'){
						$($tooth + 'c').attr('src','images/odontogram/n.png');
						$($tooth + 'c').attr('alt','n');
					}
					else{
						$($tooth + 't').attr('src','images/odontogram/n.png');
						$($tooth + 't').attr('alt','n');
						$($tooth + 'l').attr('src','images/odontogram/n.png');
						$($tooth + 'l').attr('alt','n');
						$($tooth + 'b').attr('src','images/odontogram/n.png');
						$($tooth + 'b').attr('alt','n');
						$($tooth + 'r').attr('src','images/odontogram/n.png');
						$($tooth + 'r').attr('alt','n');
						$($tooth + 'c').attr('src','images/odontogram/pe.png');
						$($tooth + 'c').attr('alt','pe');
					}
				break;
				
				case 6://Sin erupcionar
					if($($tooth + 'c').attr('src') == 'images/odontogram/se.png'){
						$($tooth + 'c').attr('src','images/odontogram/n.png');
						$($tooth + 'c').attr('alt','n');
					}
					else{
						$($tooth + 't').attr('src','images/odontogram/n.png');
						$($tooth + 't').attr('alt','n');
						$($tooth + 'l').attr('src','images/odontogram/n.png');
						$($tooth + 'l').attr('alt','n');
						$($tooth + 'b').attr('src','images/odontogram/n.png');
						$($tooth + 'b').attr('alt','n');
						$($tooth + 'r').attr('src','images/odontogram/n.png');
						$($tooth + 'r').attr('alt','n');
						$($tooth + 'c').attr('src','images/odontogram/se.png');
						$($tooth + 'c').attr('alt','se');
					}
				break;
				
				case 7://Resto radicular
					if($($tooth + 'c').attr('src') == 'images/odontogram/x.png'){
						$($tooth + 'c').attr('src','images/odontogram/n.png');
						$($tooth + 'c').attr('alt','n');
					}
					else{
						$($tooth + 't').attr('src','images/odontogram/n.png');
						$($tooth + 't').attr('alt','n');
						$($tooth + 'l').attr('src','images/odontogram/n.png');
						$($tooth + 'l').attr('alt','n');
						$($tooth + 'b').attr('src','images/odontogram/n.png');
						$($tooth + 'b').attr('alt','n');
						$($tooth + 'r').attr('src','images/odontogram/n.png');
						$($tooth + 'r').attr('alt','n');
						$($tooth + 'c').attr('src','images/odontogram/x.png');
						$($tooth + 'c').attr('alt','x');
					}
				break;
				
				case 8://Sellante
					if($($tooth + 'c').attr('src') == 'images/odontogram/sl.png'){
						$($tooth + 'c').attr('src','images/odontogram/n.png');
						$($tooth + 'c').attr('alt','n');
					}
					else{
						$($tooth + 'c').attr('src','images/odontogram/sl.png');
						$($tooth + 'c').attr('alt','sl');
					}
				break;
				
				case 9://Protesis fija
					if($($img).attr('src') == 'images/odontogram/' + $location + 'g.png'){
						$($img).attr('src','images/odontogram/n.png');
						$($img).attr('alt','n');
					}
					else{
						$($img).attr('src','images/odontogram/' + $location + 'g.png');
						$($img).attr('alt','g');
						if(	$($tooth + 'c').attr('src') == 'images/odontogram/pe.png' || 
							$($tooth + 'c').attr('src') == 'images/odontogram/di.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/pr.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/se.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/x.png'){
								$($tooth + 'c').attr('src','images/odontogram/n.png');
								$($tooth + 'c').attr('alt','n');
							}
					}
				break;
				
				case 10://Protesis removible
					if($($tooth + 'c').attr('src') == 'images/odontogram/pr.png'){
						$($tooth + 'c').attr('src','images/odontogram/n.png');
						$($tooth + 'c').attr('alt','n');
					}
					else{
						$($tooth + 't').attr('src','images/odontogram/n.png');
						$($tooth + 't').attr('alt','n');
						$($tooth + 'l').attr('src','images/odontogram/n.png');
						$($tooth + 'l').attr('alt','n');
						$($tooth + 'b').attr('src','images/odontogram/n.png');
						$($tooth + 'b').attr('alt','n');
						$($tooth + 'r').attr('src','images/odontogram/n.png');
						$($tooth + 'r').attr('alt','n');
						$($tooth + 'c').attr('src','images/odontogram/pr.png');
						$($tooth + 'c').attr('alt','pr');
					}
				break;
				
				case 11://Diente incluido
					if($($tooth + 'c').attr('src') == 'images/odontogram/di.png'){
						$($tooth + 'c').attr('src','images/odontogram/n.png');
						$($tooth + 'c').attr('alt','n');
					}
					else{
						$($tooth + 't').attr('src','images/odontogram/n.png');
						$($tooth + 't').attr('alt','n');
						$($tooth + 'l').attr('src','images/odontogram/n.png');
						$($tooth + 'l').attr('alt','n');
						$($tooth + 'b').attr('src','images/odontogram/n.png');
						$($tooth + 'b').attr('alt','n');
						$($tooth + 'r').attr('src','images/odontogram/n.png');
						$($tooth + 'r').attr('alt','n');
						$($tooth + 'c').attr('src','images/odontogram/di.png');
						$($tooth + 'c').attr('alt','di');
					}
				break;
				
				case 12://Supernumerario
					if($($tooth + 's').attr('src') == 'images/odontogram/sn.png'){
						$($tooth + 's').attr('src','images/odontogram/bk.png');
						$($tooth + 's').attr('alt','bk');
					}
					else{
						$($tooth + 's').attr('src','images/odontogram/sn.png');
						$($tooth + 's').attr('alt','sn');
					}
				break;
				
				case 13://Obturacion temporal
					if($($img).attr('src') == 'images/odontogram/' + $location + 'o.png'){
						$($img).attr('src','images/odontogram/n.png');
						$($img).attr('alt','n');
					}
					else{
						$($img).attr('src','images/odontogram/' + $location + 'o.png');
						$($img).attr('alt','o');
						if(	$($tooth + 'c').attr('src') == 'images/odontogram/pe.png' || 
							$($tooth + 'c').attr('src') == 'images/odontogram/di.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/pr.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/se.png' ||
							$($tooth + 'c').attr('src') == 'images/odontogram/x.png'){
								$($tooth + 'c').attr('src','images/odontogram/n.png');
								$($tooth + 'c').attr('alt','n');
							}
					}
				break;
			}
		}
		else{
			$message.html('Debe seleccionar una opci&oacute;n');
			$message.dialog({
				title:'<img alt="warning" src="images/warning.png" /> Error de procedimiento',
				buttons:{'Aceptar':function(){$(this).dialog('close');}}
			});
			$message.dialog('open');
		}
	});
});