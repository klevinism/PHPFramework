<?php
define ('site_root',$_SERVER['DOCUMENT_ROOT'].'/');
require(site_root."Modules/CookieClass.php");

if(isset($_GET['val']) && !empty($_GET['val'])){
	
	$cookie = new Cookie();
	$cookie->setName("state")
	->setValue($_GET['val'],true)
	->setExpire("7 years")
	->setDomain("gaypage.delimeta.info")
	->createCookie();
	
	require(site_root."php/States/".$_GET['val']."State.php");

}
?>