<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Utiles.inc.php');
	include('Categorias.inc.php');
	include('Traduccion.inc.php');

	Conectar();
	
	SesionPone('ArticuloEnlace',PaginaActual());
	SesionPone('CategoriaEnlace',PaginaActual());

	if (!isset($Id))
		PaginaSalir();

	$sql = "select Titulo, IdClase, Resumen, Copete, Contenido, Imagen, TextoImagen, Enlace, Visitas, Orden, IdEstado, Votos1, Votos2, Votos3, Votos4, Votos5, VigenciaDesde, VigenciaHasta from articulos where Id = $Id";
	$rs = mysql_query($sql);
	list($Titulo, $IdClase, $Resumen, $Copete, $Contenido, $Imagen, $TextoImagen, $Enlace, $Visitas, $Orden, $IdEstado, $Votos1, $Votos2, $Votos3, $Votos4, $Votos5, $VigenciaDesde, $VigenciaHasta) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	$PaginaTitulo = "Artículo: $Titulo";

	$ClaseDescripcion = TraduceArticuloClase($IdClase);

	require('Inicio.inc.php');
?>

<center>

<p>
<a href="Articulos.php">Art&iacute;culos</a>
&nbsp;
&nbsp;
<a href="ArticuloMuestra.php?Id=<? echo $Id; ?>">Muestra</a>
&nbsp;
&nbsp;
<a href="ArticuloActualiza.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="ArticuloElimina.php?Id=<? echo $Id; ?>">Elimina</a>
&nbsp;
&nbsp;
<a href="CategoriaSeleccionaArt.php?IdArticulo=<? echo $Id; ?>">Agrega a Categor&iacute;a</a>
<br>
<a href="Eventos.php?Tipo=AR&IdParametro=<? echo $Id; ?>">Visitas</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	CampoEstaticoGenera("Id",$Id);
	CampoEstaticoGenera("Título", $Titulo);
	CampoEstaticoGenera("Clase", $ClaseDescripcion);
	CampoMemoEstaticoGenera("Resumen", $Resumen);
	CampoMemoEstaticoGenera("Copete", $Copete);
	CampoMemoEstaticoGenera("Contenido", $Contenido);
	CampoEstaticoGenera("Imagen", $Imagen);
	CampoMemoEstaticoGenera("Texto de Imagen", $TextoImagen);
	CampoEstaticoGenera("Enlace", EnlaceUrlNuevo($Enlace));
	CampoEstaticoGenera("Visitas", $Visitas);
	CampoEstaticoGenera("Orden", $Orden);
	CampoEstaticoGenera("Estado", TextoEstado($IdEstado));
	CampoEstaticoGenera("Vigente Desde", $VigenciaDesde);
	CampoEstaticoGenera("Vigente Hasta", $VigenciaHasta);
	CampoEstaticoGenera("Visitas",$Visitas);
	$Votos = $Votos1 + $Votos2 + $Votos3 + $Votos4 + $Votos5;
	if ($Votos)
		$Promedio = ($Votos1 + 2*$Votos2 + 3*$Votos3 + 4*$Votos4 + 5*$Votos5)/$Votos;
	else
		$Promedio = 0;
	CampoEstaticoGenera("Votos", "1=$Votos1, 2=$Votos2, 3=$Votos3, 4=$Votos4, 5=$Votos5, Promedio=$Promedio");
?>
</table>

<?
function MuestraRegistro($reg) {
	global $Id;

	FilaInicio();

	if ($reg["Estado"])
		DatoGenera("(".CategoriasEnlaces($reg["IdCategoria"]).")");
	else
		DatoGenera(CategoriasEnlaces($reg["IdCategoria"]));		

	$accion = "<a href='CategoriaSeleccionaArt.php?IdArticulo=$Id&IdCategoria=$reg[IdCategoria]&IdCategoriaArticulo=$reg[Id]'>Modifica</a>";
	if ($reg["Estado"])
		$accion .= "&nbsp;&nbsp;<a href='CategoriaArticuloCambiaEstado.php?Id=$reg[Id]&Estado=0&IdArticulo=$Id'>Habilita</a>";
	else
		$accion .= "&nbsp;&nbsp;<a href='CategoriaArticuloCambiaEstado.php?Id=$reg[Id]&Estado=1&IdArticulo=$Id'>Deshabilita</a>";
	$accion .= "&nbsp;&nbsp;";
	$accion .= "<a href='CategoriaArticuloElimina.php?Id=$reg[Id]'>Elimina</a>";

	DatoGenera($accion);

	FilaFinal();
}

	$rs=mysql_query("select * from categoriasarticulos where IdArticulo=$Id order by Id");
	if (mysql_num_rows($rs)) {
?>

<p>
<h2>Categor&iacute;as</h2>

<?		
	
		$titulos = array("Descripci&oacute;n", "Acci&oacute;n");

		TablaInicio($titulos,"90%");

		while ($reg=mysql_fetch_array($rs)) 
			MuestraRegistro($reg);
				
		TablaFinal();
	}
?>

</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

