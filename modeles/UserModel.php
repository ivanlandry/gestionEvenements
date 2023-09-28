<?php
require_once (realpath(dirname(__FILE__)."/../config/DbConnection.php"));
require_once ("Model.php");
class UserModel extends Model
{
     public  function selectAll(){
        $req = $this->db->getPDo()->prepare("SELECT * FROM users");
        $data = $req->execute();
        return $req->fetchAll();
    }

    public function selectWhereUserNameAndPassword($username,$password){
        $req = $this->db->getPDo()->prepare("SELECT * FROM users WHERE username=? AND password=?");
        $req->execute([$username,$password]);
        $data = $req->rowCount();
        return $data;
    }
    public function create($username,$email,$password){

        $req = $this->db->getPDo()->prepare("INSERT INTO users(username,email,password) VALUES (?,?,?)");
        $req->execute([$username,$email,md5($password)]);

    }

    public function delete($id){
        $req = $this->db->getPDo()->prepare("DELETE FROM users WHERE id=?");
        $data = $req->execute([$id]);
    }
    public function update($id){

    }

}