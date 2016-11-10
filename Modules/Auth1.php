<?php

define ('site_root',realpath(dirname(__DIR__)).'/halloween'.'/');

require_once(site_root.'Modules/DB.php');

require_once(site_root.'Modules/SessionClass.php');

require_once(site_root.'Modules/SignUp.php');


class Auth1 extends DB{

	 

	protected $User_credentials = array(2);

	protected $RedirectUrl;

	

	public function __construct($user_credentials = array()){

		$this->User_credentials = $user_credentials;

		

		parent::__construct('tibo3748_konkurs','_#DAi3ke&Fao','tibo3748_konkurs');
	}

	

	public function Remember_Me($remember = false){

		//if remember me checkbox checked<br />

		//Remember the user

	}

	

	protected function Make_Hash(){

		return md5(rand(0,1000));

	}

	

	public function setRedirectUrl($Url){

		//header("Location: ".$Url);

	}

	

	public function Auth(){

		$Name = $this->User_credentials[1];// assign post data Name

		$Id = $this->User_credentials[2]; // ID

		echo $Id."<--- Id";

		$Email = $this->User_credentials[0];// assign post data Email

			

		$fields = ["fb_id","Name","Email","Hash"];//array to hold credential key's



		$AuthCred = parent::select('SELECT * FROM user WHERE fb_id = ? AND Email = ? AND Name = ?',

				array($Id,$Email,$Name),

				array('%s','%s','%s'));//If user email and name match



		if(!empty($AuthCred[0])){

			$this->AuthSession("usrml",$Email);

			$this->AuthSession("usrfbid",$Id);

			return true; //Logged in 

		}

		else{

			$signUp = new SignUp();// create object from signup class		



			//$Password = md5($_POST["SignUpConfirmPassword"]);// assign post data

			$Hash = $signUp->GenerateSignUpHash();



			$credentials = [$Id,$Name,$Email,$Hash];//make credentials array

			$CredentialsArray = array_combine($fields, $credentials);//combine field and credentials arrays



			$signUp->setCredentials($CredentialsArray);



			if(!$signUp->CredentialsInsert()){// insert to database all user credentials		

				return false;//$errors['signup'] = "Sorry!!! A problem occurred, try again later";

			}

			else{

				$signUp->SignUpSession("usrml",$Email);//Start a session for user email,

				$signUp->SignUpSession("usrfbid",$Id);//Start a session for user fb_id,

				$signUp->SignUpCookie($Hash);//Start a cookie for user,??????

				$Path = $_SERVER['SERVER_NAME'].'/registration?Email='.$Email.'&Hash='.$Hash;//path to email verification page;

				/*if(!$signUp->EmailVerification($Email,"klevindelimeta@gmail.com",$Path)){

					$errors = "Verification email not sent";

				}*/   //Email verification

				

				echo "*** CREDENTIALS INSERTED";

				return true;

			}

			

			return false; //Not Logged in

		}

	}

	

	protected function AuthSession($name, $value){

		$session = new Session();

		$session->set($name,$value);

	}

}

?>