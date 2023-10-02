<?php
require_once(realpath(dirname(__FILE__) . "/../config/DbConnection.php"));
require_once("Model.php");

class EvenementModele extends Model
{
    public function create($nom, $lieu, $description, $departements, $date)
    {
        $req = $this->db->getPDo()->prepare("INSERT INTO evenements(nom,description,lieu,date) VALUES (?,?,?,?)");
        $req->execute([$nom, $description, $lieu, $date]);

        $lastId = $this->db->getPDo()->lastInsertId();

        foreach ($departements as $departement) {
            $req = $this->db->getPDo()->prepare("INSERT INTO evenements_departements(id_evenement,id_departement) VALUES (?,?)");
            $req->execute(array($lastId, intval($departement)));
        }
    }

    public function update($nom, $lieu, $description, $departements, $date, $id)
    {
        $req = $this->db->getPDo()->prepare("UPDATE  evenements SET nom=?,description=?,lieu=?,date=? WHERE id=?");
        $req->execute([$nom, $description, $lieu, $date, $id]);

        $req = $this->db->getPDo()->prepare("DELETE FROM evenements_departements WHERE id_evenement=?");
        $req->execute(array($id));

        foreach ($departements as $departement) {
            $req = $this->db->getPDo()->prepare("INSERT INTO evenements_departements(id_departement,id_evenement) VALUES (?,?)");
            $req->execute(array($departement, $id));
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

    public function ajouterVote($vote, $value_selected, $id_evenement)
    {
        $statut = false;
        if ($value_selected == 1) {
            if (strcasecmp("faible", $vote) == 0) {
                $req = $this->db->getPDo()->prepare("UPDATE evenements SET nb_vote_faible_et=nb_vote_faible_et+1  WHERE id=?");
                $statut = $req->execute(array($id_evenement));
            } else if (strcasecmp("moyen", $vote) == 0) {
                $req = $this->db->getPDo()->prepare("UPDATE evenements SET nb_vote_moyen_et=nb_vote_moyen_et+1  WHERE id=?");
                $statut = $req->execute(array($id_evenement));
            } else {
                $req = $this->db->getPDo()->prepare("UPDATE evenements SET nb_vote_fort_et=nb_vote_fort_et+1  WHERE id=?");
                $statut = $req->execute(array($id_evenement));
            }
        } else {
            if (strcasecmp("faible", $vote) == 0) {
                $req = $this->db->getPDo()->prepare("UPDATE evenements SET nb_vote_faible_em=nb_vote_faible_em+1  WHERE id=?");
                $statut = $req->execute(array($id_evenement));
            } else if (strcasecmp("moyen", $vote) == 0) {
                $req = $this->db->getPDo()->prepare("UPDATE evenements SET nb_vote_moyen_em=nb_vote_moyen_em+1  WHERE id=?");
                $statut = $req->execute(array($id_evenement));
            } else {
                $req = $this->db->getPDo()->prepare("UPDATE evenements SET nb_vote_fort_em=nb_vote_fort_em+1  WHERE id=?");
                $statut = $req->execute(array($id_evenement));
            }
        }

        return $statut;
    }
}