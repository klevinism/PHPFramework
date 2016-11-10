<?php

  if($session->get('usrml')){//User Logged in
    if(!class_exists("User")){
    	include(site_root.'Modules/UserClass.php');
    	$UserEmail = $session->get('usrml');
    	$user = new User(array('Email'=>$UserEmail));  
    }

    require site_root.'Modules/headers/header_logged_in.php';
  }
  else{
    require site_root.'Modules/headers/header_not_logged_in.php';
  }
?>