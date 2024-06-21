<?php
namespace App\Controllers;

use App\Entity\Famille;
use App\Entity\Personne;
use App\Models\Dossier\DossiersModel;
use App\Models\FamilleModel;
use App\Models\PersonneModel;
use App\Models\SecteurModel;

class PersonneController extends Controller
{

    //POUR L acceuil
    public function index()
    {
        $this->isAdmin();

        $personnes=null;
        $dossiers=null;
        $secteurs=null;
        $familles=null;
        if(((new PersonneModel($this->bdd))->all()))
        {
            $personnes= ((new PersonneModel($this->bdd))->all());
        }
        

        if((new DossiersModel($this->bdd))->all())
        {
            $dossiers= ((new DossiersModel($this->bdd))->all());
        }
       
        if((new SecteurModel($this->bdd))->all())
        {
            $secteurs= ((new SecteurModel($this->bdd))->all());
        }

        if((new FamilleModel($this->bdd))->all())
        {
            $familles= (new familleModel($this->bdd))->all();

        }
        return $this->render('personne.index',[
            'personnes'=>$personnes,
            'dossiers'=>$dossiers,
            'secteurs'=>$secteurs,
            'familles'=>$familles
        ]);
    }


    //CREER UNE PERSONNE
    public function creerPersonne(int $id)
    {

        $this->isAdmin();

        

        if((new FamilleModel($this->bdd))->findById($id))
        {
            $famille=(new FamilleModel($this->bdd))->findById($id);
            $error=[];
            $pereMereExistePas=true;

            $pere=null;
            $mere=null;


            //Affichage automatique des Pere et Mere si elle existe
            if((new FamilleModel($this->bdd))->findById($id)->getPere_id()!=0)
            {
                $pere=((new PersonneModel($this->bdd))->findById($famille->getPere_id()));
                
            }

            if((new FamilleModel($this->bdd))->findById($id)->getMere_id()!=0)
            {
                $mere=((new PersonneModel($this->bdd))->findById($famille->getMere_id()));

            }
            

            
            
            //POUR RECUPERER LE URL PERE MERE ENFANT OU INVITE OU AUTRE, ON LE TRANSFORME EN TABLEAU AVEC LE CARAC /
              $tab=explode('/',$_GET['url']);
              $role=ucfirst((explode('-',$tab[1]))[1]);
            if(isset($_POST['valider']))
            {
                
                $personne=new Personne();

              

                if($role=="Ray"){
                    //VERIFICATION SI IL EXISTE DEJA UN PERE DANS LA FAMILLE EN QUESTION SI OUI ON LE RETOURNE AU PAGE D ACCUEIL SI NON ON PEUT CONTINUER
                    if((new FamilleModel($this->bdd))->findById($id)->getPere_id()==0)
                    {
                        //si c est nulle donc on peut ajouter
                        $personne->setSexe("homme");



                    }else
                    {
                        //on ne peut pas ajouter
                        $error[]="efa misy ny Ray ka tsy mety mamorina ianao";
                        $pereMereExistePas=false;
                    }
                    
                }elseif($role=="Reny")
                {

                    //VERIFICATION SI IL EXISTE DEJA UN PERE DANS LA FAMILLE EN QUESTION SI OUI ON LE RETOURNE AU PAGE D ACCUEIL SI NON ON PEUT CONTINUER
                    if((new FamilleModel($this->bdd))->findById($id)->getMere_id()==0)
                    {
                        //si c est nulle donc on peut ajouter
                        $personne->setSexe("femme");



                    }else
                    {
                        //on ne peut pas ajouter
                        $error[]="efa misy ny Reny ka tsy mety mamorina ianao";
                        $pereMereExistePas=false;
                    }
                    
                    
                }else
                {
                    $personne->setSexe($_POST['sexe']);

                }


                if($pereMereExistePas==true)
                {

                   
                   
                    
                    $personne->setNom($_POST['nom']);
                    $personne->setPrenom($_POST['prenom']);
               
                    $personne->setDateNaissance($_POST['dateNaissance']);
                    $personne->setLieuNaissance($_POST['lieuNaissance']);
                    $personne->setCin($_POST['cin']);
                    $personne->setLieuCin($_POST['lieuCin']);
                    $personne->setDateCin($_POST['dateCin']);

                    $personne->setProfession($_POST['profession']);
                    $personne->setMere($_POST['mere']);
                    $personne->setPere($_POST['pere']);

                    $personne->setVie(1);



                    //ON RECUPERE L INDEX 1 DU TABLEAU ET ON LE TRANSFORME EN UN AUTRE TABLEAUX AVEC LE CARAC -
                    $personne->setRoleFamille($role);

                    $personne->setfamille_id($id);

                    if($personne->isValid())
                    {

                        //si l un des champs sur le cin est nul donc on fait tous nul

                        if(empty($personne->getCin()) or empty($personne->getDateCin()) or empty($personne->getLieuCin()))
                        {
                            $personne->setCin("");
                            $personne->setDateCin("");
                            $personne->setLieuCin("");

                        }

                        if((new PersonneModel($this->bdd))->creerPersonne($personne))
                        {
                            if($role=="Ray" or $role=="Reny")
                            {
                                //update le famille
                                if($role=="Ray")
                                {
                                    $parent="pere";
                                }else
                                {
                                    $parent="mere";
                                }

                                //Recuperation de l id du Parent avec le dernier ajout
                                $lesPersonnes=(new PersonneModel($this->bdd))->all();
                                $i=0;
                                foreach($lesPersonnes as $pers){
                                    if($pers->getFamille_id()===$id and $pers->getRoleFamille()===$role)
                                    {
                                        $parentId=$pers->getId();
                                    }
                                }

                                if($role=="Ray")
                                {
                                    $famille->setPere_id($parentId);
                                }else{
                                    $famille->setMere_id($parentId);
                                }

                                
                                if(((new FamilleModel($this->bdd))->modifierParentFamille($famille,$parent)))
                                {
                                    return header('Location: /famille/'.$id);
                                }else
                                {
                                    $error[]="misy olona eo amin ny famoronana ".$role;
                                }


                                
                            }

                            return header('Location: /famille/'.$id);

                        }else
                        {
                            $error[]="misy olana ara-teknika";
                        }
                    }else
                    {
                        foreach($personne->getError() as $erreur)
                        {
                            $error[]=$erreur;
                        }
                    }

                }

                

            }
        }else
        {
            return header('Location: /famille');
        }
        return $this->render('personne.creer',
            [
                'error'=>$error,
                'role'=>$role,
                'error'=>$error,
                'pere'=>$pere,
                'mere'=>$mere,
            ]);
    }

