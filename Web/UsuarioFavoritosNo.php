<?
	include('Sesion.inc.php');
	include('Conexion.inc.php');
	include('Usuarios.inc.php');
	include('Paginas.inc.php');

	$PaginaTitulo = 'Mis Favoritos';

	include('Inicio.inc.php');
?>

<p>
<a href="UsuarioActualiza.php">Registr&aacute;ndose</a> como usuario, tendr&aacute; acceso a
<b>Mis Favoritos</b>, donde podrá consultar cuando quiera los enlaces que haya elegido como favoritos
.

<p>
Con este servicio, puede mantener su lista privada de sitios preferidos y consultarla desde
cualquier computador conectado a la Internet.
</p>

<p>
Si Ud. ya est&aacute; registrado, ingrese su c&oacute;digo y contrase&ntilde;a. Si no lo est&aacute;, puede
<a href="UsuarioActualiza.php">registrarse gratuitamente</a> en l&iacute;nea.

<?
	include('Final.inc.php');
?>
