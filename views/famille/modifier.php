
<div class="creerFamille" >
        <div class="titre">
            <h3>
                Hanitsy fianakaviana
            </h3>
        </div>
        <div class="error">
            
            <?php
             if(!empty($params['error'])){
                foreach($params['error'] as $error):
            ?>

              <p><?=$error?></p>
            <?php
             endforeach;
            }
            ?>
         </div>

          <?php
            if(!empty($params['famille']) and !empty($params['secteur']) and !empty($params['secteurs'])):
              $famille=$params['famille'];
              $secteur=$params['secteur'];
              $secteurs=$params['secteurs'];

          ?>

          <form action="" method="POST">

            <div class="elements">
                <label for="adresse">Ampidiro eto ny lot trano</label>

                <input type="text" name="adresse" id="adresse" placeholder="ohatra lot II A Ambohitsoa"  value="<?=$famille->getAdresse()?>">
            </div>
                            
                        
            <div class="elements">
                <label for="caractere">Ny Toetry ny Trano</label>

                <select name="caractere" id="caractere">
                  <option value="mahaleo_tena" <?php if($famille->getCaractere()=="mahaleo_tena"){echo "selected";}?> >Mahaleo_tena</option>
                    <option value="tompon_trano"
                   <?php if($famille->getCaractere()=="tompon_trano"){echo "selected";}?>
                   >Tompon_trano</option>
                   <option value="mpanofa_trano"
                    <?php if($famille->getCaractere()=="mpanofa_trano"){echo "selected";}?>
                   >Mpanofa_trano</option>
                </select>
            </div>
                           
                        
                           
                    
            <div class="elements">
                <button name="valider">valider</button>
            </div>            
          </form>   
          <?php
            endif
          ?>      
</div>