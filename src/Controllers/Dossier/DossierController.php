<?php
namespace App\Controllers\Dossier;

use App\Controllers\Controller;
use App\Entity\Dossier\Celibataire;
use App\Entity\Dossier\Dossiers;
use App\Entity\Dossier\Residence;
use App\Entity\Dossier\Temoin;
use App\Entity\Personne;
use App\Models\Dossier\CelibataireModel;
use App\Models\Dossier\DossiersModel;
use App\Models\Dossier\ResidenceModel;
use App\Models\Dossier\TemoinModel;
use App\Models\FamilleModel;
use App\Models\FokontanyModel;
use App\Models\PersonneModel;
use App\Models\SecteurModel;

class DossierController extends Controller
{



    //VOIR dossier

    public function voirDossier()
    {

        $dossiers=null;
        $personnes=null;
        $familles=null;
       
        $celibataires=null;
        $temoins=null;
        $residences=null;

        if((new DossiersModel($this->bdd))->all())
        {
            $dossiers=(new DossiersModel($this->bdd))->all();
        }

        if((new CelibataireModel($this->bdd))->all())
        {
            $celibataires=(new CelibataireModel($this->bdd))->all();
        }
        

        if((new ResidenceModel($this->bdd))->all())
        {
            $residences=(new ResidenceModel($this->bdd))->all();
        }

        if((new TemoinModel($this->bdd))->all())
        {
            $temoins=(new TemoinModel($this->bdd))->all();
        }

        
        if((new PersonneModel($this->bdd))->all())
        {
            $personnes=(new PersonneModel($this->bdd))->all();
        }

        if((new FamilleModel($this->bdd))->all())
        {
            $familles=(new FamilleModel($this->bdd))->all();
        }
      

           
        return $this->render('dossier.voirDossier',
          [
            'personnes'=>$personnes,
            'dossiers'=>$dossiers,
            'familles'=>$familles,
            'residences'=>$residences,
            'celibataires'=>$celibataires,
            'temoins'=>$temoins
          ]
     );
    }
    //LA PAGE D ACCUEIL
    public function index (int $id)
    {
        $this->isAdmin();
        $role=null;
        $listeResidences=[];
        $listeCelibataire=[];
        $toutCertificats=[];

        if((new PersonneModel($this->bdd))->findById($id))
        {

         $role=((new PersonneModel($this->bdd))->findById($id))->getRoleFamille();

         //Je recupere tout les dossiers que cette personne a 

         $dossiers=(new DossiersModel($this->bdd))->all();
         
         foreach($dossiers as $dossier)
         {
            if($dossier->getPersonne_id()===$id)
            {
                //je stocker dans un tableaux avec le cle est le nom du dossier, a fin de separer chaque dossier
                // selon leur nom

                if($dossier->getNom()=="Certificat de Residence")
                {
                    $listeResidences[]=((new ResidenceModel($this->bdd))->findById($dossier->getCertificat_id()));
                }
                if($dossier->getNom()=="Certificat de celibataire")
                {
                    $listeCelibataire[]=((new CelibataireModel($this->bdd))->findById($dossier->getCertificat_id()));
                }
               
            }
         }


       
        $toutCertificats["residence"]=$listeResidences;
        $toutCertificats["celibataire"]=$listeCelibataire;
         
            return $this->render('dossier.index',
            [
                'personne'=>((new PersonneModel($this->bdd))->findById($id)),
                 'role'=>$role,
                 'toutCertificats'=>$toutCertificats
            ]);

        }else
        {
            return header('Location: /famille');
        }
        
    }


