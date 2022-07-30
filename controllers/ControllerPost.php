<?php
require_once ('views/View.php');
class ControllerPost
{
    private $_postManager;
    private $_view;

    public function __construct($url)
    {


        $this->_postManager = new PostManager;
        if (empty($url)) {
            throw new Exception('Page introuvable');
        }
        $id = intval($url[1]);
        $date = date("Y-n-j");
        if ( !empty($url[2]) )  {
            if($url[2] == 'delete') {
                $this->_postManager->delete('post',$id);
                exit( header('Location: http://localhost/Unlinkedout/accueil'));
            }
            else if ($url[2] == 'create') {
                if (!empty($_POST)) {
                    $fields = "created_at,body,post,updated_at,author"; // to do author est la personne connecte
                    $value = "'" . $date . "','" . $_POST['body'] . "','" . $id . "','" . $date . "','1'";
                    $this->_postManager->insertInto('comments',$fields,$value);
                    exit( header('Location: http://localhost/Unlinkedout/post/'.$id));
                }
                else {
                    $this->createComment();
                }
            }
            else if ($url[2] == 'modify') {
                if(empty($_POST)) {
                    $post = $this->_postManager->getPost($id);
                    $this->modifyPost($post);
                }
                else {
                    $value ="body = '".$_POST["body"]."', updated_at = '".$date."'";
                    $this->_postManager->update('post',$id,$value);
                    exit( header('Location: http://localhost/Unlinkedout/post/'.$id));
                }
            }
            if (is_numeric($url[2])) {
                $idC = intval($url[2]);
                if ($url[3] == 'delete') {
                    $this->_postManager->delete('comments',$idC);
                    exit( header('Location: http://localhost/Unlinkedout/post/'.$id));
                }
                else if( $url[3] == 'modify'){
                    if(empty($_POST)) {
                        $comment = $this->_postManager->getComment($idC);
                        $this->modifyComments($comment);
                    }
                    else {
                        $value ="body = '".$_POST["body"]."', updated_at = '".$date."'";
                        $this->_postManager->update('comments',$idC,$value);
                        exit( header('Location: http://localhost/Unlinkedout/post/'.$id));
                    }

                }
            }

        }
        else {
            $this->post($id);
        }

    }
    private function post($id)
    {
        $post = $this->_postManager->getPost($id);
        $comments = $this->_postManager->getComments($id);
        
        $this->_view = new View('Post');

        $this->_view->generate(array('t'=>'post','post'=>$post,'comments'=>$comments));
    }

    private function  createComment() {
        $this->_view = new View('RegisterComments');
        $this->_view->generate(array('t' => 'créer commentaire' ));
    }
    private function modifyComments($comment)
    {
        $this->_view = new View('ModifyComments');
        $this->_view->generate(array('t'=>'modifer commentaire','comment'=>$comment ));
    }
    private function modifyPost($post)
    {
        $this->_view = new View('ModifyPost');
        $this->_view->generate(array('t'=>'modifier post','post'=>$post ));
    }
}