<?php
namespace App\Controllers;

use App\Entity\Fokontany;
use App\Entity\Secteur;
use App\Models\Dossier\DossiersModel;
use App\Models\FamilleModel;
use App\Models\FokontanyModel;
use App\Models\PersonneModel;
use App\Models\SecteurModel;
use DateTime;

class FokontanyController extends Controller
{



    //la page d accueil
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

        if(!( new FokontanyModel($this->bdd))->all())
        {
            return header('Location: /creer');
        }

       
        if(( new DossiersModel($this->bdd))->all())
        {
            $dossiers=( new DossiersModel($this->bdd))->all();
            $nbDossiers=count(( new DossiersModel($this->bdd))->all());
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
       

        return $this->render('fokontany.index',
           [
            'nbPersonnes'=>$nbPersonne,
            'nbDossiers'=>$nbDossiers,
            'nbFamilles'=>$nbFamille,
            'nbSecteurs'=>$nbSecteurs,

            'personnes'=>$personnes,
            'familles' =>$familles,
            'secteurs' =>$secteurs,
            'dossiers' =>$dossiers
           ]);
    }


    //POUR CREER UN COMPTE
    public function creerCompte()
    {

        // var_dump((new FokontanyModel($this->bdd))->all()->rowCount());
        $row=0;

        $req=(new FokontanyModel($this->bdd))->all();

        foreach($req as $foko)
        {
            $row++;
        }

        if($row<1)
        {
            $error=[];
           if(isset($_POST['valider']))
            {
            //verification des 2mot de passes

           if(!empty($_POST['password'][0] and !empty($_POST['password'][1])))
           {
           
            //verification si il sont egaux
             if($_POST['password'][0] ===$_POST['password'][1])
             {
                

                

                //LES DEUX MDP SE CORRESPONDENT

                //CREATION DE L OBJET;

                $fokontany=new Fokontany();

                $fokontany->setNom($_POST['nom']);
                $fokontany->setPassword($_POST['password'][0]);
                $fokontany->setDistrict($_POST['district']);
                $fokontany->setCommune($_POST['commune']);




                if($fokontany->isValid())
                {
                    //traitement


                    if((new FokontanyModel($this->bdd))->creerFokontany($fokontany))
                    {

                        
                      $this->setMessage($fokontany->getNom() .'  bien enregistree' );
                      return header('Location: /');
                    }else
                    {
                        $error[]="tsy tafiditra ";
                    }
               

                }else
                {
                    foreach($fokontany->getError() as $erreur)
                    {
                        $error[]=$erreur;
                    }
                }



             }else
             {
                $error[]="tsy mitovy ny teny miafina, avereno azafady!";
             }


           }else
           {
             $error[]="fenoy tsara ny toro_marika";
           }
          }
        }else
        {
            return header('Location: /');
        }


        return $this->render('fokontany.creer',[ 'error'=>$error]);
    }
    


    // POUR VOIR LE PROFIL
    public function profil()
    {
        $this->isAdmin();

        return $this->render('fokontany.profil',
    [
        'fokontany'=>((new FokontanyModel($this->bdd))->all()[0])
    ]);
    }
    

    //POUR MODIFIER LE PROFIL
    public function edit(int $id)
    {

        $this->isAdmin();
        $error=[];

        $fokontany=(new FokontanyModel($this->bdd))->findById($id);
        if(isset($_POST['valider']))
        {

           if(!empty($_POST['password']))
           {

             if($_POST['password']===$fokontany->getPassword())
             {


                //recuperation des datas

                $fokontany->setNom($_POST['nom']);
                $fokontany->setDistrict($_POST['district']); 
                $fokontany->setCommune($_POST['commune']);
                $fokontany->setUpdatAt(date('d/M/Y').' le '.date("H:i:s"));

                if($fokontany->isValid())
                {
                    //traitement


                    if((new FokontanyModel($this->bdd))->editProfilFokontany($fokontany))
                    {

                        
                      $this->setMessage($fokontany->getNom() .'  bien enregistree' );
                      
                    }else
                    {
                        return header('Location: /profil');
                    }
               

                }else
                {
                    foreach($fokontany->getError() as $erreur)
                    {
                        $error[]=$erreur;
                    }
                }
                


             }else
            {
               $error[]="Diso ny teny miafina";

            }
           }else
           {
            $error[]="fenoy ny toro-marika rehetra azafady!";
           }
            
        }



        return $this->render('fokontany.edit',[
            'fokontany'=>$fokontany,
            'error'=>$error
        ]);
    }


    //POUR MODIFIER LE MOT DE PASSE

    public function editPassword(int $id)
    {
        $this->isAdmin();

        $fokontany=(new FokontanyModel($this->bdd))->findById($id);

        $error=[];

        if(isset($_POST['valider']))
        {
           //POUR SUPPRIMER LE VALIDE POST
           array_pop($_POST);


           if(!empty($_POST['password']) and !empty($_POST['newPassword'][0] and !empty($_POST['newPassword'][1])))
           {

            //verification du mot de passe
            if($_POST['password']===$fokontany->getPassword())
            {
                if($_POST['newPassword'][0] ===$_POST['newPassword'][1])
                {
                  //TRAITEMENT
                  $fokontany->setPassword($_POST['newPassword'][0]);
                  $fokontany->setUpdatAt(date('D/M/Y').' le '.date("H:i:s"));

                if($fokontany->isValid())
                {
                    //traitement


                    if((new FokontanyModel($this->bdd))->editProfilFokontany($fokontany))
                    {

                        
                      $this->setMessage($fokontany->getNom() .'  bien enregistree' );
                      return header('Location: /');
                    }else
                    {
                      return header('Location: /security/connexion');
                    }
               

                }else
                {
                    foreach($fokontany->getError() as $erreur)
                    {
                        $error[]=$erreur;
                    }
                }
                

                }else{
                  $error[]="tsy mitovy ny teny miafina, avereno azafady!";
                }
            }else
            {
                $error[]="diso ny teny miafina";

            }
             
           }else
           {
            $error[]="fenoy tsara ny toro_marika";
           }
          
           
        }
        return $this->render('fokontany.editPassword',['error'=>$error,'fokontany'=>$fokontany]);
    }
    
    //CONNEXION
    public function connexion()
    {

        $error=[];
        if(isset($_POST['valider']))
        {
            

            if(!empty($_POST['password']))
            {
                //recuperation du fokontany;
                $fokontany=((new FokontanyModel($this->bdd))->all()[0]);


                if($_POST['password']===$fokontany->getPassword())
                {
                   $_SESSION['auth']=true;

                   $_SESSION['fokontany']=$fokontany;

                   return header('Location: /?connecte=true');
                }else
                {
                    $error[]="Diso ny teny miafina !";
                }

            }else
            {
                $error[]="fenoy ny teny miafina azafady";
            }

           
            
        }
        return $this->render('fokontany.security.connexion',['error'=>$error]);
    }

    //POUR SE DECONNECTER
    public function deconnexion()
    {
      session_destroy();
      return header('Location:/security/connexion');
    }



   
}