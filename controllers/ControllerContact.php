<?php

require_once ('views/View.php');
class ControllerContact
{
    private $_postManager;
    private $_view;

    public function __construct($url)
    {
        $this->_postManager = new PostManager;
        if (empty($url)) {
            throw new Exception('Page introuvable');
        }
        if (!empty($url[1]) && $url[1] == "send" && !empty($this->getPost('email'))) {
            $sendTo = 'mathieulagnel@gmail.com';
            $subject = 'Contact de ' . $this->getPost('name');
            $message = 'email : ' .  $this->getPost('email') . " message : " . $this->getPost("message");
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            mail($sendTo,$subject,$message,$headers);
            $this->posts();
        }
        else
            $this->contact();
    }
    private function posts()
    {
        $posts = $this->_postManager->getPosts();
        $this->_view = new View('Accueil');
        $this->_view->generate(array('t'=>'post','posts'=>$posts));
    }
    private function contact()
    {
        $this->_view = new View('Contact');
        $this->_view->generate(array('t'=>'Contact'));
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