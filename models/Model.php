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
        $req->closeCursor();
        return $var;

    }
    protected function getALLComments($table,$obj,$id)
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM '.$table.' WHERE post = '.$id);
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }
        $req->closeCursor();
        return $var;
    }
    protected function getCommentsValide($table,$obj,$id)
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM '.$table.' WHERE post = '.$id . ' AND valide = 1');
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
        $req->closeCursor();
        return $var;

    }
    protected  function  getUserEmail($table,$obj,$email){
        $req = $this->getBdd()->prepare("SELECT * FROM ".$table." WHERE email = '".$email."'");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $var =null;
        if (!empty($data)) {
            $var = new $obj($data);
        }
        $req->closeCursor();
        return $var;

    }

    protected  function insert($table,$fields,$value) {
        $req = $this->getBdd()->prepare("INSERT INTO ".$table." ( ".$fields. " ) VALUES (".$value .");" );
        $req->execute();
        return $req;
    }

    protected function modify($table,$id,$value) {
        $req = $this->getBdd()->prepare("UPDATE ".$table." SET ". $value ." WHERE id = " . $id );
        $req->execute();
    }

    protected function remove($table,$id) {
        $req = $this->getBdd()->prepare("DELETE from ".$table." WHERE id = " . $id );
        $req->execute();
    }

    protected function getAuth($email,$password){
        $req = $this->getBdd()->prepare("SELECT * FROM author WHERE email = '".$email ."' AND password= '".$password."'");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        if (!empty($data)) {
            $var = new User($data);
            return $var;
        }
        else {
            return null;
        }

    }
}
