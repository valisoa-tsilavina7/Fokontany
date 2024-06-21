<?php
namespace App\Models;

use App\Entity\Secteur;
use PDO;

class SecteurModel extends Models{
    protected string $table="secteur";
    protected string $nameSpaceTable="App\Entity\Secteur";




    //VOIR SI LE NOM EXISTE DEJA
    public function findByName(string $name)
    {
        $sql="SELECT * FROM {$this->table} WHERE nom=?";
        $requete=$this->bdd->getPdo()->prepare($sql);
        $requete->execute(array($name));
        return $requete->fetch();

    }


    //POUR CREER UN SECTEUR
    public function creerSecteur(Secteur $secteur)
    {
        $sql="INSERT INTO {$this->table}(nom,creatAt,updatAt,fokontany_id) VALUES(?,?,?,?)";

        $requete=$this->bdd->getPdo()->prepare($sql);
        if($requete->execute([
            $secteur->getNom(),
            $secteur->getCreatAt(),
            $secteur->getUpdatAt(),
            $secteur->getFokontany_id()
            ])==true){
            return true;
        }else{
            return false;
        }
    }



    //POUR MODIFIER UN SECTEUR 
    public function editSecteur(Secteur $secteur)
    {

        $sql="UPDATE {$this->table} SET nom=?,creatAt=?, updatAt=?, fokontany_id=? WHERE id=?";

       $requete=$this->bdd->getPdo()->prepare($sql);


       $requete->execute([
        $secteur->getNom(),
        $secteur->getCreatAt(),
        $secteur->getUpdatAt(),
        $secteur->getFokontany_id(),
        $secteur->getId()]);
    }



    



    //VOIR UN Fokontany
    public function voirFokontany(int $id)
    {
        $sql="SELECT * FROM
         {$this->table}
        INNER JOIN fokontany ON {$this->table}.fokontany_id=fokontany.id WHERE id=?";

       $requete=$this->bdd->getPdo()->prepare($sql);
       $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,"App\Entity\Fokontany");

       $requete->execute(array($id));
       return $requete->fetch();

   

      

        
    }


    //VOIR UN SECTEUR ET FAMILLE
    public function voirSecteur()
    {
        $sql="SELECT * FROM
         {$this->table} 
        INNER JOIN famille ON {$this->table}.id=famille.secteur_id WHERE id=?";

       $requete=$this->bdd->getPdo()->prepare($sql);
    //    $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,"App\Entity\Famille");

       $requete->execute(array(2));
       return $requete->fetch();



        
    }


}