    //MODIFICATION D UNE PERSONNE
    public function ModifierPersonne(int $id)
    {
        $this->isAdmin();
        $personne=null;
        $error=null;
        $afficheSexe=false;
        if((new PersonneModel($this->bdd))->findById($id))
        {
            $personne=(new PersonneModel($this->bdd))->findById($id);


            //LE SEXE APPARAIT SI LE ROLE FAMILLE EST DIFFERENT DE PERE ET MERE
           
            
            $sexeApparait=$personne->getRoleFamille();
            if($sexeApparait==="Vahiny" or $sexeApparait==="Zanaka" or $sexeApparait==="Taiza")
            {
                //si c est du vahiny ou zanaka ou taiza alors c est vrai ca affiche
                $afficheSexe=true;

            }else
            {
                //si c est du pere ou mere c est faux ca affichera paas
                $afficheSexe=false;

            }

           
            if(isset($_POST["valider"]))
            {

                //RECUPERATION DES DATAS 
                $personne->setNom($_POST['nom']);
                $personne->setPrenom($_POST['prenom']);
                $personne->setPere($_POST['pere']);
                $personne->setMere($_POST['mere']);
                $personne->setDateNaissance($_POST['dateNaissance']);
                $personne->setLieuNaissance($_POST['lieuNaissance']);
                $personne->setCin($_POST['cin']);
                $personne->setLieuCin($_POST['lieuCin']);
                $personne->setDateCin($_POST['dateCin']);
                $personne->setProfession($_POST['profession']);

                $personne->setVie($_POST['vie']);


                $personne->setUpdatAt(date('d/M/Y').' le '.date("H:i:s"));


                //VALIDEE

                if($personne->isValid())
                {
                    if((new PersonneModel($this->bdd))->modifierPersonne($personne))
                    {
                        return header('Location: /famille/'.$personne->getFamille_id());
                    }
                }else
                {
                    foreach($personne->getError() as $erreur)
                    {
                        $error[]=$erreur;
                    }
                }
                
            }
        }else
        {
            return header('Location: /famille');
        }
        return $this->render("personne.modifier",
            [
                'personne'=>$personne,
                'error'=>$error,
                'afficheSexe'=>$afficheSexe
            ]
        );
    }






    //SUPRIMER UNE PERSONNE
    public function supprimerPersonne(int $id)
    {
        $personne=(new PersonneModel($this->bdd))->findById($id);

        //verification si la personne existe et que et la famille aussi existe
        if($personne and (new FamilleModel($this->bdd))->findById($personne->getFamille_id()))
        {
            $famille=(new FamilleModel($this->bdd))->findById($personne->getFamille_id());

            // var_dump($personne);
            // var_dump($personne->getRoleFamille()=="Ray" or $personne->getRoleFamille()=="Reny");die();
            if($personne->getRoleFamille()=="Ray" or $personne->getRoleFamille()=="Reny")
            {
                if($personne->getRoleFamille()=="Ray")
                {
                    $parent="pere";

                    //donc on remplacer le id_Pre par 0
                    $famille->setPere_id(0);

                    //MODIFICATION DU PERE_id ou MERE_id dans la table famille
                    $changeParent=(new FamilleModel($this->bdd))->modifierParentFamille($famille,$parent);
                }else
                {
                    $parent="mere";
                    //donc on remplacer le id_Mere par 0

                    $famille->setMere_id(0);
                    //MODIFICATION DU PERE_id ou MERE_id dans la table famille
                    $changeParent=(new FamilleModel($this->bdd))->modifierParentFamille($famille,$parent);

                }

                

            }

            //je peux supprimer maintenant la personne que soit pere,mere ,enfant,adoptif,invite

            if((new PersonneModel($this->bdd))->supprimer($id))
            {
               return header('Location: /famille/'.$famille->getId());
            }
            return header('Location: /famille');
        }
    }

}