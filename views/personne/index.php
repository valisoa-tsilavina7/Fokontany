
                <div class="voirPagePersonnes">
                        <h3>Mponina rehetra</h3>
                        <?php
                             if(!empty($params['personnes']) and !empty($params['secteurs']) and !empty($params['familles']) and !empty($params['dossiers'])):

                              $personnes=$params['personnes'];
                              $familles=$params['familles'];
                              $dossiers=$params['dossiers'];
                              $secteurs=$params['secteurs'];

                        ?>
                        <table >
                            <tr class="head">
                              <td class="col-1 first">Id</td>
                              <td class="col-2">Anarana</td>
                              <td class="col-2">Fanampiny</td>
                              <td class="col-1">Sexe</td>
                              <td class="col-2">Cin</td>
                              <td class="col-2">Asa</td>
                              <td class="col-2">Ray</td>
                              <td class="col-2">Reny</td>
                              <td class="col-2">Adresse</td>
                              <td class="col-2">Sektera</td>
                              <td class="col-1">Dossier</td>
                              <td class="col-3"></td>
                            </tr>
                            <?php
                               foreach($personnes as $personne):
                            ?>
                            <tr class="valeur">
                              <td class="first">
                                 <?=$personne->getId() ?>
                              </td>
                              <td >
                               
                                <?=$personne->getNom()?>
                            </td>
                              <td>
                                
                                <?=$personne->getPrenom()?>
                            </td>
                              <td>
                           
                              <?=$personne->getSexe()?>
                            </td>
                              <td>
                                
                                <?php if($personne->getCin()){echo $personne->getCin();}else{echo "tsy misy";} ?>
                            </td>
                              <td>
                                
                                <?=$personne->getProfession()?>
                            </td>
                              <td>
                                
                                <?=$personne->getPere()?>
                            </td>
                              <td>
                                
                                <?=$personne->getMere()?>
                            </td>
                          
                              <td>
                                
                                  <!-- POUR TROUVER L ADRRESSE DU FAMILLE  -->
                                 <?php
                                   foreach($familles as $famille)
                                   {
                                      if($famille->getId()===$personne->getFamille_id())
                                      {
                                          echo $famille->getAdresse();
                                      }
                                   }
                                 ?>
                              </td>
                              <td>
                                
                                   <!-- POUR TROUVER LE SECTEURS -->
                                  <?php
                                   foreach($familles as $famille)
                                   {
                                      if($famille->getId()===$personne->getFamille_id())
                                      {
                                          foreach($secteurs as $secteur)
                                          {
                                              if($secteur->getId()===$famille->getSecteur_id())
                                              {
                                                  echo $secteur->getNom();
                                              }
                                          }
                                      }
                                   }
                                 ?>
                              </td>
                          
                              <td>
                              
                                   <!-- POUR TROUVER LE DOSSIERS -->
                                  <?php
                                    $nb=0;
                                   foreach($dossiers as $dossier)
                                   {
                                      
                                      if($dossier->getPersonne_id()==$personne->getId())
                                      {
                                          $nb++;
                                      }
                                   }
                          
                                   echo $nb;
                                 ?>
                              </td>
                              <td>
                                  <?php
                                   foreach($familles as $famille)
                                   {
                                      if($famille->getId()===$personne->getFamille_id())
                                      {
                                          $idFamille=$famille->getId();
                                      }
                                   }
                                 ?>
                                  <button>
                                       <a href="/famille/<?=$idFamille?>">voir</a>
                                  </button>
                              </td>
                          
                            </tr>
                            <?php
                              endforeach //fin foraeach
                            ?>
                              
                          
                        </table>
                        <?php
                            endif //pour le table empty
                        ?>
                </div>