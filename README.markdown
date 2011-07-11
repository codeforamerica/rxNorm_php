Overview
========
NDF-RT API PHP Library

Usage
=====
http://rxnav.nlm.nih.gov/NdfrtAPI.html

The NDF-RT API is a web service for accessing the current 
National Drug File - Reference Terminology (NDF-RT) data set from your program via SOAP/WSDL.

// Base API Class
require 'APIBaseClass.php';

require 'rxNormApi.php';

$new = new rxNormApi();

// Debug information
die(print_r($new).print_r(get_object_vars($new)).print_r(get_class_methods(get_class($new))));