    //PAGE RESIDENCE
    public function residence(int $id)
    {
        $this->isAdmin();
        
        $personne=null;
        if((new PersonneModel($this->bdd))->findById($id))
        {

            $personne=((new PersonneModel($this->bdd))->findById($id));
            // var_dump($personne);
        


            $error=[];
            if(isset($_POST['valider']))
            {
                //objet Residenxce et objet Dossiers
                $residence= new Residence();
                $dossiers= new Dossiers();



                // var_dump($_POST['nom'],$_POST['motif']);die();

                //recuperation des date;

                $residence->setNom($personne->getNom());
                $residence->setPrenom($personne->getPrenom());
                $residence->setDateNaissance($personne->getDateNaissance());
                $residence->setLieuNaissance($personne->getLieuNaissance());
                $residence->setPere($personne->getPere());
                $residence->setMere($personne->getMere());
                $residence->setPersonne_id($personne->getId());
                $residence->setProfession($personne->getProfession());


                //si le cin existe 
                if($personne->getCin())
                {
                    $residence->setCin($personne->getCin());
                    $residence->setLieuCin($personne->getLieuCin());
                    $residence->setDateCin($personne->getDateCin());
                }
               

                $residence->setPasseport($_POST['passeport']);
                $residence->setDatePasseport($_POST['datePasseport']);
                $residence->setDateValidePasseport($_POST['dateValidePasseport']);

                $residence->setNationalite($_POST['nationalite']);
                $residence->setMotif($_POST['motif']);
               
                //affichage

               //validation
               if($residence->isValid())
               {
                
                //SI L UN DES 3 DATAS DE PASSEPORT N EXISTE PAS DONC TOUT CES CHAMPS SONT NULS
                 if(empty($residence->getPasseport()) or empty($residence->getDatePasseport())
                  or empty($residence->getDateValidePasseport()))
                 {
                    $residence->setPasseport("");
                    $residence->setDatePasseport("");
                    $residence->setDateValidePasseport("");
                 }


                
               
                
                if((new ResidenceModel($this->bdd))->creerResidence($residence))
                {
                   
                    
                   

                    //recuperer le dernier ajouter
                    $residences=(new ResidenceModel($this->bdd))->all();

                    //je recuperer le id le plus grand car le plus grand c est le dernier a ajouter
                    $residenceId=$residences[0]->getId();

                    foreach($residences as $residence)
                    {
                        if($residenceId<=$residence->getId())
                        {
                            $residenceId=$residence->getId();
                        }
                    }

                    //IL FAUT L ENREGISTRER DANS LE DOSSIERS
                    $dossiers->setNom("Certificat de Residence");
                    $dossiers->setCertificat_id($residenceId);
                    $dossiers->setPersonne_id($personne->getId());

                    if((new DossiersModel($this->bdd))->creerDossier($dossiers))
                    {
                        //Voir directement en chercherchant le iD du dernier ajout
                        $residences=(new ResidenceModel($this->bdd))->all();

                        $residenceId=$residences[0]->getId();
                        foreach($residences as $residence)
                        {
                            if($residenceId<=$residence->getId())
                            {
                                $residenceId=$residence->getId();
                            }
                        }

                        //le redirige maintenant

                        return header('Location: /dossier/residence-voir/'.$residenceId);
                        
                    }
                }else
                {
                    $error[]="probleme tecniqa";
                }

               }else
               {
                foreach($residence->getError() as $erreur)
                {
                    $error[]=$erreur;
                }
               }
            }


            return $this->render('dossier.residence.creer',
            [
                'personne'=>$personne,
                'error'=>$error
            ]);

        }else
        {
            return header('Location: /famille');
        }
    }

    //VOIR UN RESIDENCE
    public function voirResidence(int $id)
    {

        $this->isAdmin();
        
         $residence=null;
         $personne=null;
         $famille=null;
         $fokontany=null;
         $secteur=null;
        if((new ResidenceModel($this->bdd))->findById($id))
        {

            $residence=((new ResidenceModel($this->bdd))->findById($id));

            $personne=((new PersonneModel($this->bdd))->findById($residence->getPersonne_id()));

            $famille=((new FamilleModel($this->bdd))->findById($personne->getFamille_id()));

            $secteur=((new SecteurModel($this->bdd))->findById($famille->getSecteur_id()));

            $fokontany=((new FokontanyModel($this->bdd))->findById($secteur->getFokontany_id()));

        }else
        {
            return header('Location: /');
        }

        return $this->render('dossier.residence.voir',
          [
            'residence'=>$residence,
            'personne'=>$personne,
            'famille'=>$famille,
            'fokontany'=>$_SESSION['fokontany'],
            'secteur'=>$secteur,
            'fokontany'=>$fokontany
          ]
        );

    }


