<?php
namespace App\Models\Dossier;

use App\Entity\Dossier\Temoin;
use App\Models\Models;

class TemoinModel extends Models
{

    protected string $table="temoin";
    protected string $nameSpaceTable="App\Entity\Dossier\Temoin";



    //CREER UN TEMOIN
    public function creerTemoin(Temoin $temoin)
    {
        $sql="INSERT INTO {$this->table}
        (nom,prenom,sexe,dateNaissance,lieuNaissance,cin,lieuCin,dateCin,pere,mere,profession,adresse,dossier_id,creatAt,updatAt)
         VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $requete=$this->bdd->getPdo()->prepare($sql);

        if($requete->execute([
            $temoin->getNom(),
            $temoin->getPrenom(),
            $temoin->getSexe(),
            $temoin->getDateNaissance(),
            $temoin->getLieuNaissance(),
            $temoin->getCin(),
            $temoin->getLieuCin(),
            $temoin->getDateCin(),
          

            $temoin->getPere(),
            $temoin->getMere(),

            $temoin->getProfession(),
            $temoin->getAdresse(),

            $temoin->getDossier_id(),

            $temoin->getCreatAt(),
            $temoin->getUpdatAt(),

        ])===true){
            return true;
        }else
        {
            return false;
        }

    }



    //MODIFIER UN TEMOIN
    public function modifierTemoin(Temoin $temoin)
    {
        $sql="UPDATE {$this->table} SET
        nom=?,prenom=?,sexe=?,dateNaissance=?,lieuNaissance=?,cin=?,lieuCin=?,dateCin=?,pere=?,mere=?,profession=?,adresse=?,updatAt=? WHERE id=?";

        $requete=$this->bdd->getPdo()->prepare($sql);

        if($requete->execute([
            $temoin->getNom(),
            $temoin->getPrenom(),
            $temoin->getSexe(),
            $temoin->getDateNaissance(),
            $temoin->getLieuNaissance(),
            $temoin->getCin(),
            $temoin->getLieuCin(),
            $temoin->getDateCin(),
          

            $temoin->getPere(),
            $temoin->getMere(),

            $temoin->getProfession(),
            $temoin->getAdresse(),
            $temoin->getUpdatAt(),
            $temoin->getId()

        ])===true){
            return true;
        }else
        {
            return false;
        }

    }
    

}