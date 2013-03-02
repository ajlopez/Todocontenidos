<?
	include($PaginaPrefijo.'Paginas.inc.php');
	include($PaginaPrefijo.'Usuarios.inc.php');
?>
<p>&nbsp;</p>


<p align="center" class="Pie">
<?
function GeneraOpcionPie($texto,$enlace) {
	global $PaginaPrefijo;
?>
<a href="<? echo $PaginaPrefijo.$enlace; ?>"><? echo $texto; ?></a>
&nbsp;&nbsp;
<?
}

	GeneraOpcionPie("Principal", PaginaPrincipal());
	GeneraOpcionPie("Cursos", "CursosMuestra.php");
	GeneraOpcionPie("Temas", "Temas.php");
	if (!UsuarioIdentificado()) {
		GeneraOpcionPie("Ingrese", "UsuarioIdentifica.php");
		GeneraOpcionPie("Registrarse", "UsuarioActualiza.php");
		GeneraOpcionPie("Mis Contenidos", "UsuarioPaginaNo.php");
	}
	else {
		GeneraOpcionPie("Mis Contenidos", "UsuarioPagina.php");
		if (EsAdministrador())
			GeneraOpcionPie("Administraci&oacute;n", "Administrador.php");
		GeneraOpcionPie("Salir", "UsuarioSalir.php");
	}
	echo "<br>";
//	GeneraOpcionPie("Mapa del Sitio", "Mapa.php");
//	GeneraOpcionPie("Preguntas Frecuentes", "Preguntas.php");
	GeneraOpcionPie("Cont&aacute;ctenos", "Contacto.php");
//	GeneraOpcionPie("Ayuda", "Ayuda.php");
?>

</p>
<br>
<br>

