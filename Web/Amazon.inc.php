<?
$Amazon1 = false;
$Amazon2 = false;

function ShowAmazonStore() {
	return;

	global $Amazon1;
	global $Amazon2;

	if ($Amazon1 || random(0,200)%3) {
		ShowAmazonKindle();
		return;
	}

	$Amazon1 = true;
?>
<script type="text/javascript"><!--
amazon_ad_tag="todocontenido-20"; 
amazon_ad_width="728"; 
amazon_ad_height="90"; 
amazon_color_border="C80109"; 
amazon_color_logo="FFFFFF"; 
amazon_color_link="DC1D25"; 
amazon_ad_logo="hide"; 
amazon_ad_title="TodoContenidos Store"; //--></script>
<script type="text/javascript" src="http://www.assoc-amazon.com/s/asw.js"></script>
<?
}

function ShowAmazonKindle() {
	return;

	global $Amazon2;

	if ($Amazon2)
		return;

	$Amazon2 = true;
?>
<iframe src="http://rcm.amazon.com/e/cm?t=todocontenido-20&o=1&p=48&l=ur1&category=kindle&banner=0Y98S4SYN0MXZ8260582&f=ifr" width="728" height="90" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>
<?
}
?>