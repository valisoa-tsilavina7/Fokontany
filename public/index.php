<?php

require '../vendor/autoload.php';


use Routes\Router;
use Routes\Route;


define('VIEWS',dirname(__DIR__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);
define('SCRIPTS',dirname($_SERVER['SCRIPT_NAME']));


$router=new Router($_GET['url']);


//LES ROUTERS

//le route principal le page d acceuil
$router->get('/',"App\Controllers\FokontanyController@index");



// ******************** ROUTER POUR LE FOKONTANY **************************

//LE ROUTE POUR CREER UN COMPTE AVEC METHOD GET ET POST
$router->get('/creer',"App\Controllers\FokontanyController@creerCompte");
$router->post('/creer',"App\Controllers\FokontanyController@creerCompte");

//LE ROUTE POUR LA CONNEXION ET DECOONNEXION
$router->get('/security/connexion',"App\Controllers\FokontanyController@connexion");
$router->post('/security/connexion',"App\Controllers\FokontanyController@connexion");
$router->get('/security/deconnexion',"App\Controllers\FokontanyController@deconnexion");

//LE ROUTE POUR LE PROFIL ET EDITION DU PROFIL
$router->get('/profil',"App\Controllers\FokontanyController@profil");
$router->get('/profil/edit/:id',"App\Controllers\FokontanyController@edit");
$router->post('/profil/edit/:id',"App\Controllers\FokontanyController@edit");

//LE ROUTE POUR LE PROFIL ET EDITION DU PASSWORD
$router->get('/profil/edit-password/:id',"App\Controllers\FokontanyController@editPassword");
$router->post('/profil/edit-password/:id',"App\Controllers\FokontanyController@editPassword");





// ************************LES ROUTERS POUR LE SECTEUR ******************************

//le ROUTE POUR L ACCEUIL SECTEURS
$router->get('/secteur',"App\Controllers\SecteurController@index");


//le ROUTE POUR CREER UN SECTEURS
$router->get('/secteur/creer',"App\Controllers\SecteurController@creerSecteur");
$router->post('/secteur/creer',"App\Controllers\SecteurController@creerSecteur");



//POUR MODIFIER UN SECTEUR AVEC LA METHODS GET ET POST
$router->get('/secteur/edit/:id',"App\Controllers\SecteurController@editSecteur");
$router->post('/secteur/edit/:id',"App\Controllers\SecteurController@editSecteur");




//POUR VOIR UN SECTEUR
$router->get('/secteur/:id',"App\Controllers\SecteurController@voirSecteur");



//POUR SUPPRIMER UN SECTEUR
$router->post('/secteur/delete/:id',"App\Controllers\SecteurController@supprimerSecteur");





// ********************** LES ROUTES POUR FAMILLE ***********************

//LE ROUTE D ACCEUIL
$router->get('/famille',"App\Controllers\FamilleController@index");


//LE ROUTER POUR CREER UNE FAMILLE
$router->get('/famille/creer/:id',"App\Controllers\FamilleController@creerFamille");
$router->post('/famille/creer/:id',"App\Controllers\FamilleController@creerFamille");


//POUR MODIFIER UNE FAMILLE
$router->get('/famille/edit/:id',"App\Controllers\FamilleController@modifierFamille");
$router->post('/famille/edit/:id',"App\Controllers\FamilleController@modifierFamille");

//POUR SUPPRIMER UNE FAMILLE
$router->post('/famille/delete/:id',"App\Controllers\FamilleController@supprimerFamille");

//VOIR UNE FAMILLE
$router->get('/famille/:id',"App\Controllers\FamilleController@voirFamille");





// ************************************* ROUTEUR POUR LA PERSONNE *******************
$router->get('/personne',"App\Controllers\PersonneController@index");



$personnes=["ray","reny","zanaka","taiza","vahiny"];


foreach($personnes as $personne)
{
    // POUR CREER UNE PERSONNE

    $router->get("/personne/creer-".$personne."/:id","App\Controllers\PersonneController@creerPersonne");
    $router->post("/personne/creer-".$personne."/:id","App\Controllers\PersonneController@creerPersonne");


    //POUR MODIFIER UNE PERSONNE

    $router->get("/personne/modifier-".$personne."/:id","App\Controllers\PersonneController@modifierPersonne");
    $router->post("/personne/modifier-".$personne."/:id","App\Controllers\PersonneController@modifierPersonne");

    //Pour supprimer
    $router->post("/personne/supprimer-".$personne."/:id","App\Controllers\PersonneController@supprimerPersonne");



    //POUR CREER DES DOSSIER OU CERTIFICAT
    $router->get("/dossier/index-".$personne."/:id","App\Controllers\Dossier\DossierController@index");


    // ***********************************POUR RESIDENCE *********************

    //CREER UN CERTIFICAT DE RESIDENCE
    $router->get("/dossier/residence-".$personne."/:id","App\Controllers\Dossier\DossierController@residence");
    $router->post("/dossier/residence-".$personne."/:id","App\Controllers\Dossier\DossierController@residence");

    //voir un residence
    $router->get("/dossier/residence-voir/:id","App\Controllers\Dossier\DossierController@voirResidence");

    //modifier un residence
    $router->get("/dossier/residence-edit/:id","App\Controllers\Dossier\DossierController@modifierResidence");
    $router->post("/dossier/residence-edit/:id","App\Controllers\Dossier\DossierController@modifierResidence");

    //supprimer un residence
    $router->post("/dossier/residence-supprimer/:id","App\Controllers\Dossier\DossierController@supprimerResidence");


    // ***********************************POUR CELIBATAIRE *********************

    //creer un celibaitre
    $router->get("/dossier/celibataire-".$personne."/:id","App\Controllers\Dossier\DossierController@creerCelibataire");

    $router->post("/dossier/celibataire-".$personne."/:id","App\Controllers\Dossier\DossierController@creerCelibataire");

}


// ***********************************POUR CREER UN TEMOIN APPARTIR DU DOSSIER *********************
//creer un temoin
$router->get("/dossier/celibataire-temoin-creer/:id","App\Controllers\Dossier\DossierController@creerTemoin");
$router->post("/dossier/celibataire-temoin-creer/:id","App\Controllers\Dossier\DossierController@creerTemoin");

//pour suppimer un celibait
$router->post("/dossier/celibataire-supprimer/:id","App\Controllers\Dossier\DossierController@supprimerCelibataire");

//modifier un motif celibat et voir temoins
$router->get("/dossier/celibataire-edit/:id","App\Controllers\Dossier\DossierController@modifierCelibataire");
$router->post("/dossier/celibataire-edit/:id","App\Controllers\Dossier\DossierController@modifierCelibataire");

//modifier temoins
$router->get("/dossier/temoin-edit/:id","App\Controllers\Dossier\DossierController@modifierTemoin");
$router->post("/dossier/temoin-edit/:id","App\Controllers\Dossier\DossierController@modifierTemoin");


//pour voir les dossiers
$router->get("/dossier/","App\Controllers\Dossier\DossierController@voirDossier");












// $router->post('/creer',"App\Controllers\FokontanyController@creerCompte");




$router->get('/secteur/:id',"App\Controllers\FokontanyController@show");

$router->run();