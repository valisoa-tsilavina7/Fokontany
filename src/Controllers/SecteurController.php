<?php
namespace App\Controllers;

use App\Entity\Famille;
use App\Entity\Secteur;
use App\Models\FamilleModel;
use App\Models\FokontanyModel;
use App\Models\PersonneModel;
use App\Models\SecteurModel;

class SecteurController extends Controller
{


    //POUR VOIR TOUT LES SECTEURS
    public function index()
    {
        $this->isAdmin();

        $requete=(new SecteurModel($this->bdd))->all();
        return $this->render('secteur.index',
      [
        'secteur'=>(new SecteurModel($this->bdd))->all()
      ]);
    }

    //POUR VOIR CREER UN SECTEUR
    public function creerSecteur()
    {
        $this->isAdmin();
        $error=[];
        if(isset($_POST['valider']))
        {
            //recuperatiopn des datas

            $secteur=new Secteur();

            $secteur->setNom($_POST['nom']);
            $secteur->setFokontany_id($_SESSION['fokontany']->getId());


            if($secteur->isValid())
            {
                //traitement
                
                if((new SecteurModel($this->bdd))->findByName($secteur->getNom())===false)
                {

                    
                    if((new SecteurModel($this->bdd))->creerSecteur($secteur))
                    {
                        return header('Location: /secteur');
                    }else
                    {
                     $error[]="misy olona ara-teknika";

                    }
                }else
                {
                    $error[]="efa misy ny Secteur napidirinao";
                }

            }else
            {
                foreach($secteur->getError() as $erreur)
                {
                    $error[]=$erreur;
                }
            }

        }
        
        return $this->render('secteur.creer',['error'=>$error]);
    }


    //POUR MODIFIER UN SECTEUR
    public function editSecteur(int $id)
    {
        $this->isAdmin();
        $secteur=(new SecteurModel($this->bdd))->findById($id);
        $error=[];
        if(isset($_POST['valider']))
        {
         
            

            //recuperation des donnes
            $nomAncienne=$secteur->getNom();
            $secteur->setNom($_POST['nom']);
            $secteur->setUpdatAt(date('d/M/Y').' le '.date("H:i:s"));


            if($secteur->isValid())
            {

                //si le nom correspond a l ancienne nom , donc il n y a pas de modification
                if($secteur->getNom()===$nomAncienne)
                {
                    return header('Location: /secteur');
                }else if((new SecteurModel($this->bdd))->findByName($secteur->getNom())===false)
                {

                    
                    if((new SecteurModel($this->bdd))->editSecteur($secteur))
                    {
                        return header('Location: /secteur');
                    }else
                    {
                     $error[]="misy olona ara-teknika";
                     return header('Location: /secteur');
                    }
                }else
                {
                    $error[]="efa misy ny Secteur napidirinao";
                }
            }else
            {

                foreach($secteur->getError() as $erreur)
                {
                    $error[]=$erreur;
                }

            }

        }
        return $this->render('secteur.edit',[
            'secteur'=>$secteur,
            'error'=>$error
        ]);
    }


    //POUR SUPPRIMER UN SECTEUR 
    public function supprimerSecteur(int $id)
    {
        $this->isAdmin();
        if((new SecteurModel($this->bdd))->findById($id)){


            //rechercher tout les famille avec cet secteur

            $secteur=(new SecteurModel($this->bdd))->findById($id);

            $secteurId=$secteur->getId();

            $familles=(new FamilleModel($this->bdd))->all();

            foreach($familles as $famille)
            {
                if($famille->getSecteur_id()==$id)
                {


                    //supprimer les familles apres

                    $suppimer= new FamilleModel($this->bdd);
                    $suppimer->supprimer($famille->getId());


                    $famille_id=$famille->getId();

                    //supprimer les personnes dans cette famille
                    $personnes=(new PersonneModel($this->bdd))->all();
                    foreach($personnes as $personne)
                    {
                        if($personne->getFamille_id()===$famille->getId())
                        {
                            $suppimer= new PersonneModel($this->bdd);
                            $suppimer->supprimer($personne->getId());

                            
                        }
                    }
                  
                }
            }

            if((new SecteurModel($this->bdd))->supprimer($id))
            {
                return header('Location: /secteur');
            }
            
        }
        
    }



    //POUR VOIR UN SECTEUR 
     public function voirSecteur(int $id)
    {
        $this->isAdmin();
        $secteur=null;
         //un tabmeaux familles
        $LesFamilles=[];
        $peres=null;
        $meres=null;
        if((new SecteurModel($this->bdd))->findById($id))
        {


            //rechercher tout les famille avec cet secteur

            $secteur=(new SecteurModel($this->bdd))->findById($id);

            $familles=(new FamilleModel($this->bdd))->all();


    
            foreach($familles as $famille)
            {
                if($famille->getSecteur_id()===$id)
                {
                   $LesFamilles[]=$famille;

                   if($famille->getPere_id()!=0 )
                   {

                    $peres[]=(new PersonneModel($this->bdd))->findById($famille->getPere_id());
                   }
                   if($famille->getMere_id()!=0)
                   {
                    $meres[]=(new PersonneModel($this->bdd))->findById($famille->getMere_id());
                   }

                }
            }

            
            
        }



        return $this->render('secteur.voir',
        [
         'secteur'=>$secteur,
          'familles'=>$LesFamilles,
          'peres'=>$peres,
          'meres'=>$meres
        ]);
    }

}