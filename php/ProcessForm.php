<?php
define ('site_root',$_SERVER['DOCUMENT_ROOT'].'/halloween'.'/');
require_once(site_root.'Modules/Auth1.php');

//-----------------------------MAIN------------------------------------------------------------------
/*ProcessForm.php*/
//if($_SERVER['REQUEST_METHOD'] != 'POST'){
//header("Location: http://nfpf.org.al/admin");
//}
$errors	= array();      // array to hold validation errors
$data	= array();      // array to pass back data

// validate the variables, if any of these variables don't exist, add an error to our $errors array
//echo json_encode("adsfasdfadfasd");

 //error_log("Oracle database not available!", 0);
if((!empty($_POST['LoginEmail'])) && (!empty($_POST['LoginName']))){
	
	$UsrCredentials = array($_POST['LoginEmail'],$_POST['LoginName'],$_POST['LoginId']);//User credentials
	
	ValidateUser($UsrCredentials,$errors,$data); // Validation method for User
}
else{
    if (empty($_POST['LoginEmail']))
        $errors['email'] = 'Email is required.';
    if (empty($_POST['LoginName']))
        $errors['name'] = 'Name is required.';
}
	ReturnResponse($errors,$data);
	
//--------------------------!END OF MAIN--------------------------------------------------------------



//-----------------------------LOGIN FUNCTIONS---------------------------------------------------------

function ValidateUser($usrCredentials,&$errors,&$data){
	if(isValidEmail_Password($usrCredentials,$errors))//If not empty email or name
		AuthenticateUser($usrCredentials,$errors,$data);//Authentication method
}

function isValidEmail_Password($usrCredentials,&$errors){
	
	if(!filter_var($usrCredentials[0], FILTER_VALIDATE_EMAIL)){
		$errors['email'] = "Please enter a valid email address";
	}
	
	
	if(!isValidPassword($usrCredentials[1])){
		$errors['name'] = "Please enter a valid name. (8-16 characters long)";
	}
	
	$isValid = (!empty($errors) ? false : true);
	
	return $isValid;
}

function isValidPassword($name){//Password validation ==========================
	if(!empty($name) && $name != "") 
		return true;
}

function AuthenticateUser($usrCredentials,&$errors,&$data){//Authenticate user
	$client = new Auth1($usrCredentials);
	if($client->Auth()){
		//User authenticated successfully
		//Do other things, like remember me, etc
		//Then redirect
		
		$data['Redirect'] = '/admin/dashboard';
		//$client->setRedirectUrl('http://nfpf.org.al/admin/dashboard');
	}
	else{
		$errors['Auth'] = "Sorry wrong username or password";
	}
	/*Create instance of authentication class for user,
	  Authenticate User,
	  Make new error if not authenticated.*/
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

    // return all our data to json
    echo json_encode($data);	
}
//------------------------------------------!END OF LOGIN FUNCTIONS---------------------------------------
?>