    //MODIFIER UN RESIDENCE
    public function modifierResidence(int $id)
    {
        $this->isAdmin();
        
        $personne=null;
        $residence=null;
        $error=null;
        if((new ResidenceModel($this->bdd))->findById($id))
        {
            $residence=(new ResidenceModel($this->bdd))->findById($id);


            if(isset($_POST['valider']))
            {

                
                //recuperation des date
              
               

                //si le passeport existe
                if(!empty($residence->getPasseport()) and isset($_POST['passeport'])
                 and isset($_POST['datePasseport']) and isset($_POST['dateValidePasseport']))
                {
                    $residence->setPasseport($_POST['passeport']);
                    $residence->setDatePasseport($_POST['datePasseport']);
                    $residence->setDateValidePasseport($_POST['dateValidePasseport']);
                }
                
                
                $residence->setNationalite($_POST['nationalite']);
                $residence->setMotif($_POST['motif']);
                $residence->setUpdatAt(date('d/M/Y').' le '.date("H:i:s"));


                
                 //validation
               if($residence->isValid())
               {
                
                //SI L UN DES 3 DATAS DE PASSEPORT N EXISTE PAS DONC TOUT CES CHAMPS SONT NULS
                 if(empty($residence->getPasseport()) or empty($residence->getDatePasseport())
                  or empty($residence->getDateValidePasseport()))
                 {
                    $residence->setPasseport("");
                    $residence->setDatePasseport("");
                    $residence->setDateValidePasseport("");
                 }
                
                if((new ResidenceModel($this->bdd))->modifierResidence($residence))
                {

                    return header('Location: /dossier/residence-voir/'.$id); 
                }else
                {
                    $error[]="probleme tecniqa";
                }

               }else
               {
                foreach($residence->getError() as $erreur)
                {
                    $error[]=$erreur;
                }
               }
            }
        }else
        {
            return header('Location: /');
        }
        return $this->render('dossier.residence.modifier',
           [
            'residence'=>$residence,
            'error'=>$error
           ]);
    }

    //SUPPRIMER UN RESIDENCE
    public function supprimerResidence(int $id)
    {
        $this->isAdmin();
        

        if((new ResidenceModel($this->bdd))->findById($id))
        {
           $residence=(new ResidenceModel($this->bdd))->findById($id);
           $personne=((new PersonneModel($this->bdd))->findById($residence->getPersonne_id()));
           //je cherche aussi le dossier
           $dossiers=(new DossiersModel($this->bdd))->all();


           foreach($dossiers as $dossier)
           {
            if($dossier->getCertificat_id()===$id)
            {
                $dossierSupprimer= (new DossiersModel($this->bdd))->supprimer($dossier->getId());
            }
           }

           if((new ResidenceModel($this->bdd))->supprimer($residence->getId()))
           {
            $route=lcfirst($personne->getRoleFamille())."/".$personne->getId();
            return header('Location:/dossier/index-'.$route);
           }
        }else
        {
            return header('Location: /');
        }
    }





