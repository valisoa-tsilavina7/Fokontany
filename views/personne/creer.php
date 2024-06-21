
<div class="creerPersonne">
  <div class="titre">
      <h3>Hamorina <?php if(!empty($params['role'])){echo $params['role'];} ?></h3>
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
          <input type="text" name="nom" id="nom" placeholder="ohatra Rakoto">
      </div>
                         
                    
      <div class="elements">
          <label for="prenom">Fanampiny</label>
          <input type="text" name="prenom" id="prenom" placeholder="ohatra Mitia">
      </div>
                           
                        
                        
                        
      <?php
        //SI PERE ET MERE ET CLIQUE DONC ON AFFICHE PLUS LE SEXE
        if(!empty($params['role']) and ($params['role']!="Ray" and ($params['role']!="Reny"))):
      ?>
      <div class="elements">
          <label for="">Sexe</label>
          <input type="radio" name="sexe" id="homme" value="homme"checked  class="sexe"> <label for="homme">Lehilahy</label>
          <input type="radio" name="sexe" id="femme" value="femme"  class="sexe"> <label for="femme">Vehivavy</label>
      </div>
      <?php
        endif
      ?>
                           
                            
      <div class="elements">
          <label for="pere">Ray</label>
          <input type="text" name="pere" id="pere" placeholder="Rakotovao"
            value="<?php 
                                        
                  if(!empty($params['pere']))
                    {
                      echo $params['pere']->getNom()." ".$params['pere']->getPrenom();
                    }
                ?>"
          >
      </div>
                           
                        

      <div class="elements">
          <label for="mere">Reny</label>
              <input type="text" name="mere" id="mere" placeholder="Ravao"
              value="<?php 
                  if(!empty($params['mere']))
                  {
                      echo $params['mere']->getNom()." ".$params['mere']->getPrenom();
                  }
              ?>"  
              >
      </div>

                          
                        
      <div class="elements">
          <label for="dateNaissance">Taona Nahaterahana</label>
          <input type="date" name="dateNaissance" id="dateNaissance">
      </div>
                        
                            

      <div class="elements">
          <label for="lieuNaissance">Toerana Nahaterahana</label>
          <input type="text" name="lieuNaissance" id="lieuNaissance" placeholder="ohatra Befelantanana">
      </div>
                           
        <div class="elements">
          <label for="cin">Karam_panondro</label>
          <input type="text" name="cin" id="cin"
                                placeholder="">
        </div>
                          

      <div class="elements">
          <label for="lieuCin">Toerana nanovana Karam_panondro</label>
          <input type="text" name="lieuCin" id="lieuCin" placeholder="">
      </div>

      <div class="elements">
          <label for="dateCin">Taona Nanaovana Karam_panondro</label>
          <input type="date" name="dateCin" id="dateCin">
      </div>
                        
                       
                           
                        
      <div class="elements">
          <label for="profession">Asa atao </label>
          <input type="text" name="profession" id="profession"
          placeholder="">
      </div>

                        
      <div class="elements">
          <button name="valider">valider</button>
      </div>
                    
                        
  </form>
</div>