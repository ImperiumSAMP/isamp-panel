<?php

class Account_model extends MY_Model {

    var $Id	= 0;
	var $Name	= '';
	var $Password	= '';
	var $Ip	= '';
	var $Level	= 0;
	var $AdminLevel	= 0;
	var $DonateRank	= 0;
	var $Age	= 0;
	var $Exp	= 0;
	var $CashMoney	= 0;
	var $BankMoney	= 0;
	var $Skin	= 0;
	var $Drugs	= 0;
	var $Materials	= 0;
	var $Job	= 0;
	var $JobTime	= 0;
	var $pJobAllowed	= 0;
	var $PlayingHours	= 0;
	var $PayCheck	= 0;
	var $pPayTime	= 0;
	var $Faction	= 0;
	var $Rank	= 0;
	var $HouseKey	= 0;
	var $BizKey	= 0;
	var $Warnings	= 0;
	var $PhoneNumber	= 0;
	var $PhoneCompany	= 0;
	var $PhoneBook	= 0;
	var $JailedTime	= 0;
	var $Products	= 0;
	var $pInterior	= 0;
	var $pWorld	= 0;
	var $pVeh1	= 0;
	var $pVeh2	= 0;
	var $pRegStep	= 0;
	var $pOrigin	= 0;
	var $pHospitalized	= 0;
	var $pPoints	= 0;
	var $pWantedLevel	= 0;
	var $pJobLimitCounter	= 0;
	var $pBMLimit	= 0;
	var $pFelonExp	= 0;
	var $pFelonLevel	= 0;
	var $pRobPersonLimit	= 0;
	var $pRobHouseLimit	= 0;
	var $pRob247Limit	= 0;
	var $pRobLastVictimPID	= 0;
	var $pTheftPersonLimit	= 0;
	var $pTheft247Limit	= 0;
	var $pTheftLastVictimPID	= 0;
	var $pMuteB	= 0;
	var $pRentCarID	= 0;
	var $pRentCarRID	= 0;
	var $pLighter	= 0;
	var $pCigarettes	= 0;
	var $pFightStyle	= 0;
	var $pMarijuana	= 0;
	var $pLSD	= 0;
	var $pEcstasy	= 0;
	var $pCocaine	= 0;
	var $pAdictionAbstinence	= 0;

	function get_by_login($username,$password){
		return $this->get_by(array('Name' => $username, 'Password' => md5($password)));
	}
	
	function get_by_name($name){
		return $this->get_by(array('Name' => $name));
	}
	
}