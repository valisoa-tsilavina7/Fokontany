<?php
namespace App\Entity;

class Famille
{

    private ?int $id=null;

    private ?string $adresse=null;
    private ?string $caractere=null;

    private ?string $creatAt=null;
    private ?string $updatAt=null;

    private ?int $secteur_id=null;

    private ?array $error=null;

    private ?int $mere_id=null;
    private ?int $pere_id=null;



    


    public function __construct()
    {
        $this->creatAt= date('d/M/Y').' le '.date("H:i:s");
        $this->updatAt= date('d/M/Y').' le '.date("H:i:s");
    }


    public function getId():?int
    {
        return $this->id;
    }



    public function setAdresse(string $adresse):void
    {
        if(is_string($adresse) && !empty($adresse) )
        {
            $this->adresse=$adresse;
        }else
        {
          $this->error[]="tsy mety ny adiresy";
        }
    }

    public function getAdresse():string
    {
        return $this->adresse;
    }



    public function setCaractere(string $caractere):void
    {
        if(is_string($caractere) && !empty($caractere) )
        {
            $this->caractere=$caractere;
        }else
        {
          $this->error[]="tsy mety ny adiresy";
        }
    }

    public function getCaractere():string
    {
        return $this->caractere;
    }

    public function setSecteur_id(string $secteur_id):void
    {
        if(is_string($secteur_id) && !empty($secteur_id) )
        {
            $this->secteur_id=$secteur_id;
        }
    }

    public function getSecteur_id():?int
    {
        return $this->secteur_id;
    }

    public function setMere_id(int $mere_id):void
    {
        $this->mere_id=$mere_id;
    }

    public function getMere_id():?int
    {
        return $this->mere_id;
    }

    public function setPere_id(int $pere_id):void
    {
        $this->pere_id=$pere_id;
    }

    public function getPere_id():?int
    {
        return $this->pere_id;
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