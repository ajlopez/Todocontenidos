<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Validaciones.inc.php');
	include('Categorias.inc.php');

	AdministradorControla('');

	if (!$Descripcion)
		$mensaje .= "Debe ingresar Descripci&oacute;n<br>";

	if ($mensaje)
		ErrorMuestra($mensaje);	

	Conectar();

	if (isset($Id))
		$sql = "Update categorias Set ";
	else
		$sql = "Insert categorias Set ";

	$IdPadre += 0;

	if ($IdPadre) {
		$rsPadre = mysql_query("select Estado from categorias where Id = $IdPadre");
		list($Estado) = mysql_fetch_row($rsPadre);
		mysql_free_result($rsPadre);
	}
	else
		$Estado = CATEGORIAS_ESTADO_NORMAL;

	$sql = $sql .  "
		Descripcion = '$Descripcion', 
		Detalle = '$Detalle',
		Resumen = '$Resumen',
		Terminos = '$Terminos',
		IdPadre = $IdPadre,
		Alias = '$Alias',
		Estado = $Estado";

	if (isset($Id))
		$sql = $sql . " where Id = $Id";

	mysql_query($sql);
	$id = mysql_insert_id();

	$CategoriaEnlace = SesionToma("CategoriaEnlace");
	SesionSaca("CategoriaEnlace");

	if (!$CategoriaEnlace)
		$CategoriaEnlace = "Categorias.php";

	header("Location: $CategoriaEnlace");
	exit;
?>