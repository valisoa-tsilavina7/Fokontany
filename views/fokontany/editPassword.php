

<?php
 if(!empty($params['fokontany'])):
   $fokontany=$params['fokontany'];
?>
<div class="editPasswordFokontany">
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
  <form action="/profil/edit-password/<?=$fokontany->getId()?>" method="POST">

      <div class="elements">
          <label for="password">Ampidiro ny Teny Miafina Amin Izao: </label>
          <input type="password" name="password" id="password" placeholder="teny miafina amin izao">
      </div>
                            
                    
      <div class="elements">
          <label for="password1">Ampidiro ny Teny Miafina Vaovao</label>
          <input type="password" name="newPassword[]" id="password1" placeholder="teny miafina vaovao">
      </div>
                           
                        
      <div class="elements">
          <label for="password2">Amafiso  ny Teny Miafina Vaovao</label>
          <input type="password" name="newPassword[]" id="password2" placeholder="amafiso ny teny miafina vaovao">
      </div>
                           
                        
      <div class="elements">
          <button name="valider">Vita</button><br>
      </div>
                            
  </form>
</div>

<?php
 endif
?>
