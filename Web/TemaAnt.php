<?
	include($PaginaPrefijo.'Usuarios.inc.php');
	include($PaginaPrefijo.'Paginas.inc.php');
	include($PaginaPrefijo.'Categorias.inc.php');
	include($PaginaPrefijo.'Utiles.inc.php');
	include($PaginaPrefijo.'Eventos.inc.php');

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

	CategoriaTraduce($Id,$Descripcion,$IdPadre);

	$PaginaTitulo = $Descripcion;

	include($PaginaPrefijo.'Inicio.inc.php');
?>

<center>

<p>
<script type="text/javascript"><!--
google_ad_client = "pub-8624135492444658";
//728x90, created 12/16/07
google_ad_slot = "0384229662";
google_ad_width = 728;
google_ad_height = 90;
//--></script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</p>

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

<table cellspacing=1 cellpadding=3 width=600 border=0 bgcolor=black>

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

<?
function ItemMuestra($Id,$Descripcion,$Detalle,$Url)
{
	global $PaginaPrefijo;

	if (!strpos($Url,":/"))
		$Url = "http://" . $Url;
?>
<tr>
<td class=item valign=top>
<a class=item target='_blank' href="<? echo $PaginaPrefijo; ?>ItemVe.php?Id=<? echo $Id; ?>">
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
	$sql = "Select i.* from categoriasitems ci left join items i on ci.IdItem = i.Id where ci.IdCategoria = $Id and ci.Estado=0 and i.Estado=0 order by i.orden desc, i.visitas desc";
	$rsItems = mysql_query($sql);

	if (mysql_errno())
		echo mysql_error() . ": " . $sql;

	if ($rsItems && mysql_num_rows($rsItems)) {
?>
<h2><? echo $Descripcion; ?> en Internet</h2>
<table width="100%" cellspacing=0 cellpadding=3>
<?
		while ($reg=mysql_fetch_object($rsItems))
			ItemMuestra($reg->Id, $reg->Descripcion, $reg->Detalle, $reg->Url);
?>
</table>
<?		
	}

// The Yahoo! Web Services request
$Descripcion2 = str_replace("á","a",$Descripcion);
$Descripcion2 = str_replace("é","e",$Descripcion2);
$Descripcion2 = str_replace("í","i",$Descripcion2);
$Descripcion2 = str_replace("ó","o",$Descripcion2);
$Descripcion2 = str_replace("ú","u",$Descripcion2);
$req = "http://search.yahooapis.com/WebSearchService/V1/webSearch?appid=YahooDemo&query=".urlencode($Descripcion2)."&results=20&output=php";
// Make the request
$phpserialized = file_get_contents($req);
// Parse the serialized response
$phparray = unserialize($phpserialized);
?>
<!--

req = <?= $req ?>

-->
<?

if ($phparray['ResultSet']['Result']) {
	foreach ($phparray['ResultSet']['Result'] as $Item) {
//		$Summary = iconv("ISO-8859-1", "UTF-8", $Item['Summary']);
		$Summary = $Item['Summary'];
		$b = substr('Ã³­',0,2);
		$Summary = str_replace($b,"&oacute;",$Summary);
		$b = substr('Ãº',0,2);
		$Summary = str_replace($b,'&uacute;',$Summary);
		$b = substr('Ã©',0,2);
		$Summary = str_replace($b,'&eacute;',$Summary);
		$b = substr('Ã¡',0,2);
		$Summary = str_replace($b,'&aacute;',$Summary);
		$b = substr('Ã',0,1);
		$Summary = str_replace('Ã­',"&iacute;",$Summary);

		$Title = $Item['Title'];
		$b = substr('Ã³­',0,2);
		$Title = str_replace($b,"&oacute;",$Title);
		$b = substr('Ãº',0,2);
		$Title = str_replace($b,'&uacute;',$Title);
		$b = substr('Ã©',0,2);
		$Title = str_replace($b,'&eacute;',$Title);
		$b = substr('Ã¡',0,2);
		$Title = str_replace($b,'&aacute;',$Title);
		$b = substr('Ã',0,1);
		$Title = str_replace('Ã­',"&iacute;",$Title);


		ItemMuestra2($Title,$Summary,$Item['Url']);
	}
}
/*
<xmp>
<? print_r($phparray); ?>
</xmp>
*/
?>


<?
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

