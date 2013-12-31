<?php
    include_once('Settings.inc.php');
    
	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Errores.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Paginas.inc.php');
	include_once('Categorias.inc.php');

	AdministradorControla('');

	Conectar();
	
	if (isset($Id)) {
		$sql = "select * from categorias where Id = $Id"; 
		$rs = mysql_query($sql);
		$reg = mysql_fetch_object($rs);
		$Descripcion = $reg->Descripcion;
		$Detalle = $reg->Detalle;
		$Resumen = $reg->Resumen;
		$Terminos = $reg->Terminos;
		$IdPadre = $reg->IdPadre;
		$Alias = $reg->Alias;
		mysql_free_result($rs);
		$PaginaTitulo = "Actualiza Categor&iacute;a";
		$EsNuevo = 0;
	}	
	else {
		$PaginaTitulo = "Nueva Categor&iacute;a";
		$EsNuevo = 1;
	}

	require('Inicio.inc.php');
?>

<center>

<?php
	$Enlaces = CategoriasEnlaces($IdPadre);

	if ($Enlaces) {
?>
<p>
<?php echo $Enlaces; ?>
</p>
<?php
	}
?>

<p>
<a href="Categorias.php">Categor&iacute;as</a>

<?php
	if (!$EsNuevo) {
?>
&nbsp;
&nbsp;
<a href="Categoria.php?Id=<?php echo $Id; ?>">Categor&iacute;a</a>
&nbsp;
&nbsp;
<a href="CategoriaElimina.php?Id=<?php echo $Id; ?>">Elimina</a>
<?php
	}
?>
</p>

<p>

<form action="CategoriaGraba.php" method=post>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?php
	if (!$EsNuevo)
		CampoEstaticoGenera("Id",$Id);
	CampoTextoGenera("Descripcion","Descripci&oacute;n",$Descripcion,50);
	CampoTextoGenera("Alias","Alias",$Alias,16);
	CampoMemoGenera("Detalle","Detalle",$Detalle,10,50);
	CampoMemoGenera("Resumen","Resumen",$Resumen,5,50);
	CampoTextoGenera("Terminos","T&eacute;rminos",$Terminos,60);

	CampoAceptarGenera();
?>
</table>

<input type="hidden" name="IdPadre" value="<?php echo $IdPadre; ?>">
<?php
	if (!$EsNuevo)
		IdGenera($Id);
?>
</form>

</center>

<?php
	Desconectar();
	require('Final.inc.php');
?>

