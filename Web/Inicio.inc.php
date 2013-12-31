<?php
	include_once($PaginaPrefijo.'Usuarios.inc.php');
	include_once($PaginaPrefijo.'Paginas.inc.php');
	include_once($PaginaPrefijo.'Cache.inc.php');
	include_once($PaginaPrefijo.'Google.inc.php');
?>

<html>
<head>

<title><?php echo $PaginaTitulo; ?></title>

<META name="title" content="todocontenidos">
<META name="description" content="contenidos en internet">
<META name="keywords" content="contenidos, internet, negocios, empleo, recursos">
<META name="language" content="es">
<META name="revisit-after" content="2 days">
<META name="rating" content="General">
<META name="author" content="Angel J Lopez">
<META name="owner" content="Angel J Lopez">
<META name="robot" content="index, follow">
<meta name="verify-v1" content="+QxaBG2H5WRJhkcP41CxvhQMoXO4x9JgnbJwGKq2KUY=" />

<link rel="stylesheet" href="<?php echo $PaginaPrefijo; ?>css/Estilo.css">

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write("\<script src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'>\<\/script>" );
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-3235626-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>

<?php
	if ($ArchivoJs)
		echo "<script language='javascript' src='js/$ArchivoJs'></script>\n";
?>
</head>

<body bgcolor=#ffffff leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>

<table width="100%" class="Tope" cellspacing=0 cellpadding=0 border=0>
<tr height=60>
<td class="TituloSitio">
<!-- &nbsp;todocontenidos.com -->
<a href="<?php echo PaginaPrincipal(); ?>" target="_top">
<img src="<?php echo $PaginaPrefijo; ?>images/todocontenidos2.gif" border=0>
</a>
</td>
</tr>
<tr>
<td>

<table width=100% bgcolor=black cellspacing=1 cellpadding=0>
<tr>
<td bgcolor="#e71212" align=right>
<font class=headerU><b>Internet que sirve</b>&nbsp;&nbsp;&nbsp;&nbsp;</font>
</td>
</table>

</td>
</tr>

<tr>
<td align="center">

<table cellspacing=2 cellpadding=0 border=0>

<tr>

<?php
function GeneraOpcionTope($texto,$enlace)
{
	global $PaginaPrefijo;
?>

<TD WIDTH=117>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
<TBODY>
<TR bgColor=#454543>
<TD width=1 bgColor=#454543 rowSpan=3><IMG height=1 src="images/1x1.gif" width=1></TD>
<TD><IMG height=1 src="images/1x1.gif" width=1></TD>
<TD width=1 bgColor=#454543 rowSpan=3><IMG height=1 src="images/1x1.gif" width=1></TD>
</TR>
<TR>
<TD align=middle width=117 bgColor=#dedede height=18><A class=linkonHdr href="<?php echo $PaginaPrefijo.$enlace; ?>"><?php echo $texto; ?></A></TD>
</TR>
<TR bgColor=#454543>
<TD><IMG height=1 src="images/1x1.gif" width=1></TD>
</TR>
</TBODY>
</TABLE>
</TD>

<?php
}
?>

<?php
	GeneraOpcionTope("Principal",PaginaPrincipal());
//	GeneraOpcionTope("Cursos","CursosMuestra.php");
	GeneraOpcionTope("Temas","Temas.php");
	if (UsuarioIdentificado())
		GeneraOpcionTope("Mis Contenidos","UsuarioPagina.php");
	else
		GeneraOpcionTope("Mis Contenidos","UsuarioPaginaNo.php");
	if (UsuarioIdentificado())
		GeneraOpcionTope("Mis Favoritos","UsuarioFavoritos.php");
	else
		GeneraOpcionTope("Mis Favoritos","UsuarioFavoritosNo.php");
?>

</tr>


</td>
</tr>

</table>

<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>

<td width=120 height=500 valign="top" class="izquierda">

<br>

<center>

<?php
function MenuInicio($titulo)
{
?>
<p>
<table class="menu" cellspacing=1 cellpadding=2 width="95%">
<tr>
<td align=center class="menutitulo">
<?php echo $titulo; ?>
</td>
</tr>
</tr>
<td valign="top" class="menuopcion">
<?php
}

