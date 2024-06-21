<?php
namespace App\Entity\Dossier;

class Residence
{


    //LES DATAS
    private ?int $id=null;

    private ?string $nom=null;
    private ?string $prenom=null;

    private ?string $dateNaissance=null;
    private ?string $lieuNaissance=null;

    private ?string $cin=null;
    private ?string $lieuCin=null;
    private ?string $dateCin=null;


    private ?string $profession=null;

    private ?string $pere=null;
    private ?string $mere=null;


    private ?string $creatAt=null;
    private ?string $updatAt=null;

    //AUTRE
    private ?string $nationalite=null;
    private ?string $motif=null;
    private ?int $personne_id=null;

    private ?string $passeport=null;
    private ?string $datePasseport=null;
    private ?string $dateValidePasseport=null;



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







    public function setNationalite(string $nationalite):void
    {
        if(!empty($nationalite) and is_string($nationalite) and !is_numeric($nationalite))
        {
            $this->nationalite=$nationalite;
        }else
        {
            $this->error[]="tsy mety ny zom-pirenena";
            
        }
    }

    public function getNationalite():string
    {
        return $this->nationalite;
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



    //DATE PASSEPORT
    
    public function setPasseport(string $passeport):void
    {
        $this->passeport=$passeport;
       
    }

    public function getPasseport():string
    {
        return $this->passeport;
    }

    
    public function setdatePasseport(string $datePasseport):void
    {
       $this->datePasseport=$datePasseport;
    }
    public function getDatePasseport():string
    {
        return $this->datePasseport;
    }


    //DATE VALIDE PASSEPORRT
    public function setdateValidePasseport(string $dateValidePasseport):void
    {
       $this->dateValidePasseport=$dateValidePasseport;
    }

    public function getdateValidePasseport():string
    {
        return $this->dateValidePasseport;
    }

    public function setNom(string $nom):void
    {
        if(!empty($nom) and is_string($nom) and !is_numeric($nom))
        {
            $this->nom=$nom;
        }else
        {
            $this->error[]="tsy mety ny anarana";
            
        }
    }

    public function getNom():string
    {
        return $this->nom;
    }


    public function setPrenom(string $prenom):void
    {
        if(is_numeric($prenom))
        {
            $this->error[]="tsy mety ny fanampin anarana";
        }else
        {
            $this->prenom=$prenom;
        }
    }

    public function getPrenom():?string
    {
        return $this->prenom;
    }




    public function setDateNaissance(string $dateNaissance):void
    {
        if(!empty($dateNaissance) and is_string($dateNaissance))
        {
            $this->dateNaissance=$dateNaissance;
        }else
        {
            $this->error[]="tsy mety ny taona nahaterahana";
        }
    }

    public function getDateNaissance():string
    {
        return $this->dateNaissance;
    }


    public function setLieuNaissance(string $lieuNaissance):void
    {
        if(!empty($lieuNaissance) and is_string($lieuNaissance) and !is_numeric($lieuNaissance))
        {
            $this->lieuNaissance=$lieuNaissance;
        }else
        {
            $this->error[]="tsy mety ny toerana nahaterahana";
        }
    }

    public function getLieuNaissance():string
    {
        return $this->lieuNaissance;
    }


    public function setCin(string $cin):void
    {
        $this->cin=$cin;
    }

    public function getCin():?string
    {
        return $this->cin;
    }


    public function setLieuCin(string $lieuCin):void
    {
        $this->lieuCin=$lieuCin;
    }

    public function getLieuCin():?string
    {
        return $this->lieuCin;
    }

    public function setDateCin(string $dateCin):void
    {
       
        $this->dateCin=$dateCin;

    }

    public function getDateCin():?string
    {
        return $this->dateCin;
    }



    public function setProfession(string $profession):void
    {
        if(!empty($profession) and is_string($profession) and !is_numeric($profession))
        {
            $this->profession=$profession;
        }else
        {
            $this->error[]="tsy mety ny asa";
        }
    }

    public function getProfession():string
    {
        return $this->profession;
    }



    public function setPere(string $pere):void
    {
        if(!empty($pere) and is_string($pere) and !is_numeric($pere))
        {
            $this->pere=$pere;
        }else
        {
            $this->error[]="tsy mety ny anaranan ny Ray";
        }
    }

    public function getPere():string
    {
        return $this->pere;
    }


    public function setMere(string $mere):void
    {
        if(!empty($mere) and is_string($mere) and !is_numeric($mere))
        {
            $this->mere=$mere;
        }else
        {
            $this->error[]="tsy mety ny anaran ny Reny";
        }
    }

    public function getmere():string
    {
        return $this->mere;
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