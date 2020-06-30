<?php
/*Author: Austin Parker
Date: 6-20-2020
index.php
Index page that defines F3 functions to produce views and maintain data.*/

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();


//Require the autoload file
require_once('vendor/autoload.php');
require_once ('model/data-layer.php');
require_once ('model/validate.php');

//Instantiate the F3 Base class
$f3 = Base::instance();

//Define a default route
$f3 -> route('GET /', function() {
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define Personal Information route
$f3 -> route('GET|POST /personalInformation', function($f3) {

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (!validName($_POST['Fname'])) {
            $f3->set('errors["Fname"]', "Please provide a first name");
        }
        else {
            $f3->set('correct["Fname"]', $_POST['Fname']);
        }

        if (!validName($_POST['Lname'])) {
            $f3->set('errors["Lname"]', "Please provide a last name");
        }
        else {
            $f3->set('correct["Lname"]', $_POST['Lname']);
        }

        if (!validAge($_POST['age'])) {
            $f3->set('errors["age"]', "Please provide a valid age");
        }
        else {
            $f3->set('correct["age"]', $_POST['age']);
        }

        if (!validGender($_POST['gender'])) {
            $f3->set('errors["gender"]', "Please select a gender");
        }
        else {
            $f3->set('correct["gender"]', $_POST['gender']);
        }

        if (!validPhone($_POST['phone'])) {
            $f3->set('errors["phone"]', "Please provide a phone number");
        }
        else {
            $f3->set('correct["phone"]', $_POST['phone']);
        }

        if (empty($f3->get('errors'))) {

            /*$_SESSION['Fname'] = $_POST['Fname'];
            $_SESSION['Lname'] = $_POST['Lname'];
            $_SESSION['age'] = $_POST['age'];
            $_SESSION['gender'] = $_POST['gender'];
            $_SESSION['phone'] = $_POST['phone'];*/

            if(isset($_POST['member'])){
                $object = new PremiumMember($_POST['Fname'], $_POST['Lname'], $_POST['age'], $_POST['gender'],
                    $_POST['phone']);
                $_SESSION['isPremium'] = true;
            }
            else {
                $object = new Member($_POST['Fname'], $_POST['Lname'], $_POST['age'], $_POST['gender'],
                    $_POST['phone']);
                $_SESSION['isPremium'] = false;
            }

            $_SESSION['member'] = $object;

            $f3->reroute('profile');
        }
    }

    $view = new Template();
    echo $view->render('views/personalInformation.html');
});

//Define Profile route
$f3 -> route('GET|POST /profile', function($f3) {

    $state = getState();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (!validEmail($_POST['email'])) {
            $f3->set('errors["email"]', "Please provide an email");
        }
        else {
            $f3->set('correct["email"]', $_POST['email']);
        }

        if (!validState($_POST['state'])) {
            $f3->set('errors["state"]', "Please provide a valid State");
        }

        if (!validGender($_POST['seeking'])) {
            $f3->set('errors["seeking"]', "Please select a gender");
        }
        else {
            $f3->set('correct["seeking"]', $_POST['seeking']);
        }

        if (!validName($_POST['bio'])) {
            $f3->set('errors["bio"]', "Please provide a bio");
        }
        else {
            $f3->set('correct["bio"]', $_POST['bio']);
        }

        if (empty($f3->get('errors'))) {
            /*$_SESSION['email'] = $_POST['email'];
            $_SESSION['state'] = $_POST['state'];
            $_SESSION['seeking'] = $_POST['seeking'];
            $_SESSION['bio'] = $_POST['bio'];*/

            $_SESSION['member']->setEmail($_POST['email']);
            $_SESSION['member']->setState($_POST['state']);
            $_SESSION['member']->setSeeking($_POST['seeking']);
            $_SESSION['member']->setBio($_POST['bio']);

            if($_SESSION['isPremium'] == true){
                $f3->reroute('interests');
                }
            else{
                $f3->reroute('summary');
            }

        }
    }

    $f3->set('state', $state);

    $view = new Template();
    echo $view->render('views/profile.html');
});

$f3 -> route('GET|POST /interests', function($f3) {
    $indoor = getIndoor();
    $outdoor = getOutdoor();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (!validIndoor($_POST['indoor'])) {
            $f3->set('errors["indoor"]', "Please provide an indoor interest");
        }

        if (!validOutdoor($_POST['outdoor'])) {
            $f3->set('errors["outdoor"]', "Please provide an indoor interest");
        }

        if (empty($f3->get('errors'))) {
            /*$_SESSION['indoor'] = $_POST['indoor'];
            $_SESSION['outdoor'] = $_POST['outdoor'];*/

            $_SESSION['member']->setInDoorInterests($_POST['indoor']);
            $_SESSION['member']->setOutDoorInterests($_POST['outdoor']);
        }
        $f3->reroute('summary');
    }

    $f3->set('indoor', $indoor);
    $f3->set('outdoor', $outdoor);
    $view = new Template();
    echo $view->render('views/interests.html');
});

$f3 -> route('GET|POST /summary', function($f3) {
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run fat free
$f3 -> run();