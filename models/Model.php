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
    protected  function  getUserEmail($table,$obj,$email){
        $req = $this->getBdd()->prepare("SELECT * FROM ".$table." WHERE email = '".$email."'");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $var =null;
        if (!empty($data)) {
            $var = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected  function insert($table,$champs,$value) {
        $req = $this->getBdd()->prepare("INSERT INTO ".$table." ( ".$champs. " ) VALUES (".$value .");" );
        $req->execute();
    }

    protected  function modify($table,$id,$value) {
        $req = $this->getBdd()->prepare("UPDATE ".$table." SET ". $value ." WHERE id = " . $id );
        $req->execute();
    }
    protected  function remove($table,$id) {
        $req = $this->getBdd()->prepare("DELETE from ".$table." WHERE id = " . $id );
        $req->execute();
    }




}