function MenuOpcion($texto,$enlace)
{
	global $PaginaPrefijo;

	echo "&nbsp;&nbsp;<strong>·</strong>&nbsp;&nbsp;";
	echo "<a href='$PaginaPrefijo$enlace' class='menuopcion'>$texto</a>";
	echo "<br>\n";
}

function MenuFinal()
{
?>
</td>
</tr>
</table>

<br>
<br>

</p>

<?php
}
?>

<?php
	if (UsuarioIdentificado()) {
		MenuInicio('Usuario');
		echo "<div align='center'>";
		echo "<font color='#cc0000'><b>" . UsuarioCodigo() . "</b></font></div>\n";
		echo "</td></tr><tr><td valign=top class=menuopcion>";
		MenuOpcion('Mis Contenidos','UsuarioPagina.php');
//		MenuOpcion('Mis Cursos','UsuarioCursos.php');
		MenuOpcion('Mis Datos', 'Usuario.php');
		MenuOpcion('Mis Preferencias', 'UsuarioPreferencias.php');
		MenuOpcion('Mis Favoritos', 'UsuarioFavoritos.php');
		MenuOpcion('Mis Puntos', 'UsuarioPuntos.php');
		if (EsAdministrador()) {
			MenuOpcion('Administraci&oacute;n','Administrador.php');
			MenuOpcion('Usuarios','Usuarios.php');
			MenuOpcion('Cursos','Cursos.php');
			MenuOpcion('Categor&iacute;as','Categorias.php');
			MenuOpcion('Art&iacute;culos','Articulos.php');
			MenuOpcion('Items','Items.php');
			MenuOpcion('Eventos','Eventos.php');
			MenuOpcion('Ingresos','Eventos.php?Tipo=IN');
			MenuOpcion('Registraciones','Eventos.php?Tipo=RG');
		}
		MenuOpcion('Recomendar', 'Recomendar.php');
		MenuOpcion('Salir', 'UsuarioSalir.php');
		MenuFinal();
	}
	else if (!$NoUsuario) {
		MenuInicio('Usuarios');
		echo "<div align=center>\n";
		echo "<form action='UsuarioValida.php' method='post'>\n";
		echo "C&oacute;digo<br>\n";
		echo "<input style='font-size: 8pt;' type=text name=Codigo size=14><br>\n";
		echo "Contrase&ntilde;a<br>\n";
		echo "<input style='font-size: 8pt;' type=password name=Contrasenia size=14><br>\n";
		echo "<input style='font-size: 8pt;' type=submit value='Ingresar'>\n";
		echo "</form>\n";
		echo "</div>\n";
		echo "<p>";
		MenuOpcion('Registrarse', 'UsuarioActualiza.php');
		MenuOpcion('Recomendar', 'Recomendar.php');
		MenuFinal();
	}
/*
	MenuInicio('Cursos');
	MenuOpcion('Todos','CursosMuestra.php');
	MenuOpcion('Inform&aacute;tica','CursosMuestra.php?IdCategoria=1');
	MenuOpcion('Internet','CursosMuestra.php?IdCategoria=2');
	MenuOpcion('Gratuitos','CursosGratuitos.php');
	MenuFinal();
*/
	MenuInicio('Temas');
	MenuOpcion('Todos','Temas.php');
	MenuOpcion('Ciencia','Tema.php?Id=1');
	MenuOpcion('Computaci&oacute;n','Tema.php?Id=10');
	MenuOpcion('Dinero','Tema.php?Id=114');
	MenuOpcion('Educaci&oacute;n','Tema.php?Id=6');
	MenuOpcion('Empleo','Tema.php?Id=5');
	MenuOpcion('Emprendedores','emprendedores');
	MenuOpcion('Entretenimiento','Tema.php?Id=7');
	MenuOpcion('Internet','Tema.php?Id=2');
	MenuOpcion('Negocios','Tema.php?Id=4');
	MenuOpcion('Salud','Tema.php?Id=18');
	MenuOpcion('Tecnolog&iacute;a','Tema.php?Id=111');
	MenuFinal();

/*
	MenuInicio('Oportunidades');
	MenuOpcion('Gane Puntos','Puntos.php');
	MenuOpcion('Afiliados', 'Afiliados.php');
	MenuOpcion('Webmasters', 'Webmasters.php');
	MenuOpcion('Publicidad', 'Publicidad.php');
	MenuFinal();
*/
?>

<?php
	ShowGoogleV();
?>

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

