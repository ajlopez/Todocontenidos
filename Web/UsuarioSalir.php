<?php
    include_once('Settings.inc.php');
    
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');

	SesionDestruye();

	PaginaRedireccionar(PaginaPrincipal());
?>