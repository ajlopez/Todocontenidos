<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');

	if (!isset($Filtro) && !isset($IdCategoria))
		PaginaRedireccionar('ArticulosFiltro.php');

	$PaginaTitulo = "Art&iacute;culos";

	Conectar();

	$sql = "select distinct a.Titulo, a.Id, a.Enlace from (articulos a left join categoriasarticulos ca on a.Id = ca.IdArticulo) left join categorias c on ca.IdCategoria = c.Id";

	$where = '';

	if ($IdCategoria) {
		if ($where)
			$where .= ' and ';
		$where .= "ca.IdCategoria = $IdCategoria";
	}

	if ($Titulo) {
		if ($where)
			$where .= ' and ';
		$where .= "a.Titulo like '%$Titulo%'";
	}

	if ($Palabra) {
		if ($where)
			$where .= ' and ';
		$where .= "(a.Titulo like '%$Palabra%' or a.Resumen like '%$Palabra%' or a.Contenido like '%$Palabra%' or a.Enlace like '%$Palabra%' or a.Copete like '%$Palabra%')";
	}

	if ($Enlace) {
		if ($where)
			$where .= ' and ';
		$where .= "a.Enlace like '%$Enlace%'";
	}

	if ($Categoria) {
		if ($where)
			$where .= ' and ';
		$where .= "(c.Descripcion like '%$Categoria%' or c.Detalle like '%$Categoria%' or c.Alias like '%$Categoria%' or c.Resumen like '%$Categoria%')";	
	}

	if ($where)
		$sql .= " where $where";

	$sql .= " order by a.Titulo";

	$rs = mysql_query($sql);

	$titulos = array("T&iacute;tulo");

	SesionPone("ArticuloEnlace", PaginaActual());

	include('Inicio.inc.php');
?>

<center>

<p>
<a href="ArticuloActualiza.php?IdCategoria=$IdCategoria">Nuevo Art&iacute;culo...</a>
<p>

<?		
function MuestraRegistro($reg) {
	FilaInicio();
	DatoEnlaceGenera($reg["Titulo"], "Articulo.php?Id=".$reg["Id"]."&Enlace=".$reg["Enlace"]);
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
