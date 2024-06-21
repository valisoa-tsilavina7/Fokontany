<?php
namespace App\Models\Dossier;

use App\Entity\Dossier\Dossiers;
use App\Models\Models;

class DossiersModel extends Models
{

    protected string $table="dossiers";
    protected string $nameSpaceTable="App\Entity\Dossier\Dossiers";



    public function creerDossier(Dossiers $dossiers)
    {
        $sql="INSERT INTO {$this->table}(nom,certificat_id,personne_id) VALUES(?,?,?)";

        $requete=$this->bdd->getPdo()->prepare($sql);

        if($requete->execute(array(
            $dossiers->getNom(),
            $dossiers->getCertificat_id(),
            $dossiers->getPersonne_id()
        ))===true)
        {
            return true;
        }else
        {
            return false;
        }
    }

}