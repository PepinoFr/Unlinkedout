<?php
class PostManager extends Model
{
    public function getPosts(){
        $this->getBdd();
        return $this->getAll('post','Post');
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

}