<?
	include_once('Buscar.inc.php');

	if (!$Descripcion)
		$Descripcion='Empleo';

	$results = Buscar($Descripcion);
?>
<xmp>
<?
	print_r($results);
?>
</xmp>