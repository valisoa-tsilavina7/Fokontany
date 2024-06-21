<?php
namespace App\Entity;

class Secteur
{

    private ?int $id=null;

    private ?string $nom=null;

    private ?string $creatAt=null;
    private ?string $updatAt=null;

    private ?int $fokontany_id=null;

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



    public function setNom(string $nom):void
    {
        if(is_string($nom) && !empty($nom) )
        {
            $this->nom=$nom;
        }else
        {
          $this->error[]="tsy mety ny anarana ";
        }
    }

    public function getNom():string
    {
        return $this->nom;
    }

    public function setFokontany_id(string $fokontany_id):void
    {
        if(is_string($fokontany_id) && !empty($fokontany_id) )
        {
            $this->fokontany_id=$fokontany_id;
        }
    }

    public function getFokontany_id():?int
    {
        return $this->fokontany_id;
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