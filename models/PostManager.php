<?php
class PostManager extends Model
{
    public function getPosts(){
        $this->getBdd();
        return $this->getAll('post','Post');
    }
}