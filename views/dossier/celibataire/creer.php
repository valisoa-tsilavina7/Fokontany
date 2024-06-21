
<?php
 if(!empty($params['personne'])):
?>
  <div class="creerCelibataire">
      <h3>Certificat de Celibataire</h3>
     
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
                                <label for="motif">Antony angatahana certificat de celibataire: </label>
                                <input type="text" name="motif" id="motif">
          </div>

          <div class="elements">
              <button name="valider">valider</button>
          </div>
                            
      </form>
  </div>
<?php
endif
?>