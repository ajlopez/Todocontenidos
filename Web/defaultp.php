<?
	include('Usuarios.inc.php');
	include('Paginas.inc.php');
	include('Eventos.inc.php');
	include('Categorias.inc.php');

	Conectar();

	EventoPagina();

	$Categorias = array();
	$Resumenes = array();

	$sql = "select * from categorias where IdPadre=0";
	if (!EsAdministrador())
		$sql .= " and Estado = " . CATEGORIAS_ESTADO_NORMAL;
	$sql .= " order by descripcion";
	$rs = mysql_query($sql);
	while ($reg = mysql_fetch_object($rs)) {
		if ($reg->Estado)
			$Categorias[$reg->Id] = "($reg->Descripcion)";
		else
			$Categorias[$reg->Id] = $reg->Descripcion;
		$Resumenes[$reg->Id] = $reg->Resumen;
	}

	$PaginaTitulo = "todocontenidos.com";

	SesionLee();

	include('Inicio.inc.php');
?>

<center>

<p>
<? echo $CkSesionId; ?>
<p>
<? echo serialize($Sesion); ?>
<p>
<? SesionMuestra(); ?>
<p>
Bienvenido a <a href="<? echo PaginaPrincipal(); ?>">todocontenidos</a>, donde encontrar&aacute; sitios, p&aacute;ginas, y art&iacute;culos
sobre los temas que le interesan.
</p>

<h2>Cursos</h2>

<p>
Consulte e inscr&iacute;base en nuestros <a href="CursosMuestra.php">cursos en l&iacute;nea</a>. Estudie a la medida
de su tiempo y sus horarios. Precios accesibles. Consulte promociones y cursos gratuitos.

<h2>Temas</h2>

<p>
Actualmente en construcci&oacute;n, en esta secci&oacute;n catalogamos distintas fuentes de contenidos
en castellano y otros idiomas. Si desea colaborar, puede <a href="ItemSugiere.php">sugerir un sitio</a>,
sugerir <a href="ArticuloSugiere.php">un art&iacute;culo</a> o un <a href="TemaSugiere.php">nuevo tema</a>.

<p>

<table cellspacing=1 cellpadding=3 width=600 border=0 bgcolor=black>

<?
function MuestraCategoria($Id,$Descripcion,$Resumen,$x,$y)
{
	$pos = $x + $y;

	if ($pos % 2)
		$fondo = "#eeeeee";
	else
		$fondo = "#dddddd";

	echo "<td width='33%' class=categoria valign=top bgcolor=$fondo><a class=categoria href='Tema.php?Id=$Id'>$Descripcion</a></td>\n";
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

<?
	Desconectar();
	include('Final.inc.php');
?>

