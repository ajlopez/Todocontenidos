<?php
	include_once($PaginaPrefijo.'Conexion.inc.php');
	include_once($PaginaPrefijo.'Azar.inc.php');
	include_once($PaginaPrefijo.'Errores.inc.php');

	$SesionTiempo = 86400;

	if (!isset($GLOBALS['Sesion']))
		$GLOBALS['Sesion'] = array();

function SesionDepura() {
	global $SesionTiempo;

	$tiempo = time() - $SesionTiempo;
	mysql_query("delete from sesion where Tiempo < $tiempo");
}

function SesionDestruye() {
	global $CkSesionId;
	
	if (!$CkSesionId)
		return;

	setcookie('CkSesionId');

	Conectar();
	mysql_query("delete from sesion where Codigo = '$CkSesionId'");
	Desconectar();
}

function SesionCrea() {
	global $SesionId;
//	global $GLOBALS['Sesion'];
	global $CkDebug;

	if ($CkDebug){
		echo "SesionCrea<br>";
	}

	$SesionId = RandName(16);
	$GLOBALS['Sesion'] = array();
	$Texto = addSlashes(serialize($GLOBALS['Sesion']));
	setcookie('CkSesionId', $SesionId, 0, "/");
	Conectar();
	mysql_query("insert sesion set
		Codigo = '$SesionId',
		Texto = '$Texto',
		Tiempo = unix_timestamp()
		");
	Desconectar();
}

function SesionLee() {
	global $CkSesionId;
	global $SesionId;
//	global $GLOBALS['Sesion'];
	global $CkDebug;

	if ($CkDebug)
		echo "SesionLee $CkSesionId<br>";

	Conectar();

	SesionDepura();

	if ($CkSesionId) {
		$SesionId=$CkSesionId;

		$rs = mysql_query("select id, codigo, texto from sesion where Codigo = '$SesionId'");

		if ($rs && mysql_num_rows($rs)) {
			list($Id,$Codigo,$Texto) = mysql_fetch_row($rs);
			$arreglo = unserialize(stripSlashes($Texto));
			$GLOBALS['Sesion'] = $arreglo;

			if ($Texto && !$GLOBALS['Sesion']) {
				$arreglo2 = unserialize($Texto);
				$GLOBALS['Sesion'] = $arreglo2;
			}

			if ($Texto && !$GLOBALS['Sesion']) {
				$arreglo3 = unserialize($Texto);
				$GLOBALS['Sesion'] = $arreglo3;
			}

			mysql_query("update sesion set Tiempo = unix_timestamp() where Codigo = '$SesionId'");
			if ($CkDebug)
				echo "Texto es " . $Texto . "<br>";
			if ($CkDebug)
				echo "Sesion es " . $GLOBALS['Sesion'] . "<br>";
		}
		else
			SesionCrea();
	}
	else
		SesionCrea();

	Desconectar();
}

function SesionGraba() {
//	global $GLOBALS['Sesion'];
	global $SesionId;
	global $CkDebug;

	if ($CkDebug){
		echo "SesionGraba<br>";
		SesionMuestra();
	}

	if (!is_array($GLOBALS['Sesion']))
		SesionLee();

	Conectar();
	
	$Texto = addSlashes(serialize($GLOBALS['Sesion']));
	$query = "update sesion set Texto = '$Texto', Tiempo = unix_timestamp() where Codigo = '$SesionId'";
	$res = mysql_query($query);
	if (!$res)
		ErrorSqlEx(__LINE__, __FILE__, $query);

	Desconectar();
}

function SesionToma($nombre) {
//	global $GLOBALS['Sesion'];
	global $CkDebug;

	if ($CkDebug){
		echo "SesionToma $nombre<br>";
		SesionMuestra();
	}

	if (is_array($GLOBALS['Sesion']))
		return($GLOBALS['Sesion'][$nombre]);

	SesionLee();

	if (is_array($GLOBALS['Sesion']))
		return($GLOBALS['Sesion'][$nombre]);

	return '';
}

function SesionPone($nombre,$valor,$graba=1) {
//	global $GLOBALS['Sesion'];
	global $CkDebug;

	if ($CkDebug){
		echo "SesionPone $nombre $valor<br>";
		SesionMuestra();
	}

	$GLOBALS['Sesion'][$nombre]=$valor;

	if ($graba)
		SesionGraba();
}

function SesionSaca($nombre,$graba=1) {
//	global $GLOBALS['Sesion'];
	global $CkDebug;

	if ($CkDebug){
		echo "SesionSaca $nombre<br>";
		SesionMuestra();
	}

	if (!$GLOBALS['Sesion'])
		return;

	unset($GLOBALS['Sesion'][$nombre]);

	if ($graba)
		SesionGraba();
}

function SesionMuestra() {
//	global $GLOBALS['Sesion'];
	global $SesionId;

	reset($GLOBALS['Sesion']);

	echo "SesionId: $SesionId<br>\n";

	while (list($codigo,$valor) = each($GLOBALS['Sesion']))
		echo "$codigo: $valor<br>\n";
}

	SesionLee();
	if ($CkDebug)
		SesionMuestra();
?>