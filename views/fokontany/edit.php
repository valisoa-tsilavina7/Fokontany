
<?php
 if(!empty($params['fokontany'])):
   $fokontany=$params['fokontany'];
?>


<div class="editProfilFokontany" >

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

<h3>Hanova Fokontany</h3>
<form action="/profil/edit/<?=$fokontany->getId()?>" method="POST">

    <div class="elements">
        <label for="nom">Anaran ny fokontany</label>
        <input type="text" name="nom" id="nom" placeholder="nom du fokontany"
         value="<?=$fokontany->getNom()?>">
    </div>
   

    <div class="elements">
        <label for="commune">Anaran ny Kaominina</label>
         <input type="text" name="commune" id="commune" placeholder="nom du Commune"
          value="<?=$fokontany->getCommune()?>">
    </div>
    


    <div class="elements">
        <label for="district">Anaran ny Distrika</label>
        <input type="text" name="district" id="district" placeholder="nom du Disctrict"
        value="<?=$fokontany->getDistrict()?>">
    </div>
   

    <div class="elements">
        <label for="password1">Ampidiro ny Teny Miafina</label>
        <input type="password" name="password" id="password1" placeholder="teny miafina">
    </div>


    <div class="elements">
        <button name="valider">Vita</button>
    </div>
</form>

<div class="passwords">
    <button><a href="/profil/edit-password/<?=$fokontany->getId()?>">Hanova Teny Miafina</a></button>
</div>

</div>


<?php
endif;
?>