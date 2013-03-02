<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Utiles.inc.php');
	include('Categorias.inc.php');
	include('Traduccion.inc.php');
	include('Usuarios.inc.php');
	include('Articulos.inc.php');
	include('Google.inc.php');

	Conectar();
	
	if (!isset($Id))
		PaginaSalir();

	$sql = "select Titulo, IdClase, Resumen, Copete, Contenido, Imagen, TextoImagen, Enlace, Visitas, Orden, IdEstado, Votos1, Votos2, Votos3, Votos4, Votos5, VigenciaDesde, VigenciaHasta from articulos where Id = $Id";
	$rs = mysql_query($sql);
	list($Titulo, $IdClase, $Resumen, $Copete, $Contenido, $Imagen, $TextoImagen, $Enlace, $Visitas, $Orden, $IdEstado, $Votos1, $Votos2, $Votos3, $Votos4, $Votos5, $VigenciaDesde, $VigenciaHasta) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	if (UsuarioIdentificado()) {
		$rsVisitas = mysql_query("select * from eventos where Tipo = 'AR' and IdUsuario = " . UsuarioId() . " and IdParametro = $Id and FechaHora >= (now() - Interval 1 day)");
		if (mysql_errno())
			echo mysql_error();
		if (!mysql_num_rows($rsVisitas))
			PuntosVisita();
		mysql_free_result($rsVisitas);
	}

	$ArticulosVisitados = SesionToma('ArticulosVisitados');

	if (!$ArticulosVisitados)
		$ArticulosVisitados = array();

	if (!$ArticulosVisitados[$Id]) {
		$ArticulosVisitados[$Id]=1;
		SesionPone('ArticulosVisitados',$ArticulosVisitados);
		EventoVisitaArticulo($Id);
		ArticuloVisita($Id);
	}


	$PaginaTitulo = "Artículo: $Titulo";

	$ClaseDescripcion = TraduceArticuloClase($IdClase);

	$PaginaTitulo = $Titulo;

	require('Inicio.inc.php');
?>

<center>
<? ShowGoogle(); ?>
</center>

<?
	if (EsAdministrador()) {
		echo "<center><p><a href='Articulo.php?Id=$Id'>Administra</a></p></center>";
	}

	if ($Copete) {
		echo "<p class=noticiacopete>";
		echo nl2br($Copete);
		echo "</p>";
	}
?>

<table width="100%" cellspacing="10" border="0">
<tr>
<td valign="top">

<?
	if ($Imagen) {
		if (substr($Imagen,0,8)=='youtube:') {
			$youtube = substr($Imagen,8);
			$Imagen = "http://img.youtube.com/vi/${youtube}/default.jpg";
?>
<object width="425" height="355" align="left"><param name="movie" value="http://www.youtube.com/v/<?= $youtube ?>"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/<?= $youtube ?>&rel=1" type="application/x-shockwave-flash" wmode="transparent" width="425" height="355"></embed></object>
</td>
<td valign="top">
<?
		}
		else if (substr($Imagen,0,8)=='soapbox:') {
			$soapbox = substr($Imagen,8);
			$p = strpos($soapbox,'|');
			$Imagen = substr($soapbox,$p+1);
			$soapbox = substr($soapbox,0,$p);
?>
<embed src="http://images.video.msn.com/flash/soapbox1_1.swf"
 quality="high" width="432" height="364" 
 base="http://images.video.msn.com" 
 type="application/x-shockwave-flash"
 allowFullScreen="true"
 pluginspage="http://macromedia.com/go/getflashplayer"
 flashvars="c=v&v=<?= $soapbox ?>&ifs=true&fr=msnvideo&mkt=en-US&brand="></embed>
<br /><a href="http://video.msn.com/video.aspx?vid=<?= $soapbox ?>" target="_new" title="<?= $Titulo ?>">Video: <?= $Titulo ?></a>
</td>
<td valign="top">
<?
		}
		else {
			echo "<img src='$Imagen' align='left'>\n";
		}
	}

	if (!$Contenido)
		$Contenido = $Resumen;

	if ($Contenido) {
		echo "<p class=noticiatexto>";
		echo nl2br($Contenido);
		echo "</p>";
	}

	if ($Enlace) {
		echo "<p>";
		echo "<a href='$Enlace'>$Enlace</a>";
		echo "</p>";
	}
?>
</td>
</tr>
</table>

</p>

<?
	Desconectar();
	require('Final.inc.php');
?>

