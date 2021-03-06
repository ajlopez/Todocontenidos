<?php
	define('CATEGORIAS_ESTADO_NORMAL',0);
	define('CATEGORIAS_ESTADO_DESHABILITADA',1);

	$CategoriasEstado = array(CATEGORIAS_ESTADO_NORMAL => 'Normal',
		CATEGORIAS_ESTADO_DESHABILITADA => 'Deshabilitada');

	include_once($PaginaPrefijo.'Conexion.inc.php');

function CategoriaTraduce($Id, &$Descripcion, &$IdPadre)
{
	if (!$Id) {
		$Descripcion = "Categor&iacute;as";
		$IdPadre = 0;
		return;
	}

	Conectar();

	$rs = mysql_query("select * from categorias where Id=$Id");
	if ($rs && mysql_num_rows($rs)) {
		$reg = mysql_fetch_object($rs);
		$Descripcion = $reg->Descripcion;
		$IdPadre = $reg->IdPadre;
		if ($reg->Estado)
			$Descripcion = '(' . $Descripcion . ')';
	}
	else {
		$Descripcion = "";
		$IdPadre = 0;
		return;
	}
	if ($rs)
		mysql_free_result($rs);

	Desconectar();
}

function CategoriaTraduceEx($Id, &$Descripcion, &$Terminos, &$IdPadre)
{
	if (!$Id) {
		$Descripcion = "Categor&iacute;as";
		$IdPadre = 0;
		return;
	}

	Conectar();

	$rs = mysql_query("select * from categorias where Id=$Id");
	if ($rs && mysql_num_rows($rs)) {
		$reg = mysql_fetch_object($rs);
		$Descripcion = $reg->Descripcion;
		$Terminos = $reg->Terminos;
		$IdPadre = $reg->IdPadre;
		if ($reg->Estado)
			$Descripcion = '(' . $Descripcion . ')';
	}
	else {
		$Descripcion = "";
		$Terminos = "";
		$IdPadre = 0;
		return;
	}
	if ($rs)
		mysql_free_result($rs);

	Desconectar();
}

function CategoriaEnlace($Id, $Descripcion, $Pagina = 'Categoria.php', $Parametro='Id')
{
	global $PaginaPrefijo;

	if (strpos($Pagina,"?")>0)
		$Pagina = $Pagina . "&$Parametro=$Id";
	else
		$Pagina = $Pagina . "?$Parametro=$Id";

	return "<a href='$PaginaPrefijo$Pagina'>$Descripcion</a>\n";
}

function CategoriasEnlaces($Id, $Pagina = 'Categoria.php', $Parametro='Id')
{
	if (!$Id)
		return '';

	CategoriaTraduce($Id,$Descripcion,$IdPadre);

	if ($IdPadre)
		$Enlaces = CategoriasEnlaces($IdPadre, $Pagina, $Parametro) . '&nbsp;->&nbsp;';

	$Enlaces .= CategoriaEnlace($Id, $Descripcion, $Pagina, $Parametro);

	return $Enlaces;	
}

function CategoriaVisita($Id) {
	Conectar();
	mysql_query("update categorias set Visitas = Visitas + 1 where Id = $Id");
	Desconectar();
}

function CategoriaEstadoTraduce($estado) {
	global $CategoriasEstado;

	if ($CategoriasEstado[$estado])
		return $CategoriasEstado[$estado];

	return $estado;
}

function CategoriaPoneEstado($Id,$Estado=CATEGORIAS_ESTADO_NORMAL,$Expande=0) {
	Conectar();

	mysql_query("update categorias set Estado = $Estado where Id = $Id");

	if ($Expande) {
		$rs = mysql_query("select Id from categorias where IdPadre = $Id");
		while (list($IdHijo) = mysql_fetch_row($rs))
			CategoriaPoneEstado($IdHijo, $Estado, $Expande);
		mysql_free_result($rs);
	}

	Desconectar();
}

?>