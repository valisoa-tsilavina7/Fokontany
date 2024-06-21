    <div class="presentation">
                        <div class="element">
                            <div class="enfant"></div>
                            <h3 >Sektera: <?= $params['nbSecteurs'] ?> </h3>
                        </div>
                        <div class="element">
                            <div class="enfant"></div>
                            <h3  >Fianakaviana:  <?= $params['nbFamilles'] ?></h3>
                        </div>
                        <div class="element">
                            <div class="enfant"></div>
                            <h3 >Mponina:  <?= $params['nbPersonnes'] ?></h3>
                        </div>
                        <div class="element">
                            <div class="enfant"></div>
                            <h3 >Dossier: <?= $params['nbDossiers'] ?></h3>
                        </div>
                    </div>



        <div class="listeSecteur">

                        <div class="titreTable">
                            <h3>Listry ny Sektera</h3>
                            <a href="/secteur">Hijery manontolo</a>
                        </div>
                        

                        <?php
                          if(!empty($params['secteurs'])):
                        ?>


            <table >
                            <tr class="titre">
                                <td class="col-3 col-left">Anarana</td>
                                <td class="col-2">Ankohonana</td>
                                <td class="col-2">Mponina</td>
                                <td class="col-2">Action</td>
                            </tr>                    


                        <?php
                           $secteurs= $params['secteurs'];
                          foreach($secteurs as $secteur):
                        ?>                
                    <tr>
                        <td class="  col-left"> <?=$secteur->getNom() ?></td>
                        <td>
                            <?php
                               if(!empty($params['familles']))
                               {
                                 $familles=$params['familles'];
                                 $nbfamilleSecteur=0;
                                 foreach($familles as $famille)
                                 {
                                    if($famille->getSecteur_id()===$secteur->getId())
                                    {
                                        $nbfamilleSecteur++;
                                    }
                                 }

                                 echo $nbfamilleSecteur;
                               }else
                               {
                                echo '0';
                               }
                            ?>
                        </td>

                        <td>
                        <?php
                               if(!empty($params['personnes']))
                               {

                                $familles=$params['familles'];
                                 $personnes=$params['personnes'];
                                 $nbPersonneSecteur=0;

                                 foreach($familles as $famille)
                                 {
                                    if($famille->getSecteur_id()==$secteur->getId())
                                    {
                                        foreach($personnes as $personne)
                                        {
                                            if($personne->getFamille_id()===$famille->getId())
                                            {
                               $nbPersonneSecteur++;
                                            }
                                        }
                                    }
                                 }

                                 echo $nbPersonneSecteur;
                               }else
                   {
                                echo '0';
                               }
                            ?>
                        </td>
                        <td class="action">

                            <button class="voir">
                              <a href="/secteur/<?=$secteur->getId()?>">Hijery</a>
                            </button>

                            <button class="voir">
                               <a href="/secteur/edit/<?=$secteur->getId()?>">Hovaina</a>
                            </button>

                            <form action="/secteur/delete/<?=$secteur->getId()?>" method="POST">
                                <button>
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </form>
               </td>
                    </tr>
                    <?php
             endforeach // TR DU TABLEUAX
                           ?>
   
                           </tr>
   
            </table>

                        <?php
                          endif//fin secteurs existe
                        ?>
        </div>



        <div class="listeFamille">

                      <div class="titreTable">
                          <h3>Listry ny Fianakaviana</h3>
                          
                      </div>


                      <?php 
                        if(!empty($params['familles'])):
                          $familles=$params['familles'];                      
                      ?>
                      <table >
                          <tr class="titre">
                              <td class="col-3 " style="padding-left: 1%;">Lot</td>
                              <td class="col-2">Ray</td>
                              <td class="col-2">Reny</td>
                              <td class="col-2">Sektera</td>
                              <td class="col-1">Action</td>
                          </tr>

                          <?php 
                            foreach($familles as $famille):
                          ?>
                          <tr>
                              <td class="col lot col-left"> <?= $famille->getAdresse() ?> </td>
        
                              <td class="col pere ">
                                 <?php
                                   if(!empty($params['personnes']))
                                   {
                                      $personnes=$params['personnes'];

                                      $pere=null;
                                      foreach($personnes as $personne)
                                      {
                                          if($personne->getId()===$famille->getPere_id())
                                          {
                                              $pere=$personne->getNom() ." ".$personne->getPrenom();
                                          }
                                      }

                                      if($pere)
                                      {
                                          echo $pere;
                                      }else
                                      {
                                          echo "mbola tsy misy Ray";
                                      }
                                   }else
                                   {
                                      echo "tsy mbola misy Ray";
                                   }
                                ?>
                                </td>

                              <td class="col mere">
                              <?php
                                   if(!empty($params['personnes']))
                                   {
                                      $personnes=$params['personnes'];

                                      $mere=null;
                                      foreach($personnes as $personne)
                                      {
                                          if($personne->getId()===$famille->getMere_id())
                                          {
                                              $mere=$personne->getNom() ." ".$personne->getPrenom();
                                          }
                                      }

                                      if($mere)
                                      {
                                          echo $mere;
                                      }else
                                      {
                                          echo "mbola tsy misy Reny";
                                      }
                                   }else
                                   {
                                      echo "tsy mbola misy Reny";
                                   }
                               ?>
                              </td>
        
                              <td class="col secteur">
                                 <?php
                                    $secteurs=$params['secteurs'];

                                    foreach($secteurs as $secteur)
                                    {
                                      if($secteur->getId()===$famille->getSecteur_id())
                                      {
                                          echo $secteur->getNom();
                                      }
                                    }
                                 ?>
                              </td>

                              <td class="cols action">
                                  <button class="voir">
                                      <a href="/famille/<?=$famille->getId()?>">Hijery</a>
                                  </button>

          
                                    <form action="/famille/delete/<?=$famille->getId()?>" method="POST">
                                        <button>
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                    </form>
            
                              </td>

                          </tr>
                          <?php 
                            endforeach // end forach pour familles
                          ?>
    
                      </table>

             <?php 
                endif//fin famille if empty
             ?>

        </div>


                    