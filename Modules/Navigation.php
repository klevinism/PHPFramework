<?php

define ('site_root',    realpath(dirname(__DIR__)).'/');

class Navigation {

	public function __construct($locationMask, $locationName){

		$this->LocationMask = $locationMask;// LocationMask = array('StateMask','RegionMask','CityMask')

		$this->LocationName = $locationName;// LocationName = array('StateName','RegionName','CityName')



		$this->getPostNavigationLink();

	}

	public function getPostNavigationLink(){

		$cnt = 0;

		$NavString = "<a href='index'>Home</a> 

		> <a href='map?state=".$this->LocationMask[0]."&region=".$this->LocationMask[1]."'>".$this->LocationName[1]."</a>

		> <a href='map?state=".$this->LocationMask[0]."&region=".$this->LocationMask[1]."&city=".$this->LocationMask[2]."'>Annunci ".$this->LocationName[2]."</a> 

		> <a href='map?state=".$this->LocationMask[0]."&region=".$this->LocationMask[1]."&city=".$this->LocationMask[2]."'>Gay ".$this->LocationName[2]."</a>";



		return $NavString;

	}



}





?>