<?php
define ('site_root',realpath(dirname(__DIR__)).'/');
include(site_root.'Modules/DB.php');

class City extends DB{
	
	public function __construct($city,$column = 'Mask'){
		parent::__construct('tibo3748_konkurs','gaypage','tibo3748_konkurs','localhost');//connect to database
		$this->Column = $column;	

		$this->GetCityInformation($city);
	}

	private function GetCityInformation($city){
		$sqlquery = "SELECT * FROM Cities WHERE ".$this->Column." = ?";
		$CityData = parent::select($sqlquery,array($city),array("%s"))[0];

		if(!empty($CityData)){
			$this->Id = $CityData['Id'];
			$this->Name = $CityData['Name'];
			$this->Mask = $CityData['Mask'];
			$this->OwnerRegion = $CityData['OwnerRegion'];
		}
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
	public function getOwnerRegion(){
		return $this->OwnerRegion;
	}
}

?>