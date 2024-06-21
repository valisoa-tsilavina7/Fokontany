<?php
namespace App\Controllers;

use App\Entity\Famille;
use App\Entity\Personne;
use App\Entity\Secteur;
use App\Models\FamilleModel;
use App\Models\FokontanyModel;
use App\Models\PersonneModel;
use App\Models\SecteurModel;

class FamilleController extends Controller
{


    //POUR AFFICHER TOUTE LES FAMILLES
    public function index()
    {


        $nbPersonne=0;
        $nbDossiers=0;
        $nbSecteurs=0;
        $nbFamille=0;

        $personnes=null;
        $familles=null;
        $secteurs=null;
        $dossiers=null;

        if(!( new FamilleModel($this->bdd))->all())
        {
            return header('Location: /');
        }

       
       

       
        if(( new SecteurModel($this->bdd))->all())
        {
            $secteurs=( new SecteurModel($this->bdd))->all();
            $nbSecteurs=count(( new SecteurModel($this->bdd))->all());
        }


       
        if(( new FamilleModel($this->bdd))->all())
        {
            $familles=( new FamilleModel($this->bdd))->all();
            $nbFamille=count(( new FamilleModel($this->bdd))->all());
        }
       
        if(( new PersonneModel($this->bdd))->all())
        {
            $personnes=( new PersonneModel($this->bdd))->all();
            $nbPersonne=count(( new PersonneModel($this->bdd))->all());
        }



        //L OBEJCTIT C EST DE PRRENDRE TOUT LES SECTEURS AVEC 2 familles

        $this->isAdmin();
       

        return $this->render('famille.index',
           [
            
            'personnes'=>$personnes,
            'familles' =>$familles,
            'secteurs' =>$secteurs,
            'dossiers' =>$dossiers
           ]);
    }

    //POUR CREER UNE FAMILLE
    public function creerFamille(int $id)
    {
        $this->isAdmin();
        $error=[];
        
        //VERIFICATION SI LE SECTEUR TAPER SUR L URL N EXISTE PAS
        if((new SecteurModel($this->bdd))->findById($id)){


            if(isset($_POST['valider'])){
               

              //recuperation des datas par l objet
              $famille=new Famille();

              $famille->setAdresse($_POST['adresse']);
              $famille->setCaractere($_POST['caractere']);
              $famille->setSecteur_id($id);



              if($famille->isValid())
              {

               //seul les adresse qui ont tompon_trano et mpanofa ont la possibilite de se repeter
                if((new FamilleModel($this->bdd))->findByAdresse($famille->getAdresse())===false or
                (new FamilleModel($this->bdd))->findByAdresse($famille->getAdresse())->getCaractere()!=="mahaleo_tena")
                {

                    if((new FamilleModel($this->bdd))->creerFamille($famille)){

                        return header('Location: /secteur/'.$id);

                    }else{
                        $error[]="misy olona ara teknika azafady";
                    }
                }else
                {
                    $error[]="efa misy mapiasa ny adresse nampidirinao";
                }
                

              }else{
                foreach($famille->getError() as $erreur)
                {
                    $error[]=$erreur;
                }
              }


            }

        }else{
            
           //rediriger vers la racine si le secteur id n existe pas
            return header('Location:/');
        }

        
        return $this->render('famille.creer',
         [
           'error'=>$error
         ]);
    }

    //POUR MODIFIER UNE FAMILLE
    public function modifierFamille(int $id)
    {
    

        $this->isAdmin();
        $famille=null;
        $secteur=null;
        $secteurs=null;
        $error=[];
        if((new FamilleModel($this->bdd))->findById($id))
        {

            //recuperer les datas
            $famille=(new FamilleModel($this->bdd))->findById($id);
            $secteur=((new SecteurModel($this->bdd))->findById($famille->getSecteur_id()));
            $secteurs=(new SecteurModel($this->bdd))->all();


            //Recuperation

            if(isset($_POST['valider']))
            {
                //recuperer les anciens
                $ancienAdresse=$famille->getAdresse();
                $ancienCaractere=$famille->getCaractere();
                $ancienSecteur=$famille->getSecteur_id();




                $famille->setAdresse($_POST['adresse']);
                $famille->setUpdatAt(date('D/M/Y').' le '.date("H:i:s"));
               
                $famille->setCaractere($_POST['caractere']);


                if($famille->isValid())
                {
                    //SI L ADRESSE NE CHANGE PAS DONC PAS DE MODIFICATION 

                    if($ancienAdresse==$famille->getAdresse() and $ancienCaractere==$famille->getCaractere() and $ancienSecteur==$famille->getSecteur_id())
                    {
                        return header('Location: /famille');


                    }else{

                        //chose Nouveau

                        if((new FamilleModel($this->bdd))->findByAdresse($famille->getAdresse())===false or
                              (new FamilleModel($this->bdd))->findByAdresse($famille->getAdresse())->getCaractere()!=="mahaleo_tena")
                        {


                            if((new FamilleModel($this->bdd))->modifierFamille($famille)){

                                return header('Location: /famille');
        
                            }else{
                                $error[]="misy olona ara teknika azafady";
                            }

                        }else
                        {
                            $error[]="efa misy mapiasa ny adresse nampidirinao";
                        }


                    }

                }else
                {
                    foreach($famille->getError() as $erreur)
                {
                    $error[]=$erreur;
                }
                }



            }

            
        }else
        {
            return header('Location: /famille');
        }

       
        return $this->render('famille.modifier',
          [
            'famille'=>$famille,
            'secteur'=>$secteur,
            'secteurs'=>$secteurs,
            'error'=>$error
          ]);
    }


