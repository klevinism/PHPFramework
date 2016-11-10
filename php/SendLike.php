<?php
define ('site_root',$_SERVER['DOCUMENT_ROOT'].'/halloween'.'/');
require_once(site_root.'Modules/DB.php');

//-----------------------------MAIN------------------------------------------------------------------
/*ProcessForm.php*/
//if($_SERVER['REQUEST_METHOD'] != 'POST'){
//header("Location: http://nfpf.org.al/admin");
//}
$errors	= array();      // array to hold validation errors
$data	= array();      // array to pass back data
$db = new DB('tibo3748_konkurs','_#DAi3ke&Fao','tibo3748_konkurs');

// validate the variables, if any of these variables don't exist, add an error to our $errors array
//echo json_encode("adsfasdfadfasd");

 //error_log("Oracle database not available!", 0);
if((!empty($_POST['Liker_Id'])) && (!empty($_POST['Liked_Id'])) && (!empty($_POST['action']))){
	$action = $_POST['action'];
	$liked_id = $_POST['Liked_Id'];
	$liker_id = $_POST['Liker_Id'];
	
	if($action == "add"){
		$form = array('Liker_fb_id'=>$liker_id, 'Liked_fb_id'=>$liked_id);
		$format = array('%s','%s');
		
		//if(notLikedYet($liker_id, $liked_id)){
			$results = $db->select("SELECT * FROM competitors INNER JOIN user ON competitors.fb_id = user.fb_id WHERE user.fb_id = ?",array($liked_id),array('%s'));
			$total_likes = $results[0]["total_likes"]+1;
			if($db->update("competitors",array("total_likes"=>$total_likes),array('%d'),array("fb_id"=>$liked_id),array('%s'))){
					// echo "DONE";
				}
			//update($table, $data, $format, $where, $where_format)
			
			if($db->insert("likes",$form,$format)){
				//echo "YOU LIKED ".$_POST['Liked_Id'];
				//echo $_POST['Liked_Id'];
				
				
				echo "Vota juaj u shtua me sukses";
			}else{
				echo "Ndodhi 1 gabim ne shtimin e votes";
			}
		//}else{
		//	echo "Ju nuk mund te votoni dy here per te njejtin person";
		//}
		
	}else if($action == "remove"){
		
		
	}
	
	//$UsrCredentials = array($_POST['LoginEmail'],$_POST['LoginName'],$_POST['LoginId']);//User credentials
	
	//ValidateUser($UsrCredentials,$errors,$data); // Validation method for User
}
/*else{
    if (empty($_POST['LoginEmail']))
        $errors['email'] = 'Email is required.';
    if (empty($_POST['LoginName']))
        $errors['name'] = 'Name is required.';
}*/
	//ReturnResponse($errors,$data);
	
//--------------------------!END OF MAIN--------------------------------------------------------------



//-----------------------------LOGIN FUNCTIONS---------------------------------------------------------

function notLikedYet($liker_id, $liked_id){
	$db = new DB('tibo3748_konkurs','_#DAi3ke&Fao','tibo3748_konkurs');
	$likeResults = $db->select("SELECT * FROM likes WHERE Liker_fb_id = ? AND Liked_fb_id = ?",array($liker_id,$liked_id),array('%s','%s'));
	if(!empty($likeResults)){
		return false;
	}else{
		return true;
	}
	
}

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