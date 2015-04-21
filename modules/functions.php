<?php
	
	/* getAppointmentStatus(option)
		Retorna el nombre completo del estado de la cita
	*/
	function getAppointmentStatus($option){
		$name = '';
		switch($option){
			case 'sol':	$name = 'Solicitada';	break;
			case 'con':	$name = 'Confirmada';	break;
			case 'cum':	$name = 'Cumplida';		break;
			case 'inc':	$name = 'Incumplida';	break;
			case 'can':	$name = 'Cancelada';	break;
		}
		return $name;
	}
	
	/* getAppointmentStatusCode(option)
		Retorna el nombre completo del estado de la cita
	*/
	function getAppointmentStatusCode($option){
		$name = 0;
		switch($option){
			case 'sol':	$name = 1;	break;
			case 'con':	$name = 2;	break;
			case 'cum':	$name = 3;	break;
			case 'inc':	$name = 4;	break;
			case 'can':	$name = 5;	break;
		}
		return $name;
	}
	
	/* getAppointmentType(option)
		Retorna el nombre completo del tipo de la cita
	*/
	function getAppointmentType($option){
		$name = '';
		switch($option){
			case 'val':	$name = 'Valoraci&oacute;n';	break;
			case 'tra':	$name = 'Tratamiento';			break;
			case 'con':	$name = 'Control';				break;
		}
		return $name;
	}
	
	/* getAppointmentTypeCode(option)
		Retorna el nombre completo del tipo de la cita
	*/
	function getAppointmentTypeCode($option){
		$name = 0;
		switch($option){
			case 'val':	$name = 1;	break;
			case 'tra':	$name = 2;			break;
			case 'con':	$name = 3;				break;
		}
		return $name;
	}
	
	/* getBloodtype(option)
		Retorna el nombre completo del tipo de sangre que se mande por parametro
	*/
	function getBloodtype($option){
		$complete = "---";
		switch($option){
			case "on":  $complete = "O-"; break;
			case "op":  $complete = "O+"; break;
			case "an":  $complete = "A-"; break;
			case "ap":  $complete = "A+"; break;
			case "bn":  $complete = "B-"; break;
			case "bp":  $complete = "B+"; break;
			case "abn": $complete = "AB-"; break;
			case "abp": $complete = "AB+"; break;
		}
		return $complete;
	}
	
	/* getBloodtypeCode(option)
		Retorna el codigo del tipo de sangre que se mande por parametro
	*/
	function getBloodtypeCode($option){
		$complete = 0;
		switch($option){
			case "on":  $complete = 1; break;
			case "op":  $complete = 2; break;
			case "an":  $complete = 3; break;
			case "ap":  $complete = 4; break;
			case "bn":  $complete = 5; break;
			case "bp":  $complete = 6; break;
			case "abn": $complete = 7; break;
			case "abp": $complete = 8; break;
		}
		return $complete;
	}
	
	/* getDentist(state)
		
	*/
	function getDentist($state){
		$value = '';
		switch($state){
			case 0: $value = 'No'; break;
			case 1: $value = 'Si'; break;
		}
		return $value;
	}
	
	/* getDentistList()
		Escribe la lista de dentistas que se encuentran registrados en el sistema.
	*/
	function getDentistList(){
		$handler = new DBHandler();
		$specialty = '';
		$string = '<option value="0">---</option>';
		$count = $handler->getDentistCrossCount();
		if($count > 0){
			$list = $handler->getDentistCrossList();
			for($i = 0;$i < $count;$i += 1){
				if($specialty != $list[$i][1]){
					if($i > 0){
						$string .= '</optgroup>';
					}
					$string .= '<optgroup label="' . $list[$i][1] . '">';
					$specialty = $list[$i][1];
				}
				$string .= '<option value="' . $list[$i][2] . '">' . $list[$i][3] . ' ' . $list[$i][4] . ' ' . $list[$i][5] .  '</option>';
			}
			$string .= '</optgroup>';
		}
		return $string;
	}
	
	/* getDocumentType(option)
		Retorna el nombre completo del tipo de documento de identificacion que se mande por parametro
	*/
	function getDocumenttype($option){
		$complete = "---";
		switch($option){
			case "cc": $complete = "C&eacute;dula de Ciudadan&iacute;a"; break;
			case "ti": $complete = "Tarjeta de Identidad"; break;
			case "rc": $complete = "Registro Civil"; break;
			case "pa": $complete = "Pasaporte"; break;
			case "ce": $complete = "C&eacute;dula de Extranjer&iacute;a"; break;
		}
		return $complete;
	}
	
	/* getDocumentTypeCode(option)
		Retorna el codigo del tipo de documento de identificacion que se mande por parametro
	*/
	function getDocumenttypeCode($option){
		$complete = 0;
		switch($option){
			case "cc": $complete = 1; break;
			case "ti": $complete = 2; break;
			case "rc": $complete = 3; break;
			case "pa": $complete = 4; break;
			case "ce": $complete = 5; break;
		}
		return $complete;
	}
	
	/* getLocationList()
		Escribe la lista de ubicaciones que se encuentran registrados en el sistema.
	*/
	function getLocationList(){
		$handler = new DBHandler();
		$locationlist = '<option value="0">---</option>';
		$total = $handler->getLocationCount();
		if($total > 0){
			$list = $handler->getLocationList();
			for($i = 0;$i < $total;$i += 1){
				$locationlist .= '<option value="' . $list[$i][0] . '">' . $list[$i][1] . ' - ' . $list[$i][2] . '</option>';
			}
		}
		return $locationlist;
	}
	
	/* getMaritalStatus(option)
		Retorna el nombre completo del tipo de relacion marital que se mande por parametro
	*/
	function getMaritalstatus($option){
		$complete = "---";
		switch($option){
			case "sol": $complete = "Soltero"; break;
			case "cas": $complete = "Casado"; break;
			case "unl": $complete = "Uni&oacute;n Libre"; break;
			case "sep": $complete = "Separado"; break;
			case "div": $complete = "Divorciado"; break;
			case "viu": $complete = "Viudo"; break;
		}
		return $complete;
	}
	
	/* getMaritalStatusCode(option)
		Retorna el codigo del tipo de relacion marital que se mande por parametro
	*/
	function getMaritalstatusCode($option){
		$complete = 0;
		switch($option){
			case "sol": $complete = 1; break;
			case "cas": $complete = 2; break;
			case "unl": $complete = 3; break;
			case "sep": $complete = 4; break;
			case "div": $complete = 5; break;
			case "viu": $complete = 6; break;
		}
		return $complete;
	}
	
	/* getPatientDataById(id)
		Retorna un vector con la informacion del paciente de acuerdo a su id
	*/
	function getPatientDataById($id){
		$handler = new DBHandler();
		$data = $handler->getPatientDataById($id);
		$array = null;
		if($data != null){
			$array = array(
				'id' => $data['id'],
				'firstname' => $data['firstname'],
				'middlename' => $data['middlename'],
				'firstlastname' => $data['firstlastname'],
				'secondlastname' => $data['secondlastname'],
				'sex' => $data['sex'],
				'documenttype' => $data['documenttype'],
				'documentnumber' => $data['documentnumber'],
				'birthdate' => $data['birthdate'],
				'bloodtype' => $data['bloodtype'],
				'address' => $data['address'],
				'phonehome' => $data['phonehome'],
				'phoneoffice' => $data['phoneoffice'],
				'cellnumber' => $data['cellnumber'],
				'email' => $data['email'],
				'maritalstatus' => $data['maritalstatus'],
				'occupation' => $data['occupation'],
				'active' => $data['active']
			);
		}
		return $array;
	}
	
	/* getPaymentDataById(id)
		Retorna un vector con la informacion del recaudo de acuerdo a su id
	*/
	function getPaymentDataById($id){
		$handler = new DBHandler();
		$data = $handler->getPaymentDataById($id);
		$array = null;
		if($data != null){
			$array = array(
				'id' => $data['id'],
				'patient' => $data['patient'],
				'user' => $data['user'],
				'date' => $data['date'],
				'value' => $data['value'],
				'paymenttype' => $data['paymenttype'],
				'number' => $data['number'],
				'bank' => $data['bank'],
				'description' => $data['description']
			);
		}
		return $array;
	}
	
	/* getPaymenttype(id)
		Retorna el nombre completo de la forma de tipo de pago por parametro
	*/
	function getPaymenttypeName($id){
		$handler = new DBHandler();
		$name = $handler->getPaymenttypeName($id);
		return $name;
	}
	
	/* getPrivileges(option)
		Retorna el nombre completo del privilegio que se mande por parametro
	*/
	function getPrivileges($option){
		$complete = "---";
		switch($option){
			case "sec": $complete = "Recepci&oacute;n"; break;
			case "aux": $complete = "Auxiliar"; break;
			case "den": $complete = "Dentista"; break;
			case "man": $complete = "Gerente"; break;
			case "web": $complete = "Webmaster"; break;
		}
		return $complete;
	}
	
	/* getPrivilegesCode(option)
		Retorna el codigo del privilegio que se mande por parametro
	*/
	function getPrivilegesCode($option){
		$complete = 0;
		switch($option){
			case "sec": $complete = 1; break;
			case "aux": $complete = 2; break;
			case "den": $complete = 3; break;
			case "man": $complete = 4; break;
			case "web": $complete = 5; break;
		}
		return $complete;
	}
	
	/* getSex(option)
		Retorna el nombre completo del sexo que se mande por parametro
	*/
	function getSex($option){
		$complete = "---";
		switch($option){
			case "m": $complete = "Masculino"; break;
			case "f": $complete = "Femenino"; break;
		}
		return $complete;
	}
	
	/* getSexCode(option)
		Retorna el codigo del sexo que se mande por parametro
	*/
	function getSexCode($option){
		$complete = 0;
		switch($option){
			case "m": $complete = 1; break;
			case "f": $complete = 2; break;
		}
		return $complete;
	}
	
	/* getState(state)
		
	*/
	function getState($state){
		$value = '';
		switch($state){
			case 0: $value = 'Inactivo'; break;
			case 1: $value = 'Activo'; break;
		}
		return $value;
	}
	
	/* getTimeList()
		Escribe las horas desde las 7:00 am hasta las 8:00 pm con intervalos de cinco minutos
	*/
	function getTimeList(){
		$handler = new DBHandler();
		$timelist = '<option value="0">---</option>';
		$total = $handler->getTimeCount();
		if($total > 0){
			$list = $handler->getTimeList();
			for($i = 0;$i < $total;$i += 1){
				$timelist .= '<option value="' . $list[$i][0] . '">' . $list[$i][1] . '</option>';
			}
		}
		return $timelist;
	}
	
	/* getUserDataById(id)
		Retorna un vector con la informacion del usuario de acuerdo a su id
	*/
	function getUserDataById($id){
		$handler = new DBHandler();
		$data = $handler->getUserDataById($id);
		$array = null;
		if($data != null){
			$array = array(
				'id' => $data['id'],
				'firstname' => $data['firstname'],
				'middlename' => $data['middlename'],
				'firstlastname' => $data['firstlastname'],
				'secondlastname' => $data['secondlastname'],
				'sex' => $data['sex'],
				'documenttype' => $data['documenttype'],
				'documentnumber' => $data['documentnumber'],
				'birthdate' => $data['birthdate'],
				'bloodtype' => $data['bloodtype'],
				'address' => $data['address'],
				'phonehome' => $data['phonehome'],
				'phoneoffice' => $data['phoneoffice'],
				'cellnumber' => $data['cellnumber'],
				'email' => $data['email'],
				'maritalstatus' => $data['maritalstatus'],
				'dentist' => $data['dentist'],
				'specialty' => $data['specialty'],
				'username' => $data['username'],
				'password' => $data['password'],
				'privileges' => $data['privileges'],
				'active' => $data['active']
			);
		}
		return $array;
	}
	
	/* splitDate(date)
		Fragmenta la fecha ingresada en un arreglo de esta forma
		[0] = Mes
		[1] = dia
		[2] = año
	*/
	function splitDate($date){
		$array = str_split($date);
		$split = Array($array[0] . $array[1],$array[3] . $array[4],$array[6] . $array[7] . $array[8] . $array[9]);
		return $split;
	}
	
	/* toFormDate(date)
		Transforma una fecha de formato MySQL a formato HTML
	*/
	function toFormDate($date){
		$new = null;
		$array = preg_split('/-/',$date);
		$year = $array[0];
		$month = $array[1];
		$day = $array[2];
		$new = $day;
		return $month . '/' .$day . '/' . $year;
	}
	
	/* writeBankList()
		Escribe la lista de los bancos registrados en el sistema
	*/
	function writeBankList(){
		$handler = new DBHandler();
		echo '<option value="0">---</option>';
		$total = $handler->getBankCount();
		if($total > 0){
			$list = $handler->getBankList();
			for($i = 0;$i < $total;$i += 1){
				echo '<option value="' . $list[$i][0] . '">' . $list[$i][1] . '</option>';
			}
		}
	}
	
	/* writeDentistList()
		Escribe la lista de dentistas que se encuentran activados en el sistema agrupados de acuerdo a la especialidad
	*/
	function writeDentistList(){
		$handler = new DBHandler();
		$specialty = '';
		echo '<option value="0">---</option>';
		$count = $handler->getDentistCrossCount();
		if($count > 0){
			$list = $handler->getDentistCrossList();
			for($i = 0;$i < $count;$i += 1){
				if($specialty != $list[$i][1]){
					if($i > 0){
						echo '</optgroup>';
					}
					echo '<optgroup label="' . $list[$i][1] . '">';
					$specialty = $list[$i][1];
				}
				echo '<option value="' . $list[$i][2] . '">' . $list[$i][3] . ' ' . $list[$i][4] . ' ' . $list[$i][5] .  '</option>';
			}
			echo '</optgroup>';
		}
	}
	
	/* writeLocationList()
		Escribe la lista de ubicaciones que se encuentran registrados en el sistema.
	*/
	function writeLocationList(){
		$handler = new DBHandler();
		echo '<option value="0">---</option>';
		$total = $handler->getLocationCount();
		if($total > 0){
			$list = $handler->getLocationList();
			for($i = 0;$i < $total;$i += 1){
				echo '<option value="' . $list[$i][0] . '">' . $list[$i][1] . ' - ' . $list[$i][2] . '</option>';
			}
		}
	}
	
	/* writePaymenttypeList()
		Escribe la lista de las formas de pago registrados en el sistema
	*/
	function writePaymenttypeList(){
		$handler = new DBHandler();
		echo '<option value="0">---</option>';
		$total = $handler->getPaymenttypeCount();
		if($total > 0){
			$list = $handler->getPaymenttypeList();
			for($i = 0;$i < $total;$i += 1){
				echo '<option value="' . $list[$i][0] . '">' . $list[$i][1] . '</option>';
			}
		}
	}
	
	/* writeProcedureList()
		Escribe la lista de procedimientos activos que se encuentren registrados y los agrupa de acuerdo al tipo de procedimiento.
	*/
	function writeProcedureList(){
		$handler = new DBHandler();
		$type = '';
		echo '<option value="0">---</option>';
		$count = $handler->getProceduretypeCrossCount();
		if($count > 0){
			$list = $handler->getProceduretypeCrossList();
			for($i = 0;$i < $count;$i += 1){
				if($type != $list[$i][1]){
					if($i > 0){
						echo '</optgroup>';
					}
					echo '<optgroup label="' . $list[$i][1] . '">';
					$type = $list[$i][1];
				}
				echo '<option value="' . $list[$i][2] . '">' . $list[$i][3] . '</option>';
			}
			echo '</optgroup>';
		}
	}
	
	
	/* getProcedureList()
		Retorna la lista de procedimientos
	*/
	function getProcedureList(){
		$handler = new DBHandler();
		$list = '<option value="0">---</option>';
		$typecount = $handler->getProceduretypeCount();
		$typelist = $handler->getProceduretypeList();
		for($i = 0;$i < $typecount;$i += 1){
			$list .= '<optgroup label="' . $typelist[$i][1] . '">';
			$typeid = $typelist[$i][0];
			$procedurecount = $handler->getProcedureCount($typeid);
			$procedurelist = $handler->getProcedureList($typeid);
			for($j = 0;$j < $procedurecount;$j += 1){
				$list .= '<option value="' . $procedurelist[$j][0] . '">' . $procedurelist[$j][1] . ' - ' . $procedurelist[$j][2] . '</option>';
			}
			$list .= '</optgroup>';
		}
		return $list;
	}
	
	/* writeProceduretypeList()
		Escribe la lista de tipos de procedimientos que se encuentren registrados
	*/
	function writeProceduretypeList(){
		$handler = new DBHandler();
		echo '<option value="0">---</option>';
		$count = $handler->getProceduretypeCount();
		$list = $handler->getProceduretypeList();
		for($i = 0;$i < $count;$i += 1){
			echo '<option value="' . $list[$i][0] . '">' . $list[$i][1] . '</option>';
		}
	}
	
	/* writeSpecialtyList()
		Escribe la lista de especialidades que se encuentren registradas en la tabla de especialidades
	*/
	function writeSpecialtyList(){
		$handler = new DBHandler();
		echo '<option value="0">---</option>';
		$total = $handler->getSpecialtyCount();
		if($total > 0){
			$list = $handler->getSpecialtyList();
			for($i = 0;$i < $total;$i += 1){
				echo '<option value="' . $list[$i][0] . '">' . $list[$i][1] . '</option>';
			}
		}
	}
	
	/* writeSubprocedureList()
		
	*/
	function writeSubprocedureList(){
		$handler = new DBHandler();
		$proc = '';
		echo '<option value="0">---</option>';
		$count = $handler->getProcedureCrossCount();
		if($count > 0){
			$list = $handler->getProcedureCrossList();
			for($i = 0;$i < $count;$i += 1){
				if($proc != $list[$i][1]){
					if($i > 0){
						echo '</optgroup>';
					}
					echo '<optgroup label="' . $list[$i][1] . '">';
					$proc = $list[$i][1];
				}
				echo '<option value="' . $list[$i][2] . '">' . $list[$i][3] . '</option>';
			}
			echo '</optgroup>';
		}
	}
	
	/* writeTimeList()
		Escribe las horas desde las 7:00 am hasta las 8:00 pm con intervalos de cinco minutos
	*/
	function writeTimeList(){
		$handler = new DBHandler();
		echo '<option value="0">---</option>';
		$total = $handler->getTimeCount();
		if($total > 0){
			$list = $handler->getTimeList();
			for($i = 0;$i < $total;$i += 1){
				echo '<option value="' . $list[$i][0] . '">' . $list[$i][1] . '</option>';
			}
		}
	}
	
	/* writeUserList()
		Escribe los usuarios que aparecen registrados en el sistema (activos o no activos)
	*/
	function writeUserList(){
		$handler = new DBHandler();
		echo '<option value="0">---</option>';
		$total = $handler->getUserCount();
		if($total > 0){
			$list = $handler->getUserList();
			for($i = 0;$i < $total;$i += 1){
				echo '<option value="' . $list[$i][0] . '">' . $list[$i][1] . ' ' . $list[$i][2] . ' ' . $list[$i][3] . '</option>';
			}
		}
	}
?>