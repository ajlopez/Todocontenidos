<?
	include('Conexion.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');
	include('Items.inc.php');
	include('Paginas.inc.php');

	Conectar();

	AdministradorControla();

	$Id += 0;

/*
	IdClase
	Descripcion
	Detalle
	IdUsuario
	Url
	Orden
	Visitas
	Votos1
	Votos2
	Votos3
	Votos4
	Votos5
	Imagen
	Estado

	Titulo
	IdClase
	Contenido
	Resumen
	IdUsuario
	Visitas
	Votos
	Votos1
	Votos2
	Votos3
	Votos4
	Votos5
	Imagen
	IdEstado
*/

	$rsItem = mysql_query("select * from items where Id = $Id");

	$item = mysql_fetch_object($rsItem);
/*
	echo "insert articulos set Titulo = '" . addSlashes($item->Descripcion) ."',
		Resumen = '" . addSlashes($item->Detalle) ."',
		IdUsuario = $item->IdUsuario,
		Enlace = '$item->Url',
		Orden = $item->Orden,
		Visitas = $item->Visitas,
		Votos1 = $item->Votos1,
		Votos2 = $item->Votos2,
		Votos3 = $item->Votos3,
		Votos4 = $item->Votos4,
		Votos5 = $item->Votos5,
		IdEstado = $item->Estado";
*/
	mysql_query("insert articulos set Titulo = '" . addSlashes($item->Descripcion) ."',
		Resumen = '" . addSlashes($item->Detalle) ."',
		IdUsuario = $item->IdUsuario,
		Enlace = '$item->Url',
		Orden = $item->Orden,
		Visitas = $item->Visitas,
		Votos1 = $item->Votos1,
		Votos2 = $item->Votos2,
		Votos3 = $item->Votos3,
		Votos4 = $item->Votos4,
		Votos5 = $item->Votos5,
		IdEstado = $item->Estado");

	if (mysql_errno()) {
		echo mysql_error();
		exit();
	}

	$IdNuevo = mysql_insert_id();

	$rsCategorias = mysql_query("select IdCategoria, Estado from categoriasitems where IdItem = $Id");

	while (list($IdCategoria,$CatEstado) = mysql_fetch_row($rsCategorias))
		mysql_query("insert categoriasarticulos set IdCategoria = $IdCategoria, IdArticulo = $IdNuevo, Estado = $CatEstado");

	mysql_query("delete from categoriasitems where IdItem = $Id");
	mysql_query("delete from items where Id = $Id");

	mysql_query("update eventos set IdParametro = $IdNuevo, Tipo = 'AR' where IdParametro=$Id and Tipo='IT'");
	mysql_query("update eventos set IdParametro = $IdNuevo, Tipo = 'VA' where IdParametro=$Id and Tipo='VI'");
	
	Desconectar();

	PaginaRedireccionar("Articulo.php?Id=$IdNuevo");
?>