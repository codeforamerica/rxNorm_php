<?php
// SOAP/REST ... implementing REST with SOAP style method selection. Enjoy! Only supports XML for now.
// use _apiHelper($query path) instead of _request  for quick json support.
class rxNormApi extends APIBaseClass{
// would like to some day implement this in SOAP...

        public static $api_url = 'http://rxnav.nlm.nih.gov/REST';


        public function _request($path,$method,$data=NULL){
                if ($this->output_type == 'json')
                        return parent::_request($path,$method,$data,"Accept:application/json");
                else
                        return parent::_request($path,$method,$data,"Accept:application/xml");
        }
        public function __construct($url=NULL)
        {
                $this->output_type = 'xml';
                parent::new_request(($url?$url:self::$api_url));
        }

        public function setOutputType($type){
                if($type != $this->output_type)
                        $this->output_type = ($type != 'xml'?'json':'xml');
        }
        public function setRxcui($rxcui){
                $this->rxcui = $rxcui;
        }

        public function getRxcui($rxcui=NULL){
                if($rxcui != NULL) return $rxcui;
                elseif($this->rxcui) return $this->rxcui;
        }
        public function findRxcuiByString( $name, $searchString =NULL,$searchType=NULL,$source_list=NULL, $allSourcesFlag=NULL)    {
                $data['name'] = $name;
                if($allSourcesFlag =! NULL ){
                        $data['allsrc'] = $allSourcesFlag;
                        if($source_list != NULL && $allSourcesFlag == 1) $data['srclist'] = $source_list;
                }
                if($searchString != NULL)
                        $data['search']=$searchString;
                return self::_request("/rxcui",'GET',$data);

        }
        public function findRxcuiByID($idType,$id,$allSourcesFlag=NULL){
                $data['idtype'] = $idType;
                $data['id'] = $id;
                if($allSourcesFlag != NULL ) $data['allsrc'] = $allSourcesFlag;
                return self::_request("/rxcui?idtype=$idType&id=$id&allsrc=$allSourcesFlag",'GET');
        }

        public function getSpellingSuggestions( $searchString ){
                return self::_request("/spellingsuggestions?name=$searchString",'GET');
        }

        public function getRxConceptProperties( $rxcui = NULL ){
                $rxcui = self::getRxcui($rxcui);
                return self::_request('/rxcui/'.$rxcui.'/properties','GET');
        }
        public function getRelatedByRelationship( $relationship_list , $rxcui = NULL ){
                $rxcui = self::getRxcui($rxcui);
                return self::_request("/rxcui/$rxcui/related?rela=$relationship_list",'GET');
        }
        public function getRelatedByType($type_list, $rxcui = NULL ){
                $rxcui = self::getRxcui($rxcui);
                return self::_request("/rxcui/$rxcui/related?tty=$type_list",'GET');
        }
        public function getAllRelatedInfo( $rxcui = NULL ){
                $rxcui = self::getRxcui($rxcui);
                return self::_request("/rxcui/$rxcui/allrelated",'GET');
        }
        public function getDrugs( $name ){
                return self::_request("/drugs?name=$name",'GET');
        }

        public function getNDCs( $rxcui = NULL){
                $rxcui = self::getRxcui($rxcui);
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

        public function getProprietaryInformation( $rxcui, $proxyTicket,$source_list=NULL ){
                $data['ticket']= $proxyTicket;
                if($source_list != NULL) $data['srclist'] = $source_list;
                return self::_request("/rxcui/$rxcui/proprietary",'GET',$data);
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

        public function getSplSetId( $idType,$id,$allsrc=NULL ){

                $data['idtype'] = $idType;
                $data['id'] = $id;
                if($allsrc != NULL) $data['allsrc']=$allsrc;
                return self::_request("/rxcui",'GET',$data);
        }

        public function findRemapped( $rxcui ){
                return self::_request("/remap/$rxcui",'GET');
        }

}
