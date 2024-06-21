<?php
namespace App\Models\Dossier;

use App\Entity\Dossier\Residence;
use App\Models\Models;

class ResidenceModel extends Models
{

    protected string $table="residence";
    protected string $nameSpaceTable="App\Entity\Dossier\Residence";




    //CREER UN RESIDENCE
    public function creerResidence(Residence $residence)
    {
        
        $sql="INSERT INTO {$this->table}(nom,prenom,dateNaissance,lieuNaissance,cin,lieuCin,dateCin,passeport,datePasseport,dateValidePasseport,profession,pere,mere,nationalite,motif,personne_id,creatAt,updatAt)
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
        ";

        $requete=$this->bdd->getPdo()->prepare($sql);

        if($requete->execute([
            $residence->getNom(),
            $residence->getPrenom(),
            $residence->getDateNaissance(),
            $residence->getLieuNaissance(),

            $residence->getCin(),
            $residence->getLieuCin(),
            $residence->getDateCin(),

            $residence->getPasseport(),
            $residence->getDatePasseport(),
            $residence->getDateValidePasseport(),

            $residence->getProfession(),
            $residence->getPere(),
            $residence->getMere(),

            $residence->getNationalite(),
            $residence->getMotif(),
            $residence->getPersonne_id(),

            $residence->getCreatAt(),
            $residence->getUpdatAt()

        ])===true)
        {
            return true;
        }else
        {
            return false;
        }
    }


    //MODIFIER UN RESIDENCE
    public function ModifierResidence(Residence $residence)
    {
        
        $sql="UPDATE {$this->table} SET passeport=?,datePasseport=?,dateValidePasseport=?,nationalite=?,motif=?,updatAt=? WHERE id=?";

        $requete=$this->bdd->getPdo()->prepare($sql);

        if($requete->execute([
            $residence->getPasseport(),
            $residence->getDatePasseport(),
            $residence->getDateValidePasseport(),

            $residence->getNationalite(),
            $residence->getMotif(),
            $residence->getUpdatAt(),
            $residence->getId()

        ])===true)
        {
            return true;
        }else
        {
            return false;
        }
    }

}