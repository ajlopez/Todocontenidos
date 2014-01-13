<?php
    include_once('Settings.inc.php');

	include_once($PaginaPrefijo.'Usuarios.inc.php');
	include_once($PaginaPrefijo.'Paginas.inc.php');
	include_once($PaginaPrefijo.'Eventos.inc.php');

	Conectar();

	EventoPagina();

	$Categorias = array();
	$Resumenes = array();

	$sql = "select * from categorias where IdPadre=0 and Estado=0 order by descripcion";
	$rs = mysql_query($sql);
	while ($reg = mysql_fetch_object($rs)) {
		$Categorias[$reg->Id] = $reg->Descripcion;
		$Resumenes[$reg->Id] = $reg->Resumen;
	}

	$PaginaTitulo = "Temas";

	include($PaginaPrefijo.'Inicio.inc.php');
?>

<center>

<p>
Actualmente en construcci&oacute;n, en esta secci&oacute;n catalogamos distintas fuentes de contenidos
en castellano y otros idiomas. Si desea colaborar, puede <a href="ItemSugiere.php">sugerir un sitio</a>,
sugerir <a href="ArticuloSugiere.php">un art&iacute;culo</a> o un <a href="TemaSugiere.php">nuevo tema</a>.

<p>

<table cellspacing=1 cellpadding=3 width=600 bgcolor=black>

<?php
function MuestraCategoria($Id,$Descripcion,$Resumen,$x,$y)
{
	$pos = $x + $y;

	if ($pos % 2)
		$fondo = "#eeeeee";
	else
		$fondo = "#dddddd";

	echo "<td width='33%' height=80 class=categoria valign=top bgcolor=$fondo><a class=categoria href='Tema.php?Id=$Id'>$Descripcion</a><br>$Resumen</td>\n";
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

	while (list($Id,$Descripcion) = each($Categorias)) {
		$Resumen = $Resumenes[$Id];
		$y = (integer) ($n / $ncols);
		$x = $n % $ncols;

		if ($x==0 && $n)
			echo "</tr>\n";

		if ($x==0)
			echo "<tr>\n";

		MuestraCategoria($Id,$Descripcion,$Resumen,$x,$y);
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
</center>

<?php
	Desconectar();
	include_once($PaginaPrefijo.'Final.inc.php');
?>

