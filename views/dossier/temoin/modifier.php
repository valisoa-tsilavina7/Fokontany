


          <?php
            

            if(!empty($params['temoin'])):
               $temoin=$params['temoin'];
           
          ?>           
                <div class="creerTemoin">
                        <h3>Hanova Vavolombelona</h3>

                          <?php

                           if(!empty($params['error'])){
                              foreach($params['error'] as $error):

                           ?>
                               <div class="error">
                                  <p><?=$error?></p>
                               </div>
                           
                          <?php
                           endforeach;
                           }
                          ?>
                      


                        <form action="" method="POST">

                            <div class="elements">
                                <label for="nom">Anarana</label>
                                <input type="text" name="nom" id="nom" placeholder="ohatra Rakoto" value="<?= $temoin->getNom() ?>">
                            </div>
                           
                        
                            <div class="elements">
                                <label for="prenom">Fanampiny</label>
                                <input type="text" name="prenom" id="prenom" placeholder="ohatra Mitia"
                                value="<?= $temoin->getPrenom() ?>">
                            </div>
                          
                        
                        
                            

                            <div class="elements">
                                  <label for="">Sexe</label>
                                    <input type="radio" name="sexe" id="homme" value="homme"<?php if($temoin->getSexe()=="homme") echo "checked";?>> <label for="homme">Lehilahy</label>
                                      <input type="radio" name="sexe" id="femme" value="femme"
                                          <?php
                                            if($temoin->getSexe()=="femme") echo "checked";
                                                ?>> <label for="femme">Vehivavy</label>
                            </div>
                           
                        
                            
                        

                            <div class="elements">
                                <label for="pere">Ray</label>
                                <input type="text" name="pere" id="pere" placeholder="Rakotovao" value="<?= $temoin->getPere() ?>">
                            </div>
                            
                        

                            <div class="elements">
                                <label for="mere">Reny</label>
                                <input type="text" name="mere" id="mere" placeholder="Ravao" value="<?= $temoin->getMere() ?>">
                            </div>
                           
                        
                        

                            <div class="elements">
                                <label for="dateNaissance">Taona Nahaterahana</label>
                                <input type="date" name="dateNaissance" id="dateNaissance"
                                value="<?= $temoin->getDateNaissance() ?>">
                            </div>
                           
                        

                            <div class="elements">
                                <label for="lieuNaissance">Toerana Nahaterahana</label>
                                <input type="text" name="lieuNaissance" id="lieuNaissance"
                                placeholder="ohatra Befelantanana" value="<?= $temoin->getLieuNaissance() ?>">
                            </div>
                           
                        

                            <div class="elements">
                                <label for="cin">Karam_panondro</label>
                                <input type="text" name="cin" id="cin"
                                placeholder="" value="<?= $temoin->getCin() ?>">
                            </div>
                           
                        

                            <div class="elements">
                                <label for="lieuCin">Toerana nanovana Karam_panondro</label>
                               <input type="text" name="lieuCin" id="lieuCin"
                                  placeholder="" value="<?= $temoin->getLieuCin() ?>">
                            </div>
                            
                        

                            <div class="elements">
                                <label for="dateCin">Taona Nanaovana Karam_panondro</label>
                               <input type="date" name="dateCin" id="dateCin" value="<?= $temoin->getDateCin() ?>">
                            </div>
                            
                        
                        

                            <div class="elements">
                                <label for="profession">Asa aman_-draharaha </label>
                                <input type="text" name="profession" id="profession"
                                placeholder="" value="<?= $temoin->getProfession() ?>">
                            </div>
                           
                        

                            <div class="elements">
                                <label for="adresse">Monina ao amin ny Lot: </label>
                                <input type="text" name="adresse" id="adresse"
                            placeholder="" value="<?= $temoin->getAdresse() ?>">
                            </div>
                            
                        

                            <div class="elements">
                                <button name="valider">valider</button>
                            </div>
                            
                            
                        
                        </form>
                </div>

          <?php
           endif
          ?>