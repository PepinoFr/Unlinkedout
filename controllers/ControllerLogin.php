<?php

require_once ('views/View.php');
require_once ('functions/auth.php');
class ControllerLogin
{
    private $_postManager;
    private $_view;

    public function __construct($url)
    {
        if (empty($url)) {
            throw new Exception('Page introuvable');
        }
        else {
            $this->_postManager = new PostManager;
            if (!empty($url[1]) && $url[1] == "create") {
                if (!empty($_POST)) {
                    $user = $this->_postManager->getUserByEmail($_POST['email']);
                    if (empty($user)) {
                        $fields = "name,email,password,role";
                        $value = "'".$_POST['pseudo']."','".$_POST['email']."','".$_POST['password']."','1'";
                        $this->_postManager->insertInto('author',$fields,$value);
                        // to do connetcer
                        exit( header('Location: http://localhost/Unlinkedout/accueil'));
                    }
                    else {
                        $this->register(1);
                    }
                }
                else {
                    $this->register();
                }
            }
            else {
                $erreur="";
                if (!empty($_POST)) {
                    $user = $this->_postManager->auth($_POST['email'],$_POST['password']);
                    if (!empty($user)) {
                        connect($user);
                        //$_SESSION['connecte'] = $user;
                      //  exit( header('Location: http://localhost/Unlinkedout/accueil'));
                    }
                    else {
                        $erreur=1;
                    }
                }

                $this->login($erreur);
            }
        }
    }
    private function login($erreur)
    {
        $this->_view = new View('Login');
        $this->_view->generate(array('t' => 'Login','erreur'=>$erreur));
    }

    private function register($exist = 0)
    {
        $this->_postManager = new PostManager;

        $this->_view = new View('RegisterLogin');
        $this->_view->generate(array('t' => 'Register','exist'=>$exist ));
    }
}
