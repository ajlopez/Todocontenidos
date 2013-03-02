<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');

	if (!isset($Filtro) && !isset($IdCategoria))
		PaginaRedireccionar('ItemsFiltro.php');

	$PaginaTitulo = "Items";

	Conectar();

	$sql = "select distinct i.Descripcion, i.Id, i.Url, i.Estado from (items i left join categoriasitems ci on i.Id = ci.IdItem) left join categorias c on ci.IdCategoria = c.Id";

	$where = '';

	if ($IdCategoria) {
		if ($where)
			$where .= ' and ';
		$where .= "ci.IdCategoria = $IdCategoria";
	}

	if ($Descripcion) {
		if ($where)
			$where .= ' and ';
		$where .= "i.Descripcion like '%$Descripcion%'";
	}

	if ($Palabra) {
		if ($where)
			$where .= ' and ';
		$where .= "(i.Descripcion like '%$Palabra%' or i.Detalle like '%$Palabra%' or i.Url like '%$Palabra%')";
	}

	if ($Enlace) {
		if ($where)
			$where .= ' and ';
		$where .= "i.Url like '%$Enlace%'";
	}

	if ($Categoria) {
		if ($where)
			$where .= ' and ';
		$where .= "(c.Descripcion like '%$Categoria%' or c.Detalle like '%$Categoria%' or c.Alias like '%$Categoria%' or c.Resumen like '%$Categoria%')";	
	}

	if ($where)
		$sql .= " where $where";

	$sql .= " order by i.Descripcion";

	$rs = mysql_query($sql);

	$titulos = array("Descripci&oacute;n");

	SesionPone("ItemEnlace", PaginaActual());

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="ItemActualiza.php?IdCategoria=$IdCategoria">Nuevo Item...</a>
<p>

<?		
function MuestraRegistro($reg) {
	FilaInicio();
	$descripcion = $reg["Descripcion"];
	if ($reg["Estado"])
		$descripcion = "($descripcion)";
	DatoEnlaceGenera($descripcion, "Item.php?Id=".$reg["Id"]."&Url=".$reg["Url"]);
	FilaFinal();
}
	
	TablaInicio($titulos,"90%");

	while ($reg=mysql_fetch_array($rs)) 
		MuestraRegistro($reg);
				
	TablaFinal();
	
?>

</center>

<?
	Desconectar();
	include('Final.inc.php');
?>
