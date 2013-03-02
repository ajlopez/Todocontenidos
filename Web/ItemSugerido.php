<?
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Utiles.inc.php');
	include_once('Categorias.inc.php');
	include_once('Items.inc.php');
	include_once('Usuarios.inc.php');

	AdministradorControla('');

	Conectar();
	
	SesionPone('ItemSugeridoEnlace',PaginaActual());
	SesionPone('CategoriaEnlace',PaginaActual());

	if (!isset($Id))
		PaginaSalir();

	$sql = "select Descripcion, Detalle, Url, IdUsuario, IdCategoria
		 from itemssugeridos where Id = $Id";		 
	$res = mysql_query($sql);
	list($Descripcion, $Detalle, $Url, $IdUsuario, $IdCategoria)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$PaginaTitulo = "Item Sugerido: $Descripcion";

	CategoriaTraduce($IdCategoria,$CategoriaDescripcion,$IdCategoriaPadre);

	require('Inicio.inc.php');
?>

<center>

<p>
<a href="ItemsSugeridosExplora.php">Items Sugeridos</a>
&nbsp;
&nbsp;
<a href="ItemSugeridoActualiza.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="ItemSugeridoElimina.php?Id=<? echo $Id; ?>">Elimina</a>
&nbsp;
&nbsp;
<a href="ItemSugeridoAItem.php?Id=<? echo $Id; ?>">Acepta como Item</a>
&nbsp;
&nbsp;
<a href="ItemSugeridoAArticulo.php?Id=<? echo $Id; ?>">Acepta como Art&iacute;culo</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	CampoEstaticoGenera("Id",$Id);
	CampoEstaticoGenera("Descripci&oacute;n",$Descripcion);
	CampoEstaticoGenera("Detalle",NormalizaHtml($Detalle));
	CampoEstaticoGenera("Enlace",EnlaceUrlNuevo($Url));
	if ($IdCategoria)
		CampoEstaticoGenera("Categoria","<a href='Categoria.php?Id=$IdCategoria'>$CategoriaDescripcion</a>");
?>
</table>

</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

