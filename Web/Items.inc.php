<?
if (__Items_inc == 1)
	return;
define ('__Items_inc', 1);

	define('ITEMS_ESTADO_NORMAL',0);
	define('ITEMS_ESTADO_PENDIENTE',1);

	include('Usuarios.inc.php');
	include('Conexion.inc.php');

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
<br>
<table border="0" widht="95%">
<tr>
<?
	$imagen = $PaginaPrefijo."images/items/$Id.png";

	if (file_exists($imagen)) {
?>
<td valign="top">
<img src="<?= $imagen ?>" style="margin:0px 20px 20px 0px;">
</td>
<?
	}
?>
<td valign="top">
<p>
<? echo NormalizaHtml($Detalle); ?>
<br>
<br>
</p>
</td>
</tr>
</table>
<?
}


?>