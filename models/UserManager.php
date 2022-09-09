<?php
class UserManager extends Model
{
    public function getUser($id) {
        $this->getBdd();
        return $this->getUsersbyID('author','User',$id);
    }
    public function delete($table,$id) {
        $this->getBdd();
        return $this->remove($table,$id);
    }
    public function update($table,$id,$value) {
        $this->getBdd();
        return $this->modify($table,$id,$value);
    }
    public function insertInto($table,$fields,$value){
        $this->getBdd();
        return $this->insert($table,$fields,$value);
    }

    public function getPosts($id) {
        $this->getBdd();
        return $this->getByauthor('post','Post',$id);
    }

    public function getUsers(){
        $this->getBdd();
        return $this->getAll('author','User');
    }
    public function getUserByEmail($email){
        $this->getBdd();
        return $this->getUserEmail('author','User',$email);
    }
    public function auth($email,$password){
        $this->getBdd();
        return $this->getAuth($email,$password);
    }
    public function getTovalidate() {
        $this->getBdd();
        return $this->getUsersToValide();
    }
}