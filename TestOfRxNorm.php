<?php
/* load simpletest library

   downloadable using

wget http://downloads.sourceforge.net/project/simpletest/simpletest/simpletest_1.1/simpletest_1.1alpha3.tar.gz;
tar -zxf simpletest_1.1alpha3.tar.gz;

*/
require_once('simpletest/autorun.php');
// load baseclass 
require_once('APIBaseClass.php');
// load your class here...
require_once('rxNormApi.php');
// the name of the api class is 'yourApi'
class TestOfApiClass extends UnitTestCase {
   public $api;
   // put your class name here
   public static $class_name = 'rxNormApi';
    function testApiConstructs(){
    	$this->api = new self::$class_name();
	$this->assertIsA($this->api->findRxcuiByString('lipitor'), 'string');
	$this->assertIsA($this->api->findRxcuiByID('umlscui','C0487782'), 'string');
	$this->assertIsA($this->api->getSpellingSuggestions('ambienn'), 'string');
	$this->assertIsA($this->api->getRxConceptProperties('131725'), 'string');
	$this->assertIsA($this->api->getRelatedByType('SBD+SBDF','174742'), 'string');
	$this->assertIsA($this->api->getAllRelatedInfo('866350'), 'string');
	$this->assertIsA($this->api->getDrugs('cymbalta'), 'string');
	$this->assertIsA($this->api->findRxcuiByString('lipitor'), 'string');
	$this->assertIsA($this->api->getNDCs('213269'), 'string');
	$this->assertIsA($this->api->getRxNormVersion(), 'string');
	$this->assertIsA($this->api->getIdTypes(), 'string');
	$this->assertIsA($this->api->getRelaTypes(), 'string');
	$this->assertIsA($this->api->getSourceTypes(), 'string');
	$this->assertIsA($this->api->getTermTypes(), 'string');
	$this->assertIsA($this->api->getProprietaryInformation('xhruziw05Y','MSH+RXNORM','261455'), 'string');
	$this->assertIsA($this->api->getMultiIngredBrand('8896+20610'), 'string');
	$this->assertIsA($this->api->getDisplayTerms(), 'string');
	$this->assertIsA($this->api->getStrength('315246'), 'string');
	$this->assertIsA($this->api->getQuantity('207716'), 'string');
	$this->assertIsA($this->api->getUNII('161'), 'string');
	$this->assertIsA($this->api->getSplSetId('umlscui','C0487782'), 'string');
	$this->assertIsA($this->api->findRemapped('105048'), 'string');

    	$this->check_class_params('_http _root api_url');
    }

    function check_class_params($params=NULL,$mode=TRUE){
    	// look up parameters inside of class and see if they are set/ true
    	// also allow to only check for certain parameters by passing in an array with the names of those variables or a space seperated string
    	// parameters to look for in the object
    	$api_class_vars =  get_class_vars(get_class($this->api));
    	if($params != null && is_string($params)){    		
			$params = explode(' ',$params);
			foreach($params as $key_name)
				$api_vars [$key_name] = "$key_name";
			$api_vars = array_intersect_key($api_class_vars,$api_vars);
    	}
    	else
    		$api_vars = $api_class_vars;		
    	// anything that isnt intersected should return false
   
    	foreach($api_vars as $key=>$value){
    		if($mode == TRUE)
    			$this->assertTrue(array_key_exists($key,$api_class_vars));
    		elseif($mode == FALSE)
    			$this->assertFalse(array_key_exists($key,$api_class_vars));
    		}
    }
}
?>
