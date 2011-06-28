<?php
// SOAP/REST ... implementing REST with SOAP style method selection. Enjoy! Only supports XML for now.
// use _apiHelper($query path) instead of _request  for quick json support.
class rxNormApi extends APIBaseClass{
// would like to some day implement this in SOAP...

	public static $api_url = 'http://rxnav.nlm.nih.gov/REST/';
	
	public function __construct($url=NULL)
	{
		parent::new_request(($url?$url:self::$api_url));
	}
	public function findRxcuiByString( $searchString, $source_list, $allSourcesFlag, $searchType ){
	// is 'name' search type?
		return self::_request(self::$api_url."/rxcui?name=$searchType&srclist=$source_list&allsrc=$allSourcesFlag&search=$searchString");
	
	}
	public function findRxcuiByID($idType,$id,$allSourcesFlag){
		return self::_request(self::$api_url."/rxcui?idtype=$idType&id=$id&allsrc=$allSourcesFlag");
	}		

	public function getSpellingSuggestions( $searchString ){
		return self::_request(self::$api_url. "/spellingsuggestions?name=$searchString");
	}
	
	public function getRxConceptProperties( $rxcui ){
		return self::_request(self::$api_url.'/rxcui/'.$rxcui.'/properties');
	}
	public function getRelatedByRelationship( $rxcui, $relationship_list ){
		return self::_request(self::$api_url."/rxcui/$rxcui/related?rela=$relationship_list");
	}
	public function getRelatedByType( $rxcui, $type_list ){
		return self::_request(self::$api_url."/rxcui/$rxcui/related?tty=$type_list");
	}
	public function getAllRelatedInfo( $rxcui ){
		return self::_request(self::$api_url."/rxcui/$rxcui/allrelated");
	}
	public function getDrugs( $name ){
		return self::_request(self::$api_url."/drugs?name=$name");
	}
	
	public function getNDCs( $rxcui ){
		return self::_request(self::$api_url."/rxcui/$rxcui/ndcs");
	}
	
	public function getRxNormVersion( ){
		return self::_request(self::$api_url.'/version');
	}
	
	public function getIdTypes(){
		return self::_request(self::$api_url.'/idtypes');
	}
	
	public function getRelaTypes(){
		return self::_request(self::$api_url.'/relatypes');
	}
	
	public function getSourceTypes(){
		return self::_request(self::$api_url."/sourcetypes");
	}
	
	public function getTermTypes(){
		return self::_request(self::$api_url."/termtypes");
	}
	
	public function getProprietaryInformation( $rxcui, $source_list, $proxyTicket ){
		return self::_request(self::$api_url."/rxcui/$rxcui/proprietary?srclist=$source_list&ticket=$proxyTicket");
	}
	
	public function getMultiIngredBrand( $rxcui_list ){
		return self::_request(self::$api_url."/brands?ingredientids=$rxcui_list");
	}
	// assume this is get display names too ??
	public function getDisplayTerms(){
		return self::_request(self::$api_url."/displaynames");
	}
	
	public function getStrength( $rxcui ){
		return self::_request(self::$api_url."/rxcui/$rxcui/strength");
	}
	
	public function getQuantity( $rxcui ){
		return self::_request(self::$api_url."/rxcui/$rxcui/quantity");
	}
	
	public function getUNII( $rxcui ){
		return self::_request(self::$api_url."/rxcui/$rxcui/unii");
	}
	
	public function getSplSetId( $rxcui ){
		return self::_request(self::$api_url."/rxcui/$rxcui/splsetid");
	}
	
	public function findRemapped( $rxcui ){
		return self::_request(self::$api_url."/remap/$rxcui");
	}

}