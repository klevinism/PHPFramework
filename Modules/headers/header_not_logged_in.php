<?php
define ('site_root',$_SERVER['DOCUMENT_ROOT'].'/');
$cookie = new Cookie();
if(empty($cookie->getCookie('state',true))){
  $state = 'Italy';
}
else{
  $state = $cookie->getCookie('state',true);
}
  require(site_root.'Modules/StateClass.php');
  require(site_root.'Modules/RegionClass.php');

  $states = new State($state,'Name');
  
  $StateId = $states->getId();
  $StateName = $state;
  $StateMask = $states->getMask();

  $Regions = $db->select("SELECT * FROM Regions WHERE OwnerState = ?",array($StateId),array("%d"));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<title>Business World</title>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<link href="style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

<script type="text/javascript" src="js/script.js"></script>

<script type="text/javascript" src="js/cufon-yui.js"></script>

<script type="text/javascript" src="js/arial.js"></script>

<script type="text/javascript" src="js/cuf_run.js"></script>

<script type="text/javascript" >



function ChangeState(val){

var xmlhttp;
if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
  	xmlhttp=new XMLHttpRequest();
  	}
	else
  	{// code for IE6, IE5
  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	xmlhttp.onreadystatechange=function()
  	{
  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    document.getElementById("mapState").innerHTML=xmlhttp.responseText;
      console.log("ajaxComplete");
      LoadMap();
	    }
  	}
    var map = null;
  	document.getElementById("mapState").innerHTML="<img src='images/ajax-loader.gif' />";
  xmlhttp.open("GET","php/States/SettingsState.php?val="+val,true);
	xmlhttp.send();
}

$(document).ready(function(){
    if(typeof(LoadMap) == "function"){
      LoadMap();
    }
})
</script>


</head>

<body>

<!-- START PAGE SOURCE -->

<div class="main">

  <div class="header_block">

    <div class="header_resize">

      <div class="search" style="margin-right: 33px;">

        <form method="get" id="search" action="search.php">

          <span>
          <?php
          if(isset($SearchValue)){
            $SearchPlaceholder = $SearchValue;
          }
          else{
            $SearchPlaceholder = "Search...";
          }

          if(isset($SearchCategory)){
            $SearchCategoryPlaceholder = "selected";
          }
          else{
            $SearchCategoryPlaceholder = "";
          }
          ?>
          <input type="text" placeholder="<?=$SearchPlaceholder;?>" name="s" id="s" />
      <select name="Region" style="
float: right;
  width: 163px;
  height: 36px;
  position: absolute;
  margin-top: -6px;
  margin-left: -49px;
    border: none;
      border-left: 1px solid;
  border-right: 1px solid;
      ">
          <option value="" selected="true">Region</option>
          <?php
          foreach($Regions as $var=>$val){
            if(!empty($val)){
              $selected = ($_GET['Region'] == $val['Mask']?"selected":"");
              echo '<option value="'.$val['Mask'].'" '.$selected.' >'.$val['Name'].'</option>';              
            }
          }
          ?>
          </select>
          <input name="searchsubmit" type="image" src="images/search.gif" value="Go" id="searchsubmit" class="btn" style="margin-left: 128px;">
          </span>

        </form>
        <div class="clr"></div>

      </div>

      <div class="menu_nav">

        <ul>

          <li class="active"><a href="index">Home</a></li>

          <li><a href="support.html">Support</a></li>

          <li><a href="about.html">About Us</a></li>

          <li><a href="blog.html">Blog</a></li>

          <li><a href="contact.html">Contact Us</a></li>

        </ul>

      </div>

      <div class="clr"></div>

    </div>

  </div>

  <div class="clr"></div>

  <div class="header">

   <div class="logo">
    <span align="center" style="
    background-color: blue;
    width: 15%;
    float: right;
    background: linear-gradient(to bottom, #2f7abb 0%,#26649a 100%);
    height: 38px;
    padding-top: 13px;
      margin-right: 33px;
    margin-top: 17px;
    color: #fff;
"><a href="/login" style="color:#fff;">PUBBLICA ANNUNCIO</a></span><span align="center" style="
     width: 22%;
  float: right;
  /* background: linear-gradient(to bottom, #2f7abb 0%,#26649a 100%); */
  height: 38px;
  padding-top: 13px;
  margin-top: 17px;
  color: #313131;
  font-size: 16px;
  font-weight: 500;
"><a href="/login">ACCEDI</a> | <a href="signup">REGISTRATI</a></span>

      <h1><a href="index"><cufon class="cufon cufon-canvas" alt=" " style="width: 6px; height: 28px;"><canvas width="66" height="39" style="width: 66px; height: 39px; top: -6px; left: -18px;"></canvas><cufontext> </cufontext></cufon><span></span><small></small></a></h1>
 
    </div>

    <div class="clr"></div>

  </div>