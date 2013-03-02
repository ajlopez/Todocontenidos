<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Usuarios.inc.php');
	include('Utiles.inc.php');

	$PaginaTitulo = "Items";

	AdministradorControla();

	Conectar();

	$sql = "Select * from items";

	if ($Tipo) {
		$where = WhereAgrega($where,"Tipo = '$Tipo'");
		$Parametros .= "&Tipo=$Tipo";
	}
	if ($IdUsuario)	{
		$where = WhereAgrega($where,"IdUsuario = '$IdUsuario'");
		$Parametros .= "&IdUsuario=$IdUsuario";
	}
	if ($Ip)	{
		$where = WhereAgrega($where,"Ip = '$Ip'");
		$Parametros .= "&Ip=$Ip";
	}
	if ($IdParametro)	{
		$where = WhereAgrega($where,"IdParametro = $IdParametro");
		$Parametros .= "&IdParametro=$IdParametro";
	}
	if ($Parametro)	{
		$where = WhereAgrega($where,"Parametro = '$Parametro'");
		$Parametros .= "&Parametro=$Parametro";
	}
	if ($Subparametro)	{
		$where = WhereAgrega($where,"Subparametro = '$Subparametro'");
		$Parametros .= "&Subparametro=$Subparametro";
	}

	$Desde += 0;
	$Cantidad = 50;

	$sqlcuenta = "Select count(*) from eventos";

	if ($where) {
		$sql .= " where $where";
		$sqlcuenta .= " where $where";
	}

	if ($Orden) {
		$sql .= " order by $Orden";
		$Parametros .= "&Orden=" . urlencode($Orden);
	}
	else
		$sql .= " order by Id desc";

	$sql .= " limit $Desde, $Cantidad";

	$rs = mysql_query($sql);

	$rsCuenta = mysql_query($sqlcuenta);
	list($TotalCantidad) = mysql_fetch_row($rsCuenta);
	mysql_free_result($rsCuenta);

	$titulos = array("Id", "Descripci&oacute;n", "Detalle", "Enlace", "Orden","Usuario","Fecha/Hora Alta");

	$Primero = 0;
	$Ultimo = $TotalCantidad - $Cantidad;
	$Anterior = $Desde-$Cantidad;
	$Siguiente = $Desde+$Cantidad;

	if ($Anterior<0)
		$Anterior = 0;
	if ($Siguiente+$Cantidad>$TotalCantidad)
		$Siguiente = $TotalCantidad - $Cantidad;
	if ($Siguiente<0)
		$Siguiente = 0;
	if ($Ultimo<0)
		$Ultimo = 0;

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="ItemsExplora.php?Desde=0<? echo $Parametros; ?>">Inicio</a>
&nbsp;&nbsp;
<a href="ItemsExplora.php?Desde=<? echo $Anterior; ?><? echo $Parametros; ?>">Anterior</a>
&nbsp;&nbsp;
<a href="ItemsExplora.php?Desde=<? echo $Siguiente; ?><? echo $Parametros; ?>">Siguiente</a>
&nbsp;&nbsp;
<a href="ItemsExplora.php?Desde=<? echo $Ultimo; ?><? echo $Parametros; ?>">Final</a>
&nbsp;&nbsp;

<br>
<br>

<?		
function MuestraRegistro($reg) {
	FilaInicio();
	DatoEnlaceGenera($reg["Id"], "Item.php?Id=".$reg["Id"]);
	DatoGenera($reg['Descripcion']);
	DatoGenera($reg['Detalle']);
	DatoEnlaceGenera($reg['Url'],$reg['Url']);
	DatoGenera($reg['Orden']);
	if ($reg["IdUsuario"])
		DatoEnlaceGenera(UsuarioTraduce($reg["IdUsuario"]), "Usuario.php?Id=".$reg["IdUsuario"]);
	else
		DatoGenera(UsuarioTraduce($reg["IdUsuario"]));
	DatoGenera($reg["FechaHora"]);
	FilaFinal();
}
	
	TablaInicio($titulos,"98%");

	while ($reg=mysql_fetch_array($rs)) 
		MuestraRegistro($reg);
				
	TablaFinal();
	
?>

</center>

<?
	Desconectar();
	include('Final.inc.php');
?>
