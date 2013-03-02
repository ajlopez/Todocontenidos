<?
	include('Usuarios.inc.php');
	include('Conexion.inc.php');

	UsuarioControla();

	if (!$Id)
		PaginaSalir();

	if (!$Pagina)
		$Pagina = 'Tema.php?Id='.$IdCategoria;

	Conectar();

	$IdUsuario = UsuarioId();

//	echo "select Id from favoritos where IdCategoria = $IdCategoria and IdItem = $Id and IdUsuario = $IdUsuario";

	$rs = mysql_query("select Id from favoritos where IdCategoria = $IdCategoria and Id = $Id and IdUsuario = $IdUsuario");
	list($IdFavorito) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	if ($IdFavorito) {
		header("Location: $Pagina");
		exit;
	}

	mysql_query("insert favoritos set IdItem = $Id, IdCategoria = $IdCategoria, IdUsuario = $IdUsuario");
	mysql_query("update items set Favoritos = Favoritos + 1 where Id = $Id");

	header("Location: $Pagina");	
?>