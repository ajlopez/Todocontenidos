<?
	include_once('Buscar.inc.php');
	include_once('Conexion.inc.php');

	if (!$Descripcion)
		$Descripcion='Empleo';

	$results = Buscar($Descripcion);

	Conectar();

	foreach ($results as $result) {
		$IdItem = BuscarItem($result['Url'],$result['Title']);

		if (!$IdItem) {
			$Url = addslashes($result['Url']);
			$Title = addslashes($result['Title']);
			$Summary = addslashes($result['Summary']);

			if ($IdCategoria)
				InsertarItem($IdCategoria,$Url,$Title,$Summary);
?>
<xmp>
<?
	print_r($result);
?>
</xmp>
<?
		}			
	}
?>
