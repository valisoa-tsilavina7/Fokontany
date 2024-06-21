<?php
namespace App\Entity;




class Fokontany 
{

    //les propriete
    private ?int $id=null;

    private ?string $nom=null;
    private ?string $password=null;
    private ?string $creatAt=null;
    private ?string $updatAt=null;

    private ?string $district=null;
    private ?string $commune=null;

    




    //propriete d erreur
    private array $error=[];


    //constructeur




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


    public function setPassword(string $password):void
    {
        if(is_string($password) && !empty($password) )
        {
            $this->password=$password;
        }else
        {
            $this->error[]="tsy mety ny teny miafina";
        }
    }

    public function getPassword():string
    {
        return $this->password;
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



    public function setDistrict(string $district):void
    {
        if(is_string($district) && !empty($district) )
        {
            $this->district=$district;
        }else
        {
            $this->error[]="tsy mety ny anaran ny distrika";
        }
    }
    public function getDistrict():?string
    {
       
        return $this->district;
        
    }

    public function setCommune(string $commune):void
    {
        if(is_string($commune) && !empty($commune) )
        {
            $this->commune=$commune;
        }else
        {
            $this->error[]="tsy mety ny anaran ny coummune";
        }
    }
    public function getCommune():?string
    {
       
        return $this->commune;
        
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