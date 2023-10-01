<?php
require_once(realpath(dirname(__FILE__) . "/../config/DbConnection.php"));
require_once("Model.php");

class DepartementModel extends Model
{
    public function selectAll()
    {
        $req = $this->db->getPDo()->prepare("SELECT * FROM departements");
        $data = $req->execute();
        return $req->fetchAll();
    }

    public function selectById($libelle){
        $req = $this->db->getPDo()->prepare("SELECT * FROM departements WHERE libelle=?");
        $req->execute(array($libelle));

        return $req->fetch();
    }
    public function create($libelle, $description)
    {
        $req = $this->db->getPDo()->prepare("INSERT INTO departements(libelle,description) VALUES (?,?)");
        $req->execute([$libelle, $description]);
    }

    public function getDepartements($idDevenement)
    {
        $req = $this->db->getPDo()->prepare("SELECT libelle FROM departements d INNER JOIN evenements_departements ed
            ON d.id=ed.id_departement WHERE ed.id_evenement=?");
        $req->execute(array($idDevenement));

        return $req->fetchAll();
    }
}