<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');
	include('Validaciones.inc.php');

	$PaginaTitulo = "Sugiere Sitio o Enlace";

	if (!$IdCategoria)
		$mensaje .= "Debe ingresar Tema<br>";		

	if (!$Descripcion)
		$mensaje .= "Debe ingresar Descripci&oacute;n<br>";

	if (!$Url)
		$mensaje .= "Debe ingresar Enlace<br>";

	if (!$Detalle)
		$mensaje .= "Debe ingresar Detalle<br>";

	if ($mensaje)
		ErrorMuestra($mensaje);	

	Conectar();

	$IdUsuario = UsuarioId() + 0;
	$IdCategoria = $IdCategoria + 0;

	$sql = "Insert itemssugeridos set IdUsuario = $IdUsuario,
		IdCategoria = $IdCategoria,
		FechaHora = Now(),
		Descripcion = '$Descripcion',
		Url = '$Url',
		Detalle = '$Detalle',
		Estado = 0";

	mysql_query($sql);

	if (mysql_errno())
		echo mysql_error();

	$Id = mysql_insert_id();

	require('Inicio.inc.php');
?>

<p>
Su sugerencia ha sido registrada. La procesaremos a la brevedad.
</p>

<?
	Desconectar();
	require('Final.inc.php');
?>

