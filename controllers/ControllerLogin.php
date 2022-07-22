<?php

require_once ('views/View.php');
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
                    echo $_POST['email'];
                    $user = $this->_postManager->getUserByEmail($_POST['email']);
                    if (empty($user)) {
                        $champs = "name,email,password,role";
                        $value = "'".$_POST['pseudo']."','".$_POST['email']."','".$_POST['password']."','1'";
                        $this->_postManager->insertInto('author',$champs,$value);
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
                $this->login();
            }
        }
    }
    private function login()
    {
        $this->_view = new View('Login');
        $this->_view->generate(array('t' => 'Login'));
    }

    private function register($exist = 0)
    {
        $this->_postManager = new PostManager;

        $this->_view = new View('Register');
        $this->_view->generate(array('t' => 'Register','exist'=>$exist ));
    }
}
