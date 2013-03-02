<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Utiles.inc.php');
	include('Categorias.inc.php');
	include('Items.inc.php');
	include('Usuarios.inc.php');

	AdministradorControla('');

	Conectar();
	
	SesionPone('ItemEnlace',PaginaActual());
	SesionPone('CategoriaEnlace',PaginaActual());

	if (!isset($Id))
		PaginaSalir();

	$sql = "select Descripcion, Detalle, Url, IdUsuario, Orden, Visitas, Favoritos, Votos1, Votos2, Votos3, Votos4, Votos5, Estado
		 from items where Id = $Id";		 
	$res = mysql_query($sql);
	list($Descripcion, $Detalle, $Url, $IdUsuario, $Orden, $Visitas, $Favoritos, $Votos1, $Votos2, $Votos3, $Votos4, $Votos5, $Estado)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$PaginaTitulo = "Item: $Descripcion";

	require('Inicio.inc.php');
?>

<center>

<p>
<a href="Items.php">Items</a>
&nbsp;
&nbsp;
<a href="ItemActualiza.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="ItemElimina.php?Id=<? echo $Id; ?>">Elimina</a>
&nbsp;
&nbsp;
<a href="CategoriaSelecciona.php?IdItem=<? echo $Id; ?>">Agrega a Categor&iacute;a</a>
<br>
<a href="Eventos.php?Tipo=IT&IdParametro=<? echo $Id; ?>">Visitas</a>
&nbsp;
<?
	if ($Estado == ITEMS_ESTADO_NORMAL) {
?>
<a href="ItemCambiaEstado.php?Id=<? echo $Id; ?>&Estado=<? echo ITEMS_ESTADO_PENDIENTE ?>">Pasa a Pendiente</a>
<?
	}
	else {
?>
<a href="ItemCambiaEstado.php?Id=<? echo $Id; ?>&Estado=<? echo ITEMS_ESTADO_NORMAL ?>">Pasa a Normal</a>
<?
	}
?>
&nbsp;
<a href="ItemAArticulo.php?Id=<? echo $Id; ?>">Convierte en Artículo</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="Formulario">
<?
	CampoEstaticoGenera("Id",$Id);
	CampoEstaticoGenera("Descripci&oacute;n",$Descripcion);
	CampoEstaticoGenera("Detalle",NormalizaHtml($Detalle));
	CampoEstaticoGenera("Enlace",EnlaceUrlNuevo($Url));
	CampoEstaticoGenera("Orden",$Orden);
	if ($IdUsuario) {
		$UsuarioDescripcion = UsuarioTraduce($IdUsuario);
		if (!$UsuarioDescripcion)
			$UsuarioDescripcion = $IdUsuario;
		CampoEstaticoGenera("Usuario","<a href='Usuario.php?Id=$IdUsuario'>$UsuarioDescripcion</a>");
	}

	CampoEstaticoGenera("Estado",TextoEstado($Estado));
	CampoEstaticoGenera("Visitas",$Visitas);
	CampoEstaticoGenera("Favoritos",$Favoritos);

	$Votos = $Votos1 + $Votos2 + $Votos3 + $Votos4 + $Votos5;
	if ($Votos)
		$Promedio = ($Votos1 + 2*$Votos2 + 3*$Votos3 + 4*$Votos4 + 5*$Votos5)/$Votos;
	else
		$Promedio = 0;
	CampoEstaticoGenera("Votos", "1=$Votos1, 2=$Votos2, 3=$Votos3, 4=$Votos4, 5=$Votos5, Promedio=$Promedio");
?>
</table>

<?
function MuestraRegistro($reg) {
	global $Id;

	FilaInicio();

	if ($reg["Estado"])
		DatoGenera("(".CategoriasEnlaces($reg["IdCategoria"]).")");
	else
		DatoGenera(CategoriasEnlaces($reg["IdCategoria"]));

	$accion = "<a href='CategoriaSelecciona.php?IdItem=$Id&IdCategoria=$reg[IdCategoria]&IdCategoriaItem=$reg[Id]'>Modifica</a>";
	if ($reg["Estado"])
		$accion .= "&nbsp;&nbsp;<a href='CategoriaItemCambiaEstado.php?Id=$reg[Id]&Estado=0&IdItem=$reg[IdItem]'>Habilita</a>";
	else
		$accion .= "&nbsp;&nbsp;<a href='CategoriaItemCambiaEstado.php?Id=$reg[Id]&Estado=1&IdItem=$reg[IdItem]'>Deshabilita</a>";
	$accion .= "&nbsp;&nbsp;";
	$accion .= "<a href='CategoriaItemElimina.php?Id=$reg[Id]&IdItem=$reg[IdItem]'>Elimina</a>";

	DatoGenera($accion);

	FilaFinal();
}

	$rs=mysql_query("select * from categoriasitems where IdItem=$Id order by Id");
	if (mysql_num_rows($rs)) {
?>

<p>
<h2>Categor&iacute;as</h2>

<?		
	
		$titulos = array("Descripci&oacute;n", "Acci&oacute;n");

		TablaInicio($titulos,"90%");

		while ($reg=mysql_fetch_array($rs)) 
			MuestraRegistro($reg);
				
		TablaFinal();
	}
?>

</center>

<?
	Desconectar();
	require('Final.inc.php');
?>

