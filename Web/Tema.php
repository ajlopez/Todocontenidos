<?
	include_once($PaginaPrefijo.'Usuarios.inc.php');
	include_once($PaginaPrefijo.'Paginas.inc.php');
	include_once($PaginaPrefijo.'Categorias.inc.php');
	include_once($PaginaPrefijo.'Items.inc.php');
	include_once($PaginaPrefijo.'Articulos.inc.php');
	include_once($PaginaPrefijo.'Utiles.inc.php');
	include_once($PaginaPrefijo.'Eventos.inc.php');
	include_once($PaginaPrefijo.'Buscar.inc.php');
	include_once($PaginaPrefijo.'Google.inc.php');

	if (!$Id)
		PaginaRedireccionar(PaginaPrincipal());

	Conectar();

	EventoPagina($Id);
	CategoriaVisita($Id);

	SesionPone('ItemEnlace',PaginaActual(),0);
	SesionPone('CategoriaEnlace',PaginaActual());

	$Categorias = array();
	$Resumenes = array();

	$sql = "select * from categorias where IdPadre=$Id and Estado=0 order by descripcion";
	$rs = mysql_query($sql);
	while ($reg = mysql_fetch_object($rs)) {
		if ($reg->IdReferencia)
			$reg->Id = $reg->IdReferencia;
		$Categorias[$reg->Id] = $reg->Descripcion;
		$Resumenes[$reg->Id] = $reg->Resumen;
	}

	CategoriaTraduceEx($Id,$Descripcion,$Terminos,$IdPadre);

	if (!$Terminos)
		$Terminos = $Descripcion;

	if ((rand() % 20) == 0)
		ProcesarItems($Id,$Terminos);

	$PaginaTitulo = $Descripcion;
	$IdCategoriaActual = $Id;

	include($PaginaPrefijo.'Inicio.inc.php');
?>

<center>

<?
	ShowGoogle();
?>

<p>
<a href="<? echo $PaginaPrefijo; ?>ItemSugiere.php?IdCategoria=<? echo $Id; ?>">Agregar Enlace</a>
&nbsp;
&nbsp;
<!-- Remove
<a href="<? echo $PaginaPrefijo; ?>ArticuloSugiere.php?IdCategoria=<? echo $Id; ?>">Agregar Art&iacute;culo</a>
&nbsp;
&nbsp;
-->
<a href="<? echo $PaginaPrefijo; ?>TemaSugiere.php?IdCategoria=<? echo $Id; ?>">Agregar Tema</a>
<?
	if (EsAdministrador()) {
		echo "&nbsp;&nbsp;";
		echo "<a href='" . $PaginaPrefijo . "Categoria.php?Id=$Id'>Administra</a>";
	}
?>
</p>
<p>
<a href="<? echo $PaginaPrefijo; ?>Temas.php">Temas</a>
<?
	if ($IdPadre) {
		echo "&nbsp;->&nbsp;";
		echo CategoriasEnlaces($IdPadre,$PaginaPrefijo.'Tema.php');
	}
?>
</p>

<?
function MuestraCategoria($Id,$Descripcion,$Resumen,$x,$y)
{
	global $PaginaPrefijo;

	$pos = $x + $y;

	if ($pos % 2)
		$fondo = "#eeeeee";
	else
		$fondo = "#dddddd";

	echo "<td width='33%' class=categoria valign=top bgcolor=$fondo><a class=categoria href='" . $PaginaPrefijo . "Tema.php?Id=$Id'>$Descripcion</a><br>$Resumen</td>\n";
}

function MuestraVacio($x,$y)
{
	$pos = $x + $y;

	if ($pos % 2)
		$fondo = "#eeeeee";
	else
		$fondo = "#dddddd";

	echo "<td width='33%' class=categoria valign=top bgcolor=$fondo>&nbsp;</td>\n";
}

if (count($Categorias)) {
?>
<table cellspacing=1 cellpadding=3 width=600 border=0 bgcolor=black>


<?
	reset($Categorias);

	$x=0; $y=0;
	$ncols = 3;
	$n=0;

	while (list($IdCategoria,$DescripcionCategoria) = each($Categorias)) {
		$Resumen = $Resumenes[$IdCategoria];
		$y = (integer) ($n / $ncols);
		$x = $n % $ncols;

		if ($x==0 && $n)
			echo "</tr>\n";

		if ($x==0)
			echo "<tr>\n";

		MuestraCategoria($IdCategoria,$DescripcionCategoria,$Resumen,$x,$y);
		$n++;
	}

	$x++;

	while ($x<$ncols) {
		MuestraVacio($x,$y);
		$x++;
	}

	echo "</tr>\n";
?>

</table>
<br>
<br>
<?
}

	$sql = "Select i.* from categoriasitems ci left join items i on ci.IdItem = i.Id where ci.IdCategoria = $Id and ci.Estado=0 and i.Estado=0 and i.Orden = 0 order by i.orden, i.visitas desc, i.id desc";
	$rsItemsDestacados = mysql_query($sql);

	if (mysql_errno())
		echo mysql_error() . ": " . $sql;

	if ($rsItemsDestacados && mysql_num_rows($rsItemsDestacados)) {
		while ($reg=mysql_fetch_object($rsItemsDestacados))
			ItemMuestraDestacado($reg->Id, $reg->Descripcion, $reg->Detalle, $reg->Url, $reg->Orden, $reg->Visitas, $reg->Favoritos);
	}

	$sql = "Select a.* from categoriasarticulos ca left join articulos a on ca.IdArticulo = a.Id where ca.IdCategoria = $Id and ca.Estado=0 and a.IdEstado=0 and a.Orden = 0 order by a.orden, a.visitas desc, a.id desc";
	$rsArticulosDestacados = mysql_query($sql);

	if (mysql_errno())
		echo mysql_error() . ": " . $sql;

	if ($rsArticulosDestacados && mysql_num_rows($rsArticulosDestacados)) {
		while ($reg=mysql_fetch_object($rsArticulosDestacados))
			ArticuloMuestraDestacado($reg->Id, $reg->Titulo, $reg->Resumen, $reg->Url, $reg->Orden, $reg->Visitas, $reg->Imagen);
	}


