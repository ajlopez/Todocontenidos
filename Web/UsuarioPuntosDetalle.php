<?php
    include_once('Settings.inc.php');

	include_once('Campos.inc.php');
	include_once('Conexion.inc.php');
	include_once('Paginas.inc.php');
	include_once('Sesion.inc.php');
	include_once('Usuarios.inc.php');
	include_once('Puntos.inc.php');

	$PaginaTitulo = "Detalle de Mis Puntos";

	UsuarioControla();

	Conectar();

	$IdUsuario = UsuarioId();

	$sql = "select * from puntos where IdUsuario = $IdUsuario order by Id";
	$rs = mysql_query($sql);

	$titulos = array("Fecha/Hora", "Puntos", "Detalle");

	include('Inicio.inc.php');
?>

<center>

<p>

<?php		
function MuestraRegistro($reg) {
   FilaInicio();
   DatoGenera($reg["FechaHora"]);
   DatoNumGenera($reg["Puntos"]);
   DatoGenera(PuntosTipoTraduce($reg["Tipo"]));
   FilaFinal();
}
	
	TablaInicio($titulos,"90%");

	while ($reg=mysql_fetch_array($rs)) 
		MuestraRegistro($reg);
				
	TablaFinal();
	
?>

</center>

<?php
	Desconectar();
	include('Final.inc.php');
?>
