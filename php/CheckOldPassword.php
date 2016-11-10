<?php
define ('site_root',$_SERVER['DOCUMENT_ROOT'].'/');

require(site_root."Modules/DB.php");

$errors	= array();      // array to hold validation errors
$data	= array();      // array to pass back data

$db = new DB('delimeta_gaypage','gaypage','delimeta_gaypage','hostingmysql330.register.it');

if(isset($_GET['OldPass']) && !empty($_GET['OldPass'])){
	$pass = md5($_GET['OldPass']);

	if(empty($db->select("SELECT * FROM Users WHERE Password=?",array($pass),array("%s"))[0])){
		$errors['OldPass'] = "Sorry your password is wrong";
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