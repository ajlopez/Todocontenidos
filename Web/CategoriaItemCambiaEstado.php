<?
	include('Conexion.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');
	include('Categorias.inc.php');
	include('Paginas.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;
	$Estado += 0;

	mysql_query("update categoriasitems set Estado = $Estado where Id = $Id");

	Desconectar();

	if ($IdCategoria)
		PaginaRedireccionar("Categoria.php?Id=$IdCategoria");
	if ($IdItem)
		PaginaRedireccionar("Item.php?Id=$IdItem");
	PaginaSalir();
?>