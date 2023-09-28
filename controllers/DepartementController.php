<?php
require_once(realpath(dirname(__FILE__)."/../modeles/DepartementModel.php"));
require_once (realpath(dirname(__FILE__)."/../Util.php"));
class DepartementController
{
    private $departementModel;
    public function __construct()
    {
        $this->departementModel = new DepartementModel();
    }

    public function getDepartements(){
        return $this->departementModel->selectAll();
    }

}