<?php
require_once ('views/View.php');
require_once ('functions/auth.php');
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
        $user = getConnect();
        if ( !empty($url[2]) && !empty($user) )  {
            $post = $this->_postManager->getPost($id);
            if($url[2] == 'delete' ) {
                if (authorized($user,$post)) {
                    $this->_postManager->delete('post',$id);
                    exit( header('Location: http://localhost/Unlinkedout/accueil'));
                }
                else {
                    $this->Unauthorized();
                }

            }
            else if ($url[2] == 'modify') {
                if (authorized($user,$post)) {
                    if(empty($_POST)) {
                        $this->modifyPost($post);
                    }
                    else {
                        $value ="body = '".$_POST["body"]."', updated_at = '".$date."'";
                        $this->_postManager->update('post',$id,$value);
                        exit( header('Location: http://localhost/Unlinkedout/post/'.$id));
                    }
                }
                else {
                    $this->Unauthorized();
                }
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
            if (is_numeric($url[2])) {
                $idC = intval($url[2]);
                $comment = $this->_postManager->getComment($idC);
                if ($url[3] == 'delete' ) {
                    if ( authorized($user,$comment)) {
                        $this->_postManager->delete('comments',$idC);
                        exit( header('Location: http://localhost/Unlinkedout/post/'.$id));
                    }
                    else {
                        $this->Unauthorized();
                    }
                }
                else if( $url[3] == 'modify' ){
                    if (authorized($user,$comment)) {
                        if(empty($_POST)) {
                            $this->modifyComments($comment);
                        }
                        else {
                            $value ="body = '".$_POST["body"]."', updated_at = '".$date."'";
                            $this->_postManager->update('comments',$idC,$value);
                            exit( header('Location: http://localhost/Unlinkedout/post/'.$id));
                        }
                    }
                    else {
                        $this->Unauthorized();
                    }
                }
                else if ( $url[3] == 'valide') {
                    if (authorized($user,$post)) {
                        $value = "valide = '1'";
                        $this->_postManager->update('comments',$idC,$value);
                        exit( header('Location: http://localhost/Unlinkedout/post/'.$id));
                    }
                    else {
                        $this->Unauthorized();
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
        $user = getConnect();
        if ($user->getRole() == 2 || $user->getID() == $post->getAuthor() ) {
            $comments = $this->_postManager->getComments($id);
        }
        else {
            $comments = $this->_postManager->getValide($id);
        }

        
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
    private function Unauthorized(){
        $this->_view = new View('Unauthorized');
        $this->_view->generate(array('t'=>'Unauthorized' ));
    }
}