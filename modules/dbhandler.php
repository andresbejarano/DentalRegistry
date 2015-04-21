<?php
class DBHandler{

	const DB_SERVER = 'localhost';
	const DB_NAME = 'dental';
	const DB_USERNAME = 'root';
	const DB_PASSWORD = '';
	
	// C --------------------------------------------------------------------------------------------------
	
	/* checkPatient(documenttype,document)
		Verifica que el tipo de documento y el numero corresponden a un paciente registrado.
		Retorna:
		-1: No hay correspondencia entre el tipo de documento y el número
		0: El tipo de documento y el número corresponden y el paciente está desactivado
		1: El tipo de documento y el número corresponden y el paciente está activado
	*/
	function checkPatient($documenttype,$documentnumber){
		$answer = -1;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `active` 
				FROM `dental`.`patient` 
				WHERE `documenttype` = ' . $documenttype .' AND `documentnumber` = ' . $documentnumber . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			if($data['active'] == 1)
				$answer = 1;
			else
				$answer = 0;
		}
		mysql_close($link);
		return $answer;
	}
	
	/* checkProcedure(code)
		Verifica que el codigo corresponda a un procedimiento registrado.
		Retorna:
		-1: No hay correspondencia con el codigo
		0: El codigo corresponde y el procedimiento está desactivado
		1: El codigo corresponde y el procedimiento está activado
	*/
	function checkProcedure($code){
		$answer = -1;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `active` 
				FROM `dental`.`procedure` 
				WHERE `code` = UPPER("' . $code . '")';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			if($data['active'] == 1)
				$answer = 1;
			else
				$answer = 0;
		}
		mysql_close($link);
		return $answer;
	}
	
	/* checkProceduretype(id)
		Verifica que el id corresponda a un tipo de procedimiento registrado.
		Retorna:
		-1: No hay correspondencia con el id
		0: Nunca va a retornar este valor
		1: El id corresponde
	*/
	function checkProceduretype($id){
		$answer = -1;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id` 
				FROM `dental`.`proceduretype` 
				WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			if($data['id'] == $id)
				$answer = 1;
			else
				$answer = 0;
		}
		mysql_close($link);
		return $answer;
	}
	
	/* checkUser(documenttype,document)
		Verifica que el tipo de documento y el numero corresponden a un usuario registrado.
		Retorna:
		-1: No hay correspondencia entre el tipo de documento y el número
		0: El tipo de documento y el número corresponden y el usuario está desactivado
		1: El tipo de documento y el número corresponden y el usuario está activado
	*/
	function checkUser($documenttype,$documentnumber){
		$answer = -1;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `active` 
				FROM `dental`.`user` 
				WHERE `documenttype` = ' . $documenttype .' AND `documentnumber` = ' . $documentnumber . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			if($data['active'] == 1)
				$answer = 1;
			else
				$answer = 0;
		}
		mysql_close($link);
		return $answer;
	}
	
	/* checkUserById(id)
		Verifica que el id corresponda a un usuario registrado.
		Retorna:
		-1: No hay correspondencia con el id
		0: El id corresponde y el usuario está desactivado
		1: El id corresponde y el usuario está activado
	*/
	function checkUserById($id){
		$answer = -1;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `active` 
				FROM `dental`.`user` 
				WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			if($data['active'] == 1)
				$answer = 1;
			else
				$answer = 0;
		}
		mysql_close($link);
		return $answer;
	}
	
	/* checkUserLogin(username,password)
		Verifica que el nombre de usuario corresponde con la contraseña.
		Retorna:
		-1: No hay correspondencia entre el usuario y la contraseña
		0: El usuario y la contraseña corresponden y el usuario esta desactivado
		1: El usuario y la contraseña corresponden y el usuario esta activado
	*/
	function checkUserLogin($username,$password){
		$answer = -1;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `active` 
				FROM `dental`.`user` 
				WHERE `username` = "' . $username .'" AND `password` = MD5("' . $password . '")';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			if($data['active'] == 1)
				$answer = 1;
			else
				$answer = 0;
		}
		mysql_close($link);
		return $answer;
	}
	
	// E -------------------------------------------------------------------------------------
	
	/* executeQuery(query)
		Ejecuta una insercion o modificacion dentro de la base de datos
		Retorna:
		0: Si la insercion no pudo ser ejecutada
		1: si la insercion pudo ser ejecutada
	*/
	function executeQuery($query){
		$success = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$result = mysql_query($query,$link);
		if($result)
			$success = 1;
		mysql_close($link);
		return $success;
	}
	
	/* existBank(id)
		Verifica que el id corresponda a un banco
		Retorna:
		0: No existe el id del banco
		1: Existe el id del banco
	*/
	function existBank($id){
		$answer = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id` 
				FROM `dental`.`bank` 
				WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1)
			$answer = 1;
		mysql_close($link);
		return $answer;
	}
	
	/* existLocation(id)
	*/
	function existLocation($id){
		$answer = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id` 
				FROM `dental`.`location` 
				WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1)
			$answer = 1;
		mysql_close($link);
		return $answer;
	}
	
	/* existPaymenttype(id)
		Verifica que el id corresponda a una forma de pago
		Retorna:
		0: No existe el id de la forma de pago
		1: Existe el id de la forma de pago
	*/
	function existPaymenttype($id){
		$answer = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id` 
				FROM `dental`.`paymenttype` 
				WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1)
			$answer = 1;
		mysql_close($link);
		return $answer;
	}
	
	/* existProcedure(id)
		Verifica que el id corresponda a un procedimiento
		Retorna:
		0: No existe el id del procedimiento
		1: Existe el id del procedimiento
	*/
	function existProcedure($id){
		$answer = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id` 
				FROM `dental`.`procedure` 
				WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1)
			$answer = 1;
		mysql_close($link);
		return $answer;
	}
	
	/* existProceduretype(id)
		Verifica que el id corresponda a un tipo de procedimiento
		Retorna:
		0: No existe el id del tipo de procedimiento
		1: Existe el id del tipo de procedimiento
	*/
	function existProceduretype($id){
		$answer = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id` 
				FROM `dental`.`proceduretype` 
				WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1)
			$answer = 1;
		mysql_close($link);
		return $answer;
	}
	
	/* existSpecialty(id)
		Verifica que el id corresponda a una especialidad existente
		Retorna:
		0: No existe el id de la especialidad
		1: Existe el id de la especialidad
	*/
	function existSpecialty($id){
		$answer = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id` 
				FROM `dental`.`specialty` 
				WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			if($data['id'] == $id)
				$answer = 1;
		}
		mysql_close($link);
		return $answer;
	}
	
	/* existSubprocedure(id)
		Verifica que el id corresponda a un subprocedimiento
		Retorna:
		0: No existe el id del subprocedimiento
		1: Existe el id del subprocedimiento
	*/
	function existSubprocedure($id){
		$answer = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id` 
				FROM `dental`.`subprocedure` 
				WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1)
			$answer = 1;
		mysql_close($link);
		return $answer;
	}
	
	/* existUsername(username)
		Busca en la tabla de usuarios si el nombre de usuario ingresado ya se encuentra registrado.
		Retorna:
		0: El nombre de usuario no se encuentra registrado
		1: El nombre de usuario se encuentra registrado
	*/
	function existUsername($username){
		$answer = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id` 
				FROM `dental`.`user` 
				WHERE `username` = "' . $username . '"';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1)
			$answer = 1;
		mysql_close($link);
		return $answer;
	}
	
	// G -------------------------------------------------------------------------------------
	
	/* getActiveBudgetCount(patient)
		Retorna la cantidad de presupuestos activos del paciente indicado
	*/
	function getActiveBudgetCount($patient){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`budget` 
				WHERE `patient` = ' . $patient . ' AND `active` = 1';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	/* getActiveBudgetList(patient) */
	function getActiveBudgetList($patient){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`code`,`patient`,`user`,`date`,`discount`,`active`,`description` 
				FROM `dental`.`budget` 
				WHERE `patient` = ' . $patient . ' AND `active` = 1';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['code'];
				$list[$i][2] = $row['patient'];
				$list[$i][3] = $row['user'];
				$list[$i][4] = $row['date'];
				$list[$i][5] = $row['discount'];
				$list[$i][6] = $row['active'];
				$list[$i][7] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	/* getAllActiveBudgetCount()
		Retorna la cantidad de presupuestos activos
	*/
	function getAllActiveBudgetCount(){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`budget` WHERE `active` = 1';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	/* getAllActiveBudgetList() */
	function getAllActiveBudgetList($patient){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`code`,`patient`,`user`,`date`,`discount`,`active`,`description` 
				FROM `dental`.`budget` WHERE `active` = 1';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['code'];
				$list[$i][2] = $row['patient'];
				$list[$i][3] = $row['user'];
				$list[$i][4] = $row['date'];
				$list[$i][5] = $row['discount'];
				$list[$i][6] = $row['active'];
				$list[$i][7] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	/* getAppointmentCount(date)
		Retorna la cantidad de citas programadas para el dia indicado
	*/
	function getAppointmentCount($date){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" 
				FROM `dental`.`appointment` 
				WHERE `date` = "' . $date . '"';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	/* getAppointmentCountByDateAndDentist(date,dentist)
		Retorna la cantidad de citas programadas para el dia indicado
	*/
	function getAppointmentCountByDateAndDentist($date,$dentist){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" 
				FROM `dental`.`appointment` 
				WHERE `date` = "' . $date . '" AND `dentist` = ' . $dentist . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	/* getAppointmentCountByDentist(dentist)
		Retorna la cantidad de citas programadas para el dia indicado
	*/
	function getAppointmentCountByDentist($dentist){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" 
				FROM `dental`.`appointment` 
				WHERE `dentist` = ' . $dentist . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	/* getAppointmentCountByPatient(patient)
		Retorna la cantidad de citas programadas para el dia indicado
	*/
	function getAppointmentCountByPatient($patient){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" 
				FROM `dental`.`appointment` 
				WHERE `patient` = ' . $patient . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	/* getAppointmentData()
	*/
	function getAppointmentData($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`patient`,`dentist`,`date`,`init`,`end`,`type`,`subprocedure`,`location`,`status`,`description` 
				FROM `dental`.`appointment` 
				WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1)
			$data = mysql_fetch_array($result);
		mysql_close($link);
		return $data;
	}
	
	/* getAppointmentList(date)
		Retorna la lista de citas programadas para el dia indicado
		Retorna:
		null: Si no hay citas registradas para el dia indicado
		array: Un vector con la siguiente informacion en este orden:
			id: Identificacion del banco
			name: Nombre
	*/
	function getAppointmentList($date){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`patient`,`dentist`,`date`,`init`,`end`,`type`,`subprocedure`,`location`,`status`,`description` 
				FROM `dental`.`appointment` 
				WHERE `date` = "' . $date . '" 
				ORDER BY `init`';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['patient'];
				$list[$i][2] = $row['dentist'];
				$list[$i][3] = $row['date'];
				$list[$i][4] = $row['init'];
				$list[$i][5] = $row['end'];
				$list[$i][6] = $row['type'];
				$list[$i][7] = $row['subprocedure'];
				$list[$i][8] = $row['location'];
				$list[$i][9] = $row['status'];
				$list[$i][10] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	/* getAppointmentListByDateAndDentist(date,dentist)
		Retorna la lista de citas programadas para el dia indicado
		Retorna:
			null: Si no hay citas registradas para el dia indicado
			array: Un vector con la siguiente informacion en este orden:
			id: Identificacion del banco
			name: Nombre
	*/
	function getAppointmentListByDateAndDentist($date,$dentist){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`patient`,`dentist`,`date`,`init`,`end`,`type`,`subprocedure`,`location`,`status`,`description` 
			FROM `dental`.`appointment` 
			WHERE `date` = "' . $date . '" AND `dentist` = ' . $dentist . ' 
			ORDER BY `init`';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['patient'];
				$list[$i][2] = $row['dentist'];
				$list[$i][3] = $row['date'];
				$list[$i][4] = $row['init'];
				$list[$i][5] = $row['end'];
				$list[$i][6] = $row['type'];
				$list[$i][7] = $row['subprocedure'];
				$list[$i][8] = $row['location'];
				$list[$i][9] = $row['status'];
				$list[$i][10] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	/* getAppointmentListByPatient(patient)
		Retorna la lista de citas programadas para el dia indicado
		Retorna:
			null: Si no hay citas registradas para el dia indicado
			array: Un vector con la siguiente informacion en este orden:
			id: Identificacion del banco
			name: Nombre
	*/
	function getAppointmentListByPatient($patient){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`patient`,`dentist`,`date`,`init`,`end`,`type`,`subprocedure`,`location`,`status`,`description` 
				FROM `dental`.`appointment` 
				WHERE `patient` = ' . $patient . ' 
				ORDER BY `date` DESC,`init` DESC';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['patient'];
				$list[$i][2] = $row['dentist'];
				$list[$i][3] = $row['date'];
				$list[$i][4] = $row['init'];
				$list[$i][5] = $row['end'];
				$list[$i][6] = $row['type'];
				$list[$i][7] = $row['subprocedure'];
				$list[$i][8] = $row['location'];
				$list[$i][9] = $row['status'];
				$list[$i][10] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	/* getAppointmentListByDentist(dentist)
		Retorna la lista de citas programadas para el dia indicado
		Retorna:
			null: Si no hay citas registradas para el dia indicado
			array: Un vector con la siguiente informacion en este orden:
				id: Identificacion del banco
				name: Nombre
	*/
	function getAppointmentListByDentist($dentist){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`patient`,`dentist`,`date`,`init`,`end`,`type`,`subprocedure`,`location`,`status`,`description` 
				FROM `dental`.`appointment` 
				WHERE `dentist` = ' . $dentist . ' 
				ORDER BY `date`,`init`';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['patient'];
				$list[$i][2] = $row['dentist'];
				$list[$i][3] = $row['date'];
				$list[$i][4] = $row['init'];
				$list[$i][5] = $row['end'];
				$list[$i][6] = $row['type'];
				$list[$i][7] = $row['subprocedure'];
				$list[$i][8] = $row['location'];
				$list[$i][9] = $row['status'];
				$list[$i][10] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	
	function getHistory($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT * FROM `dental`.`history` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
		}
		mysql_close($link);
		return $data;
	}
	
	function getHistoryByPatient($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id` FROM `dental`.`history` WHERE `patient` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
		}
		mysql_close($link);
		return $data;
	}
	
	/* getBankCount()
		Retorna la cantidad de bancos que se encuentran registrados
	*/
	function getBankCount(){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`bank`';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	/* getBankData(id)
		Retorna los datos del banco con el id ingresado
		Retorna:
			null: Si no correspondencia con el id
			array: Un vector con la siguiente informacion en este orden:
				id: Id del banco
				name: Nombre
				description: Descripcion
	*/
	function getBankData($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`name`,`description` FROM `dental`.`bank` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
		}
		mysql_close($link);
		return $data;
	}
	
	/* getBankList()
		Retorna la lista de bancos que se encuentran en el sistema.
		Retorna:
			null: Si no hay bancos en la base de datos
			array: Un vector con la siguiente informacion en este orden:
				id: Identificacion del banco
				name: Nombre
	*/
	function getBankList(){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`name` FROM `dental`.`bank` ORDER BY `name`';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['name'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	/* getBankName(id)
		Retorna el nombre del banco indicado. Si no existe el banco retorna nulo
	*/
	function getBankName($id){
		$data = null;
		$name = '---';
		if($id == null){
			$id = -1;
		}
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `name` FROM `dental`.`bank` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$name = $data['name'];
		}
		mysql_close($link);
		return $name;
	}
	
	/* getBudgetCount(patient)
		Retorna la cantidad de presupuestos que tenga el paciente indicado
	*/
	function getBudgetCount($patient){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`budget` WHERE `patient` = ' . $patient . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	/* getBudgetDataById(id)
		Retorna los datos del presupuesto con el id ingresado
		Retorna:
			null: Si no correspondencia con el id
			array: Un vector con la siguiente informacion en este orden:
				id: Id del presupuesto
				code: codigo
				patient: id del paciente
				user: id del usuario
				date: fecha
				discount: descuento
				active: activo
				description: descripcion
	*/
	function getBudgetDataById($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`code`,`patient`,`user`,`date`,`discount`,`active`,`description` 
				FROM `dental`.`budget` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
		}
		mysql_close($link);
		return $data;
	}
   
	/* getBudgetDataByCode(code)
		Retorna los datos del presupuesto con el codigo ingresado
		Retorna:
			null: Si no correspondencia con el codigo
			array: Un vector con la siguiente informacion en este orden:
				id: Id del presupuesto
				code: codigo
				patient: id del paciente
				user: id del usuario
				date: fecha
				active: activo
				description: descripcion
	*/
	function getBudgetDataByCode($code){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`code`,`patient`,`user`,`date`,`discount`,`active`,`description` 
				FROM `dental`.`budget` WHERE `code` = "' . $code . '"';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1)
			$data = mysql_fetch_array($result);
		mysql_close($link);
		return $data;
	}
	
	function getBudgetEvolveCount($budget){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`budgetevolve` WHERE `budget` = ' . $budget . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	function getBudgetEvolveList($budget){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`budget`,`budgetinfo`,`procedure`,`subprocedure`,`done`,`user`,`date`,`location`,`description` 
				FROM `dental`.`budgetevolve` WHERE `budget` = ' . $budget . '';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['budget'];
				$list[$i][2] = $row['budgetinfo'];
				$list[$i][3] = $row['procedure'];
				$list[$i][4] = $row['subprocedure'];
				$list[$i][5] = $row['done'];
				$list[$i][6] = $row['user'];
				$list[$i][7] = $row['date'];
				$list[$i][8] = $row['location'];
				$list[$i][9] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
   
	function getBudgetInfoCount($budget){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`budgetinfo` WHERE `budget` = ' . $budget . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	function getBudgetInfoList($budget){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`budget`,`procedure`,`location`,`description` 
				FROM `dental`.`budgetinfo` WHERE `budget` = ' . $budget . '';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['budget'];
				$list[$i][2] = $row['procedure'];
				$list[$i][3] = $row['location'];
				$list[$i][4] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
   
	/* getBudgetList(patient)
		Retorna la lista de presupuestos del paciente indicado
		Retorna:
		null: Si no hay presupuestos con el paciente indicado
		array: Un vector con la siguiente informacion en este orden:
			id:
			code:
			patient:
			user:
			date:
			active:
			description:
	*/
	function getBudgetList($patient){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`code`,`patient`,`user`,`date`,`discount`,`active`,`description`
				FROM `dental`.`budget` 
				WHERE `patient` = ' . $patient . '';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['code'];
				$list[$i][2] = $row['patient'];
				$list[$i][3] = $row['user'];
				$list[$i][4] = $row['date'];
				$list[$i][5] = $row['discount'];
				$list[$i][6] = $row['active'];
				$list[$i][7] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	/* getBudgetPrice(id)
		Retorna el costo total del presupuesto indicado
	*/
	function getBudgetPrice($id){
		$total = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT SUM(`price`) as "total" 
				FROM  `dental`.`budgetinfo` INNER JOIN `dental`.`procedure` 
				ON `budgetinfo`.`procedure` = `procedure`.`id` 
				WHERE `budget` = ' . $id . '';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	function getConditionedPatientCount($where){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`patient` ' . $where . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	function getConditionedPatientList($where){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`firstname`,`firstlastname`,`secondlastname`,`sex`,`documenttype`,`documentnumber` 
				FROM `dental`.`patient` ' . $where . '';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['firstname'];
				$list[$i][2] = $row['firstlastname'];
				$list[$i][3] = $row['secondlastname'];
				$list[$i][4] = $row['sex'];
				$list[$i][5] = $row['documenttype'];
				$list[$i][6] = $row['documentnumber'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	function getConditionedUserCount($where){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`user` ' . $where . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	function getConditionedUserList($where){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`firstname`,`firstlastname`,`secondlastname`,`sex`,`documenttype`,`documentnumber` 
				FROM `dental`.`user` ' . $where . '';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['firstname'];
				$list[$i][2] = $row['firstlastname'];
				$list[$i][3] = $row['secondlastname'];
				$list[$i][4] = $row['sex'];
				$list[$i][5] = $row['documenttype'];
				$list[$i][6] = $row['documentnumber'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	/* getDentistCount(specialty)
		Retorna la cantidad de dentistas activos con la especial indicada
	*/
	function getDentistCount($specialty){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`user` 
				WHERE `dentist` = TRUE AND `active` = TRUE AND `specialty` = ' . $specialty . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	/* getDentistList(specialty)
		Retorna la lista de los dentistas activos de acuerdo a la especialidad indicada
		Retorna:
			null: Si no hay dentistas activos en la base de datos
			array: Un vector con la siguiente informacion en este orden:
				id: Identificacion del dentista
				firstname: Primer nombre
				firstlastname: Primer apellido
				secondlastname: Segundo apellido
	*/
	function getDentistList($specialty){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `user`.`id`,`firstname`,`firstlastname`,`secondlastname` 
				FROM `dental`.`user` INNER JOIN `dental`.`specialty` 
				ON `user`.`specialty` = `specialty`.`id` 
				WHERE `dentist` = TRUE AND `active` = TRUE AND `specialty` = ' . $specialty . ' 
				ORDER BY `firstname`';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['firstname'];
				$list[$i][2] = $row['firstlastname'];
				$list[$i][3] = $row['secondlastname'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	function getDevelopmentCount($patient){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`development` 
				WHERE `patient` = ' . $patient . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	function getDevelopmentList($patient){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`patient`,`user`,`date`,`pregnant`,`months`,`plaque`,`description` 
				FROM `dental`.`development` WHERE `patient` = ' . $patient . '';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['patient'];
				$list[$i][2] = $row['user'];
				$list[$i][3] = $row['date'];
				$list[$i][4] = $row['pregnant'];
				$list[$i][5] = $row['months'];
				$list[$i][6] = $row['plaque'];
				$list[$i][7] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	function getDiagnosisByPatient($patient){
		return 0;
	}
	
	function getFeeReportCount($init,$end){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT(`id`) AS "total" FROM `dental`.`budgetevolve` 
				WHERE `done` = 1 AND `date` BETWEEN ' . $init . ' AND ' . $end . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	function getFeeReportCountByDentist($init,$end,$user){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT(`id`) AS "total" FROM `dental`.`budgetevolve` 
				WHERE `done` = 1 AND `date` BETWEEN ' . $init . ' AND ' . $end . ' AND `user` = ' . $user . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	function getFeeReportList($init,$end){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`budget`,`budgetinfo`,`procedure`,`subprocedure`,`done`,`user`,`date`,`location`,`description` 
				FROM `dental`.`budgetevolve` WHERE `done` = 1 AND `date` BETWEEN ' . $init . ' AND ' . $end . '';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['budget'];
				$list[$i][2] = $row['budgetinfo'];
				$list[$i][3] = $row['procedure'];
				$list[$i][4] = $row['subprocedure'];
				$list[$i][5] = $row['done'];
				$list[$i][6] = $row['user'];
				$list[$i][7] = $row['date'];
				$list[$i][8] = $row['location'];
				$list[$i][9] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	function getFeeReportListByDentist($init,$end,$user){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`budget`,`budgetinfo`,`procedure`,`subprocedure`,`done`,`user`,`date`,`location`,`description` 
				FROM `dental`.`budgetevolve` WHERE `done` = 1 AND `date` BETWEEN ' . $init . ' AND ' . $end . ' AND `user` = ' . $user . '';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['budget'];
				$list[$i][2] = $row['budgetinfo'];
				$list[$i][3] = $row['procedure'];
				$list[$i][4] = $row['subprocedure'];
				$list[$i][5] = $row['done'];
				$list[$i][6] = $row['user'];
				$list[$i][7] = $row['date'];
				$list[$i][8] = $row['location'];
				$list[$i][9] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	/* getLocationCount()
		Retorna la cantidad de ubicaciones orales que se encuentran registrados
	*/
	function getLocationCount(){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`location`';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}

	/* getLocationData(id) */
	function getLocationData($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`code`,`name`,`description` FROM `dental`.`location` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
		}
		mysql_close($link);
		return $data;
	}

	/* getLocationId(code) */
	function getLocationId($code){
		$data = null;
		$id = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id` FROM `dental`.`location` WHERE `code` = ' . $code . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$id = $data['id'];
		}
		mysql_close($link);
		return $id;
	}
	
	/* getLocationList()
		Retorna la lista de las ubicaciones orales que se encuentran en el sistema.
		Retorna:
			null: Si no hay ubicaciones en la base de datos
			array: Un vector con la siguiente informacion en este orden:
				id: Identificacion de la ubicacion
				code: Codigo de la ubicacion
				ame: Nombre de la ubicacion
	*/
	function getLocationList(){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`code`,`name` FROM `dental`.`location`';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['code'];
				$list[$i][2] = $row['name'];
			}
		}
		mysql_close($link);
		return $list;
	}
   
	/* getLocationName(id)
		Retorna el nombre de la ubicacion indicada
		Retorna:
		-1: Si no correspondencia con el id
		valor: El nombre del procedimiento
	*/
	function getLocationName($id){
		$data = null;
		$name = '---';
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `code` FROM `dental`.`location` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$name = $data['code'];
		}
		mysql_close($link);
		return $name;
	}
	
	function getOdontogramCount($patient){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`odontogram` WHERE `patient` = ' . $patient . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	function getOdontogramData($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT * FROM `dental`.`odontogram` 
			WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
		}
		mysql_close($link);
		return $data;
	}
	
	function getOdontogramList($patient){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`user`,`date` FROM `dental`.`odontogram` WHERE `patient` = ' . $patient . '';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['user'];
				$list[$i][2] = $row['date'];
			}
		}
		mysql_close($link);
		return $list;
	}
   
	/* getPatientId(documenttype,documentnumber)
	* Busca el valor asignado a la persona dentro de la tabla de patientes, de acuerdo a su tipo y numero del documento de identificacion.
	* Retorna:
	*   0: No se encontro correspondencia entre el tipo de documento y el numero
	*   #: El indice del patiente en la base de datos si hubo correspondencia entre el tipo de documento y el numero
	*/
	function getPatientId($documenttype,$documentnumber){
		$id = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id` FROM `dental`.`patient` 
			WHERE `documenttype` = ' . $documenttype . ' AND `documentnumber` = ' . $documentnumber . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$id = $data['id'];
		}
		mysql_close($link);
		return $id;
	}
   
	/* getPatientCount()
	* Retorna la cantidad de pacientes que se encuentran registrados en la base de datos
	*/
	function getPatientCount(){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`patient`';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
   
	/* getPatientData(documenttype,documentnumber)
	* Retorna los datos personales del paciente con tipo de documento y numero ingresados
	* Retorna:
	*   null: Si no correspondencia con el tipo de documento y numero
	*   array: Un vector con la siguiente informacion en este orden:
	*     id: Id del paciente dentro de la base de datos
	*     firstname: Primer nombre
	*     middlename: Segundo nombre
	*     firstlastname: Primer apellido
	*     secondlastname: Segundo apellido
	*     sex: Sexo
	*     documenttype: Tipo de documento
	*     documentnumber: Numero de documento
	*     birthdate: Fecha de nacimiento
	*     bloodtype: Tipo de sangre
	*     address: Direccion
	*     phonehome: Telefono de la casa
	*     phoneoffice: Telefono de la oficina
	*     cellnumber: Numero celular
	*     email: Correo electronico
	*     maritalstatus: Estado civil
	*     occupation: Ocupacion
	*     active: Estado
	*/
	function getPatientData($documenttype,$documentnumber){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`firstname`,`middlename`,`firstlastname`,`secondlastname`,`sex`,`documenttype`,
			`documentnumber`,`birthdate`,`bloodtype`,`address`,`phonehome`,`phoneoffice`,
			`cellnumber`,`email`,`maritalstatus`,`occupation`,`active` 
			FROM `dental`.`patient` 
			WHERE `documenttype` = ' . $documenttype . ' AND `documentnumber` = ' . $documentnumber . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
		}
		mysql_close($link);
		return $data;
	}
   
	/* getPatientDataById(id)
	* Retorna los datos personales del paciente con el indice ingresado
	* Retorna:
	*   null: Si no correspondencia con el indice
	*   array: Un vector con la siguiente informacion en este orden:
	*     id: Id del paciente dentro de la base de datos
	*     firstname: Primer nombre
	*     middlename: Segundo nombre
	*     firstlastname: Primer apellido
	*     secondlastname: Segundo apellido
	*     sex: Sexo
	*     documenttype: Tipo de documento
	*     documentnumber: Numero de documento
	*     birthdate: Fecha de nacimiento
	*     bloodtype: Tipo de sangre
	*     address: Direccion
	*     phonehome: Telefono de la casa
	*     phoneoffice: Telefono de la oficina
	*     cellnumber: Numero celular
	*     email: Correo electronico
	*     maritalstatus: Estado civil
	*     occupation: Ocupacion
	*     active: Estado
	*/
	function getPatientDataById($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`firstname`,`middlename`,`firstlastname`,`secondlastname`,`sex`,`documenttype`,
			`documentnumber`,`birthdate`,`bloodtype`,`address`,`phonehome`,`phoneoffice`,
			`cellnumber`,`email`,`maritalstatus`,`occupation`,`active`,`contact`,`contactnumber` 
			FROM `dental`.`patient` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
		}
		mysql_close($link);
		return $data;
	}
   
	/* getPatientName(id)
	* Retorna el nombre completo del paciente indicado. En caso de no existir retorna nulo
	*/
	function getPatientName($id){
		$data = null;
		$name = '---';
		if($id == null){
			$id = -1;
		}
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `firstname`,`firstlastname`,`secondlastname` FROM `dental`.`patient` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$name = $data['firstname'] . ' ' . $data['firstlastname'] . ' ' . $data['secondlastname'];
		}
		mysql_close($link);
		return $name;
	}
   
	/* getPatientList()
	* Retorna la lista de pacientes registrados en la base de datos
	* Retorna:
	*   null: Si no hay pacientes registrados
	*   array: Una matriz donde cada fila es un paciente.
	*     id: Identificacion
	*     firstname: id del paciente
	*     middlename: id del usuario
	*     firstlastname: fecha del recaudo
	*     secondlastname: valor del recaudo
	*     sex: tipo de recaudo
	*     documenttype: numero de la tarjeta o cheque, de acuerdo a la forma de pago
	*     documentnumber: banco
	*     birthdate: descripcion
	*     bloodtype:
	*     address:
	*     phonehome
	*     phoneoffice
	*     cellnumber
	*     email
	*     maritalstatus
	*     occupation
	*     active
	*/
	function getPatientList(){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`firstname`,`middlename`,`firstlastname`,`secondlastname`,`sex`,`documenttype`,
			`documentnumber`,`birthdate`,`bloodtype`,`address`,`phonehome`,`phoneoffice`,
			`cellnumber`,`email`,`maritalstatus`,`occupation`,`active` 
			FROM `dental`.`patient`';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['firstname'];
				$list[$i][2] = $row['middlename'];
				$list[$i][3] = $row['firstlastname'];
				$list[$i][4] = $row['secondlastname'];
				$list[$i][5] = $row['sex'];
				$list[$i][6] = $row['documenttype'];
				$list[$i][7] = $row['documentnumber'];
				$list[$i][8] = $row['birthdate'];
				$list[$i][9] = $row['bloodtype'];
				$list[$i][10] = $row['address'];
				$list[$i][11] = $row['phonehome'];
				$list[$i][12] = $row['phoneoffice'];
				$list[$i][13] = $row['cellnumber'];
				$list[$i][14] = $row['email'];
				$list[$i][15] = $row['maritalstatus'];
				$list[$i][16] = $row['occupation'];
				$list[$i][17] = $row['active'];
			}
		}
		mysql_close($link);
		return $list;
	}
   
	/* getPaymentCount(patient)
		Retorna la cantidad de recaudos realizados por el paciente indicado
		*/
	function getPaymentCount($patient){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" 
				FROM `dental`.`payment` 
				WHERE `patient` = ' . $patient . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	/* getPaymentDataById(id)
		Retorna los datos del recaudo con el indice ingresado
		Retorna:
		null: Si no correspondencia con el indice
		array: Un vector con la siguiente informacion en este orden:
			id: Id del paciente dentro de la base de datos
			patient: id del paciente
			user: id del usuario
			date: fecha
			value: valor
			paymenttype: id de la forma de pago
			number: numero de la tarjeta o cheque
			bank: banco
			description: Descripcion
	*/
	function getPaymentDataById($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`patient`,`user`,`date`,`value`,`paymenttype`,`number`,`bank`,`description` 
				FROM `dental`.`payment` 
				WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1)
			$data = mysql_fetch_array($result);
		mysql_close($link);
		return $data;
	}
	
	/* getPaymentList(patient)
		Retorna la lista de recaudos realizados por el paciente indicado
		Retorna:
		null: Si no hay formas de pago en la base de datos
		array: Un vector con la siguiente informacion en este orden:
			id: Identificacion de la forma de pago
			patient: id del paciente
			user: id del usuario
			date: fecha del recaudo
			value: valor del recaudo
			paymenttype: tipo de recaudo
			number: numero de la tarjeta o cheque, de acuerdo a la forma de pago
			bank: banco
			description: descripcion
	*/
	function getPaymentList($patient){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`patient`,`user`,`date`,`value`,`paymenttype`,`number`,`bank`,`description` 
				FROM `dental`.`payment` 
				WHERE `patient` = ' . $patient . ' ORDER BY `date` DESC';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['patient'];
				$list[$i][2] = $row['user'];
				$list[$i][3] = $row['date'];
				$list[$i][4] = $row['value'];
				$list[$i][5] = $row['paymenttype'];
				$list[$i][6] = $row['number'];
				$list[$i][7] = $row['bank'];
				$list[$i][8] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	function getPaymentReportCount($init,$end){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`payment` 
				WHERE `date` BETWEEN ' . $init . ' AND ' . $end . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	function getPaymentReportList($init,$end){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`patient`,`user`,`date`,`value`,`paymenttype`,`number`,`bank`,`description` 
				FROM `dental`.`payment` WHERE `date` BETWEEN ' . $init . ' AND ' . $end . '';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['patient'];
				$list[$i][2] = $row['user'];
				$list[$i][3] = $row['date'];
				$list[$i][4] = $row['value'];
				$list[$i][5] = $row['paymenttype'];
				$list[$i][6] = $row['number'];
				$list[$i][7] = $row['bank'];
				$list[$i][8] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
   
	/* getPaymenttypeCount()
	* Retorna la cantidad de formas de pago que se encuentran registrados
	*/
	function getPaymenttypeCount(){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`paymenttype`';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
   
	/* getPaymenttypeData(id)
	* Retorna los datos de la forma de pago con el id ingresado
	* Retorna:
	*   null: Si no correspondencia con el id
	*   array: Un vector con la siguiente informacion en este orden:
	*     id: Id de la forma de pago
	*     name: Nombre
	*     description: Descripcion
	*/
	function getPaymenttypeData($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`name`,`description` FROM `dental`.`paymenttype` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
		}
		mysql_close($link);
		return $data;
	}
   
	/* getPaymenttypeList()
	* Retorna la lista de las formas de pago que se encuentran en el sistema.
	* Retorna:
	*   null: Si no hay formas de pago en la base de datos
	*   array: Un vector con la siguiente informacion en este orden:
	*     id: Identificacion de la forma de pago
	*     name: Nombre
	*/
	function getPaymenttypeList(){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`name` FROM `dental`.`paymenttype` ORDER BY `name`';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['name'];
			}
		}
		mysql_close($link);
		return $list;
	}
   
	/* getPaymenttypeName(id)
	* Retorna el nombre completo de la forma de pago indicada. En caso de no existir retorna nulo
	*/
	function getPaymenttypeName($id){
		$data = null;
		$name = '---';
		if($id == null){
			$id = -1;
		}
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `name` FROM `dental`.`paymenttype` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$name = $data['name'];
		}
		mysql_close($link);
		return $name;
	}
   
	/* getProcedureCount(type)
	* Retorna la cantidad de procedimientos que se encuentran registrados de acuerdo al tipo de procedimiento indicado
	*/
	function getProcedureCount($type){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`procedure` 
			WHERE `proceduretype` = ' . $type . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
   
	/* getProcedureData(id)
		Retorna los datos del procedimiento con el id ingresado
		Retorna:
		null: Si no correspondencia con el id
		array: Un vector con la siguiente informacion en este orden:
			id: Id del tipo de procedimiento
			code: Codigo
			name: Nombre
			price: Precio
			active: Activo
			proceduretype: Tipo de procedimiento
			description: Descripcion
	*/
	function getProcedureData($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`code`,`name`,`price`,`active`,`proceduretype`,`description` 
				FROM `dental`.`procedure` 
				WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1)
			$data = mysql_fetch_array($result);
		mysql_close($link);
		return $data;
	}
   
	/* getProcedureId(code)
	* Busca el valor asignado al procedimiento de acuerdo a su codigo
	* Retorna:
	*   0: No se encontro correspondencia con el codigo
	*   #: El indice del procedimiento
	*/
	function getProcedureId($code){
		$id = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id` FROM `dental`.`procedure` WHERE `code` = "' . $code . '"';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$id = $data['id'];
		}
		mysql_close($link);
		return $id;
	}
   
	/* getProcedureList(type)
	* Retorna la lista de los procedimiento que se encuentran en el sistema de acuerdo al tipo ingresado
	* Retorna:
	*   null: Si no hay tipos de procedimiento en la base de datos
	*   array: Un vector con la siguiente informacion en este orden:
	*     id: Id del tipo de procedimiento
	*     code: Codigo
	*     name: Nombre
	*     price: Precio
	*     active: Activo
	*     proceduretype: Tipo de procedimiento
	*     description: Descripcion
	*/
	function getProcedureList($type){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`code`,`name`,`price`,`active`,`proceduretype`,`description` 
			FROM `dental`.`procedure` WHERE `proceduretype` = ' . $type . '';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['code'];
				$list[$i][2] = $row['name'];
				$list[$i][3] = $row['price'];
				$list[$i][4] = $row['active'];
				$list[$i][5] = $row['proceduretype'];
				$list[$i][6] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
   
	/* getProcedureName(id)
	* Retorna el nombre del procedimiento indicado
	* Retorna:
	*   -1: Si no correspondencia con el id
	*   valor: El nombre del procedimiento
	*/
	function getProcedureName($id){
		$data = null;
		$name = '---';
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `name` FROM `dental`.`procedure` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$name = $data['name'];
		}
		mysql_close($link);
		return $name;
	}
   
	/* getProcedurePrice(id)
	* Retorna el precio del procedimiento indicado
	* Retorna:
	*   -1: Si no correspondencia con el id
	*   valor: El precio del procedimiento
	*/
	function getProcedurePrice($id){
		$data = null;
		$price = -1;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `price` FROM `dental`.`procedure` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$price = $data['price'];
		}
		mysql_close($link);
		return $price;
	}
   
	/* getProceduretypeCount()
	* Retorna la cantidad de tipos de procedimiento que se encuentran registrados
	*/
	function getProceduretypeCount(){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`proceduretype`';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
   
	/* getProceduretypeData(id)
	* Retorna los datos del tipo de procedimiento con el id ingresado
	* Retorna:
	*   null: Si no correspondencia con el id
	*   array: Un vector con la siguiente informacion en este orden:
	*     id: Id del tipo de procedimiento
	*     name: Nombre
	*     description: Descripcion
	*/
	function getProceduretypeData($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`name`,`description` FROM `dental`.`proceduretype` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
		}
		mysql_close($link);
		return $data;
	}
   
	/* getProceduretypeList()
	* Retorna la lista de los tipos de procedimiento que se encuentran en el sistema.
	* Retorna:
	*   null: Si no hay tipos de procedimiento en la base de datos
	*   array: Un vector con la siguiente informacion en este orden:
	*     id: Identificacion del tipo de procedimiento
	*     name: Nombre
	*/
	function getProceduretypeList(){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`name` FROM `dental`.`proceduretype`';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['name'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	function getProceduretypeName($id){
		$data = null;
		$name = '---';
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `name` FROM `dental`.`proceduretype` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$name = $data['name'];
		}
		mysql_close($link);
		return $name;
	}
   
	/* getSchedule(dentist,date)
	* Retorna los datos del horario que se ajuste a la fecha ingresada con el dentista indicado
	*/
	function getSchedule($dentist,$date){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`dentist`,`dateinit`,`monday`,`mondayinit`,`mondayend`,`tuesday`,`tuesdayinit`,`tuesdayend`,
				`wednesday`,`wednesdayinit`,`wednesdayend`,`thursday`,`thursdayinit`,`thursdayend`,`friday`,`fridayinit`,`fridayend`,
				`saturday`,`saturdayinit`,`saturdayend`,`sunday`,`sundayinit`,`sundayend`,`description` 
				FROM `dental`.`schedule` 
				WHERE `dentist` = ' . $dentist . ' AND `dateinit` <= "' . $date . '" ORDER BY `dateinit` DESC';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) >= 1){
			$row = mysql_fetch_array($result);
			$data = array(
				'id'			=> $row[0],
				'dentist'		=> $row[1],
				'dateinit'		=> $row[2],
				'monday'		=> $row[3],
				'mondayinit'	=> $row[4],
				'mondayend'		=> $row[5],
				'tuesday'		=> $row[6],
				'tuesdayinit'	=> $row[7],
				'tuesdayend'	=> $row[8],
				'wednesday'		=> $row[9],
				'wednesdayinit'	=> $row[10],
				'wednesdayend'	=> $row[11],
				'thursday'		=> $row[12],
				'thursdayinit'	=> $row[13],
				'thursdayend'	=> $row[14],
				'friday'		=> $row[15],
				'fridayinit'	=> $row[16],
				'fridayend'		=> $row[17],
				'saturday'		=> $row[18],
				'saturdayinit'	=> $row[19],
				'saturdayend'	=> $row[20],
				'sunday'		=> $row[21],
				'sundayinit'	=> $row[22],
				'sundayend'		=> $row[23],
				'description'	=> $row[24]
			);
		}
		mysql_close($link);
		return $data;
	}
   
	/* getScheduleById(id)
		Retorna el horario con el id ingresado
	*/
	function getScheduleById($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`dentist`,`dateinit`,`monday`,`mondayinit`,`mondayend`,`tuesday`,`tuesdayinit`,`tuesdayend`,
					`wednesday`,`wednesdayinit`,`wednesdayend`,`thursday`,`thursdayinit`,`thursdayend`,`friday`,`fridayinit`,`fridayend`,
					`saturday`,`saturdayinit`,`saturdayend`,`sunday`,`sundayinit`,`sundayend`,`description` 
				FROM `dental`.`schedule` 
				WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) >= 1){
			$row = mysql_fetch_array($result);
			$data = array(
				'id'			=> $row[0],
				'dentist'		=> $row[1],
				'dateinit'		=> $row[2],
				'monday'		=> $row[3],
				'mondayinit'	=> $row[4],
				'mondayend'		=> $row[5],
				'tuesday'		=> $row[6],
				'tuesdayinit'	=> $row[7],
				'tuesdayend'	=> $row[8],
				'wednesday'		=> $row[9],
				'wednesdayinit'	=> $row[10],
				'wednesdayend'	=> $row[11],
				'thursday'		=> $row[12],
				'thursdayinit'	=> $row[13],
				'thursdayend'	=> $row[14],
				'friday'		=> $row[15],
				'fridayinit'	=> $row[16],
				'fridayend'		=> $row[17],
				'saturday'		=> $row[18],
				'saturdayinit'	=> $row[19],
				'saturdayend'	=> $row[20],
				'sunday'		=> $row[21],
				'sundayinit'	=> $row[22],
				'sundayend'		=> $row[23],
				'description'	=> $row[24]
			);
		}
		mysql_close($link);
		return $data;
	}
   
	/* getScheduleCount(dentist)
	* Retorna la cantidad de horarios que tiene el dentista
	* 
	*/
	function getScheduleCount($dentist){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`schedule` WHERE `dentist` = ' . $dentist . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
   
	/* getScheduleData(id)
	* Retorna los datos del horario ingresado
	* Retorna:
	*   null: Si no correspondencia con el id
	*   array: Un vector con la siguiente informacion
	*     id:
	*     dentist:
	*     dateinit:
	*     monday:
	*     mondayinit:
	*     mondayend:
	*     tuesday:
	*     tuesdayinit:
	*     tuesdayend:
	*     wednesday:
	*     wednesdayinit:
	*     wednesdayend:
	*     thursday:
	*     thursdayinit:
	*     thursdayend:
	*     friday:
	*     fridayinit:
	*     fridayend:
	*     saturday:
	*     saturdayinit:
	*     saturdayend:
	*     sunday:
	*     sundayinit:
	*     sundayend:
	*     description:
	*/
	function getScheduleData($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`dentist`,`dateinit`,`monday`,`mondayinit`,`mondayend`,`tuesday`,`tuesdayinit`,`tuesdayend`,
			`wednesday`,`wednesdayinit`,`wednesdayend`,`thursday`,`thursdayinit`,`thursdayend`,`friday`,`fridayinit`,`fridayend`,
			`saturday`,`saturdayinit`,`saturdayend`,`sunday`,`sundayinit`,`sundayend`,`description` 
			FROM `dental`.`schedule` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
		}
		mysql_close($link);
		return $data;
	}
   
	/* getScheduleList(id)
	*    id
	dentist
	dateinit
	monday
	mondayinit
	mondayend
	tuesday
	tuesdayinit
	tuesdayend
	wednesday
	wednesdayinit
	wednesdayend
	thursday
	thursdayinit
	thursdayend
	friday
	fridayinit
	fridayend
	saturday
	saturdayinit
	saturdayend
	sunday
	sundayinit
	sundayend
	description
	* 
	*/
	function getScheduleList($dentist){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`dentist`,`dateinit`,`monday`,`mondayinit`,`mondayend`,`tuesday`,`tuesdayinit`,`tuesdayend`,
			`wednesday`,`wednesdayinit`,`wednesdayend`,`thursday`,`thursdayinit`,`thursdayend`,`friday`,`fridayinit`,`fridayend`,
			`saturday`,`saturdayinit`,`saturdayend`,`sunday`,`sundayinit`,`sundayend`,`description`  
			FROM `dental`.`schedule` WHERE `dentist` = ' . $dentist . ' ORDER BY `dateinit` DESC';
		$result = mysql_query($query,$link);
		$num_rows = mysql_num_rows($result);
		for($i = 0;$i < $num_rows;$i += 1){
			$row = mysql_fetch_array($result);
			$data[$i][0] = $row['id'];
			$data[$i][1] = $row['dentist'];
			$data[$i][2] = $row['dateinit'];
			$data[$i][3] = $row['monday'];
			$data[$i][4] = $row['mondayinit'];
			$data[$i][5] = $row['mondayend'];
			$data[$i][6] = $row['tuesday'];
			$data[$i][7] = $row['tuesdayinit'];
			$data[$i][8] = $row['tuesdayend'];
			$data[$i][9] = $row['wednesday'];
			$data[$i][10] = $row['wednesdayinit'];
			$data[$i][11] = $row['wednesdayend'];
			$data[$i][12] = $row['thursday'];
			$data[$i][13] = $row['thursdayinit'];
			$data[$i][14] = $row['thursdayend'];
			$data[$i][15] = $row['friday'];
			$data[$i][16] = $row['fridayinit'];
			$data[$i][17] = $row['fridayend'];
			$data[$i][18] = $row['saturday'];
			$data[$i][19] = $row['saturdayinit'];
			$data[$i][20] = $row['saturdayend'];
			$data[$i][21] = $row['sunday'];
			$data[$i][22] = $row['sundayinit'];
			$data[$i][23] = $row['sundayend'];
			$data[$i][24] = $row['description'];
		}
		mysql_close($link);
		return $data;
	}
   
	/* Funcion getSpecialtyCount()
	* Retorna la cantidad de especialidades que pueden tener los medicos dentro
	* del sistema.
	*/
	function getSpecialtyCount(){
		$data = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`specialty`';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$data = $row['total'];
		}
		mysql_close($link);
		return $data;
	}
   
	/* getSpecialtyData(id)
		Retorna los datos de la especialidad con el id ingresado
		Retorna:
		null: Si no hay correspondencia con el id
		array: Un vector con la siguiente informacion en este orden:
			id: Id de la especialidad
			name: Nombre
			fee: Honorario
			description: Descripcion
	*/
	function getSpecialtyData($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`name`,`fee`,`description` 
				FROM `dental`.`specialty` 
				WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1)
			$data = mysql_fetch_array($result);
		mysql_close($link);
		return $data;
	}
   
	/* getSpecialtyList()
	* Retorna la lista de especialidades que pueden tener los dentistas dentro del sistema.
	*/
	function getSpecialtyList(){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`name` FROM `dental`.`specialty` ORDER BY `name` ASC';
		$result = mysql_query($query,$link);
		$num_rows = mysql_num_rows($result);
		for($i = 0;$i < $num_rows;$i += 1){
			$row = mysql_fetch_array($result);
			$data[$i][0] = $row['id'];
			$data[$i][1] = $row['name'];
		}
		mysql_close($link);
		return $data;
	}
   
	/* getSpecialtyName(id)
	* Retorna el nombre completo de la especialidad indicada. En caso de no existir retorna nulo
	*/
	function getSpecialtyName($id){
		$data = null;
		$name = '---';
		if($id == null){
			$id = -1;
		}
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `name` FROM `dental`.`specialty` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$name = $data['name'];
		}
		mysql_close($link);
		return $name;
	}

	/* getSubprocedureCode(id)
		
	*/
	function getSubprocedureCode($id){
		$code = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `code` 
				FROM `dental`.`subprocedure` 
				WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$code = $data['code'];
		}
		mysql_close($link);
		return $code;
	}

	/* getSubprocedureCount(proc)
	* Retorna la cantidad de subprocedimientos que se encuentran registrados de acuerdo al tipo de procedimiento indicado
	*/
	function getSubprocedureCount($proc){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`subprocedure` WHERE `procedure` = ' . $proc . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}

	/* getSubprocedureData(id)
		Retorna los datos del procedimiento con el id ingresado
		Retorna:
		null: Si no correspondencia con el id
		array: Un vector con la siguiente informacion en este orden:
			id: Id del tipo de procedimiento
			code: Codigo
			name: Nombre
			price: Precio
			active: Activo
			procedure: Procedimiento
			description: Descripcion
	*/
	function getSubprocedureData($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`code`,`name`,`price`,`active`,`procedure`,`description` 
				FROM `dental`.`subprocedure` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1)
			$data = mysql_fetch_array($result);
		mysql_close($link);
		return $data;
	}   
	
	/* getSubprocedureId(code)
		Busca el valor asignado al subprocedimiento de acuerdo a su codigo
		Retorna:
		0: No se encontro correspondencia con el codigo
		#: El indice del procedimiento
	*/
	function getSubprocedureId($code){
		$id = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id` 
				FROM `dental`.`subprocedure` 
				WHERE `code` = "' . $code . '"';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$id = $data['id'];
		}
		mysql_close($link);
		return $id;
	}
   
	/* getSubprocedureList(proc)
	* Retorna la lista de los subprocedimiento que se encuentran en el sistema de acuerdo al procedimiento ingresado
	* Retorna:
	*   null: Si no hay subprocedimiento asociados
	*   array: Una matriz con la siguiente informacion en este orden, donde cada fila es un subprocedimiento:
	*     id: Id del tipo de procedimiento
	*     code: Codigo
	*     name: Nombre
	*     price: Precio
	*     active: Activo
	*     procedure:  procedimiento
	*     description: Descripcion
	*/
	function getSubprocedureList($proc){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`code`,`name`,`price`,`active`,`procedure`,`description` 
			FROM `dental`.`subprocedure` WHERE `procedure` = ' . $proc . '';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['code'];
				$list[$i][2] = $row['name'];
				$list[$i][3] = $row['price'];
				$list[$i][4] = $row['active'];
				$list[$i][5] = $row['procedure'];
				$list[$i][6] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	function getSubProcedureName($id){
		$data = null;
		$name = '---';
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `name` FROM `dental`.`subprocedure` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$name = $data['name'];
		}
		mysql_close($link);
		return $name;
	}

	/* Funcion getTimeCount()
	* Retorna la cantidad de tiempos
	* del sistema.
	*/
	function getTimeCount(){
		$data = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`time`';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$data = $row['total'];
		}
		mysql_close($link);
		return $data;
	}
   
	/* getTimeList()
	* Retorna la lista de tiempos
	*/
	function getTimeList(){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`name` FROM `dental`.`time`';
		$result = mysql_query($query,$link);
		$num_rows = mysql_num_rows($result);
		for($i = 0;$i < $num_rows;$i += 1){
			$row = mysql_fetch_array($result);
			$data[$i][0] = $row['id'];
			$data[$i][1] = $row['name'];
		}
		mysql_close($link);
		return $data;
	}
	
	/* getTotalProcedureCount()
	* Retorna la cantidad de procedimientos que se encuentran registrados de acuerdo al tipo de procedimiento indicado
	*/
	function getTotalProcedureCount(){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`procedure`';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
   
	/* getTotalProcedureList()
	* Retorna la lista de los procedimiento que se encuentran en el sistema
	* Retorna:
	*   null: Si no hay tipos de procedimiento en la base de datos
	*   array: Un vector con la siguiente informacion en este orden:
	*     id: Id del tipo de procedimiento
	*     code: Codigo
	*     name: Nombre
	*     price: Precio
	*     active: Activo
	*     proceduretype: Tipo de procedimiento
	*     description: Descripcion
	*/
	function getTotalProcedureList(){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`code`,`name`,`price`,`active`,`proceduretype`,`description` 
			FROM `dental`.`procedure`';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['code'];
				$list[$i][2] = $row['name'];
				$list[$i][3] = $row['price'];
				$list[$i][4] = $row['active'];
				$list[$i][5] = $row['proceduretype'];
				$list[$i][6] = $row['description'];
			}
		}
		mysql_close($link);
		return $list;
	}
   
	/* getUserCount()
	* Retorna la cantidad de usuarios que se encuentran registrados
	*/
	function getUserCount(){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `id` ) AS "total" FROM `dental`.`user`';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
   
	/* getUserData(documenttype,documentnumber)
	* Retorna los datos personales del usuario con tipo de documento y numero ingresados
	* Retorna:
	*   null: Si no correspondencia con el tipo de documento y numero
	*   array: Un vector con la siguiente informacion en este orden:
	*     id: Id del usuario dentro de la base de datos
	*     firstname: Primer nombre
	*     middlename: Segundo nombre
	*     firstlastname: Primer apellido
	*     secondlastname: Segundo apellido
	*     sex: Sexo
	*     documenttype: Tipo de documento
	*     documentnumber: Numero de documento
	*     birthdate: Fecha de nacimiento
	*     bloodtype: Tipo de sangre
	*     address: Direccion
	*     phonehome: Telefono de la casa
	*     phoneoffice: Telefono de la oficina
	*     cellnumber: Numero celular
	*     email: Correo electronico
	*     maritalstatus: Estado civil
	*     dentist: Si es dentista o no
	*     specialty: Id de la especialidad (null si no es dentista)
	*     username: Nombre de usuario
	*     privileges: Privilegios en el sistema
	*     active: estado
	*/
	function getUserData($documenttype,$documentnumber){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`firstname`,`middlename`,`firstlastname`,`secondlastname`,`sex`,`documenttype`,
			`documentnumber`,`birthdate`,`bloodtype`,`address`,`phonehome`,`phoneoffice`,
			`cellnumber`,`email`,`maritalstatus`,`dentist`,`specialty`,`username`,`privileges`,`active` 
			FROM `dental`.`user` 
			WHERE `documenttype` = ' . $documenttype . ' AND `documentnumber` = ' . $documentnumber . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
		}
		mysql_close($link);
		return $data;
	}
   
	/* getUserDataById(id)
	* Retorna los datos personales del usuario con el indice ingresado
	* Retorna:
	*   null: Si no correspondencia con el indice
	*   array: Un vector con la siguiente informacion en este orden:
	*     id: Id del paciente dentro de la base de datos
	*     firstname: Primer nombre
	*     middlename: Segundo nombre
	*     firstlastname: Primer apellido
	*     secondlastname: Segundo apellido
	*     sex: Sexo
	*     documenttype: Tipo de documento
	*     documentnumber: Numero de documento
	*     birthdate: Fecha de nacimiento
	*     bloodtype: Tipo de sangre
	*     address: Direccion
	*     phonehome: Telefono de la casa
	*     phoneoffice: Telefono de la oficina
	*     cellnumber: Numero celular
	*     email: Correo electronico
	*     maritalstatus: Estado civil
	*     dentist: Si es dentista o no
	*     specialty: Id de la especialidad (null si no es dentista)
	*     username: Nombre de usuario
	*     password:
	*     privileges: Privilegios en el sistema
	*     active: estado
	*/
	function getUserDataById($id){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`firstname`,`middlename`,`firstlastname`,`secondlastname`,`sex`,`documenttype`,
			`documentnumber`,`birthdate`,`bloodtype`,`address`,`phonehome`,`phoneoffice`,
			`cellnumber`,`email`,`maritalstatus`,`dentist`,`specialty`,`username`,`password`,`privileges`,`active` 
			FROM `dental`.`user` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
		}
		mysql_close($link);
		return $data;
	}
      
	/* getUserId(documenttype,documentnumber)
	* Busca el valor asignado al usuario dentro de la tabla de usuarios, de acuerdo a su tipo y numero del documento de identificacion.
	* Retorna:
	*   0: No se encontro correspondencia entre el tipo de documento y el numero
	*   #: El indice del usuario en la base de datos si hubo correspondencia entre el tipo de documento y el numero
	*/
	function getUserId($documenttype,$documentnumber){
		$id = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id` FROM `dental`.`user` 
			WHERE `documenttype` = ' . $documenttype . ' AND `documentnumber` = ' . $documentnumber . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$id = $data['id'];
		}
		mysql_close($link);
		return $id;
	}
   
	/* getUserIdByUsername(username)
	* Busca el valor asignado al usuario dentro de la tabla de usuarios, de acuerdo al nombre de usuario
	* Retorna:
	*   0: No se encontro correspondencia con el nombre de usuario
	*   #: El indice del usuario en la base de datos si hubo correspondencia con el nombre de usuario
	*/
	function getUserIdByUsername($username){
		$id = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id` FROM `dental`.`user` WHERE `username` = "' . $username . '"';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$id = $data['id'];
		}
		mysql_close($link);
		return $id;
	}
   
	/* getUserList()
	* Retorna la lista de usuarios registrados en la base de datos
	* Retorna:
	*   null: Si no hay pacientes registrados
	*   array: Una matriz donde cada fila es un paciente.
	*     id: Identificacion
	*     firstname: id del paciente
	*     middlename: id del usuario
	*     firstlastname: fecha del recaudo
	*     secondlastname: valor del recaudo
	*     sex: tipo de recaudo
	*     documenttype: numero de la tarjeta o cheque, de acuerdo a la forma de pago
	*     documentnumber: banco
	*     birthdate: descripcion
	*     bloodtype:
	*     address:
	*     phonehome
	*     phoneoffice
	*     cellnumber
	*     email
	*     maritalstatus
	*     dentist
	*     specialty
	*     username
	*     password
	*     privileges
	*     active
	*/
	function getUserList(){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`firstname`,`middlename`,`firstlastname`,`secondlastname`,`sex`,`documenttype`,
			`documentnumber`,`birthdate`,`bloodtype`,`address`,`phonehome`,`phoneoffice`,
			`cellnumber`,`email`,`maritalstatus`,`dentist`,`specialty`,`username`,`password`,`privileges`,`active` 
			FROM `dental`.`user`';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['id'];
				$list[$i][1] = $row['firstname'];
				$list[$i][2] = $row['middlename'];
				$list[$i][3] = $row['firstlastname'];
				$list[$i][4] = $row['secondlastname'];
				$list[$i][5] = $row['sex'];
				$list[$i][6] = $row['documenttype'];
				$list[$i][7] = $row['documentnumber'];
				$list[$i][8] = $row['birthdate'];
				$list[$i][9] = $row['bloodtype'];
				$list[$i][10] = $row['address'];
				$list[$i][11] = $row['phonehome'];
				$list[$i][12] = $row['phoneoffice'];
				$list[$i][13] = $row['cellnumber'];
				$list[$i][14] = $row['email'];
				$list[$i][15] = $row['maritalstatus'];
				$list[$i][16] = $row['dentist'];
				$list[$i][17] = $row['specialty'];
				$list[$i][18] = $row['username'];
				$list[$i][19] = $row['password'];
				$list[$i][20] = $row['privileges'];
				$list[$i][21] = $row['active'];
			}
		}
		mysql_close($link);
		return $list;
	}
   
	/* getUserLoginData(username)
	* Retorna un arreglo con la informacion de sesion del usuario.
	* Retorna:
	*   null: Si el nombre de usuario no existe
	*   array: Un vector con la siguiente informacion en este orden:
	*     id: Identificacion del usuario dentro de la base de datos
	*     firstname: Primer nombre
	*     middlename: Segundo nombre
	*     firstlastname: Primer apellido
	*     secondlastname: Segundo apellido
	*     sex: Sexo
	*     privileges: Indicador de privilegios
	*/
	function getUserLoginData($username){
		$data = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `id`,`firstname`,`middlename`,`firstlastname`,`secondlastname`,`sex`,`privileges` 
			FROM `dental`.`user` WHERE `username` = "' . $username . '"';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
		}
		mysql_close($link);
		return $data;
	}
  
	/* getUserName(id)
	* Retorna el nombre completo del usuario indicado. En caso de no existir retorna nulo
	*/
	function getUserName($id){
		$data = null;
		$name = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `firstname`,`firstlastname`,`secondlastname` FROM `dental`.`user` WHERE `id` = ' . $id . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$name = $data['firstname'] . ' ' . $data['firstlastname'] . ' ' . $data['secondlastname'];
		}
		mysql_close($link);
		return $name;
	}
	
	function getHour($n){
		$data = null;
		$name = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `name` FROM `dental`.`time` WHERE `id` = ' . $n . '';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$data = mysql_fetch_array($result);
			$name = $data['name'];
		}
		mysql_close($link);
		return $name;
	}
	
	function getDentistCrossCount(){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `specialty`.`id` ) AS "total" FROM `dental`.`specialty` 
				INNER JOIN `dental`.`user` ON `specialty`.`id` = `user`.`specialty`';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	function getDentistCrossList(){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `specialty`.`id` AS "specialty",`specialty`.`name`,`user`.`id` AS "user",`user`.`firstname`,`user`.`firstlastname`,`user`.`secondlastname` 
				FROM `dental`.`specialty` INNER JOIN `dental`.`user` ON `specialty`.`id` = `user`.`specialty` 
				ORDER BY `specialty`.`name`';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['specialty'];
				$list[$i][1] = $row['name'];
				$list[$i][2] = $row['user'];
				$list[$i][3] = $row['firstname'];
				$list[$i][4] = $row['firstlastname'];
				$list[$i][5] = $row['secondlastname'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	function getProceduretypeCrossCount(){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `proceduretype`.`id` ) AS "total"
				FROM `dental`.`proceduretype` 
				INNER JOIN `dental`.`procedure` ON `proceduretype`.`id` = `procedure`.`proceduretype`';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	function getProceduretypeCrossList(){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `proceduretype`.`id` AS "proceduretype",`proceduretype`.`name` AS "typename",`procedure`.`id` AS "procedure",`procedure`.`name` AS "procname"
				FROM `dental`.`proceduretype` 
				INNER JOIN `dental`.`procedure` ON `proceduretype`.`id` = `procedure`.`proceduretype` 
				ORDER BY `proceduretype`.`id`,`procedure`.`id`';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['proceduretype'];
				$list[$i][1] = $row['typename'];
				$list[$i][2] = $row['procedure'];
				$list[$i][3] = $row['procname'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
	
	
	function getProcedureCrossCount(){
		$total = 0;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT COUNT( `procedure`.`id` ) AS "total"
				FROM `dental`.`procedure` 
				INNER JOIN `dental`.`subprocedure` ON `procedure`.`id` = `subprocedure`.`procedure`';
		$result = mysql_query($query,$link);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$total = $row['total'];
		}
		mysql_close($link);
		return $total;
	}
	
	function getProcedureCrossList(){
		$list = null;
		$link = mysql_connect(self::DB_SERVER,self::DB_USERNAME,self::DB_PASSWORD);
		mysql_select_db(self::DB_NAME,$link);
		$query = 'SELECT `procedure`.`id` AS "procedure",`procedure`.`name` AS "procname",`subprocedure`.`id` AS "subprocedure",`subprocedure`.`name` AS "subname"
				FROM `dental`.`procedure` 
				INNER JOIN `dental`.`subprocedure` ON `procedure`.`id` = `subprocedure`.`procedure` 
				ORDER BY `procedure`.`id`,`subprocedure`.`id`';
		$result = mysql_query($query,$link);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			for($i = 0;$i < $rows;$i += 1){
				$row = mysql_fetch_array($result);
				$list[$i][0] = $row['procedure'];
				$list[$i][1] = $row['procname'];
				$list[$i][2] = $row['subprocedure'];
				$list[$i][3] = $row['subname'];
			}
		}
		mysql_close($link);
		return $list;
	}
	
  
}
?>