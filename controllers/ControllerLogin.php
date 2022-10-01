<?php

require_once ('views/View.php');
require_once ('functions/auth.php');
class ControllerLogin
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (empty($url)) {
            throw new Exception('Page introuvable');
        }
        else {
            $this->_userManager = new UserManager;
            if (!empty($url[1])) {
                if ( $url[1] == "create") {
                    if (!empty($this->getPost('email'))) {
                        //checks if the email address exists before creating the user
                        $user = $this->_userManager->getUserByEmail($this->getPost('email'));
                        if (empty($user)) {
                            $fields = "name,email,password,role,avatar";
                            $value = "'" . $this->getPost('pseudo') . "','" . $this->getPost('email') . "','" . $this->getPost('password') . "','0','avatars/default.jpg'";
                            $this->_userManager->insertInto('author', $fields, $value);
                            $user = $this->_userManager->auth($this->getPost('email'),$this->getPost('password'));
                            connect($user);
                            $this->author($user);
                        } else {
                            $this->register(1);
                        }
                    } else {
                        $this->register();
                    }
                }
                else if($url[1] == "logout") {
                    logout();
                }
            }
            else {
                $erreur='';
                //part of the code for this login
                if (!empty($this->getPost('email'))) {
                    $user = $this->_userManager->auth($this->getPost('email'),$this->getPost('password'));
                    if (!empty($user)) {
                        connect($user);
                        $this->author($user);
                    }
                    else {
                        $erreur=1;
                    }
                }
                if (empty($user)) {
                    $this->login($erreur);
                }
            }
        }
    }
    private function author($author)
    {
        $this->_view = new View('User');
        $this->_view->generate(array('t'=>'Author','author'=>$author ));
    }
    private function login($erreur)
    {
        $this->_view = new View('Login');
        $this->_view->generate(array('t' => 'Login','erreur'=>$erreur));
    }

    private function register($exist = 0)
    {

        $this->_view = new View('RegisterLogin');
        $this->_view->generate(array('t' => 'Register','exist'=>$exist ));
    }
    private function  getPost($arg='') {
        $post = filter_input(INPUT_POST, $arg);
        if (!empty($post)) {
            return $post;
        }
        else {
            return '';
        }
    }
}
