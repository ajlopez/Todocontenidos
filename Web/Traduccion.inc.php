<?php
if (__Traduccion_inc == 1)
	return;
define ('__Traduccion_inc', 1);

include_once('Conexion.inc.php');

function TraduccionCarga($tabla,$campo='Descripcion')
{
	$vector = Array();

	Conectar();

	$rs = mysql_query("select id, $campo from $tabla order by id");

	while (list($Clave, $Dato) = mysql_fetch_row($rs))
		$vector[$Clave] = $Dato;

	mysql_free_result($rs);

	Desconectar();

	return $vector;
}

function TraduceArticuloClase($Id)
{
	if (!$Id)
		return '';
	Conectar();
	$rs = mysql_query("select descripcion from articulosclases where Id = $Id");
	if ($rs && mysql_num_rows($rs))
		list($Descripcion) = mysql_fetch_row($rs);
	mysql_free_result($rs);
	Desconectar();
	return $Descripcion;
}


?>