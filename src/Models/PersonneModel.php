<?php
namespace App\Models;


use App\Entity\Personne;
use PDO;

class PersonneModel extends Models
{
    protected string $table="personne";
    protected string $nameSpaceTable="App\Entity\Personne";


    //POUR CREER UNE FAMILLE
    public function creerPersonne(Personne $personne):bool
    {
        $sql="INSERT INTO {$this->table}(nom,prenom,sexe,dateNaissance,lieuNaissance,cin,lieuCin,dateCin,profession,pere,mere,roleFamille,vie,creatAt,updatAt,famille_id)
         VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $requete=$this->bdd->getPdo()->prepare($sql);

        if($requete->execute([
            $personne->getNom(),
            $personne->getPrenom(),
            $personne->getSexe(),
            $personne->getDateNaissance(),
            $personne->getLieuNaissance(),
            $personne->getCin(),
            $personne->getLieuCin(),
            $personne->getDateCin(),
            $personne->getProfession(),

            $personne->getPere(),
            $personne->getMere(),
            $personne->getRoleFamille(),
            $personne->getVie(),

            $personne->getCreatAt(),
            $personne->getUpdatAt(),
            $personne->getfamille_id()

        ])===true){
            return true;
        }else
        {
            return false;
        }
    }

    //POUR MODIFIER UNE PERSONNE
    public function modifierPersonne(Personne $personne)
    {
        $sql="UPDATE {$this->table} SET nom=?,prenom=?,sexe=?,dateNaissance=?,lieuNaissance=?,cin=?,lieuCin=?,dateCin=?,profession=?,pere=?,mere=?,vie=?,updatAt=? WHERE id=?";



        $requete=$this->bdd->getPdo()->prepare($sql);
        if($requete->execute([
            $personne->getNom(),
            $personne->getPrenom(),
            $personne->getSexe(),

            $personne->getDateNaissance(),
            $personne->getLieuNaissance(),

            $personne->getCin(),
            $personne->getLieuCin(),
            $personne->getDateCin(),

            $personne->getProfession(),

            $personne->getPere(),
            $personne->getMere(),
          
            $personne->getVie(),
            $personne->getUpdatAt(),

            $personne->getId()

        ])===true){
            return true;
        }else
        {
            return false;
        }

    }
    
}