    //POUR CREER UN CELIBATAIRE
    public function creerCelibataire(int $id)
    {
        $this->isAdmin();
        
        $personne=null;
      
        $error=[];
        
        $personne=null;
        if((new PersonneModel($this->bdd))->findById($id))
        {

            $personne=(new PersonneModel($this->bdd))->findById($id);
            $dossiers= new Dossiers();

            //recuperation des datas

            if(isset($_POST['valider']))
            {
                $celibataire= new Celibataire();

                $celibataire->setMotif($_POST['motif']);
                $celibataire->setTemoin1_id(0);
                $celibataire->setTemoin2_id(0);
                $celibataire->setPersonne_id($personne->getId());

                if($celibataire->isValid())
                {
                   if((new CelibataireModel($this->bdd))->creerCelibataire($celibataire))
                   {


                    //recuperer le dernier ajouter
                    $celibataires=(new CelibataireModel($this->bdd))->all();

                    //je recuperer le id le plus grand car le plus grand c est le dernier a ajouter
                    $celibataireId=$celibataires[0]->getId();

                    foreach($celibataires as $celibataire)
                    {
                        if($celibataireId<=$celibataire->getId())
                        {
                            $celibataireId=$celibataire->getId();
                        }
                    }
                     //IL FAUT L ENREGISTRER DANS LE DOSSIERS
                    $dossiers->setNom("Certificat de celibataire");

                    $dossiers->setCertificat_id($celibataireId);

                    $dossiers->setPersonne_id($personne->getId());

                    if((new DossiersModel($this->bdd))->creerDossier($dossiers))
                    {
                      //IL FAUT ENREGITRER LES TEMOINS 

                      //LE ROUTE CE FAIT APARTIR DU DOSSIER
                   


                      //Donc je dois recuperer le dernier ajout dans le dossier

                      //recuperer le dernier ajouter
                      $dossiersAll=((new DossiersModel($this->bdd))->all());
                      $dernierDossier=$dossiersAll[0]->getId();
                      foreach($dossiersAll as $dossier)
                      {
                        if($dernierDossier<=$dossier->getId() and $dossier->getNom()=="Certificat de celibataire")
                        {
                            $dernierDossier=$dossier->getId();
                        }
                      }

                      //maintenat je recuperer le dossier avec le dernier id inserer
                      $dossiers=((new DossiersModel($this->bdd))->findById($dernierDossier));


                      //la redirection

                      return header('Location:/dossier/celibataire-temoin-creer/'.$dossier->getId());

                    }

                   }
                }else
                {
                    foreach($celibataire->getError() as $erreur)
                {
                    $error[]=$erreur;
                }
                }
            }
        }else
        {
            return header('Location: /famille');
        }


        
        return $this->render('dossier.celibataire.creer',
        [
            'personne'=>$personne,
            'error'=>$error,
        ]);
    }


