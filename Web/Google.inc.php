<?php
$Google1 = false;
$Google2 = false;

function ShowGoogle() {
	global $Google1;
	global $Google2;

//	if ($Google1 || random(0,200)%2) {
	if (random(0,200)%2) {
		ShowGoogle2();
		return;
	}

	$Google1 = true;
?>
<p>
<script type="text/javascript"><!--
google_ad_client = "pub-8624135492444658";
//728x90, created 12/16/07
google_ad_slot = "0384229662";
google_ad_width = 728;
google_ad_height = 90;
//--></script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</p>
<?php
}

function ShowGoogle2() {
	global $Google2;

	if ($Google2)
		return;

	$Google2 = true;
?>
<script type="text/javascript"><!--
google_ad_client = "pub-8624135492444658";
//728x90, created 1/16/08
google_ad_slot = "1020804345";
google_ad_width = 728;
google_ad_height = 90;
google_cpa_choice = ""; // on file
//--></script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<?php
}

function ShowGoogleV() {
?>
<script type="text/javascript"><!--
google_ad_client = "pub-8624135492444658";
//120x600, created 1/16/08
google_ad_slot = "8208365816";
google_ad_width = 120;
google_ad_height = 600;
//--></script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<?php
}

?>