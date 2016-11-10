<?php
define ('site_root',    realpath(dirname(__DIR__)).'/halloween/');
//include('DB.php');
include(site_root.'Modules/SessionClass.php');
include(site_root.'Modules/CookieClass.php');
//include(site_root.'Modules/PHPMailer-master/PHPMailerAutoload.php');

class SignUp extends DB{

	public function __construct(){
		parent::__construct('tibo3748_konkurs','_#DAi3ke&Fao','tibo3748_konkurs');
	}

	public function setCredentials($CredentialArr){
		$this->CredentialArr = $CredentialArr;
	}

	public function CredentialsInsert(){
		$formatArr = array();
		$format = '%s';
		foreach ($this->CredentialArr as $cred){
			array_push($formatArr,$format);
		}		
		
		if(parent::insert('user',$this->CredentialArr,$formatArr)){
			return true;
		}
		else{
			return false;
		}
	}

	public function SignUpSession($name,$value){
		$session = new Session();
		$session->set($name,$value);
	}

	public function SignUpCookie($value){
		$cookie = new Cookie();
		$cookie->setName('usrhsh') // our cookie name
 			->setValue($value,false)   // second parameter, true, encrypts data
  			->setExpire('+1 hours')   // expires in 1 hour
  			->setPath('/')            // cookie path
  			->setDomain('tibo.tv/halloween')//set for localhost
  			->createCookie();
	}

	public function GenerateSignUpHash(){
		return md5(rand(0,1000).str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"));
	}

	public function EmailVerification($to, $from, $VerificationLink){
		/*$mail = new PHPMailer;
		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                 // Set mailer to use SMTP
		$mail->Host = 'vectra.websitewelcome.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'info@delimeta.info';                 // SMTP username
		$mail->Password = 'Klklkl007';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->From = $from;
		$mail->FromName = 'La mela di eva';
		$mail->addAddress($to);               // Name is optional
		$mail->addReplyTo('info@delimeta.info', 'Information');

		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Account Verification';
		$mail->Body    = 'Verify your email '.$VerificationLink;//<a href="http://'.$VerificationLink .'">here</a>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			//echo 'Mailer Error: ' . $mail->ErrorInfo;
			//echo "not send";
		   return false;
		} else {
			//echo "send";
		   return true;
		}
		/*$subject = 'Account Verification';
		$message = 'Verify your email <a href="http://'.$VerificationLink .'">here</a>';
		$headers = 'From: '. $from . "\r\n" .
		    'Reply-To: '. $to . "\r\n" .
		    'X-Mailer: PHP/' . phpversion();
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($to, $from, $subject, $message, $headers);*/
	}

	public function toString(){
		return $this->CredentialArr;
	}
}

?>