<?php
require_once(realpath(dirname(__FILE__) . "/../config/DbConnection.php"));
require_once("Model.php");

class EvenementModele extends Model
{
    public function create($nom, $lieu, $description, $departements)
    {
        $req = $this->db->getPDo()->prepare("INSERT INTO evenements(nom,description,lieu) VALUES (?,?,?)");
        $req->execute([$nom, $description, $lieu]);

        $lastId = $this->db->getPDo()->lastInsertId();

        foreach ($departements as $departement) {
            $req = $this->db->getPDo()->prepare("INSERT INTO evenements_departements(id_evenement,id_departement) VALUES (?,?)");
            $req->execute(array($lastId, intval($departement)));
        }
    }

    public function update($nom, $lieu, $description, $departements, $id)
    {
        $req = $this->db->getPDo()->prepare("UPDATE  evenements SET nom=?,description=?,lieu=? WHERE id=?");
        $req->execute([$nom, $description, $lieu, $id]);
        $dprt = new DepartementModel();
        foreach ($departements as $departement) {
            $data = $dprt->selectByLibelle($departement);
            $req = $this->db->getPDo()->prepare("UPDATE evenements_departements SET id_departement=? WHERE id_evenement=?");
            $req->execute(array($data["id"], $id));
        }
    }
    public function selectAll()
    {
        $req = $this->db->getPDo()->prepare("SELECT * FROM evenements");
        $req->execute();
        return $req->fetchAll();
    }

    public function selectById($id)
    {
        $req = $this->db->getPDo()->prepare("SELECT * FROM evenements WHERE id=?");
        $req->execute(array($id));

        return $req->fetch();
    }

    public function delete($id)
    {
        $req = $this->db->getPDo()->prepare("DELETE FROM evenements_departements WHERE id_evenement=?");
        $req->execute(array($id));
        if ($req == true) {
            $req = $this->db->getPDo()->prepare("DELETE FROM evenements WHERE id=?");
            $req->execute(array($id));
            if ($req == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}