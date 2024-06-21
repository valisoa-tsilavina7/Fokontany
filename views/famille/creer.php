<div class="creerFamille" >
        <div class="titre">
            <h3>
                Hamorina fianakaviana
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

        <form action="" method="POST">

            <div class="elements">
                <label for="adresse">Ampidiro eto ny lot trano</label>

                <input type="text" name="adresse" id="adresse" placeholder="ohatra lot II A Ambohitsoa">
            </div>
                            
                        
            <div class="elements">
                <label for="caractere">Ny Toetry ny Trano</label>

                <select name="caractere" id="caractere">
                                    <option value="mahaleo_tena" selected>Mahaleo_tena</option>
                                    <option value="tompon_trano">Tompon_trano</option>
                                    <option value="mpanofa_trano">Mpanofa_trano</option>
                </select>
            </div>
                           
                        
                           
                    
            <div class="elements">
                <button name="valider">valider</button>
            </div>

                            
        </form>         
</div>