<?php
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Utiles.inc.php');
	include_once('Categorias.inc.php');
	include_once('Usuarios.inc.php');

	AdministradorControla();

	Conectar();
	
	SesionPone('CategoriaEnlace',PaginaActual());
	SesionPone('ArticuloEnlace',PaginaActual());
	SesionPone('ItemEnlace',PaginaActual());

	if (!isset($Id))
		PaginaSale();

	$sql = "select Descripcion, Detalle, Resumen, Terminos, IdPadre, IdReferencia, Estado, Alias
		 from categorias where Id = $Id";		 
	$res = mysql_query($sql);
	list($Descripcion, $Detalle, $Resumen, $Terminos, $IdPadre, $IdReferencia, $Estado, $Alias)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$PaginaTitulo = "Categor&iacute;a: $Descripcion";

 	$rsPadre = mysql_query("Select Descripcion from categorias where Id = $IdPadre");
	if ($rsPadre && mysql_num_rows($rsPadre))
		list($PadreDescripcion) = mysql_fetch_row($rsPadre);
	if ($rsPadre)
		mysql_free_result($rsPadre);

	CategoriaTraduce($IdReferencia, $DescripcionReferencia, $IdPadreReferencia);

	include('Inicio.inc.php');
?>

<center>

<?php
	$Enlaces = CategoriasEnlaces($IdPadre);

	if ($Enlaces) {
?>
<p>
<?php echo $Enlaces; ?>
</p>
<?php
	}
?>
<p>

<p>
<a href="Categorias.php">Categor&iacute;as</a>
&nbsp;
&nbsp;
<a href="Tema.php?Id=<?php echo $Id; ?>">Muestra</a>
&nbsp;
&nbsp;
<a href="TestItems.php?IdCategoria=<?php echo $Id; ?>">Trae Items</a>
&nbsp;
&nbsp;
<a href="CategoriaActualiza.php?Id=<?php echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="CategoriaElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
<br>
<a href="CategoriaActualiza.php?IdPadre=<?php echo $Id; ?>">Nueva Subcategor&iacute;a</a>
&nbsp;
&nbsp;
<a href="ItemActualiza.php?IdCategoria=<?php echo $Id; ?>">Nuevo Item</a>
&nbsp;
&nbsp;
<a href="ArticuloActualiza.php?IdCategoria=<?php echo $Id; ?>">Nuevo Art&iacute;culo</a>
&nbsp;
&nbsp;
<a href="CategoriaSeleccionaPadre.php?IdHijo=<?php echo $Id; ?>&IdCategoria=<?php echo $IdPadre; ?>">Selecciona Padre</a>
&nbsp;
&nbsp;
<a href="CategoriaSeleccionaRef.php?IdReferente=<?php echo $Id; ?>&IdCategoria=<?php echo $IdPadre; ?>">Selecciona Referencia</a>
<br>
<?php
	if ($Estado == CATEGORIAS_ESTADO_NORMAL) {
?>
<a href="CategoriaCambiaEstado.php?Id=<?php echo $Id; ?>&Estado=<?php echo CATEGORIAS_ESTADO_DESHABILITADA ?>&Expande=1">Deshabilita Categor&iacute;a y Subcategor&iacute;as</a>
<?php
	}
	else {
?>
<a href="CategoriaCambiaEstado.php?Id=<?php echo $Id; ?>&Estado=<?php echo CATEGORIAS_ESTADO_NORMAL ?>&Expande=1">Habilita Categor&iacute;a y Subcategor&iacute;as</a>
&nbsp;
&nbsp;
<a href="CategoriaCambiaEstado.php?Id=<?php echo $Id; ?>&Estado=<?php echo CATEGORIAS_ESTADO_NORMAL ?>&Expande=0">Habilita Categor&iacute;a</a>
<?php
	}
?>
&nbsp;
&nbsp;
<a href="Eventos.php?Parametro=Tema.php&Subparametro=Id=<?php echo $Id; ?>">Visitas</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="Formulario" width="80%">
<?php
	CampoEstaticoGenera("Id",$Id);
	if ($Estado)
		CampoEstaticoGenera("Descripci&oacute;n","($Descripcion)");
	else
		CampoEstaticoGenera("Descripci&oacute;n",$Descripcion);
	CampoEstaticoGenera("Detalle",NormalizaHtml($Detalle));
	CampoEstaticoGenera("Resumen",NormalizaHtml($Resumen));
	CampoEstaticoGenera("T&eacute;rminos",$Terminos);

	if ($IdReferencia)
		CampoEstaticoGenera("Referencia", "<a href='Categoria.php?Id=$IdReferencia'>$DescripcionReferencia</a>");

	CampoEstaticoGenera("Alias",$Alias);
	CampoEstaticoGenera("Estado",CategoriaEstadoTraduce($Estado));
?>
</table>

