<?php
require_once ('views/View.php');
class ControllerUser
{
    private $_postManager;
    private $_view;

    public function __construct($url)
    {


        if (empty($url)) {
            throw new Exception('Page introuvable');
        }
        else {
            $this->post(intval($url[1]));
        }

    }
    private function post($id)
    {
        $this->_postManager = new PostManager;
        $user = $this->_postManager->getUsers($id);


        $this->_view = new View('User');

        $this->_view->generate(array('t'=>'User','user'=>$user ));
    }
}
