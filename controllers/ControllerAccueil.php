<?php

include_once 'views/View.php';
class ControllerAccueil
{
    private $_postManager;
    private $_view;

    public function __construct($url)
    {
        $this->_postManager = new PostManager;
        if (empty($url)) {
            throw new Exception('Page introuvable');
        }
        $user = getConnect();
        if (!empty($url[1]) && $url[1] == "create") {
            //
            //if the _POST variable is not empty then we create a post
            if (!empty($this->getPost('title'))) {
                $fields = "title,body,updated_at,created_at,author,header";
                $date = date("Y-n-j");
                $value = "'".$this->getPost('title')."','".$this->getPost('body')."','".$date."','".$date."',".$user->getId().",'".$this->getPost('header')."'";
                $this->_postManager->insertInto('post',$fields,$value);
                $this->posts();
            }
            // else we redirect to the creation page
            else {
                if ( !empty($user) && $user->getRole() > 0 ) {
                    $this->createPost();
                }
                else {
                    $this->Unauthorized();
                }
            }
        }
        else
            $this->posts();
    }
    private function posts()
    {
        $posts = $this->_postManager->getPosts();
        $this->_view = new View('Accueil');
        $this->_view->generate(array('t'=>'post','posts'=>$posts));
    }

    private function  createPost() {
        $this->_view = new View('RegisterPost');
        $this->_view->generate(array('t' => 'créer Post' ));
    }
    private function Unauthorized(){
        $this->_view = new View('Unauthorized');
        $this->_view->generate(array('t'=>'Unauthorized' ));
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