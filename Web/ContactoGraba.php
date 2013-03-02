<?
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');
	include('Validaciones.inc.php');

	$PaginaTitulo = "Cont&aacute;ctenos";

	if (!$Email)
		$mensaje .= "Debe ingresar Email<br>";

	if (!$Motivo)
		$mensaje .= "Debe ingresar Motivo<br>";

	if (!$Texto)
		$mensaje .= "Debe ingresar el Texto de la Consulta<br>";

	if ($mensaje)
		ErrorMuestra($mensaje);	

	Conectar();

	$IdUsuario = UsuarioId() + 0;

	$sql = "Insert contactos set IdUsuario = $IdUsuario,
		FechaHora = Now(),
		Email = '$Email',
		Motivo = '$Motivo',
		Texto = '$Texto'";

	mysql_query($sql);

	if (mysql_errno())
		echo mysql_error();

	$Id = mysql_insert_id();

	require('Inicio.inc.php');
?>

<p>
Su consulta ha sido registrada. Le contestaremos a la brevedad.
</p>

<?
	Desconectar();
	require('Final.inc.php');
?>

