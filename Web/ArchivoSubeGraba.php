<?php
    include_once('Settings.inc.php');
    
	include_once('Usuarios.inc.php');

	AdministradorControla();

	if (copy($userfile,".\\$filename"))
		$PaginaTitulo = "Archivo $filename grabado";
	else
		$PaginaTitulo = "Error grabando archivo $filename";

	include('Inicio.inc.php');
	include('Final.inc.php');
?>