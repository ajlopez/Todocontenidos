<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Validaciones.inc.php');
	include('Usuarios.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;

	$sql = "Delete from articulos where id = $Id";

	mysql_query($sql);

	$sql = "Delete from categoriasarticulos where IdArticulo = $Id";
	mysql_query($sql);

	mysql_query($sql);

	PaginaRedireccionar("Articulos.php");
?>