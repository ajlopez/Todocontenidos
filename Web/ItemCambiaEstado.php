<?
	include('Conexion.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');
	include('Items.inc.php');
	include('Paginas.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;
	$Estado += 0;

	ItemPoneEstado($Id,$Estado);

	Desconectar();

	PaginaRedireccionar("Item.php?Id=$Id");
?>