    //POUR SUPPRIMER UNE FAMILLE
    public function supprimerFamille(int $id)
    {

        $this->isAdmin();
        if((new FamilleModel($this->bdd))->findById($id)){

            $famille=(new FamilleModel($this->bdd))->findById($id);


            //je chercher les personnes dans cette famille

            $personnes=(new PersonneModel($this->bdd))->all();
            foreach($personnes as $personne)
            {
                    if($personne->getFamille_id()===$famille->getId())
                    {
                        $suppimer= new PersonneModel($this->bdd);
                        $suppimer->supprimer($personne->getId());

                            
                    }
            }

            if((new FamilleModel($this->bdd))->supprimer($id))
            {
                return header('Location: /famille');
            }
            
        }

    }



    //VOIR UNE FAMILLE
    public function voirFamille(int $id)
    {
        $this->isAdmin();
        $famille=null;
        $secteur=null;
        $secteurs=null;
        $pereExiste=false;
        $mereExiste=false;
        $pere=null;
        $mere=null;

        $infoPere=[];
        $infoMere=[];
        $autreMembre=[];

        $nbPersonne=0;
        $nbHomme=0;
        $nbFemme=0;
        if((new FamilleModel($this->bdd))->findById($id))
        {

            //recuperer les datas
            $famille=(new FamilleModel($this->bdd))->findById($id);
            $secteur=((new SecteurModel($this->bdd))->findById($famille->getSecteur_id()));

           
            if((new FamilleModel($this->bdd))->findById($id)->getPere_id()===0){
                $pereExiste=true;
            }else{
                $pereExiste=false;
            }


            if((new FamilleModel($this->bdd))->findById($id)->getMere_id()===0){
                $mereExiste=true;
            }else{
                $mereExiste=false;
            }


            //affiche Pere Et mere si il existe

            if($famille->getPere_id()!=0)
            {
                //il existe et je cherche le id dans la table personne pur trouver ses info

                $pere=((new PersonneModel($this->bdd))->findById($famille->getPere_id()));

                $infoPere["nom"]=$pere->getNom();
                $infoPere["prenom"]=$pere->getPrenom();
            }


            if($famille->getMere_id()!=0)
            {
                //il existe et je cherche le id dans la table personne pur trouver ses info

                $mere=((new PersonneModel($this->bdd))->findById($famille->getMere_id()));

                $infoMere["nom"]=$mere->getNom();
                $infoMere["prenom"]=$mere->getPrenom();
            }


            //recuperer les membres qui sont different de pere et mere
            $enfants=(new PersonneModel($this->bdd))->findByColumn("famille_id",$id);

            //on va le stocker dans un autre tableaux
           
            foreach($enfants as $enfant)
            {
                if($enfant->getRoleFamille()!="Ray" and $enfant->getRoleFamille()!="Reny")
                {
                    $autreMembre[]=$enfant;
                }
            }

          

            //nombre total des personnes
            $personnes=((new PersonneModel($this->bdd))->all());
            $nbPersonne=0;
            $nbHomme=0;
            $nbFemme=0;
            foreach($personnes as $personne)
            {
                if($personne->getFamille_id()==$famille->getId())
                {
                    $nbPersonne++;
                    if($personne->getSexe()=="homme")
                    {
                        $nbHomme++;
                    }else
                    {
                        $nbFemme++;
                    }
                }
                
            }

           


            //Recuperation
            
            
        }else
        {
            return header('Location: /famille');
        }
        return $this->render('famille.voir',[
            'famille'=>$famille,
            'secteur'=>$secteur,
            'pereExiste'=>$pereExiste,
            'mereExiste'=>$mereExiste,
            'infoPere'=>$infoPere,
            'infoMere'=>$infoMere,
            'pere'=>$pere,
            'mere'=>$mere,
            'enfants'=>$autreMembre,
            'nbPersonne'=>$nbPersonne,
            'nbHomme'=>$nbHomme,
            'nbFemme'=>$nbFemme
        ]);
    }
}