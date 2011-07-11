Overview
========
RxNorm API PHP Library in REST with SOAP style methods

http://rxnav.nlm.nih.gov/ 
Usage
=====
// Base API Class
require 'APIBaseClass.php';

require 'rxNormApi.php';

$new = new rxNormApi();

// Debug information
die(print_r($new).print_r(get_object_vars($new)).print_r(get_class_methods(get_class($new))));

