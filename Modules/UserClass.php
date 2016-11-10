<?php
define ('site_root',realpath(dirname(__DIR__)).'/');
include(site_root.'Modules/DB.php');

class User extends DB{
	public $Value = array();
	public $formatArr = array();

	public function __construct($usrdata){
		parent::__construct('delimeta_gaypage','gaypage','delimeta_gaypage','hostingmysql330.register.it');//connect to database
		$this->GetUserInformation($usrdata);
	}

	private function GetUserInformation($data){
		$sqlquery = $this->MakeSelectQuery($data);
		$UserData = parent::select($sqlquery,$this->Value,$this->formatArr)[0];

		if(!empty($UserData)){
			$this->Id = $UserData['Id'];
			$this->Username = $UserData['Username'];
			$this->Email = $UserData['Email'];
			$this->Hash = $UserData['Hash'];
			$this->Active = $UserData['Active'];
		}
	}

	private function MakeSelectQuery($data){
		$format = '%s';
		$query = "SELECT * FROM Users WHERE ";
		$i = count($data);
		
		foreach($data as $field => $value){
			array_push($this->Value,$value);
			array_push($this->formatArr,$format);

				if((--$i)){
					$query .= $field."=? AND ";
				}
				else{
					$query .= $field."=?";
				}
		}

		return $query;
	}

	public function getId(){
		return $this->Id;
	}
	public function getEmail(){
		return $this->Email;
	}
	public function getUsername(){
		return $this->Username;
	}
	public function getHash(){
		return $this->Hash;
	}
	public function getActive(){
		return $this->Active;
	}

}

?>