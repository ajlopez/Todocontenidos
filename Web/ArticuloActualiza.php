<?php
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');

	AdministradorControla('');

	Conectar();
	
	if (isset($Id)) {
		$sql = "select Titulo, IdClase, Resumen, Copete, Contenido, Imagen, Enlace, VigenciaDesde, VigenciaHasta from articulos where Id = $Id";
		$rs = mysql_query($sql);
		list($Titulo, $IdClase, $Resumen, $Copete, $Contenido, $Imagen, $Enlace, $VigenciaDesde, $VigenciaHasta) = mysql_fetch_row($rs);
		mysql_free_result($rs);
		$PaginaTitulo = "Actualiza Art&iacute;culo";
		$EsNuevo = 0;
	}	
	else {
		$PaginaTitulo = "Nuevo Art&iacute;culo";
		$EsNuevo = 1;
	}

	$rsClases = mysql_query("select id, descripcion from articulosclases order by id");

	include('Inicio.inc.php');
?>

<center>

<p>
<?php
	if (!$EsNuevo) {
?>
&nbsp;
&nbsp;
<a href="Articulo.php?Id=<?php echo $Id; ?>">Art&iacute;culo</a>
&nbsp;
&nbsp;
<a href="ArticuloElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
<?php
	}
?>
</p>

<p>

<form action="ArticuloGraba.php" method=post>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?php
	if (!$EsNuevo)
		CampoEstaticoGenera("Id",$Id);
	CampoTextoGenera("Titulo","T&iacute;tulo",$Titulo,40);
	CampoComboRsGenera("IdClase","Clase", $rsClases, $IdClase);
	CampoMemoGenera("Resumen","Resumen",$Resumen);
	CampoMemoGenera("Copete","Copete",$Copete);
	CampoMemoGenera("Contenido","Contenido", $Contenido);
	CampoTextoGenera("Imagen","Imagen", $Imagen, 40);
	CampoMemoGenera("TextoImagen","Texto de Imagen", $TextoImagen);
	CampoTextoGenera("Enlace","Enlace", $Enlace, 60);
	CampoFechaGenera("VigenciaDesde","Vigente Desde",$VigenciaDesde);
	CampoFechaGenera("VigenciaHasta","Vigente Hasta",$VigenciaHasta);

	CampoAceptarGenera();
?>
</table>

<input type="hidden" name="IdCategoria" value="<?php echo $IdCategoria; ?>">

<?php
	if (!$EsNuevo)
		IdGenera($Id);
?>

</form>

</center>

<?php
	mysql_free_result($rsClases);
	Desconectar();
	include('Final.inc.php');
?>

