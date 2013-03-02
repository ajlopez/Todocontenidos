<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Validaciones.inc.php');
	include('Usuarios.inc.php');

	AdministradorControla('');

	if (!$Descripcion)
		$mensaje .= "Debe ingresar Descripci&oacute;n<br>";

	if (!$Url)
		$mensaje .= "Debe ingresar Enlace<br>";

	if ($mensaje)
		ErrorMuestra($mensaje);	

	$Orden += 0;

	Conectar();

	if (isset($Id))
		$sql = "Update items Set ";
	else
		$sql = "Insert items Set IdUsuario = " . (UsuarioId()+0) . ", ";

	if (!EsAdministrador() && !$Id)
		$sql .= "IdEstado = 1,";

	$sql = $sql .  "
		Descripcion = '$Descripcion', 
		Detalle = '$Detalle',
		Orden = $Orden,
		Url = '$Url'";

	if (isset($Id))
		$sql = $sql . " where Id = $Id";

	mysql_query($sql);
	$IdNuevo = mysql_insert_id();

	if (!$Id && $IdCategoria) {
		$sql = "Insert categoriasitems Set IdCategoria = $IdCategoria, IdItem = $IdNuevo";
		mysql_query($sql);
	}

	$ItemEnlace = SesionToma("ItemEnlace");
	SesionSaca("ItemEnlace");

	if (!$ItemEnlace)
		$ItemEnlace = "Items.php";

	header("Location: $ItemEnlace");
	exit;
?>