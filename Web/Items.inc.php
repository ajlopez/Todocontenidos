<?php
	define('ITEMS_ESTADO_NORMAL',0);
	define('ITEMS_ESTADO_PENDIENTE',1);

	include_once('Usuarios.inc.php');
	include_once('Conexion.inc.php');

function ItemVisita($Id) {
	Conectar();
	mysql_query("update items set Visitas = Visitas + 1 where Id = $Id");
	Desconectar();
}

function ItemVoto($Id,$Voto) {
	Conectar();
	mysql_query("update items set Votos$Voto = Votos$Voto + 1 where Id = $Id");
	Desconectar();
}

function ItemVotado($Id) {
	global $REMOTE_ADDR;

	Conectar();
	if (UsuarioIdentificado()) {
		$IdUsuario = UsuarioId();
		$rsVotos = mysql_query("select * from eventos where tipo='VI' and IdUsuario = $IdUsuario and IdParametro = $Id and FechaHora >= (Now()-Interval 1 day)");
		if (mysql_num_rows($rsVotos))
			$Votado=1;
		else
			$Votado=0;
		mysql_free_result($rsVotos);
	}
	else {
		$rsVotos = mysql_query("select * from eventos where tipo='VI' and IP = '$REMOTE_ADDR' and IdUsuario=0 and IdParametro = $Id and FechaHora >= (Now()-Interval 1 hour)");
		if (mysql_num_rows($rsVotos))
			$Votado=1;
		else
			$Votado=0;
		mysql_free_result($rsVotos);
	}

	Desconectar();

	return $Votado;
}

function ItemPromedio($Votos1,$Votos2,$Votos3,$Votos4,$Votos5)
{
	$Total = $Votos1 + $Votos2 + $Votos3 + $Votos4 + $Votos5;

	if (!$Total)
		return 'Sin Votos';

	$Suma = $Votos1 + 2 * $Votos2 + 3 * $Votos3 + 4 * $Votos4 + 5 * $Votos5;

	return number_format($Suma / $Total, 2);
}

function ItemPoneEstado($Id,$Estado=ITEMS_ESTADO_NORMAL,$Expande=0) {
	Conectar();

	mysql_query("update items set Estado = $Estado where Id = $Id");

	Desconectar();
}

function ItemMuestraDestacado($Id,$Descripcion,$Detalle,$Url,$Orden,$Visitas,$Favoritos)
{
	global $PaginaPrefijo;
	global $IdCategoriaActual;

	if (!strpos($Url,":/"))
		$Url = "http://" . $Url;

	$clase = 'itemdestacado';
?>
<p align='left'>
<a class=<?= $clase ?> target='_blank' href="<?php echo $PaginaPrefijo; ?>ItemVe.php?Id=<?php echo $Id; ?>&IdCategoria=<?php echo $IdCategoriaActual ?>">
<?php echo $Descripcion; ?>
</a>
&nbsp;&nbsp;
<a href="<?php echo $PaginaPrefijo; ?>ItemAFavoritos.php?Id=<?= $Id ?>&IdCategoria=<?= $IdCategoriaActual ?>">Agrega a Mis Favoritos</a>
<?php
	if (EsAdministrador()) {
?>
&nbsp;&nbsp;
<a href="<?php echo $PaginaPrefijo; ?>Item.php?Id=<?= $Id ?>">Administra</a>
<?php
	}
?>
<br>
<br>
<table border="0" widht="95%">
<tr>
<?php
	$imagen = $PaginaPrefijo."images/items/$Id.png";

	if (file_exists($imagen)) {
?>
<td valign="top">
<img src="<?= $imagen ?>" style="margin:0px 20px 20px 0px;">
</td>
<?php
	}
?>
<td valign="top">
<p>
<?php echo NormalizaHtml($Detalle); ?>
<br>
<br>
</p>
</td>
</tr>
</table>
<?php
}


?>