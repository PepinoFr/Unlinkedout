<?php
abstract  class Model
{
    private static $_bdd;

    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=127.0.0.1;dbname=unlinkedout','root','');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }
    protected function getBdd()
    {
        if(self::$_bdd == null)
           $this->setBdd();
        return self::$_bdd;
    }
    protected function getAll($table,$obj)
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM '.$table.' ORDER BY id desc');
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }
        $req->closeCursor();
        return $var;


    }
    protected  function  getById($table,$obj,$id){

        $req = $this->getBdd()->prepare('SELECT * FROM '.$table.' WHERE id = '.$id);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $var = new $obj($data);
        return $var;
        $req->closeCursor();


    }

    protected function getALLComments($table,$obj,$id)
    {
        $var = [];

        //echo $id;
        $req = $this->getBdd()->prepare('SELECT * FROM '.$table.' WHERE post = '.$id);
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }
        $req->closeCursor();
        return $var;


    }
    protected  function  getUsersbyID($table,$obj,$id){

        $req = $this->getBdd()->prepare('SELECT * FROM '.$table.' WHERE id = '.$id);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $var = new $obj($data);
        return $var;
        $req->closeCursor();


    }


}