function ItemMuestra($Id,$Descripcion,$Detalle,$Url,$Orden,$Visitas,$Favoritos)
{
	global $PaginaPrefijo;
	global $IdCategoriaActual;

	if (!strpos($Url,":/"))
		$Url = "http://" . $Url;

	if (($Orden<=2 && $Orden>=1) || $Visitas>100 || $Favoritos>0)
		$clase = 'item2';
	else
		$clase = 'item';

//	$clase = 'item';
?>
<tr>
<td class=<?= $clase ?> valign=top>
<a class=<?= $clase ?> target='_blank' href="<? echo $PaginaPrefijo; ?>ItemVe.php?Id=<? echo $Id; ?>&IdCategoria=<? echo $IdCategoriaActual ?>">
<? echo $Descripcion; ?>
</a>
&nbsp;&nbsp;
<a href="<? echo $PaginaPrefijo; ?>ItemAFavoritos.php?Id=<?= $Id ?>&IdCategoria=<?= $IdCategoriaActual ?>">Agrega a Mis Favoritos</a>
<?
	if (EsAdministrador()) {
?>
&nbsp;&nbsp;
<a href="<? echo $PaginaPrefijo; ?>Item.php?Id=<?= $Id ?>">Administra</a>
<?
	}
?>
<br>
<? echo NormalizaHtml($Detalle); ?>
<?
	if ($clase=='item2')
		echo "<br><br>";
?>
</td>
</tr>
<?
}

function GoogleMuestra() {
?>
<tr>
<td>
<center>
<? ShowGoogle(); ?>
</center>
</td>
</tr>
<?
}

?>

<?
function ItemMuestra2($Descripcion,$Detalle,$Url)
{
	global $PaginaPrefijo;

	if (!strpos($Url,":/"))
		$Url = "http://" . $Url;
?>
<tr>
<td class=item valign=top>
<a class=item target='_blank' href="<? echo $Url ?>">
<? echo $Descripcion; ?>
</a>
<br>
<? echo NormalizaHtml($Detalle); ?>
</td>
</tr>
<?
}
?>

<?
	$sql = "Select i.* from categoriasitems ci left join items i on ci.IdItem = i.Id where ci.IdCategoria = $Id and ci.Estado=0 and i.Estado=0 and i.Orden<>0 order by i.orden, i.visitas desc, i.id desc";
	$rsItems = mysql_query($sql);

	if (mysql_errno())
		echo mysql_error() . ": " . $sql;

	if ($rsItems && mysql_num_rows($rsItems)) {
?>
<h2><? echo $Descripcion; ?> en Internet</h2>
<table width="100%" cellspacing=0 cellpadding=3>
<?
		$nitem=1;
		while ($reg=mysql_fetch_object($rsItems)) {
			ItemMuestra($reg->Id, $reg->Descripcion, $reg->Detalle, $reg->Url, $reg->Orden, $reg->Visitas, $reg->Favoritos);

			if (($nitem%20)==0) {
				GoogleMuestra();
			}

			$nitem++;
		}
?>
</table>
<?		
	}

function ArticuloMuestra($Id,$Titulo,$Resumen,$Contenido,$Url) {
	global $PaginaPrefijo;

	if ($Url && !$Contenido) {
?>
<tr>
<td class=item valign=top>
<a class=item target='_blank' href="<? echo $PaginaPrefijo; ?>ArticuloVe.php?Id=<? echo $Id; ?>">
<? echo $Titulo; ?>
</a>
<br>
<? echo NormalizaHtml($Resumen); ?>
</td>
</tr>
<?
	}
	else {
?>
<tr>
<td class=item valign=top>
<a class=item href="<? echo $PaginaPrefijo; ?>ArticuloMuestra.php?Id=<? echo $Id; ?>">
<? echo $Titulo; ?>
</a>
<br>
<? echo NormalizaHtml($Resumen); ?>
</td>
</tr>
<?
	}
}
	$rsArticulos=mysql_query("select a.Id, a.Titulo, a.Resumen, a.Contenido, a.Enlace from categoriasarticulos ca, articulos a where ca.IdArticulo = a.Id and ca.IdCategoria=$Id and ca.Estado=0 and a.IdEstado=0 order by a.Orden desc, a.Visitas desc");
	if ($rsArticulos && mysql_num_rows($rsArticulos)) {
?>

<p>
<h2>Art&iacute;culos</h2>
<table width="100%" cellspacing=0 cellpadding=3>
<?
		while ($reg=mysql_fetch_object($rsArticulos))
			ArticuloMuestra($reg->Id, $reg->Titulo, $reg->Resumen, $reg->Contenido, $reg->Enlace);
?>
</table>

<?		
	}	

	mysql_free_result($rsArticulos);
?>


</center>

<?
	Desconectar();

	include($PaginaPrefijo.'Final.inc.php');
?>

