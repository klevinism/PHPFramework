<?php
define ('site_root',    realpath(dirname(__DIR__)).'/');
include(site_root.'Modules/DB.php');

//--------------------------------MAIN--------------------------------------------------//
$errors	= array();      // array to hold validation errors
$data	= array();      // array to pass back data

if(!empty($_POST['Email'])){
	$Email = $_POST['Email'];

	if(EmailExists($Email)){
		$errors['Email'] = 'Email already exists';
	}

  ReturnResponse($errors,$data);
}
//------------------------------END MAIN------------------------------------------------//

//******************************************************Functions**************************************************************************//

function EmailExists($email){
	$dtb = new DB('delimeta_gaypage','gaypage','delimeta_gaypage','hostingmysql330.register.it');
	$Record = $dtb->select('SELECT * FROM Users WHERE Email = ?',array($email),array('%s'))[0];

	if(empty($Record)){
		return false; //Email doesn't exist
	}
	else{
		return true; //Email exist
	}
}

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