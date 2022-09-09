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
        if (!empty($url[1]) && $url[1] == "send" && !empty($_POST)) {
            $to = 'mathieulagnel@gmail.com';
            $subject = 'Contact de ' . $_POST['name'];
            $message = 'email : ' . $_POST['email'] . " message : " . $_POST["message"];
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
           $res =  mail($to,$subject,$message,$headers);
            exit( header('Location: http://localhost/Unlinkedout/accueil'));
        }
        else
            $this->contact();
    }
    private function contact()
    {

        $this->_view = new View('Contact');
        $this->_view->generate(array('t'=>'Contact'));
    }


}