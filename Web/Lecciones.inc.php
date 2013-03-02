<?
if (__Lecciones_inc == 1)
	return;
define ('__Lecciones_inc', 1);

	include('Usuarios.inc.php');
	include('Conexion.inc.php');

function LeccionVisita($Id) {
	Conectar();
	mysql_query("update lecciones set Visitas = Visitas + 1 where Id = $Id");
	Desconectar();
}

?>