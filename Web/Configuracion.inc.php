<?

if (__Configuracion_inc == 1) return;

define ('__Configuracion_inc', 1);

$MySqlHost = 'localhost';
$MySqlBase = 'todocontenidos';
$MySqlUser = 'root';
$MySqlPwd = '';

$Host = $HTTP_SERVER_VARS["HTTP_HOST"];

$EsLocal = 1;

switch ($Host)
{

}

function EsLocal() {
	global $EsLocal;
	global $Host;

//	return $EsLocal;

	if (strstr($Host,"127.0.0.1") || strstr($Host,"localhost"))
		return true;

	return false;
}

function EsGeo() {
	global $EsLocal;
	global $Host;

	if (strstr($Host,"207.153.232.30"))
		return true;

	if (strstr($Host,"latnetwork"))
		return true;

	if (strstr($Host,"209.152.174.128"))
		return true;

	if (strstr($Host,"todocontenidos.com"))
		return true;

	return false;
}


if (EsLocal()) {
	$MySqlHost = 'localhost';
	$MySqlBase = 'todocontenidos';
	$MySqlUser = 'root';
	$MySqlPwd = '';
}

if (EsGeo()) {
	// To be configured
	$MySqlHost = 'localhost';
	$MySqlBase = 'todocontenidos';
	$MySqlUser = 'root';
	$MySqlPwd = '';
}

?>