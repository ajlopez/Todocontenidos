<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Validaciones.inc.php');
	include('Usuarios.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;

	$sql = "Delete from categoriasitems where id = $Id";

	mysql_query($sql);

	$ArticuloEnlace = SesionToma("ArticuloEnlace");
	SesionSaca("ArticuloEnlace");

	if ($IdItem)
		PaginaRedireccionar("Item.php?Id=$IdItem");
	if ($IdCategoria)
		PaginaRedireccionar("Categoria.php?Id=$IdCategoria");

	PaginaRedireccionar($ArticuloEnlace,"Articulos.php");
?>