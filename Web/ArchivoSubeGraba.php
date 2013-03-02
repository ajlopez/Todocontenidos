<?
	include('Usuarios.inc.php');

	AdministradorControla();

	if (copy($userfile,".\\$filename"))
		$PaginaTitulo = "Archivo $filename grabado";
	else
		$PaginaTitulo = "Error grabando archivo $filename";

	include('Inicio.inc.php');
	include('Final.inc.php');
?>