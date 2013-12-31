<?php
    include_once('Settings.inc.php');
    
	include_once('Conexion.inc.php');
	include_once('Sesion.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Categorias.inc.php');
	include_once('Paginas.inc.php');

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