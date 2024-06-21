


  <div class="listeFamille">

      <?php
        if(!empty($params['secteur'])):

      ?>
          <div class="titreTable">
            <h3>Sektera:  <?=$params['secteur']->getNom()?></h3>
            <a href="/famille/creer/<?=$params['secteur']->getId()?>">Hamorina Fianakaviana </a>
          </div>
      <?php
        endif
      ?>      

      <?php
         if(!empty($params['familles'])):
          $familles=$params['familles'];
          $peres=$params['peres'];
          $meres=$params['meres'];
          $familles=$params['familles'];

      ?>
            <table>
              <tr class="titre">
                  <td class="col-3 col-left">Lot</td>
                  <td class="col-2">Ray</td>
                  <td class="col-2">Reny</td>
                  <td class="col-2"></td>
                  <td class="col-1"></td>
              </tr>
                  
              
              <?php
                foreach($familles as $famille):
              ?>
              <tr>
        
                <td class="col lot"><?=$famille->getAdresse()?></td>
                                
                  <td class="col pere ">
                      <?php 

                         $pereFamille=null;

                         if(!empty($peres))
                         {
                             foreach($peres as $pere)
                            {
             
             
                              if($pere->getFamille_id()===$famille->getId())
                              {
                             $pereFamille=$pere->getNom() ." ".$pere->getPrenom();
                              }
                            }

                            if($pereFamille)
                            {
                              echo $pereFamille;
                            }else
                            {
                             echo "mbola tsy misy ";
                            }
                        }else
                        {
                          echo "mbola tsy misy";
                        }
                         
                      ?>
                  </td>

                  <td class="col mere">
                    <?php 
                      $mereFamille=null;
                      if(!empty($meres))
                      {
                        foreach($meres as $mere)
                        {
                          if($mere->getFamille_id()===$famille->getId())
                          {
                            $mereFamille= $pere->getNom() ." ".$mere->getPrenom();
                  
                          }
                
                        }

                        if($mereFamille)
                        {
                          echo $mereFamille;
                        }else
                        {
                          echo "mbola tsy misy ";
                        }
                      }else
                      {
                        echo "mbola tsy misy";
                      }
                        
                    ?>
                  </td>
                                
                  <td class="col secteur">
                    <?=$famille->getCaractere()?>
                  </td>

                  <td class="cols action">
                      <button class="voir">
                        <a href="/famille/<?=$famille->getId()?>">Hijery</a>
                      </button>
                      <button class="voir">
                        <a href="/famille/edit/<?=$famille->getId()?>">Hahitsy</a>
                      </button>

            
          
                        <form action="/famille/delete/<?=$famille->getId()?>" method="POST">
                          <button>
                              <i class="fa fa-trash-alt"></i>
                          </button>
                        </form>
                                    
                  </td>

              </tr>
              <?php
                endforeach
              ?>
                            
          </table>
        <?php
         endif
        ?>

  </div>