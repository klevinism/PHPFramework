<?php
define ('site_root',$_SERVER['DOCUMENT_ROOT'].'/');
require_once(site_root.'Modules/DB.php');
require_once(site_root.'Modules/StateClass.php');
require_once(site_root.'Modules/RegionClass.php');
require_once(site_root.'Modules/CityClass.php');


//-----------------------------MAIN------------------------------------------------------------------
/*ProcessForm.php*/
//if($_SERVER['REQUEST_METHOD'] != 'POST'){
//header("Location: http://nfpf.org.al/admin");
//}
$errors = array();      // array to hold validation errors
$data   = array();      // array to pass back data

// validate the variables, if any of these variables don't exist, add an error to our $errors array
 
if(!empty($_POST['location'])){
    if($_POST['location'] == "States"){
        $affected_loc = "Region";
    }else if($_POST['location'] == "Regions"){
        $affected_loc = "Province";
    }

    $string = html_transform(getData($_POST['location'],$_POST['value']),$affected_loc);
}
  ReturnResponse($errors,$data,$string);
    
//--------------------------!END OF MAIN--------------------------------------------------------------

function getData($tableName, $data){
$db = new DB('delimeta_gaypage','gaypage','delimeta_gaypage');

    switch($tableName){
        case "States": $dta = $db->select("SELECT r.* FROM Regions r INNER JOIN States s ON r.OwnerState = s.Id WHERE s.Mask = ?",array($data),array("%s"));
                    break;
        case "Regions":$dta = $db->select("SELECT c.* FROM Cities c INNER JOIN Regions r ON c.OwnerRegion = r.Id WHERE r.Mask = ?",array($data),array("%s"));
                    break;
    }

    return $dta;
}

function html_transform($arr,$loc){
    $cnt=0;
    $str = "<option value=''>".$loc."</option>";

    while($cnt< count($arr)){
        $str .= "<option value='".$arr[$cnt]['Mask']."'>".$arr[$cnt]['Name']."</option>";
        $cnt++;
    }
    return $str;
}

function ReturnResponse($errors,$data,$message){ // return a response ============================
    // if there are any errors in our errors array, return a success boolean of false
    if (!empty($errors)) {
        // if there are items in our errors array, return those errors
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {// if there are no errors, process our form, then return a message

        //Process form...

        //Return a message
        $data['success'] = true;
        $data['message'] = $message;
    }

    // return all our data to an AJAX call
    echo json_encode($data);    
}
//------------------------------------------!END OF LOGIN FUNCTIONS---------------------------------------