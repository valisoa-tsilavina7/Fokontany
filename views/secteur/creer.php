




    <div class="creerSecteur">
      <div class="titre">
          <h3>Hamorina Sektera</h3>
          <a href="/secteur">Hijery ny Listra Sektera</a>
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

      <form action="/secteur/creer" method="POST">
                            
          <div class="elements">
              <label for="nom">Ampidiro ny Anaran ny Sektera</label>
              <input type="text" name="nom" id="nom">
          </div>
                           

          <div class="elements">
              <button name="valider">valider</button>
          </div>
                
      </form>
    </div>