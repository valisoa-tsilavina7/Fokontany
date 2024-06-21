
<?php
    $path=str_replace("\\",".",$path);

    $pageVoirResidence='dossier.residence.voir';

    $pageConnexion="fokontany.security.connexion";

    $pageCreerFokontany="fokontany.creer";

    $pagesNotDiv[]=[$pageConnexion,$pageVoirResidence,$pageCreerFokontany];
    // var_dump($path);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fokontany</title>

    <link rel="stylesheet" href="
       <?php
        
        echo SCRIPTS.'css'.DIRECTORY_SEPARATOR.'fontawesome'.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.'all.min.css';
          
       ?>
    ">


    <link rel="stylesheet" href="
      <?php
        
        echo SCRIPTS.'css'.DIRECTORY_SEPARATOR.'dashbord.css';
          
      ?>
    ">



    <link rel="stylesheet" href="
       <?php
          if($path== $pageVoirResidence)
           {
            echo SCRIPTS.'css'.DIRECTORY_SEPARATOR.'residence-voir.css';
           }

          if($path==$pageConnexion)
          {
            echo SCRIPTS.'css'.DIRECTORY_SEPARATOR.'connexion.css';
          }

          if($path==$pageCreerFokontany)
          {
            echo SCRIPTS.'css'.DIRECTORY_SEPARATOR.'creerFokontany.css';

          }
       ?>
    ">
</head>
<body>

  <!-- SI LE PATH EST EGAL A CES DIFFERENTE PAGES DONC LE CONTENT EST ORPHELIN -->
  <?php
    if($path==$pageConnexion or $path==$pageVoirResidence or $path==$pageCreerFokontany){
  ?>
    <?= $content?>
  <?php
    }
  ?>


   <!-- SI LES PATH SONT DIFFERENTE  -->
  <?php
    if(!($path==$pageConnexion or $path==$pageVoirResidence or $path==$pageCreerFokontany)):
  ?>
    <div class="container">
        <section>

            <div class="left">
                <div class="titre">
                    <h3>Fafana ny Asa</h3>
                </div>

                <div class="dossier">
                    <h3>Dossier</h3>
                    <ul>
                        <li>
                            <a href="#">Hijery</a>
                        </li>
                    </ul>
                </div>

                <div class="secteur">
                    <h3>Sektera</h3>
                    <ul>
                        <li>
                            <a href="/secteur">Hijery</a>
                        </li>
                        <li>
                            <a href="/secteur/creer">Hamorina</a>
                        </li>
                    </ul>
                </div>

                <div class="famille">
                    <h3>Dossier</h3>
                    <ul>
                        <li>
                            <a href="/famille">Hijery</a>
                        </li>
                    </ul>
                </div>


                <div class="personne">
                    <h3>Mponina</h3>
                    <ul>
                        <li>
                            <a href="/personne">Hijery</a>
                        </li>
                    </ul>
                </div>
                
            </div>


            <div class="right">

                <!-- LE HEDAER  -->
                <div class="header">

                    <div class="logo">
                        <h3>
                          <a href="/">
                            Fokontany
                           <?= ucfirst($_SESSION['fokontany']->getNom())?>
                          </a>
                         
                        </h3>
                    </div>
                    <div class="date">
                        <h3>
                          <?=str_replace('/'," ",date('d/M/Y'))?>
                        </h3> 
                    </div>
                    <div class="user">
                        <i class="fa fa-user"
                        id="user"></i>

                        <div class="affichage" id="profil">
                            <ul>
                                <li>
                                    <a href="/profil">voir profil</a>
                                </li>
                                <li>
                                    <a href="/security/deconnexion">deconnexion</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="content">
                  <!-- C EST ICI QU ON MET LE CONTENU  -->
                  <?= $content?>
                </div>
                

            </div>
        </section>
    </div>
  <?php
    endif
  ?>




  <?php
    if(!($path==$pageConnexion or $path==$pageVoirResidence or $path==$pageCreerFokontany)):
  ?>
    <script src=" <?php
        
        echo SCRIPTS.'js'.DIRECTORY_SEPARATOR.'dashbord.js';
          
       ?>"></script>
  <?php
    endif
  ?>
</body>
</html>