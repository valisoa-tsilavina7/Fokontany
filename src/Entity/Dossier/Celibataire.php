<?php
namespace App\Entity\Dossier;

class Celibataire
{
    private ?int $id=null;

    private ?string $motif=null;


    private ?int $temoin1_id=null;
    private ?int $temoin2_id=null;

    private ?int $personne_id=null;

    private ?string $creatAt=null;
    private ?string $updatAt=null;

    

    private ?array $error=null;

    

    public function __construct()
    {
        $this->creatAt= date('d/M/Y').' le '.date("H:i:s");
        $this->updatAt= date('d/M/Y').' le '.date("H:i:s");
    }


    public function getId():?int
    {
        return $this->id;
    }


   



    public function setMotif(string $motif):void
    {
        if(!empty($motif) and is_string($motif) and !is_numeric($motif))
        {
            $this->motif=$motif;
        }else
        {
            $this->error[]="tsy mety ny antony";
            
        }
    }

    public function getMotif():string
    {
        return $this->motif;
    }



    public function setPersonne_id(int $personne_id):void
    {
        $this->personne_id=$personne_id;
    }

    public function getPersonne_id():int
    {
        return $this->personne_id;
    }



    
    public function setTemoin1_id(int $temoin1_id):void
    {
        $this->temoin1_id=$temoin1_id;
    }

    public function getTemoin1_id():?int
    {
        return $this->temoin1_id;
    }


    public function setTemoin2_id(int $temoin2_id):void
    {
        $this->temoin2_id=$temoin2_id;
    }

    public function getTemoin2_id():?int
    {
        return $this->temoin2_id;
    }




    public function setCreatAt(string $creatAt):void
    {
        $this->creatAt=$creatAt;
    }

    public function getCreatAt():?string
    {
        return $this->creatAt;
    }

    public function setUpdatAt(string $updatAt):void
    {
        $this->updatAt=$updatAt;
    }

    public function getUpdatAt():?string
    {
        return $this->updatAt;
    }

    public function getError()
    {
        return $this->error;
    }

    
    public function isValid()
    {
        if(isset($this->error) and !empty($this->error))
        {
            return false;
        }else
        {
            return true;
        }
    }


}