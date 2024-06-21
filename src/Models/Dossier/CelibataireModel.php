<?php
namespace App\Models\Dossier;

use App\Entity\Dossier\Celibataire;
use App\Entity\Dossier\Temoin;
use App\Models\Models;

class CelibataireModel extends Models
{

    protected string $table="celibataire";
    protected string $nameSpaceTable="App\Entity\Dossier\Celibataire";



    //CREER UN TEMOIN
    public function creerCelibataire(Celibataire $celibataire)
    {
        $sql="INSERT INTO {$this->table}(motif,temoin1_id,temoin2_id,personne_id,creatAt,updatAt) VALUES(?,?,?,?,?,?)";

        $requete=$this->bdd->getPdo()->prepare($sql);

        if($requete->execute([
            $celibataire->getMotif(),
            $celibataire->getTemoin1_id(),
            $celibataire->getTemoin2_id(),
            $celibataire->getPersonne_id(),
            $celibataire->getCreatAt(),
            $celibataire->getUpdatAt(),

        ])===true){
            return true;
        }else
        {
            return false;
        }

    }


    //MODIFIER UN CELIBATAIRE LE MOTIF
    public function modifierMotifCelibataire(Celibataire $celibataire)
    {
        $sql="UPDATE {$this->table} SET motif=?,updatAt=? WHERE id=?";

        $requete=$this->bdd->getPdo()->prepare($sql);

        if($requete->execute([
            $celibataire->getMotif(),
            $celibataire->getUpdatAt(),
            $celibataire->getId()

        ])===true){
            return true;
        }else
        {
            return false;
        }

    }

    //MODIFIER UN TEMOIN
    public function modifierParentCelibataire(Celibataire $celibataire,string $parent)
    {
        if($parent=="temoin1")
        {
            $sql="UPDATE  {$this->table} SET temoin1_id=?,updatAt=?  WHERE id=?";

            $requete=$this->bdd->getPdo()->prepare($sql);

            if($requete->execute([
                 $celibataire->getTemoin1_id(),
                 $celibataire->getUpdatAt(),
                 $celibataire->getId(),

            ])===true){
                return true;
            }else
            {
             return false;
            }

        }else
        {
            $sql="UPDATE  {$this->table} SET temoin2_id=?,updatAt=? WHERE id=?";

            $requete=$this->bdd->getPdo()->prepare($sql);

            if($requete->execute([
                 $celibataire->getTemoin2_id(),
                 $celibataire->getUpdatAt(),
                 $celibataire->getId(),

            ])===true){
                return true;
            }else
            {
             return false;
            }
            
        }
    }
    

}