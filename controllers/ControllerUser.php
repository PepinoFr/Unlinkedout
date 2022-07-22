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
            $id = intval($url[1]);
            $this->_postManager = new PostManager;
            $user = $this->_postManager->getUsers($id);
            if (empty($_POST)) {
                if (!empty($url[2])) {
                    if ($url[2]  == "modify") {
                        $this->modifyUser($user);
                    }
                    else if ($url[2]  == "delete") {
                        $this->_postManager->delete('author',$id);
                        exit( header('Location: http://localhost/Unlinkedout/accueil'));
                    }
                }
                else {
                    $this->post($user);
                }
            }
            else {
                $value = "name ='".$_POST['name']."', firstname = '".$_POST['firstname']."', lastname = '";
                $value .= $_POST['lastname']."', email = '".$_POST["email"]."', password = '".$_POST["password"]."'";
                $this->_postManager->update('author',$id,$value);
                exit( header('Location: http://localhost/Unlinkedout/user/'.$id));
            }

        }

    }
    private function post($user)
    {

        $this->_view = new View('User');
        $this->_view->generate(array('t'=>'User','user'=>$user ));
    }
    private function modifyUser($user)
    {

        $this->_view = new View('ModifyUser');
        $this->_view->generate(array('t'=>'User','user'=>$user ));
    }
}
