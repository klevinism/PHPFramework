<?php
define ('site_root',realpath(dirname(__DIR__)).'/');
include(site_root.'Modules/DB.php');
if ( !class_exists( 'State' ) ) {
class State extends DB{
	public $AllStateInfo = array(array());

	public function __construct($state = '',$column = 'Mask'){
		parent::__construct('delimeta_gaypage','gaypage','delimeta_gaypage','hostingmysql330.register.it');//connect to database
		$this->Column = $column;	

		if($state != ''){
			$this->GetStateInformation($state);
		}else{
			$this->AllStateInfo = $this->GetAllStateInformation();
		}
	}

	private function GetStateInformation($state){
		$sqlquery = "SELECT * FROM States WHERE ".$this->Column." = ?";
		$StateData = parent::select($sqlquery,array($state),array("%s"))[0];

		if(!empty($StateData)){
			$this->Id = $StateData['Id'];
			$this->Name = $StateData['Name'];
			$this->Mask = $StateData['Mask'];
		}
	}

	private function GetAllStateInformation(){
		$sqlquery = "SELECT * FROM States";
		$StateData = parent::select($sqlquery,array(),array());
		return $StateData;
	}

	public function getId(){
		return $this->Id;
	}
	public function getName(){
		return $this->Name;
	}
	public function getMask(){
		return $this->Mask;
	}

	public function getAllStates(){
		return $this->AllStateInfo;
	}
}
}
?>