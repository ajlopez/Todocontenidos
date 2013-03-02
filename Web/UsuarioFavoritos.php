<?
	include('Campos.inc.php');
	include('Conexion.inc.php');
	include('Errores.inc.php');
	include('Paginas.inc.php');
	include('Sesion.inc.php');
	include('Utiles.inc.php');
	include('Usuarios.inc.php');
	include('Categorias.inc.php');

	Conectar();
	
	if (!UsuarioIdentificado())
		PaginaRedireccionar('UsuarioPuntosNo.php');

	if (!isset($Id))
		$Id = UsuarioId();

	if ($Id<>UsuarioId() and !EsAdministrador())
		PaginaSalir();

	SesionPone('UsuarioEnlace',PaginaActual());

	$sql = "select Codigo, Contrasenia, Nombre, Apellido, Email, IdSexo, FechaNacimiento, IdPais, Provincia, Ciudad, CodigoPostal, EsAdministrador,
		FechaHoraAlta, FechaHoraModificacion, FechaHoraUltimoIngreso,
		Ingresos, Puntos, PuntosAnteriores, PuntosPendientes
		 from usuarios where Id = $Id";		 
	$res = mysql_query($sql);
	list($Codigo, $Contrasenia, $Nombre, $Apellido, $Email, $IdSexo, $FechaNacimiento, $IdPais, $Provincia, $Ciudad, $CodigoPostal, $EsAdministrador, $FechaHoraAlta,
		$FechaHoraModificacion, $FechaHoraUltimoIngreso,
		$Ingresos, $Puntos, $PuntosAnteriores, $PuntosPendientes)
		= mysql_fetch_row($res);
	mysql_free_result($res);
	$PaginaTitulo = "Favoritos del Usuario";

	if ($Id==UsuarioId())
		$PaginaTitulo = "Mis Favoritos";

 	$rsPais = mysql_query("Select Descripcion from paises where Id = $IdPais");
	if ($rsPais && mysql_num_rows($rsPais))
		list($PaisDescripcion) = mysql_fetch_row($rsPais);
	mysql_free_result($rsPais);

	$rsFavoritos = mysql_query("select f.Id, f.IdItem, f.IdCategoria, i.Descripcion as ItemDescripcion, i.Detalle as ItemDetalle, i.Url as ItemUrl from favoritos f, items i, categorias c where f.IdUsuario = $Id and i.Id = f.IdItem and c.Id = f.IdCategoria order by f.IdCategoria, i.Orden, i.Id desc");

	require('Inicio.inc.php');

	while (list($IdFavorito,$IdItem,$IdCategoria,$ItemDescripcion,$ItemDetalle,$ItemUrl) = mysql_fetch_row($rsFavoritos)) {
		if ($IdCategoria <> $IdUltimaCategoria) {
			if ($IdUltimaCategoria) {
?>
</blockquote>
<?
			}
?>
<p>
<?= CategoriasEnlaces($IdCategoria,'Tema.php') ?>
</p>
<blockquote>
<?
			$IdUltimaCategoria = $IdCategoria;
		}
?>
<p>
<a class=item target='_blank' href="<? echo $PaginaPrefijo; ?>ItemVe.php?Id=<? echo $IdItem; ?>">
<? echo $ItemDescripcion; ?>
</a>
<br>
<? echo NormalizaHtml($ItemDetalle); ?>
</p>
<?
	}
?>
</blockquote>
<?
	mysql_free_result($rsFavoritos);
	Desconectar();
	require('Final.inc.php');
?>

