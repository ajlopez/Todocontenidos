<?
if (__Paginas_inc == 1)
	return;

define ('__Paginas_inc', 1);

	include($PaginaPrefijo.'Azar.inc.php');

function PaginaActual() {
	global $SCRIPT_NAME;
	global $QUERY_STRING;

	$enlace = $SCRIPT_NAME;

	if ($QUERY_STRING)
		$enlace .= "?$QUERY_STRING";

	return $enlace;
}

function PaginaPrincipal() {
	return "default.php";
}

function PaginaUsuario() {
	return "Usuario.php";
}

function PaginaAdministrador() {
	return "Administrador.php";
}

function PaginaControl($enlace = '') {
	if ($enlace)
		return $enlace;

	return PaginaPrincipal();
}

function PaginaRedireccionar($enlace = '', $alternativo = '') {
	global $PaginaPrefijo;

	if (!$enlace && !$alternativo)
		header("Location: $PaginaPrefijo" . PaginaControl());
	elseif (!$enlace)
		header("Location: $PaginaPrefijo$alternativo");
	else
		header("Location: $PaginaPrefijo$enlace");
	exit;
}

function PaginaSalir() {
	PaginaRedireccionar(PaginaControl());
}

?>