<?php
	include_once('Conexion.inc.php');

function NormalizaDescripcion($Descripcion) {
	$Descripcion2 = str_replace("แ","a",$Descripcion);
	$Descripcion2 = str_replace("้","e",$Descripcion2);
	$Descripcion2 = str_replace("ํ","i",$Descripcion2);
	$Descripcion2 = str_replace("๓","o",$Descripcion2);
	$Descripcion2 = str_replace("๚","u",$Descripcion2);
	$Descripcion2 = str_replace("๑","n",$Descripcion2);

	return $Descripcion2;
}

function NormalizaTextoY($Texto) {
	$b = substr('รณญ',0,2);
	$Texto = str_replace($b,"&oacute;",$Texto);
	$b = substr('รบ',0,2);
	$Texto = str_replace($b,'&uacute;',$Texto);
	$b = substr('รฉ',0,2);
	$Texto = str_replace($b,'&eacute;',$Texto);
	$b = substr('รก',0,2);
	$Texto = str_replace($b,'&aacute;',$Texto);
	$b = substr('รฑ',0,2);
	$Texto = str_replace($b,'&ntilde;',$Texto);
	$b = substr('ร',0,1);
	$Texto = str_replace('รญ',"&iacute;",$Texto);
	$Texto = str_replace('&amp;ญamp;',"&",$Texto);

	return $Texto;
}

function Buscar($Descripcion) {
	$Descripcion = NormalizaDescripcion($Descripcion);

	$req = "http://search.yahooapis.com/WebSearchService/V1/webSearch?appid=YahooDemo&query=".urlencode($Descripcion)."&results=40&output=php";
	// Make the request
	$phpserialized = file_get_contents($req);
	// Parse the serialized response
	$phparray = unserialize($phpserialized);
	
	if ($phparray['ResultSet']['Result']) {
		foreach ($phparray['ResultSet']['Result'] as $Item) {
			$Summary = NormalizaTextoY($Item['Summary']);
			$Title = NormalizaTextoY($Item['Title']);
			$Url = $Item['Url'];

			unset($result);

			$result['Title'] = $Title;
			$result['Url'] = $Url;
			$result['Summary'] = $Summary;

			$results[] = $result;
		}
	}

	return $results;
}

function BuscarItem($Url,$Title) {
	$Url = addslashes($Url);
	$Title = addslashes($Title);

	$rs = mysql_query("select Id from items where Url = '$Url' or Descripcion='$Title'");
	list($IdItem)=mysql_fetch_row($rs);
	mysql_free_result($rs);

	return $IdItem;
}

function InsertarItem($IdCategoria,$Url,$Titulo,$Descripcion) {
	mysql_query("insert items set Descripcion = '$Titulo',
		Detalle = '$Descripcion',
		Url = '$Url',
		FechaHora = Now(), 
		Orden = 4");
	$IdItem = mysql_insert_id();
	mysql_query("insert categoriasitems set IdCategoria = $IdCategoria, IdItem = $IdItem");
}

function ProcesarItems($IdCategoria,$Terminos) {
	$Terms = explode(';',$Terminos);

	foreach ($Terms as $Term) {
		$Results = Buscar(Trim($Term));
	
		foreach ($Results as $Result) {
			$IdItem = BuscarItem($Result['Url'], $Result['Title']);

			$Url = addslashes($Result['Url']);
			$Title = addslashes($Result['Title']);
			$Summary = addslashes($Result['Summary']);

			if (!$IdItem)
				InsertarItem($IdCategoria,$Url,$Title,$Summary);
		}
	}
}

?>