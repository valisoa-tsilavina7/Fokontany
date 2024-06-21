


<div class="voirSecteur">


<div class="titreTable">
  <h3>Listry ny Sektera</h3>
  <a href="/secteur/creer">Hamorina sektera vaovao</a>
</div>
    

<?php
if(!empty($params['secteur'])){
    $secteur= $params['secteur'];
    
?>
  <table >
  <tr class="titre">
      <td class="col-3 col-left">Anarana</td>
      <td class="col-2">Noforonina</td>
      <td class="col-2">Nahitsy</td>
      <td class="col-2"></td>
  </tr>
  
  <?php
    foreach($secteur as $secteur):
        
  ?>
  <tr>
      <td class="col-left"><?=$secteur->getNom()?></td>
      <td><?= str_replace("/"," ",$secteur->getCreatAt()) ?></td>
      <td><?= str_replace("/"," ",$secteur->getUpdatAt()) ?></td>
      <td class="action">
          <button class="voir">
              <a href="/secteur/<?=$secteur->getId()?>">Hijery</a>
          </button>
    
          <button class="voir">
            <a href="/secteur/edit/<?=$secteur->getId()?>">Hovaina</a>
          </button>
    
          <form action="/secteur/delete/<?=$secteur->getId()?>" method="POST">
            <button>
              <i class="fa fa-trash-alt"></i>
            </button>
          </form>
      </td>
  </tr>
  <?php
   endforeach    
  ?>
</table>

<?php
  }
?>
</div>