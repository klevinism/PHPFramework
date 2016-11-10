<?php
define ('site_root',realpath(dirname(__DIR__)).'/');
include(site_root.'Modules/DB.php');
if ( !class_exists( 'Region' ) ) {

class Region extends DB{
	
	public function __construct($region,$column = 'Mask'){
		parent::__construct('delimeta_gaypage','gaypage','delimeta_gaypage','hostingmysql330.register.it');//connect to database
		$this->Column = $column;	

		$this->GetRegionInformation($region);
	}

	private function GetRegionInformation($region){
		$sqlquery = "SELECT * FROM Regions WHERE ".$this->Column." = ?";
		$RegionData = parent::select($sqlquery,array($region),array("%s"))[0];

		if(!empty($RegionData)){
			$this->Id = $RegionData['Id'];
			$this->Name = $RegionData['Name'];
			$this->Mask = $RegionData['Mask'];
			$this->OwnerState = $RegionData['OwnerState'];
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
	public function getOwnerState(){
		return $this->OwnerState;
	}
}
}

?>