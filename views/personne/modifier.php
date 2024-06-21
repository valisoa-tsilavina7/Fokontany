

<!-- **********************LE VRAI ***************** -->
<?php


 if(!empty($params['personne']) and isset($params['afficheSexe'])):
  $personne=$params['personne'];

 
  $afficheSexe=$params['afficheSexe'];
?>
<div class="creerPersonne">
  <div class="titre">
      <h3>Hanitsy <?php if(!empty($params['role'])){echo $params['role'];} ?></h3>
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

  <form action="" method="POST">

      <div class="elements">
        <label for="nom">Anarana</label>
        <input type="text" name="nom" id="nom" placeholder="ohatra Rakoto" value="<?=$personne->getNom()?>">
      </div>
                         
                    
      <div class="elements">
          <label for="prenom">Fanampiny</label>
          <input type="text" name="prenom" id="prenom" placeholder="ohatra Mitia"
          value="<?php if($personne->getPrenom()){echo $personne->getPrenom();} ?>">
      </div>
                           
                        
                        
           
      <div class="elements">
      <?php
        //SI PERE ET MERE ET CLIQUE DONC ON AFFICHE PLUS LE SEXE
        if($afficheSexe===true):
      ?>
            <label for="">Sexe</label>
             <input type="radio" name="sexe" id="homme" value="homme"
                  <?php
                     if($personne->getSexe()=="homme") echo "checked";
              ?>
             > <label for="homme">Lehilahy</label>
             <input type="radio" name="sexe" id="femme" value="femme"
                   <?php
                     if($personne->getSexe()=="femme") echo "checked";
                   ?>
             > <label for="femme">Vehivavy</label><br><br>
      <?php
        endif
      ?>
      </div>
      
                           
                            
      <div class="elements">
        <label for="pere">Ray</label>
        <input type="text" name="pere" id="pere" placeholder="Rakotovao" value="<?=$personne->getPere()?>">
      </div>
                           
                        

      <div class="elements">
         <label for="mere">Reny</label>
        <input type="text" name="mere" id="mere" placeholder="Rakotovao" value="<?=$personne->getMere()?>">
      </div>

                          
                        
      <div class="elements">
          <label for="dateNaissance">Taona Nahaterahana</label>
          <input type="date" name="dateNaissance" id="dateNaissance" value="<?=$personne->getDateNaissance()?>">
      </div>
                        
                            

      <div class="elements">
          <label for="lieuNaissance">Toerana Nahaterahana</label>
          <input type="text" name="lieuNaissance" id="lieuNaissance" placeholder="ohatra Befelantanana" value="<?=$personne->getLieuNaissance()?>">
      </div>
                           
        <div class="elements">
          <label for="cin">Karam_panondro</label>
          <input type="text" name="cin" id="cin"
           placeholder="" value="<?=$personne->getCin()?>">
        </div>
                          

      <div class="elements">
          <label for="lieuCin">Toerana nanovana Karam_panondro</label>
          <input type="text" name="lieuCin" id="lieuCin" placeholder="" value="<?=$personne->getLieuCin()?>">
      </div>

      <div class="elements">
          <label for="dateCin">Taona Nanaovana Karam_panondro</label>
          <input type="date" name="dateCin" id="dateCin" value="<?=$personne->getDateCin()?>">
      </div>
                        
                       
                           
                        
      <div class="elements">
          <label for="profession">Asa atao </label>
          <input type="text" name="profession" id="profession" placeholder="" value="<?=$personne->getProfession()?>">
      </div>


      <div class="elements">
               <label for="vie">Fahavelomana</label>
             <input type="radio" name="vie" id="vie" value=1
                 <?php
                    if($personne->getVie()===true) echo "checked";
                 ?>
             ><label for="vie">Velona</label>

             <input type="radio" name="vie" id="mort" value=0
                   <?php
                    if($personne->getVie()===false) echo "checked";
                 ?>><label for="mort">Maty</label>
      </div>
                        
      <div class="elements">
          <button name="valider">valider</button>
      </div>
                    
                        
  </form>
</div>

<?php
endif
?>
