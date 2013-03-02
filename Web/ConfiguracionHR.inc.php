<?

if (__Configuracion_inc == 1) return;

define ('__Configuracion_inc', 1);

$MySqlHost = 'localhost';
$MySqlBase = 'todocon_todocontenidos';
$MySqlUser = 'todocon_contenid';
$MySqlPwd = 'todocontenidos';

$Host = $HTTP_SERVER_VARS["HTTP_HOST"];

$EsLocal = 1;

switch ($Host)
{

}

function EsLocal() {
	global $EsLocal;

	return $EsLocal;
}

?>