<?
	include_once('Buscar.inc.php');
	include_once('Conexion.inc.php');

	if (!$IdCategoria)
		exit;

	Conectar();

	$rs = mysql_query("select Id, Descripcion, Terminos from categorias where Id=$IdCategoria");
	list($Id,$Descripcion,$Terminos) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	if (!$Terminos)
		$Terminos = $Descripcion;

	ProcesarItems($IdCategoria,$Terminos);

	Desconectar();

	header('Location: Categoria.php?Id='.$IdCategoria);
?>
