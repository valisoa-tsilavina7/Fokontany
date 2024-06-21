
<div class="container">
        
  <div class="logo">
    <i class="fa fa-user"></i>
  </div>
  <form action="/security/connexion" method="POST">

            
    <input type="password" name="password" id="" placeholder="ampidiro ny teny miafina">
    <button name="valider">valider</button>
  </form>
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