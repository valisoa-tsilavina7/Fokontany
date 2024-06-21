<?php

namespace App\Models;

use Database\DBconnexion;
use PDO;

abstract class Models
{

    protected DBconnexion $bdd;
    protected string $table;
    protected string $nameSpaceTable;
   

    public function __construct(DBconnexion $bdd)
    {
        $this->bdd=$bdd;
        
    }


    //LES TABLES EN SQL 
    public function sqlTable():bool
    {
        $lesSqls=[];

        //LA TABLE FOKONTANY
        $lesSqls[]= "CREATE TABLE IF NOT EXISTS fokontany(
            id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            nom VARCHAR(100) NOT NULL,
            district VARCHAR(100) NOT NULL,
            commune VARCHAR(100) NOT NULL,
            password VARCHAR(200) NOT NULL,
            creatAt VARCHAR(200) NOT NULL,
            updatAt VARCHAR(200) NOT NULL)";
        
    
        //LA TABLE SECTEUR
        $lesSqls[]="CREATE TABLE IF NOT EXISTS secteur(
            id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            nom VARCHAR(100) NOT NULL,
            creatAt VARCHAR(200) NOT NULL,
            updatAt VARCHAR(200) NOT NULL,
            fokontany_id INT NOT NULL,
            FOREIGN KEY (fokontany_id) REFERENCES Fokontany(id)
            )";

        //TABLE FAMILLE
        $lesSqls[]="CREATE TABLE IF NOT EXISTS famille(
            id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            adresse VARCHAR(300) NOT NULL,
            caractere  VARCHAR(100) NOT NULL,
            creatAt VARCHAR(200) NOT NULL,
            updatAt VARCHAR(200) NOT NULL,
            secteur_id INT NOT NULL,
            mere_id INT DEFAULT 0,
            pere_id INT DEFAULT 0,
            FOREIGN KEY (mere_id) REFERENCES Personne(id),
            FOREIGN KEY (pere_id) REFERENCES Personne(id),
            FOREIGN KEY (secteur_id) REFERENCES Secteur(id)

            )";



        //TABLE PERSONNES
        $lesSqls[]="CREATE TABLE IF NOT EXISTS personne(
            id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            nom VARCHAR(100) NOT NULL,
            prenom VARCHAR(100),
            sexe VARCHAR(10) NOT NULL,
            dateNaissance VARCHAR(100) NOT NULL,
            lieuNaissance VARCHAR(200) NOT NULL,
            cin VARCHAR(12) ,
            lieuCin VARCHAR(100),
            dateCin VARCHAR(100),
            profession VARCHAR(100) NOT NULL,
            pere VARCHAR(250) NOT NULL,
            mere VARCHAR(250) NOT NULL,
            roleFamille VARCHAR(50) NOT NULL,
            vie BOOLEAN DEFAULT 1,
            creatAt VARCHAR(200) NOT NULL,
            updatAt VARCHAR(200) NOT NULL,
            famille_id INT NOT NULL,
            FOREIGN KEY (famille_id) REFERENCES Famille(id)
        )";


        //TABLE DOSSIER
        $lesSqls[]="CREATE TABLE IF NOT EXISTS dossiers(
            id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            nom VARCHAR(100) NOT NULL,
            certificat_id INT NOT NULL,
            personne_id INT NOT NULL ,
            FOREIGN KEY (certificat_id) REFERENCES Certificat(id),
            FOREIGN KEY (personne_id) REFERENCES Personne(id)
        )";



        //LA TABLE RESIDENCE
        $lesSqls[]="CREATE TABLE IF NOT EXISTS residence(
                id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                nom VARCHAR(100) NOT NULL,
                prenom VARCHAR(100),
                dateNaissance VARCHAR(100) NOT NULL,
                lieuNaissance VARCHAR(200) NOT NULL,
                cin VARCHAR(12) ,
                lieuCin VARCHAR(100),
                dateCin VARCHAR(100),

                passeport VARCHAR(200),
                datePasseport VARCHAR(100),
                dateValidePasseport VARCHAR(100),

                profession VARCHAR(100) NOT NULL,
                pere VARCHAR(250) NOT NULL,
                mere VARCHAR(250) NOT NULL,

               

                nationalite VARCHAR(20) NOT NULL,
                motif VARCHAR(250) NOT NULL,

                personne_id INT NOT NULL,
                creatAt VARCHAR(200) NOT NULL,
                updatAt VARCHAR(200) NOT NULL,

                FOREIGN KEY (personne_id) REFERENCES Personne(id)
        )";


        //TABLE CELIBATAIRE
        $lesSqls[]="CREATE TABLE IF NOT EXISTS celibataire(
            id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            motif VARCHAR(200) NOT NULL,
            temoin1_id INT DEFAULT 0 ,
            temoin2_id INT DEFAULT 0,
            personne_id INT NOT NULL,
            creatAt VARCHAR(200) NOT NULL,
            updatAt VARCHAR(200) NOT NULL,
            FOREIGN KEY (personne_id) REFERENCES Personne(id),
            FOREIGN KEY (temoin1_id) REFERENCES Temoin(id),
            FOREIGN KEY (temoin2_id) REFERENCES Temoin(id)
        )";



        //TABLE TEMOIN
        $lesSqls[]="CREATE TABLE IF NOT EXISTS temoin(
            id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            nom VARCHAR(100) NOT NULL,
            prenom VARCHAR(100),
            sexe VARCHAR(10) NOT NULL,

            dateNaissance VARCHAR(100) NOT NULL,
            lieuNaissance VARCHAR(200) NOT NULL,
            cin VARCHAR(12) ,
            lieuCin VARCHAR(100),
            dateCin VARCHAR(100),

            
            pere VARCHAR(250) NOT NULL,
            mere VARCHAR(250) NOT NULL,

            profession VARCHAR(250) NOT NULL,
            adresse VARCHAR(250) NOT NULL,

            dossier_id INT NOT NULL,
            creatAt VARCHAR(200) NOT NULL,
            updatAt VARCHAR(200) NOT NULL,
            FOREIGN KEY (dossier_id) REFERENCES Dossiers(id)

        )";
        
        $errers=[];
        foreach($lesSqls as $sql)
        {
            if($this->bdd->getPdo()->query($sql)==true){
                $errers[]=1;
            }else
            {
                $errers[]=0;
            }
        }

        if(in_array(0,$errers))
        {
            return false;
        }else{
            return true;
        }

        
    }


    // POUR TOUT VOIR
    public function all()
    {
        if($this->sqlTable()){
            
            $sql= "SELECT * FROM {$this->table}";

            $requete=$this->bdd->getPdo()->query($sql);
            $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->nameSpaceTable);


            return $requete->fetchAll();

        }else
        {
            return false;
        }
    }


    //VOIR A PARTIR DE L ID
    public function findById(int $id)
    {
        if($this->sqlTable()){
            
            $sql= "SELECT * FROM {$this->table} WHERE id=?";
            
            $requete=$this->bdd->getPdo()->prepare($sql);
            $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->nameSpaceTable);

            $requete->execute(array($id));

            return $requete->fetch();

           
        }else
        {
            return false;
        }
    }


    //VOIR A PARTIR D UN NOM
    public function findByAdresse(string $nom)
    {
        if($this->sqlTable()){
            
            $sql= "SELECT * FROM {$this->table} WHERE adresse=?";
            
            $requete=$this->bdd->getPdo()->prepare($sql);
            $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->nameSpaceTable);

            $requete->execute(array($nom));

            return $requete->fetch();

           
        }else
        {
            return false;
        }
    }


    //POUR SUPPRIMER 
    public function supprimer(int $id)
    {
        $stat=$this->bdd->getPdo()->prepare("DELETE FROM {$this->table} WHERE id=?");
        return $stat->execute(array($id));
    }


    //POUR RECHERCHER UN COLOUM SPECIFIQUE DANS UN TABLE SPECIFIQUE
    public function findByColumn(string $column,string $valeur)
    {
        if($this->sqlTable()){
            
            $sql= "SELECT * FROM {$this->table} WHERE {$column}=?";
            
            $requete=$this->bdd->getPdo()->prepare($sql);
            $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->nameSpaceTable);

            $requete->execute(array($valeur));

            return $requete->fetchAll();

           
        }else
        {
            return false;
        }
    }
    

}