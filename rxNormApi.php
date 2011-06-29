<?php
// SOAP/REST ... implementing REST with SOAP style method selection. Enjoy! Only supports XML for now.
// use _apiHelper($query path) instead of _request  for quick json support.
class rxNormApi extends APIBaseClass{
// would like to some day implement this in SOAP...

	public static $api_url = 'http://rxnav.nlm.nih.gov/REST';
	
	public function __construct($url=NULL)
	{
		parent::new_request(($url?$url:self::$api_url));
	}
	public function findRxcuiByString( $searchString, $source_list, $allSourcesFlag, $searchType ){
	// is 'name' search type?
		return self::_request("/rxcui?name=$searchType&srclist=$source_list&allsrc=$allSourcesFlag&search=$searchString",'GET');
	
	}
	public function findRxcuiByID($idType,$id,$allSourcesFlag){
		return self::_request("/rxcui?idtype=$idType&id=$id&allsrc=$allSourcesFlag",'GET');
	}		

	public function getSpellingSuggestions( $searchString ){
		return self::_request("/spellingsuggestions?name=$searchString",'GET');
	}
	
	public function getRxConceptProperties( $rxcui ){
		return self::_request('/rxcui/'.$rxcui.'/properties');
	}
	public function getRelatedByRelationship( $rxcui, $relationship_list ){
		return self::_request("/rxcui/$rxcui/related?rela=$relationship_list",'GET');
	}
	public function getRelatedByType( $rxcui, $type_list ){
		return self::_request("/rxcui/$rxcui/related?tty=$type_list",'GET');
	}
	public function getAllRelatedInfo( $rxcui ){
		return self::_request("/rxcui/$rxcui/allrelated",'GET');
	}
	public function getDrugs( $name ){
		return self::_request("/drugs?name=$name",'GET');
	}
	
	public function getNDCs( $rxcui ){
		return self::_request("/rxcui/$rxcui/ndcs",'GET');
	}
	
	public function getRxNormVersion(){
		return self::_request('/version','GET');
	}
	
	public function getIdTypes(){
		return self::_request('/idtypes','GET');
	}
	
	public function getRelaTypes(){
		return self::_request('/relatypes','GET');
	}
	
	public function getSourceTypes(){
		return self::_request("/sourcetypes",'GET');
	}
	
	public function getTermTypes(){
		return self::_request("/termtypes",'GET');
	}
	
	public function getProprietaryInformation( $rxcui, $source_list, $proxyTicket ){
		return self::_request("/rxcui/$rxcui/proprietary?srclist=$source_list&ticket=$proxyTicket",'GET');
	}
	
	public function getMultiIngredBrand( $rxcui_list ){
		return self::_request("/brands?ingredientids=$rxcui_list",'GET');
	}
	// assume this is get display names too ??
	public function getDisplayTerms(){
		return self::_request("/displaynames",'GET');
	}
	
	public function getStrength( $rxcui ){
		return self::_request("/rxcui/$rxcui/strength",'GET');
	}
	
	public function getQuantity( $rxcui ){
		return self::_request("/rxcui/$rxcui/quantity",'GET');
	}
	
	public function getUNII( $rxcui ){
		return self::_request("/rxcui/$rxcui/unii",'GET');
	}
	
	public function getSplSetId( $rxcui ){
		return self::_request("/rxcui/$rxcui/splsetid",'GET');
	}
	
	public function findRemapped( $rxcui ){
		return self::_request("/remap/$rxcui",'GET');
	}

}