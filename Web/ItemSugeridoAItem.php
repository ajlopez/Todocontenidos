<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Utiles.inc.php');
	include('Categorias.inc.php');
	include('Items.inc.php');
	include('Usuarios.inc.php');

	AdministradorControla('');

	Conectar();

	$sql = "select Descripcion, Detalle, Url, IdUsuario, IdCategoria
		 from itemssugeridos where Id = $Id";		 

	$res = mysql_query($sql);
	list($Descripcion, $Detalle, $Url, $IdUsuario, $IdCategoria)
		= mysql_fetch_row($res);
	mysql_free_result($res);

	$Descripcion = addslashes($Descripcion);
	$Detalle = addslashes($Detalle);

	$sql = "insert items set Descripcion = '$Descripcion', 
		Detalle = '$Detalle',
		Url = '$Url',
		IdUsuario = $IdUsuario,
		Orden = 2,
		FechaHora = Now()";

	mysql_query($sql);

	$IdItem = mysql_insert_id();

	if ($IdCategoria)
		mysql_query("insert categoriasitems set IdItem = $IdItem, IdCategoria = $IdCategoria");

	Desconectar();

	header('Location: Item.php?Id='.$IdItem);
?>