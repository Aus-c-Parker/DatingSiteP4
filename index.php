<?php
/*Author: Austin Parker
Date: 6-20-2020
index.php
Index page that defines F3 functions to produce views and maintain data.*/

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


//Require the autoload file
require_once('vendor/autoload.php');


session_start();

//Instantiate the F3 Base classes
$f3 = Base::instance();
$validate = new Validate();
$controller = new Controller($f3, $validate);


//Define a default route
$f3 -> route('GET /', function() {
    $GLOBALS['controller']->home();
});

//Define Personal Information route
$f3 -> route('GET|POST /personalInformation', function($f3) {
    $GLOBALS['controller']->personalInfo();
});

//Define Profile route
$f3 -> route('GET|POST /profile', function($f3) {
    $GLOBALS['controller']->profile();
});

$f3 -> route('GET|POST /interests', function($f3) {
    $GLOBALS['controller']->interests();
});

$f3 -> route('GET|POST /summary', function($f3) {
    $GLOBALS['controller']->summary();
});

//Run fat free
$f3 -> run();