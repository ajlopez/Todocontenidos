<?php
	include_once("Usuarios.inc.php");
	include_once("Paginas.inc.php");
	include_once('Cache.inc.php');
?>

<html>
<head>

<title><?php echo $PaginaTitulo; ?></title>
<link rel="stylesheet" href="css/Estilo.css">
</head>

<body bgcolor=#ffffff leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>

<table width="100%" class="Tope" cellspacing=0 cellpadding=0 border=0>
<tr height=60>
<td class="TituloSitio">
<!-- &nbsp;todocontenidos.com -->
<img src="images/todocontenidos2.gif">
</td>
<td class="Tope" align=right>
<?php
	if (UsuarioIdentificado()) {
?>
<font size=1>
Usuario: <?php echo UsuarioCodigo(); ?>
<br>
Nombre: <?php echo UsuarioNombre(); ?> <?php echo UsuarioApellido(); ?>
</font>
<?php
	}
?>
</td>
</tr>
<tr>
<td align="right" style="Font-Family: Arial; Font-Size: 16pt; Color: black;">
Internet que sirve
</td>
<td>&nbsp;</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>

<td width=120 height=500 valign="top" class="izquierda">

<br>

<center>

<table border=0 cellspacing=2 cellpadding=2 width=95%>

<?php
function GeneraOpcion($texto,$enlace) {
?>
<tr>
<td class="opcion" align="center">
<a class="opcion" href="<?php echo $enlace; ?>"><?php echo $texto; ?></a>
</td>
</tr>
<?php
}

	GeneraOpcion("Principal", PaginaPrincipal());
	GeneraOpcion("Cursos", "CursosMuestra.php");
	GeneraOpcion("Temas", "Temas.php");
	if (EsAdministrador())
		GeneraOpcion("Administraci&oacute;n", "Administrador.php");
	if (UsuarioIdentificado()) {
		GeneraOpcion("Mi P&aacute;gina", "UsuarioPagina.php");
		GeneraOpcion("Salir", "UsuarioSalir.php");
	}
	else {
		GeneraOpcion("Ingrese", "UsuarioIdentifica.php");
		GeneraOpcion("Reg&iacute;strese", "UsuarioActualiza.php");
	}
	GeneraOpcion("Ayuda", "Ayuda.php");
?>

</table>

</center>

</td>

<td valign="top">

<table width=100% cellspacing=10 border=0 cellpadding=0>
<tr>
<td>

<p>

<?php
	if (!$PaginaTituloInvisible) {
?>
<h1 align="center"><?php echo $PaginaTitulo ?></h1>
<?php
	}
?>

