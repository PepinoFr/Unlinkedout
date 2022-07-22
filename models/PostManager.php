<?php
class PostManager extends Model
{
    public function getPosts(){
        $this->getBdd();
        return $this->getAll('post','Post');
    }

    public function insertInto($table,$champs,$value){

        $this->getBdd();
        return $this->insert($table,$champs,$value);

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
    public function getComments($id) {
        $this->getBdd();
        return $this->getALLComments('comments','Comment',$id);
    }
    public function getUsers($id) {
        $this->getBdd();
        return $this->getUsersbyID('author','User',$id);
    }
    public function getUserByEmail($email){
        $this->getBdd();
        return $this->getUserEmail('author','User',$email);

    }

}