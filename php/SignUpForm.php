<?php
define ('site_root',realpath(dirname(__DIR__)).'/');
include(site_root.'Modules/SignUp.php');

/* ----------------------------MAIN----------------------------- */
$fields = ["fb_id","Username","Email","Password","Hash"];//array to hold credential key's
$data	= array();      // array to pass back data

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if(!empty($_POST["SignUpName"]) && !empty($_POST["SignUpEmail"])){
		$signUp = new SignUp();// create object from signup class		

		$Username = $_POST["SignUpName"];// assign post data
		$Id = $_POST["fb_id"];
		$Email = $_POST["SignUpEmail"];// assign post data
		$Password = md5($_POST["SignUpConfirmPassword"]);// assign post data
		$Hash = $signUp->GenerateSignUpHash();

		$credentials = [$Username,$Email,$Password,$Hash];//make credentials array
		$CredentialsArray = array_combine($fields, $credentials);//combine field and credentials arrays

		$signUp->setCredentials($CredentialsArray);

		if(!$signUp->CredentialsInsert()){// insert to database all user credentials		
			$errors['signup'] = "Sorry!!! A problem occurred, try again later";
		}
		else{
			$signUp->SignUpSession($Email);//Start a session for user,
			//$signUp->SignUpSession($Id);
			$signUp->SignUpCookie($Hash);//Start a cookie for user,??????
			$Path = $_SERVER['SERVER_NAME'].'/registration?Email='.$Email.'&Hash='.$Hash;//path to email verification page;
			
			if(!$signUp->EmailVerification($Email,"algertzharri@outlook.com",$Path)){
				
			}
		}
	}
	ReturnResponse($errors,$data);
}
/* --------------------------End MAIN---------------------------- */
	


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
    return $data;
}
?>