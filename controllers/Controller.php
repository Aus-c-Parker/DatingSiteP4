<?php

class Controller
{
    private $_f3; //router
    private $_validate; //validation object

    /**
     * Controller constructor.
     * @param $f3
     * @param #validate
     */
    public function __construct($f3, $validate)
    {
        $this->_f3 = $f3;
        $this->_validate = $validate;
    }

    public function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    public function personalInfo()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!$this->_validate->validName($_POST['Fname'])) {
                $this->_f3->set('errors["Fname"]', "Please provide a first name");
            }
            else {
                $this->_f3->set('correct["Fname"]', $_POST['Fname']);
            }

            if (!$this->_validate->validName($_POST['Lname'])) {
                $this->_f3->set('errors["Lname"]', "Please provide a last name");
            }
            else {
                $this->_f3->set('correct["Lname"]', $_POST['Lname']);
            }

            if (!$this->_validate->validAge($_POST['age'])) {
                $this->_f3->set('errors["age"]', "Please provide a valid age");
            }
            else {
                $this->_f3->set('correct["age"]', $_POST['age']);
            }

            if (!$this->_validate->validGender($_POST['gender'])) {
                $this->_f3->set('errors["gender"]', "Please select a gender");
            }
            else {
                $this->_f3->set('correct["gender"]', $_POST['gender']);
            }

            if (!$this->_validate->validPhone($_POST['phone'])) {
                $this->_f3->set('errors["phone"]', "Please provide a phone number");
            }
            else {
                $this->_f3->set('correct["phone"]', $_POST['phone']);
            }

            if (empty($this->_f3->get('errors'))) {

                /*$_SESSION['Fname'] = $_POST['Fname'];
                $_SESSION['Lname'] = $_POST['Lname'];
                $_SESSION['age'] = $_POST['age'];
                $_SESSION['gender'] = $_POST['gender'];
                $_SESSION['phone'] = $_POST['phone'];*/


                if(($_POST['member'] == 'member')){
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

                $this->_f3->reroute('profile');
            }
        }

        $view = new Template();
        echo $view->render('views/personalInformation.html');
    }

    public function profile()
    {
        $state = getState();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!$this->_validate->validEmail($_POST['email'])) {
                $this->_f3->set('errors["email"]', "Please provide an email");
            }
            else {
                $this->_f3->set('correct["email"]', $_POST['email']);
            }

            if (!$this->_validate->validState($_POST['state'])) {
                $this->_f3->set('errors["state"]', "Please provide a valid State");
            }

            if (!$this->_validate->validGender($_POST['seeking'])) {
                $this->_f3->set('errors["seeking"]', "Please select a gender");
            }
            else {
                $this->_f3->set('correct["seeking"]', $_POST['seeking']);
            }

            if (!$this->_validate->validName($_POST['bio'])) {
                $this->_f3->set('errors["bio"]', "Please provide a bio");
            }
            else {
                $this->_f3->set('correct["bio"]', $_POST['bio']);
            }

            if (empty($this->_f3->get('errors'))) {
                /*$_SESSION['email'] = $_POST['email'];
                $_SESSION['state'] = $_POST['state'];
                $_SESSION['seeking'] = $_POST['seeking'];
                $_SESSION['bio'] = $_POST['bio'];*/

                $_SESSION['member']->setEmail($_POST['email']);
                $_SESSION['member']->setState($_POST['state']);
                $_SESSION['member']->setSeeking($_POST['seeking']);
                $_SESSION['member']->setBio($_POST['bio']);

                if($_SESSION['isPremium'] == true) {
                    $this->_f3->reroute('interests');
                }
                else {
                    $this->_f3->reroute('summary');
                }

            }
        }

        $this->_f3->set('state', $state);

        $view = new Template();
        echo $view->render('views/profile.html');
    }

    public function interests()
    {
        $indoor = getIndoor();
        $outdoor = getOutdoor();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!$this->_validate->validIndoor($_POST['indoor'])) {
                $this->_f3->set('errors["indoor"]', "Please provide an indoor interest");
            }

            if (!$this->_validate->validOutdoor($_POST['outdoor'])) {
                $this->_f3->set('errors["outdoor"]', "Please provide an indoor interest");
            }

            if (empty($this->_f3->get('errors'))) {
                /*$_SESSION['indoor'] = $_POST['indoor'];
                $_SESSION['outdoor'] = $_POST['outdoor'];*/

                $_SESSION['member']->setInDoorInterests($_POST['indoor']);
                $_SESSION['member']->setOutDoorInterests($_POST['outdoor']);
            }
            $this->_f3->reroute('summary');
        }

        $this->_f3->set('indoor', $indoor);
        $this->_f3->set('outdoor', $outdoor);

        $view = new Template();
        echo $view->render('views/interests.html');
    }

    public function summary()
    {
        $view = new Template();
        echo $view->render('views/summary.html');
    }
}
