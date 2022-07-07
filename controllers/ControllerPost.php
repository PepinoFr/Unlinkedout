<?php
require_once ('views/View.php');
class ControllerPost
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
        $post = $this->_postManager->getPost($id);
        $comments = $this->_postManager->getComments($id);
        
        $this->_view = new View('Post');

        $this->_view->generate(array('t'=>'post','post'=>$post,'comments'=>$comments));
    }
}