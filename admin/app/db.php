<?php
// variables data base

//define ('DB_HOST', '127.0.0.1');
define ('DB_HOST', 'database');
define ('DB_USER', 'root');
define ('DB_PASSWORD', 'tiger');

define ('DB_DATABASE', 'genesis');

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

/**
 * habre una conexion y selecciona la base de datos
 */
function db_connect () {
	if (!($link = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD))) {
		echo '<div style="background: #f2f5fe;"><center><h1 style="margin-top:100px;">Error: Base de datos indispuesta. Comuniquese 
						con el Operador Autorizado: <br/><br/> SIA-WEB Development 70359457
			  </h1></center></div>';
		exit ();
	}
	
	if (!mysqli_select_db ($link, DB_DATABASE)) {
		echo '<div style="position:absolute; margin-top:0px;background: #f2f5fe; width: 100%; height: 100%;"><center><h1 style="margin-top:100px;">Error: Base de datos indispuesta para la seleccion. Comuniquese 
						con el Operador Autorizado
			  </h1></center></div>';
		exit ();
	}
	
	mysqli_set_charset ($link, 'utf8');

	return $link;
}

/**
 * cierra la conexion
 */
function db_close () { mysqli_close (); }

/**
 * debuelve la fecha y hora actual 
 */
function db_now () {
	$date = "";
	$table = db_query ("select NOW()");
	if ($table) if ($row = db_fetch_array ($table)) {
		$date = $row[0];
	}
	
	return $date;
}

/**
 * debuelve la fecha y hora actual 
 */
function db_now_date () {
	$date = "";
	$table = db_query ("select CURDATE()");
	if ($table) if ($row = db_fetch_array ($table)) {
		$date = $row[0];
	}
	
	return $date;
}

/**
 * verifica si la consulta tiene al menos una tupla
 * @param String $query
 */
function db_exist ($query) {
	if ($result = db_query ($query)) if (db_fetch ($result)) {
		db_free ($result);
		return true;
	}
	return false;
}

/**
 * consulta la base de datos
 * @param String $query
 */
function db_query ($query) { return mysqli_query (mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE), $query); } 

/*
* devuelbe una tupla de la base de datos introduciendo la consulta 
* @param String $query
*/
function db_result($query,$i,$data){ mysql_result($query, $i, $data); }
/**
 * consulta la base de datos sin buffer
 * @param String $query
 */
function db_unbuffered_query ($query) { return mysql_unbuffered_query ($query); }

/**
 * libera el resultado de una consulta
 */
function db_free ($result) {
	if ($result != null)
	return mysqli_free_result ($result);
	else return null;
}

// obtiene la fila siiguiente as array asosiado
/**
 * devuelbe un arreglo asociado php, vease mysql_fetch_assoc
 * @param $result
 */
//function db_fetch ($result) { if ($result == NULL) return false; return mysql_fetch_assoc ($result); }
function db_fetch ($result) { if ($result == NULL) return false; return mysqli_fetch_assoc ($result); }

/**
 * devuelbe un arreglo indexado, vease mysql_fetch_array
 * @param $result
 */
//function db_fetch_array ($result) { if ($result == NULL) return false; return mysql_fetch_array ($result); }
function db_fetch_array ($result) { if ($result == NULL) return false; return mysqli_fetch_array ($result); }

/**
 * cuenta el numero de filas del resultado
 * @param $result
 */
function db_number_row ($result) { return mysqli_num_rows ($result); }

/**
 * cuenta el numero de columnas del resultado
 */
function db_number_field ($result) { return mysqli_num_fields ($result); }

/**
 * numero de filas afectadas
 */
function db_affected () { return mysqli_affected_rows (); }

/**
 * obtiene el nombre de la columna
 * @param $result
 * @param $field_index
 */
function db_field_name ($result, $field_index) { return mysql_field_name ($result, $field_index); }

/**
 * obtiene el tipo de la columna
 * @param $result
 * @param $field_index
 */
function db_field_type ($result, $field_index) { return mysql_field_type ($result, $field_index); }

/**
 * debuelve el ultimo id asignado
 */
function db_insert_id () { return mysqli_insert_id (); }

/**
 * verifica coneccion con la base de datos
 */
function db_ping () { return mysqli_ping (); }

/**
 * devuelve el mensaje de error de la ultima operacion
 */
function db_error () { return mysqli_error (); }

/**
 * debuelve el codigo de errores
 */
function db_errno () { return mysqli_errno (); }

/**
 * status actual del sistema
 */
function db_stat () { return mysqli_stat (); }

/**
 * detalle ultima consulta
 */
function db_info () { return mysqli_info (); }

?>