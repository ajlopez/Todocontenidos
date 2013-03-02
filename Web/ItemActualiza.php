<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Usuarios.inc.php');
	include('Paginas.inc.php');

	AdministradorControla('');

	Conectar();
	
	if (isset($Id)) {
		$sql = "select * from items where Id = $Id"; 
		$rs = mysql_query($sql);
		$reg = mysql_fetch_object($rs);
		$Descripcion = $reg->Descripcion;
		$Detalle = $reg->Detalle;
		$Url = $reg->Url;
		$Orden = $reg->Orden;
		$IdUsuario = $reg->IdUsuario;
		mysql_free_result($rs);
		$PaginaTitulo = "Actualiza Item";
		$EsNuevo = 0;
	}	
	else {
		$PaginaTitulo = "Nuevo Item";
		$EsNuevo = 1;
	}

	require('Inicio.inc.php');
?>

<center>

<p>
<?
	if (!$EsNuevo) {
?>
&nbsp;
&nbsp;
<a href="Item.php?Id=<? echo $Id; ?>">Item</a>
&nbsp;
&nbsp;
<a href="ItemElimina.php?Id=<? echo $Id; ?>">Elimina</a>
<?
	}
?>
</p>

<p>

<form action="ItemGraba.php" method=post>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	if (!$EsNuevo)
		CampoEstaticoGenera("Id",$Id);
	CampoTextoGenera("Descripcion","Descripci&oacute;n",$Descripcion,50);
	CampoTextoGenera("Url", "Enlace", $Url, 50);
	CampoMemoGenera("Detalle","Detalle",$Detalle,10,50);
	CampoTextoGenera("Orden", "Orden", $Orden, 5);

	CampoAceptarGenera();
?>
</table>

<input type="hidden" name="IdCategoria" value="<? echo $IdCategoria; ?>">

<?
	if (!$EsNuevo)
		IdGenera($Id);
?>

</form>

</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

