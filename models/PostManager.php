<?php
class PostManager extends Model
{
    // to do faire plusieur model
    public function getPosts(){
        $this->getBdd();
        return $this->getAll('post','Post');
    }

    public function insertInto($table,$fields,$value){
        $this->getBdd();
        return $this->insert($table,$fields,$value);
    }
    public function update($table,$id,$value) {
        $this->getBdd();
        return $this->modify($table,$id,$value);
    }
    public function delete($table,$id) {
        $this->getBdd();
        return $this->remove($table,$id);
    }
    public function getPost($id){
        $this->getBdd();
        return $this->getById('post','Post',$id);
    }
    public function getComment($id) {
        $this->getBdd();
        return $this->getById('comments','Comment',$id);
    }
    public function getComments($id) {
        $this->getBdd();
        return $this->getALLComments('comments','Comment',$id);
    }
    public function getValide($id) {
        $this->getBdd();
        return $this->getCommentsValide('comments','Comment',$id);
    }
    public function getUsers($id) {
        $this->getBdd();
        return $this->getUsersbyID('author','User',$id);
    }
    public function getUserByEmail($email){
        $this->getBdd();
        return $this->getUserEmail('author','User',$email);

    }

    public function auth($email,$password){
        $this->getBdd();
        return $this->getAuth($email,$password);

    }

}