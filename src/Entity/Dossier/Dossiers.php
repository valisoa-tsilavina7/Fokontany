<?php
namespace App\Entity\Dossier;




class Dossiers
{

    //les propriete
    private ?int $id=null;

    private ?string $nom=null;
    private ?int $certificat_id=null;
    private ?int $personne_id=null;



    public function getId():?int
    {
        return $this->id;
    }



    public function setNom(string $nom):void
    {
        $this->nom=$nom;
    }

    public function getNom():string
    {
        return $this->nom;
    }


    public function setCertificat_id(int $certificat_id):void
    {
        $this->certificat_id=$certificat_id;
    }

    public function getCertificat_id():int
    {
        return $this->certificat_id;
    }




    public function setPersonne_id(int $personne_id):void
    {
        $this->personne_id=$personne_id;
    }

    public function getPersonne_id():int
    {
        return $this->personne_id;
    }

}