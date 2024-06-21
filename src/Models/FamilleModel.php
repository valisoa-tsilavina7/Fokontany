<?php
namespace App\Models;

use App\Entity\Famille;
use App\Entity\Personne;
use PDO;

class FamilleModel extends Models{
    protected string $table="famille";
    protected string $nameSpaceTable="App\Entity\Famille";



    //POUR CREER UNE FAMILLE
    public function creerFamille(Famille $famille):bool
    {
        $sql="INSERT INTO {$this->table}(adresse,caractere,creatAt,updatAt,secteur_id)
         VALUES(?,?,?,?,?)";

        $requete=$this->bdd->getPdo()->prepare($sql);

        if($requete->execute([
            $famille->getAdresse(),
            $famille->getCaractere(),
            $famille->getCreatAt(),
            $famille->getUpdatAt(),
            $famille->getSecteur_id()
        ])===true){
            return true;
        }else
        {
            return false;
        }
    }


    //POUR MODIFIER UNE FAMILLE
    public function modifierFamille(Famille $famille)
    {

        $sql="UPDATE {$this->table} SET adresse=?,caractere=?,creatAt=?, updatAt=?, secteur_id=? WHERE id=?";

       $requete=$this->bdd->getPdo()->prepare($sql);


       if($requete->execute([
        $famille->getAdresse(),
        $famille->getCaractere(),
        $famille->getCreatAt(),
        $famille->getUpdatAt(),
        $famille->getSecteur_id(),
        $famille->getId()])==true)
        {
            return true;
        }else
        {
            return false;
        }
       
    }


    //POUR MODIFIER UNE FAMILLE
    public function modifierParentFamille(Famille $famille,string $parent)
    {

        $sql="UPDATE {$this->table} SET updatAt=? ,{$parent}_id=? WHERE id=?";

       $requete=$this->bdd->getPdo()->prepare($sql);

       $parent="get".(ucfirst($parent))."_id";

       if($requete->execute([
        $famille->getUpdatAt(),
        $famille->$parent(),
        $famille->getId()])==true)
        {
            return true;
        }else
        {
            return false;
        }
       
    }


    //POUR TROUVER UNE FAMILLE APARTIR DE L ID DU SECTEUR
    public function findBySecteur(int $id)
    {
        $sql="SELECT * FROM {$this->table} WHERE secteur_id=?";

        $requete=$this->bdd->getPdo()->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->nameSpaceTable);

        $requete->execute([$id]);

        return $requete->fetch();
    }

}