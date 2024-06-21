



<div class="container">

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
       
        

        <form action="/creer" method="POST">

            <div class="element">
                <label for="nom">Anaran ny fokontany</label>
                <input type="text" name="nom" id="nom" placeholder="nom du fokontany">
            </div>
            
    
            <div class="element">
                <label for="commune">Anaran ny Kaominina</label>
                <input type="text" name="commune" id="commune" placeholder="nom du Commune">
            </div>
            
    
            <div class="element">
                <label for="district">Anaran ny Distrika</label>
                <input type="text" name="district" id="district" placeholder="nom du Disctrict">
            </div>
            
    
            <div class="element">
                <label for="password1">Ampidiro ny Teny Miafina</label>
                <input type="password" name="password[]" id="password1" placeholder="teny miafina">
            </div>
            
    
            <div class="element">
                <label for="password2">Amafiso eto ny Teny Miafina </label>
                <input type="password" name="password[]" id="password2" placeholder="fanamasina ny teny miafina">
            </div>
            
    
            <div class="element valider">
                <button name="valider">Vita</button>
            </div>
            
        </form>
</div>