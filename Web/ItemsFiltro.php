<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Usuarios.inc.php');
	include('Sesion.inc.php');

	$PaginaTitulo = "Items";

	AdministradorControla();

	Conectar();

	require('Inicio.inc.php');
?>
<center>

<p>
<form method=post action="Items.php">
<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	CampoTextoGenera("Palabra","Palabra Clave",$Palabra,40);
	CampoTextoGenera("Descripcion","Descripci&oacute;n",$Descripcion,40);
	CampoTextoGenera("Categoria","Categor&iacute;a",$Categoria,60);
	CampoTextoGenera("Enlace","Enlace",$Enlace,60);
	CampoAceptarGenera();
?>
</table>
<input type="hidden" name="Filtro" value="1">
</form>
</p>
</center>

<?
	require('Final.inc.php');

	Desconectar();
?>