    //POUR MODIFIER UN CELIBATAIRE
    public function modifierCelibataire(int $id)
    {
        $this->isAdmin();
        $celibataire=null;
        $temoins=[];
        $error=[];
        if((new CelibataireModel($this->bdd))->findById($id))
        {
            $celibataire=(new CelibataireModel($this->bdd))->findById($id);

            $personne=(new PersonneModel($this->bdd))->findById($celibataire->getPersonne_id());

            $temoins['temoin1']=((new TemoinModel($this->bdd))->findById($celibataire->getTemoin1_id()));
            $temoins['temoin2']=((new TemoinModel($this->bdd))->findById($celibataire->getTemoin2_id()));



            if(isset($_POST['valider']))
            {
                //recuperation des data

                $celibataire->setMotif($_POST['motif']);
                $celibataire->setUpdatAt(date('d/M/Y').' le '.date("H:i:s"));
                if($celibataire->isValid())
                {
                    if((new CelibataireModel($this->bdd))->modifierMotifCelibataire($celibataire))
                    {
                        $route="index-".lcfirst($personne->getRoleFamille()).'/'.$personne->getId();
                        return header('Location: /dossier/'.$route);
                    }
                }else
                {
                    foreach($celibataire->getError() as $erreur)
                {
                    $error[]=$erreur;
                }
                }
            }

            
            return $this->render('dossier.celibataire.modifier',
              [
                'celibataire'=>$celibataire,
                'temoins'=>$temoins,
                'error'=>$error
              ]);
        }else
        {
            return header('Location: /');
        }
        
    }
    //POUR CREER UN TEMOIN
    public function creerTemoin(int $id)
    {
         $this->isAdmin();
         
    
         $personne=null;
         $error=[];

        $dossier=null;
        $celibataire=null;
        $titre=null;
        $temoin1=null;
        $temoin2=null;
        $personne=null;
        if((new DossiersModel($this->bdd))->findById($id))
        {
          $dossier=(new DossiersModel($this->bdd))->findById($id);

          //recuperation du bon certifat de celibataire
          $celibataire=(new CelibataireModel($this->bdd))->findById($dossier->getCertificat_id());

          $personne=(new PersonneModel($this->bdd))->findById($dossier->getPersonne_id());


          if($celibataire->getTemoin1_id()==0 or $celibataire->getTemoin2_id()==0)
          {
            //si la temoin1 est diff de 0 donc on est entraint de saisir le temoin2
            if($celibataire->getTemoin1_id()!=0)
            {
                $titre="Vavolombelona faharoa";
                $temoin1=true;
                $temoin2=false;
            }else
            {
                $titre="Vavolombelona voalohany";
                $temoin1=false;
                $temoin2=true;

            }
           
            //enregistrement


            if(isset($_POST['valider']))
            {

                //CREATION D UN TEMOIN 
                //recuperation des datas
                $temoin=new Temoin();

                $temoin->setNom($_POST['nom']);
                $temoin->setPrenom($_POST['prenom']);
                $temoin->setSexe($_POST['sexe']);
                $temoin->setPere($_POST['pere']);

                $temoin->setMere($_POST['mere']);

                $temoin->setDateNaissance($_POST['dateNaissance']);
                $temoin->setLieuNaissance($_POST['lieuNaissance']);
                $temoin->setCin($_POST['cin']);
                $temoin->setLieuCin($_POST['lieuCin']);
                $temoin->setDateCin($_POST['dateCin']);
                $temoin->setAdresse($_POST['adresse']);
                $temoin->setProfession($_POST['profession']);

                $temoin->setDossier_id($dossier->getId());
                
                
                if($temoin->isValid())
                {

                   
                    // ON VA L ENREGISTRER
                    
                    if((new TemoinModel($this->bdd))->creerTemoin($temoin))
                    {

                        //Recuperer le dernier ajout de temoin
                        $temoins=(new TemoinModel($this->bdd))->all();

                        $temoinId=$temoins[0]->getId();
                        foreach($temoins as $temoin)
                        {
                            if($temoinId<=$temoin->getId() and $temoin->getDossier_id($id))
                            {
                                $temoinId=$temoin->getId();
                            }
                        }

    
                        $celibataire->setUpdatAt(date('d/M/Y').' le '.date("H:i:s"));

                        if($titre==="Vavolombelona voalohany")
                        {
                            //j affecte le Id dans le celibataire
                            $celibataire->setTemoin1_id($temoinId);
                            if((new CelibataireModel($this->bdd))->modifierParentCelibataire($celibataire,"temoin1"))
                            {
                                //donc je le reboucle dans cette meme page

                               return header('Location:/dossier/celibataire-temoin-creer/'.$id);

                            }else
                            {
                                
                            }
                        }else
                        {
                            $celibataire->setTemoin2_id($temoinId);
                            if((new CelibataireModel($this->bdd))->modifierParentCelibataire($celibataire,"temoin2"))
                            {
                                //donc je le reboucle dans cette meme page

                              //il faut le rediriger vers la page index pour voir les dossiers
                              $route="index-".lcfirst($personne->getRoleFamille()).'/'.$personne->getId();
                              return header('Location: /dossier/'.$route);

                            }else
                            {
                                $error[]="erreur teknique";
                            }
                        }


                    }else
                    {
                        $error[]="erreur teknique";
                    }
                    

                }else
                {
                    foreach($temoin->getError() as $erreur)
                    {
                    $error[]=$erreur;
                    }
                }
            }


          }else
          {
            return header('Location: /');
          }


        }else
        {
            return header('Location: /');
        }
         return $this->render('dossier.temoin.creer',
         [
             'personne'=>$personne,
             'error'=>$error,
             'dossier'=>$dossier,
             'celibataire'=>$celibataire,
             'titre'=>$titre
         ]);
    }