<?php
function MuestraRegistro($reg) {
	FilaInicio();
	if ($reg["Estado"])
		DatoEnlaceGenera("(".$reg["Descripcion"].")", "Categoria.php?Id=".$reg["Id"]);
	else
		DatoEnlaceGenera($reg["Descripcion"], "Categoria.php?Id=".$reg["Id"]);
	FilaFinal();
}

	$rs=mysql_query("select * from categorias where IdPadre=$Id order by descripcion");
	if (mysql_num_rows($rs)) {
?>

<p>
<h2>Subcategor&iacute;as</h2>

<?php		
		$titulos = array("Descripci&oacute;n");

		TablaInicio($titulos,"90%");

		while ($reg=mysql_fetch_array($rs)) 
			MuestraRegistro($reg);
				
		TablaFinal();
	}

	mysql_free_result($rs);
?>

<?php
function MuestraItem($reg) {
	global $Id;

	FilaInicio();
	$accion = "<a href='CategoriaItemElimina.php?Id=$reg[IdCI]'>Elimina</a>";
	if ($reg["Estado"]) {
		DatoEnlaceGenera("(".$reg["Descripcion"].")", "Item.php?Id=".$reg["Id"]."&Url=".$reg["Url"]);
		$accion .= "&nbsp;&nbsp;<a href='CategoriaItemCambiaEstado.php?Id=$reg[IdCI]&Estado=0&IdCategoria=$Id'>Habilita</a>";
	}
	else if ($reg["ItemEstado"]) {
		DatoEnlaceGenera("[".$reg["Descripcion"]."]", "Item.php?Id=".$reg["Id"]."&Url=".$reg["Url"]);
		$accion .= "&nbsp;&nbsp;<a href='CategoriaItemCambiaEstado.php?Id=$reg[IdCI]&Estado=0&IdCategoria=$Id'>Habilita</a>";
	}
	else {
		DatoEnlaceGenera($reg["Descripcion"], "Item.php?Id=".$reg["Id"]."&Url=".$reg["Url"]);
		$accion .= "&nbsp;&nbsp;<a href='CategoriaItemCambiaEstado.php?Id=$reg[IdCI]&Estado=1&IdCategoria=$Id'>Deshabilita</a>";
	}

	DatoGenera($accion);
	FilaFinal();
}

	$rs=mysql_query("select i.Id, i.Descripcion, i.Url, i.Estado as ItemEstado, ci.Estado, ci.Id as IdCI from categoriasitems ci, items i where ci.IdItem = i.Id and ci.IdCategoria=$Id order by i.descripcion");
	if (mysql_num_rows($rs)) {
?>

<p>
<h2>Items</h2>

<?php		
		$titulos = array("Descripci&oacute;n", "Acci&oacute;n");

		TablaInicio($titulos,"90%");

		while ($reg=mysql_fetch_array($rs)) 
			MuestraItem($reg);
				
		TablaFinal();
	}

	mysql_free_result($rs);
?>

<?php
function MuestraArticulo($reg) {
	global $Id;

	FilaInicio();
	if ($reg["Estado"])
		DatoEnlaceGenera("(".$reg["Titulo"].")", "Articulo.php?Id=".$reg["Id"]."&Enlace=".$reg["Enlace"]);
	else if ($reg["ArticuloEstado"])
		DatoEnlaceGenera("[".$reg["Titulo"]."]", "Articulo.php?Id=".$reg["Id"]."&Enlace=".$reg["Enlace"]);
	else
		DatoEnlaceGenera($reg["Titulo"], "Articulo.php?Id=".$reg["Id"]."&Enlace=".$reg["Enlace"]);

	$accion = "<a href='CategoriaArticuloElimina.php?Id=$reg[IdCA]'>Elimina</a>";

	if ($reg["Estado"])
		$accion .= "&nbsp;&nbsp;<a href='CategoriaArticuloCambiaEstado.php?Id=$reg[IdCA]&Estado=0&IdCategoria=$Id'>Habilita</a>";
	else
		$accion .= "&nbsp;&nbsp;<a href='CategoriaArticuloCambiaEstado.php?Id=$reg[IdCA]&Estado=1&IdCategoria=$Id'>Deshabilita</a>";

	DatoGenera($accion);
	FilaFinal();
}

	$rs=mysql_query("select a.Id, a.Titulo, a.Enlace, a.IdEstado as ArticuloEstado, ca.Estado, ca.Id as IdCA from categoriasarticulos ca, articulos a where ca.IdArticulo = a.Id and ca.IdCategoria=$Id order by a.Titulo");
	if ($rs && mysql_num_rows($rs)) {
?>

<p>
<h2>Art&iacute;culos</h2>

<?php	
	
		$titulos = array("T&iacute;tulo", "Descripci&oacute;n");

		TablaInicio($titulos,"90%");

		while ($reg=mysql_fetch_array($rs)) 
			MuestraArticulo($reg);
				
		TablaFinal();
	}

	if ($rs)
		mysql_free_result($rs);
?>


</center>

<?php
	Desconectar();
	include('Final.inc.php');
?>

