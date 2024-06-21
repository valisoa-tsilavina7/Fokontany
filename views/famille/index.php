

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