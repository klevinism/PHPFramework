<?php
define ('site_root',$_SERVER['DOCUMENT_ROOT'].'/');
if(!class_exists("Session") && !class_exists("Cookie")){
    include(site_root.'Modules/SessionClass.php');
    include(site_root.'Modules/DB.php');
    include(site_root.'Modules/CookieClass.php');

    $session = new Session();
    $cookie = new Cookie();
    $db = new DB('tibo3748_konkurs','_#DAi3ke&Fao','tibo3748_konkurs');
}
?>