
<?php
  if(!empty($params['personne'])):
    $personne=$params['personne'];
?>


<div class="creerResidence">
  <h3>Certificat de Residence</h3> 
        <?php
          if(!empty($params['error'])):
            foreach($params['error'] as $error){
        ?>
          <div class="error">
            <p><?=$error?></p>
          </div>
   
        <?php
            }
         endif
        ?>
       
    <form action="" method="POST">
  
      <!-- ON N AFFICHERA PAS LE CIN SI IL N Y PAS  -->

      <div class="elements">
          <label for="passeport">Pasipaoro</label>
          <input type="text" name="passeport" id="placeholder="" >
      </div>
                            

      <div class="elements">
          <label for="datePasseport">Daty nanaovana ny passeport</label>
          <input type="date" name="datePasseport" id="datePasseport" placeholder="">
      </div>
                        
                            
                    
      <div class="elements">
          <label for="dateValidePasseport">Daty ny faharetan ny passeport</label>
          <input type="date" name="dateValidePasseport" id="dateValidePasseport" placeholder="">
      </div>
                               
                        
                          
      <div class="elements">
          <label for="nationalite">Zo-mpirenena</label>
          <input type="text" name="nationalite" id="nationalite" value="Malagasy">
      </div>
                           
                    

      <div class="elements">
          <label for="motif">Antony</label>
          <input type="text" name="motif" id="motif" value="">
      </div>
                          
                        
                    
      <div class="elements">
          <button name="valider">Havoaka</button>
      </div>

                            
    </form>
                        
</div>

<?php
  endif;
?>
