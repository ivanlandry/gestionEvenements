<?php
require_once(realpath(dirname(__FILE__) . "/../modeles/EvenementModele.php"));
require_once(realpath(dirname(__FILE__) . "/../modeles/DepartementModel.php"));
require_once(realpath(dirname(__FILE__) . "/../Util.php"));

class EvenementController
{
    private $evenementModel;

    public function __construct()
    {
        $this->evenementModel = new EvenementModele();
    }
    public function getEvenement($id){
        return $this->evenementModel->selectById($id);
    }
    public function getEvenements()
    {
        return $this->evenementModel->selectAll();
    }

    public function getDepartements($idDevenement)
    {
        $departements = new DepartementModel();
        return $departements->getDepartements($idDevenement);
    }

    public function delete($id)
    {
        if ($this->evenementModel->delete($id)) {
            $_SESSION["delete_evenement"] = "evenement supprimé";
            header("Location:evenement.php");
        } else
            echo "page not found";
    }

    public function create($_nom, $_lieu, $_description, $_departements,$_date)
    {
        $nom = Util::trojan($_nom);
        $lieu = Util::trojan($_lieu);
        $description = Util::trojan($_description);
        $date = Util::trojan($_date);
        $this->evenementModel->create($nom, $lieu, $description, $_departements,$date);

        $_SESSION["add_evenement"] = "Evenement créé";
        header("Location:evenement.php");
    }

    public function update($_nom, $_lieu, $_description, $_departements,$_date,$id)
    {
        $nom = Util::trojan($_nom);
        $lieu = Util::trojan($_lieu);
        $description = Util::trojan($_description);
        $date = Util::trojan($_date);
        $this->evenementModel->update($nom, $lieu, $description, $_departements,$date,$id);

        $_SESSION["update_evenement"] = "Evenement modifié";
        header("Location:evenement.php");
    }

}