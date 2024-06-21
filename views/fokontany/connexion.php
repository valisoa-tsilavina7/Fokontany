<h2>FIDIRANA </h2><br>

<?php

 if(isset($params) and !is_null($params['error'])):
?>

   <h3><?=$params['error']?></h3>
<?php
 endif
?>
<form action="/connexion" method="POST">

    <label for="password">Ampidiro ny teny Miafina</label>
    <input type="password" name="password" id="password"><br><br>

    <button name="valider">valider</button>
</form>