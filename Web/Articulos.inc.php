<?
	include_once('Usuarios.inc.php');
	include_once('Conexion.inc.php');

function ArticuloVisita($Id) {
	Conectar();
	mysql_query("update articulos set Visitas = Visitas + 1 where Id = $Id");
	Desconectar();
}

function ArticuloVoto($Id,$Voto) {
	Conectar();
	mysql_query("update articulos set Votos$Voto = Votos$Voto + 1 where Id = $Id");
	Desconectar();
}

function ArticuloVotado($Id) {
	global $REMOTE_ADDR;

	Conectar();
	if (UsuarioIdentificado()) {
		$IdUsuario = UsuarioId();
		$rsVotos = mysql_query("select * from eventos where tipo='VA' and IdUsuario = $IdUsuario and IdParametro = $Id and FechaHora >= (Now()-Interval 1 day)");
		if (mysql_num_rows($rsVotos))
			$Votado=1;
		else
			$Votado=0;
		mysql_free_result($rsVotos);
	}
	else {
		$rsVotos = mysql_query("select * from eventos where tipo='VA' and IP = '$REMOTE_ADDR' and IdUsuario=0 and IdParametro = $Id and FechaHora >= (Now()-Interval 1 hour)");
		if (mysql_num_rows($rsVotos))
			$Votado=1;
		else
			$Votado=0;
		mysql_free_result($rsVotos);
	}

	Desconectar();

	return $Votado;
}

function ArticuloPromedio($Votos1,$Votos2,$Votos3,$Votos4,$Votos5)
{
	$Total = $Votos1 + $Votos2 + $Votos3 + $Votos4 + $Votos5;

	if (!$Total)
		return 'Sin Votos';

	$Suma = $Votos1 + 2 * $Votos2 + 3 * $Votos3 + 4 * $Votos4 + 5 * $Votos5;

	return number_format($Suma / $Total,2);
}

function ArticuloMuestraDestacado($Id,$Descripcion,$Detalle,$Url,$Orden,$Visitas,$Imagen)
{
	global $PaginaPrefijo;
	global $IdCategoriaActual;

	if (!strpos($Url,":/"))
		$Url = "http://" . $Url;

	$clase = 'itemdestacado';
	if (substr($Imagen,0,8)=='youtube:' || substr($Imagen,0,8)=='soapbox:' ||!$Url)
		$pagina = "ArticuloMuestra";
	else
		$pagina = "ArticuloVe";
?>
<table border="0" width="95%">
<tr>
<td valign="top" width="50%">
<p align='left'>
<a target='_blank' class=<?= $clase ?> href="<? echo $PaginaPrefijo; ?><?= $pagina ?>.php?Id=<? echo $Id; ?>&IdCategoria=<? echo $IdCategoriaActual ?>">
<? echo $Descripcion; ?>
</a>
<!--
&nbsp;&nbsp;
<a href="<? echo $PaginaPrefijo; ?>ArticuloAFavoritos.php?Id=<?= $Id ?>&IdCategoria=<?= $IdCategoriaActual ?>">Agrega a Mis Favoritos</a>
-->
<?
	if (EsAdministrador()) {
?>
<br>
&nbsp;&nbsp;
<a href="<? echo $PaginaPrefijo; ?>Articulo.php?Id=<?= $Id ?>">Administra</a>
<?
	}
?>
<br>
<br>
<p>
<? echo NormalizaHtml($Detalle); ?>
<br>
<br>
</p>
</td>
<?
	if ($Imagen) {
		if (substr($Imagen,0,8)=='youtube:') {
			$youtube = substr($Imagen,8);
			$Imagen = "http://img.youtube.com/vi/${youtube}/default.jpg";
		}
		else if (substr($Imagen,0,8)=='soapbox:') {
			$soapbox = substr($Imagen,8);
			$p = strpos($soapbox,'|');
			$Imagen = substr($soapbox,$p+1);
			$soapbox = substr($soapbox,0,$p);
		}		
?>
<td valign="top" width="50%">
<a target="_blank" class=<?= $clase ?> href="<? echo $PaginaPrefijo; ?><?= $pagina ?>.php?Id=<? echo $Id; ?>&IdCategoria=<? echo $IdCategoriaActual ?>">
<img src="<?= $Imagen ?>" style="margin:0px 20px 20px 0px;" border="0">
</a>
</td>
<?
	}
?>
</tr>
</table>
<?
}


?>