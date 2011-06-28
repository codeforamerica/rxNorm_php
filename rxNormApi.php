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
		return self::_request(self::$api_url."/rxcui?name=$searchType&srclist=$source_list&allsrc=$allSourcesFlag&search=$searchString",'get');
	
	}
	public function findRxcuiByID($idType,$id,$allSourcesFlag){
		return self::_request(self::$api_url."/rxcui?idtype=$idType&id=$id&allsrc=$allSourcesFlag",'get');
	}		

	public function getSpellingSuggestions( $searchString ){
		return self::_request(self::$api_url. "/spellingsuggestions?name=$searchString",'get');
	}
	
	public function getRxConceptProperties( $rxcui ){
		return self::_request(self::$api_url.'/rxcui/'.$rxcui.'/properties','get');
	}
	public function getRelatedByRelationship( $rxcui, $relationship_list ){
		return self::_request(self::$api_url."/rxcui/$rxcui/related?rela=$relationship_list",'get');
	}
	public function getRelatedByType( $rxcui, $type_list ){
		return self::_request(self::$api_url."/rxcui/$rxcui/related?tty=$type_list",'get');
	}
	public function getAllRelatedInfo( $rxcui ){
		return self::_request(self::$api_url."/rxcui/$rxcui/allrelated",'get');
	}
	public function getDrugs( $name ){
		return self::_request(self::$api_url."/drugs?name=$name",'get');
	}
	
	public function getNDCs( $rxcui ){
		return self::_request(self::$api_url."/rxcui/$rxcui/ndcs",'get');
	}
	
	public function getRxNormVersion( ){
		return self::_request(self::$api_url.'/version','get');
	}
	
	public function getIdTypes(){
		return self::_request(self::$api_url.'/idtypes','get');
	}
	
	public function getRelaTypes(){
		return self::_request(self::$api_url.'/relatypes','get');
	}
	
	public function getSourceTypes(){
		return self::_request(self::$api_url."/sourcetypes",'get');
	}
	
	public function getTermTypes(){
		return self::_request(self::$api_url."/termtypes",'get');
	}
	
	public function getProprietaryInformation( $rxcui, $source_list, $proxyTicket ){
		return self::_request(self::$api_url."/rxcui/$rxcui/proprietary?srclist=$source_list&ticket=$proxyTicket",'get');
	}
	
	public function getMultiIngredBrand( $rxcui_list ){
		return self::_request(self::$api_url."/brands?ingredientids=$rxcui_list",'get');
	}
	// assume this is get display names too ??
	public function getDisplayTerms(){
		return self::_request(self::$api_url."/displaynames",'get');
	}
	
	public function getStrength( $rxcui ){
		return self::_request(self::$api_url."/rxcui/$rxcui/strength",'get');
	}
	
	public function getQuantity( $rxcui ){
		return self::_request(self::$api_url."/rxcui/$rxcui/quantity",'get');
	}
	
	public function getUNII( $rxcui ){
		return self::_request(self::$api_url."/rxcui/$rxcui/unii",'get');
	}
	
	public function getSplSetId( $rxcui ){
		return self::_request(self::$api_url."/rxcui/$rxcui/splsetid",'get');
	}
	
	public function findRemapped( $rxcui ){
		return self::_request(self::$api_url."/remap/$rxcui",'get');
	}

}