<?php

require_once ('views/View.php');
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
        if (!empty($url[1]) && $url[1] == "create") {
            if (!empty($_POST)) {
                $fields = "title,body,updated_at,created_at,author"; // to do author est la personne connecte
                $date = date("Y-n-j");
                $value = "'".$_POST['title']."','".$_POST['body']."','".$date."','".$date."','1'";
                $this->_postManager->insertInto('post',$fields,$value);
                exit( header('Location: http://localhost/Unlinkedout/accueil'));
            }
            else {
                $user = getConnect();
                if ( !empty($user)) {
                    $this->createPost();
                }
                else {
                    // TO MESSAGE D4EREUR
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


}