    //POUR MODIFIER UN TEMOIN
    public function modifierTemoin(int $id)
    {
        $temoin=null;
        $error=null;
        if((new TemoinModel($this->bdd))->findById($id))
        {
            $temoin=(new TemoinModel($this->bdd))->findById($id);
            //recherch rapide du dossier
            $dossier=(new DossiersModel($this->bdd))->findById($temoin->getDossier_id());

            //recherch rapide du personne
            $personne=(new PersonneModel($this->bdd))->findById($dossier->getPersonne_id());

            if(isset($_POST['valider']))
            {
                //recuperation des datas

                $temoin->setUpdatAt( date('d/M/Y').' le '.date("H:i:s"));

                $temoin->setNom($_POST['nom']);
                $temoin->setPrenom($_POST['prenom']);
                $temoin->setSexe($_POST['sexe']);
                $temoin->setPere($_POST['pere']);

                $temoin->setMere($_POST['mere']);

                $temoin->setDateNaissance($_POST['dateNaissance']);
                $temoin->setLieuNaissance($_POST['lieuNaissance']);
                $temoin->setCin($_POST['cin']);
                $temoin->setLieuCin($_POST['lieuCin']);
                $temoin->setDateCin($_POST['dateCin']);
                $temoin->setAdresse($_POST['adresse']);
                $temoin->setProfession($_POST['profession']);


                if($temoin->isValid())
                {
                    if((new TemoinModel($this->bdd))->modifierTemoin($temoin))
                    {
                        $route="index-".lcfirst($personne->getRoleFamille()).'/'.$personne->getId();
                        return header('Location: /dossier/'.$route);
                    }
                }else
                {
                    foreach($temoin->getError() as $erreur)
                    {
                    $error[]=$erreur;
                    }
                }

            }

            return $this->render('dossier.temoin.modifier', 
              [
                'error'=>$error,
                'temoin'=>$temoin
              ]);
        }else
        {
            return header('Location:/');
        }
    }
    //POUR SUPPRIMER UN CELIBATAIRE
    public function supprimerCelibataire(int $id)
    {
        if((new CelibataireModel($this->bdd))->findById($id))
        {
            $celibataire=(new CelibataireModel($this->bdd))->findById($id);

            $personne=(new PersonneModel($this->bdd))->findById($celibataire->getPersonne_id());

            //on va supprimer les temoin et c ets fini
            $dossiers=((new DossiersModel($this->bdd))->all());

            foreach($dossiers as $dossier)
            {
                if($dossier->getNom="Certificat de celibataire" and ($dossier->getCertificat_id()==$id))
                {
                    //on va le supprimer
                    //je cherche les temoins et je les effacer
                    
                    $temoins=((new TemoinModel($this->bdd))->all());

                    foreach($temoins as $temoin)
                    {
                        if($temoin->getDossier_id()===$dossier->getId())
                        {
                            //supprimer le dossier
                            $temoinSupp=((new TemoinModel($this->bdd))->supprimer($temoin->getId()));


                        }
                    }
                    //supprimer le dossier
                    $dossierSupp=((new DossiersModel($this->bdd))->supprimer($dossier->getId()));
                }
            }
            
            $celibataireSupp=(new CelibataireModel($this->bdd))->supprimer($id);
           
            if($celibataireSupp)
            {
                $route=lcfirst($personne->getRoleFamille())."/".$personne->getId();
                return header('Location:/dossier/index-'.$route);
            }

        }else
        {
            return header('Location:/famille');
        }
    }



}