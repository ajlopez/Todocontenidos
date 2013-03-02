<?
	include('Paginas.inc.php');
	include('Articulos.inc.php');
	include('Conexion.inc.php');
?>

<html>
<head>

<link rel="stylesheet" href="css/Estilo.css">
</head>

<body bgcolor=#ffffff leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>

<table width="100%" class="Tope" cellspacing=0 cellpadding=0 border=0>
<tr height=60>
<td class="TituloSitio">
<!-- &nbsp;todocontenidos.com -->
<a href="<? echo PaginaPrincipal(); ?>" target="_top">
<img src="images/todocontenidos2.gif" border=0>
</a>
</td>
</tr>
<tr>
<td>

<?
	Conectar();

	$rsArticulo = mysql_query("select Visitas, Votos1, Votos2, Votos3, Votos4, Votos5 from articulos where Id = $Id");
	list($Visitas, $Votos1, $Votos2, $Votos3, $Votos4, $Votos5) = mysql_fetch_row($rsArticulo);
	mysql_free_result($rsArticulo);

	if (!$Votado)
		$Votado = ArticuloVotado($Id);
?>

<table width=100% bgcolor=black cellspacing=1 cellpadding=0>
<tr>
<?
	if (!$Votado) {
?>
<td bgcolor="#e71212" align=left>
<font class=headerU><b>&nbsp;&nbsp;Vote 
&nbsp;&nbsp;<a class=headerU href="ArticuloVoto.php?Id=<? echo $Id ?>&Voto=1">1=Malo</a>
&nbsp;&nbsp;<a class=headerU href="ArticuloVoto.php?Id=<? echo $Id ?>&Voto=2">2=Regular</a>
&nbsp;&nbsp;<a class=headerU href="ArticuloVoto.php?Id=<? echo $Id ?>&Voto=3">3=Bueno</a>
&nbsp;&nbsp;<a class=headerU href="ArticuloVoto.php?Id=<? echo $Id ?>&Voto=4">4=Muy Bueno</a>
&nbsp;&nbsp;<a class=headerU href="ArticuloVoto.php?Id=<? echo $Id ?>&Voto=5">5=Excelente</a>
</b>
</font>
</td>
<?
	}
	else {
		$Promedio=ArticuloPromedio($Votos1,$Votos2,$Votos3,$Votos4,$Votos5);
?>
<td bgcolor="#e71212" align=left>
<font class=headerU><b>&nbsp;&nbsp;
<? echo $Visitas; ?> Visitas
</b>
</font>
</td>

<td bgcolor="#e71212" align=left>
<font class=headerU><b>&nbsp;&nbsp;
Voto Promedio <? echo $Promedio; ?>
</b>
</font>
</td>
<?
	}
?>
<td bgcolor="#e71212" align=right>
<font class=headerU><b>Internet que sirve</b>&nbsp;&nbsp;&nbsp;&nbsp;</font>
</td>
</table>

</td>
</tr>

</table>
</body>
</html>

<?
	Desconectar();
?>
