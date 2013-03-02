<?
	$PaginaPrefijo='../';

	$pagina = $PHP_SELF;

	if (substr($pagina,-1)=='/')
		$pagina = substr($pagina,0,strlen($pagina)-1);

	if (substr($pagina,-10)=='/index.php')
		$pagina = substr($pagina,0,strlen($pagina)-10);

	$sufijo = substr(strrchr($pagina,'/'),1);

//	echo $PHP_SELF;
//	echo '<br>';
//	echo $sufijo;
	
	include($PaginaPrefijo.'Conexion.inc.php');

	Conectar();

	$rsCategoria = mysql_query("select Id from categorias where Alias = '$sufijo'");

	if ($rsCategoria) {
		list($Id)=mysql_fetch_row($rsCategoria);
		mysql_free_result($rsCategoria);
	}

	include('../Tema.php');

	Desconectar();
?>