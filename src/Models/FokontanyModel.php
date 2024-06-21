<?php
namespace App\Models;

use App\Entity\Fokontany;
use PDO;

class FokontanyModel extends Models
{
    protected string $table="fokontany";
    protected string $nameSpaceTable="App\Entity\Fokontany";


    
    public function creerFokontany(Fokontany $fokontany):bool
    {

       
        $sql="INSERT INTO {$this->table}(nom,district,commune,password,creatAt,updatAt) VALUES(?,?,?,?,?,?)";

        $requete=$this->bdd->getPdo()->prepare($sql);
        if($requete->execute([$fokontany->getNom(),
                              $fokontany->getDistrict(),
                              $fokontany->getCommune(),
                              $fokontany->getPassword(),
                              $fokontany->getCreatAt(),
                              $fokontany->getUpdatAt()
        ])==true){
            return true;
        }else{
            return false;
        }
    }
    public function editProfilFokontany(Fokontany $fokontany)
    {

        $sql="UPDATE {$this->table} SET nom=?, district=?, commune=?,password=?,creatAt=?, updatAt=? WHERE id=?";

       $requete=$this->bdd->getPdo()->prepare($sql);


       $requete->execute([
        $fokontany->getNom(),
        $fokontany->getDistrict(),
        $fokontany->getCommune(),
        $fokontany->getPassword(),
        $fokontany->getCreatAt(),
        $fokontany->getUpdatAt(),
        $fokontany->getId()]);
    }
    public function connexion(string $password)
    {
        $sql="SELECT * FROM {$this->table} WHERE mot_de_passe= ?";

        $requete=$this->bdd->getPdo()->prepare($sql);

        $requete->execute(array($password));

       return $req=$requete->fetch();
    }
}