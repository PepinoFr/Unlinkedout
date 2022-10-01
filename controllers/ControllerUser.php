<?php
require_once ('views/View.php');
require_once ('functions/auth.php');
class ControllerUser
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (empty($url)) {
            throw new Exception('Page introuvable');
        }
        else {
            $user = getConnect();
            $this->_userManager = new UserManager;
            if ($url[1] == 'all') {
                if (!empty($user) &&  $user->getRole() == 2 && !empty($url[2]) ) {

                    if ($url[2] == "tovalidate") {
                        $this->usersToValide();
                    }
                    else {
                        $id = (int)$url[2];
                        if (!empty($url[3])) {
                            $value = "role=";
                            if ($url[3] == 'validate') {
                                $value.= "1";
                            }
                            else if ($url[3] == 'admin') {
                                $value.= "2";
                            }
                            else if ($url[3] == 'inactif') {
                                $value.= "0";
                            }
                            $this->_userManager->update('author', $id, $value);
                        }
                        $this->users();
                    }

                }else
                    $this->users();
            } else {
                $id = (int)$url[1];
                $author = $this->_userManager->getUser($id);
                // update of a user
                if (!empty( $this->getPost('name'))) {
                    $value = "name ='" . $this->getPost('name') . "', firstname = '" . $this->getPost('firstname') . "',description = '".$this->getPost('description')."', lastname = '";
                    $value .= $this->getPost('lastname') . "', email = '" . $this->getPost("email") . "', password = '" . $this->getPost("password") . "'";
                    $value .= ",link='".$this->getPost('fb')."/".$this->getPost('twitter')."/".$this->getPost('git')."/".$this->getPost('inst')."/".$this->getPost('ytb')."'";
                    if (isset($_FILES['avatar']) and !empty($_FILES['avatar']['name'])) {
                        $sizemax = 2097152;
                        $extensionsValides = array('jpg', 'jpeg', 'png');
                        if ($_FILES['avatar']['size'] <= $sizemax) {
                            $extensionsUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
                            if (in_array($extensionsUpload, $extensionsValides)) {
                                $chemin = "avatars/" . $user->getId() . "." . $extensionsUpload;
                                $move = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                                if ($move) {
                                    $value .= ",avatar ='" . $chemin . "'";
                                } else {
                                    $msg = " Erreur de deplacement ";
                                }
                            } else {
                                $msg = " Votre photo de profil n'a pas le bon format";
                            }
                        } else {
                            $msg = " Votre photo de profil ne doit pas dépasser 2Mo";
                        }
                    }
                    if (isset($_FILES['cv']) and !empty($_FILES['cv']['name'])) {
                        $sizemax = 2097152;
                        $extensionsValides = array('jpg', 'jpeg', 'png', 'pdf');
                        if ($_FILES['cv']['size'] <= $sizemax) {
                            $extensionsUpload = strtolower(substr(strrchr($_FILES['cv']['name'], '.'), 1));
                            if (in_array($extensionsUpload, $extensionsValides)) {
                                $chemin = "cv/" . $user->getId() . "." . $extensionsUpload;
                                $move = move_uploaded_file($_FILES['cv']['tmp_name'], $chemin);
                                if ($move) {
                                    $value .= ",cv ='" . $chemin . "'";
                                    echo $value;
                                } else {
                                    $msg = " Erreur de deplacement ";
                                }
                            } else {
                                $msg = " Votre cv n'a pas le bon format";
                            }
                        } else {
                            $msg = " Votre cv ne doit pas dépasser 2Mo";
                        }
                    }
                    if (!empty($msg)) {
                        echo $msg;

                    }
                    $this->_userManager->update('author', $id, $value);
                    $this->author($author);
                } else {
                    if (!empty($url[2])) {
                        //displays all posts of a user
                        if ($url[2] == "posts") {
                            $this->posts($id);
                        } else if (!empty($user) && ($author->getId() == $user->getId() || $user->getRole() == 2 || $user->getRole() == 1)) {
                            if ($url[2] == "modify") {
                                $this->modifyUser($author);
                            } else if ($url[2] == "delete") {
                                $this->_userManager->delete('author', $id);
                               $this->users();
                            }
                        } else {
                            $this->Unauthorized();
                        }
                    } else {
                        $this->author($author);
                    }
                }
            }
        }
    }
    private function posts($id)
    {
        $posts = $this->_userManager->getPosts($id);
        $this->_view = new View('PostByUser');
        $this->_view->generate(array('t'=>'post by author','posts'=>$posts));
    }
    private function usersToValide() {
        $users = $this->_userManager->getTovalidate();
        $this->_view = new View('Users');
        $this->_view->generate(array('t'=>'Authors a valider','users'=>$users ));
    }
    private function users()
    {
        $users = $this->_userManager->getUsers();
        $this->_view = new View('Users');
        $this->_view->generate(array('t'=>'Authors','users'=>$users ));
    }
    private function author($author)
    {
        $this->_view = new View('User');
        $this->_view->generate(array('t'=>'Author','author'=>$author ));
    }
    private function modifyUser($author)
    {
        $this->_view = new View('ModifyUser');
        $this->_view->generate(array('t'=>'Author','author'=>$author ));
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
