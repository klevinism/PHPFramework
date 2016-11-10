<?php
define ('site_root',$_SERVER['DOCUMENT_ROOT'].'/');
require(site_root."Modules/DB.php");

$errors	= array();      // array to hold validation errors
$data	= array();      // array to pass back data

$db = new DB('delimeta_gaypage','gaypage','delimeta_gaypage','hostingmysql330.register.it');

if(!empty($_POST['Username']) && !empty($_POST['Email']) && !empty($_POST['OldPassword']) && !empty($_POST['NewPassword'])){
	$OldPassword = md5($_POST['OldPassword']);
	$NewPassword = md5($_POST['NewPassword']);
 
	if(!$db->update('Users',array('Username'=>$_POST['Username'],'Email'=>$_POST['Email'],'Password'=>$NewPassword),array('%s','%s','%s'),array('Password'=>$OldPassword),array('%s'))){
		$errors['UpdateProfile'] = "Sorry something went wrong";
	}

}

ReturnResponse($errors,$data);
 

function ReturnResponse($errors,$data){	// return a response ============================
    // if there are any errors in our errors array, return a success boolean of false
    if (!empty($errors)) {
        // if there are items in our errors array, return those errors
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {// if there are no errors, process our form, then return a message

		//Process form...

		//Return a message
        $data['success'] = true;
        $data['message'] = 'Success!';
    }

    // return all our data to an AJAX call
    echo json_encode($data);	
}
?>