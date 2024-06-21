
<!-- ******************** LE VRAI  -->

<?php




 if(!empty($params['secteur']) and !empty($params['famille'])):
    $secteur=$params['secteur'];
    $famille=$params['famille'];

    $nbPersonne=$params['nbPersonne'];
    $nbHomme=$params['nbHomme'];
    $nbFemme=$params['nbFemme'];

?>
<div class="voirFamille" >
  <div class="titre">

      <h3>Adresse: <?=$famille->getAdresse()?> </h3>
      <h3>Toetra: <?=$famille->getCaractere()?></h3>
      <h3>Fianakaviana laharana: <?=$famille->getId()?></h3>
      <h3>Ray: 
                <?php
                  if(!empty($params['infoPere']))
                  {
                    echo $params['infoPere']["nom"]."  ".$params['infoPere']["prenom"];
                  }else
                  {
                    echo "mbola tsy misy Ray voasoratra ";
                  }
                ?>
      </h3>
      <h3>Reny:
                <?php
                  if(!empty($params['infoMere']))
                  {
                    echo $params['infoMere']["nom"]."  ".$params['infoMere']["prenom"];
                  }else
                  {
                    echo "mbola tsy misy Reny voasoratra ";
                  }
                ?>
      </h3>

      <h3>Isan ny olona: 
                <?php
                  if($nbPersonne!=0)
                  {
                    echo $nbPersonne;
                  }else
                  {
                    echo "mbola tsy misy olona";
                  }
                ?>
      </h3>
      <h3>Isan ny lahy: 
                <?php
                  if($nbHomme!=0)
                  {
                    echo $nbHomme;
                  }else
                  {
                    echo "mbola tsy misy Lahy";
                  }
                ?>
      </h3>
      <h3>Isan ny vavy: 
                <?php
                  if($nbFemme!=0)
                  {
                    echo $nbFemme;
                  }else
                  {
                    echo "mbola tsy misy Vehivavy";
                  }
                ?>
      </h3>

    <div class="options">
        <?php
            if($params['pereExiste']===true):
        ?>
          <button>
            <a href="/personne/creer-ray/<?=$famille->getId() ?>">Hamorina Ray</a>
          </button>
       <?php
        endif
       ?>


        <?php
         if($params['mereExiste']===true):
        ?>
        <button>
            <a href="/personne/creer-reny/<?=$famille->getId()?>">Hamorina Reny</a>
        </button>
        <?php
         endif
        ?>
       

       <button>
        <a href="/personne/creer-zanaka/<?=$famille->getId()?>">Hamorina Zanaka</a>
       </button>
       <button>
           <a href="/personne/creer-taiza/<?=$famille->getId()?>">Hamorina Taiza</a>
       </button>
       <button>
           <a href="/personne/creer-vahiny/<?=$famille->getId()?>">Hamorina Vahiny</a>
       </button>
    </div>
  </div>

    

  <?php
    if(!empty($params['pere'])):
        $pere=$params['pere'];
        $role="ray";
  ?>
  <div class="parent">
      <h3>Raim-pianakaviana</h3>

      <div class="detail">
          <h4>Anarana: <?= $pere->getNom() ?></h4>
          <h4>Fanampiny: <?= $pere->getPrenom() ?></h4>
          <h4>Teraka tamin ny: <?= $pere->getDateNaissance()?></h4>
          <h4>Toerana nahaterahana: <?= $pere->getLieuNaissance()?></h4>

          <h4>Karampanondro: <?= $pere->getCin() ?></h4>
          <h4>Toerana nanaovana Karampanondro:  <?= $pere->getLieuCin()?> </h4>
          <h4>Taona nanaovana Karampanondro: <?= $pere->getDateCin() ?></h4>

          <h4>Fahavelomana: <?php if($pere->getVie()){echo "Velona";}else{ echo "Maty";} ?></h4>
          <h4>Asa atao : <?= $pere->getProfession()?></h4>
          <h4>Ray:  <?= $pere->getPere()?></h4>
          <h4>Reny: <?= $pere->getMere()?></h4>
                                   

      </div>
      <div class="option">
        <button>
          <a href="/dossier/index-<?=$role?>/<?=$pere->getId()?>">Hamorona taratasy</a>

        </button>

   
        <button>
    
          <a href="/personne/modifier-<?=$role?>/<?=$pere->getId()?>">Hanova</a>
        </button>

        <form action="/personne/supprimer-<?=$role?>/<?=$pere->getId()?>" method="POST">
           <button> <i class="fa fa-trash-alt"></i></button>
        </form>
      </div>
  </div>

  <?php
    endif
  ?>

  <?php
    if(!empty($params['mere'])):
        $mere=$params['mere'];
        $role="reny";
  ?>
  <div class="parent">
      <h3>Reny-pianakaviana</h3>

      <div class="detail">
          <h4>Anarana: <?= $mere->getNom() ?></h4>
          <h4>Fanampiny: <?= $mere->getPrenom() ?></h4>
          <h4>Teraka tamin ny: <?= $mere->getDateNaissance()?></h4>
          <h4>Toerana nahaterahana: <?= $mere->getLieuNaissance()?></h4>

          <h4>Karampanondro: <?= $mere->getCin() ?></h4>
          <h4>Toerana nanaovana Karampanondro:  <?= $mere->getLieuCin()?> </h4>
          <h4>Taona nanaovana Karampanondro: <?= $mere->getDateCin() ?></h4>

          <h4>Fahavelomana: <?php if($mere->getVie()){echo "Velona";}else{ echo "Maty";} ?></h4>
          <h4>Asa atao : <?= $mere->getProfession()?></h4>
          <h4>Ray:  <?= $mere->getPere()?></h4>
          <h4>Reny: <?= $mere->getMere()?></h4>
                                   

      </div>
      <div class="option">
        <button>
          <a href="/dossier/index-<?=$role?>/<?=$mere->getId()?>">Hamorona taratasy</a>

        </button>

   
        <button>
    
          <a href="/personne/modifier-<?=$role?>/<?=$mere->getId()?>">Hanova</a>
        </button>

        <form action="/personne/supprimer-<?=$role?>/<?=$mere->getId()?>" method="POST">
           <button> <i class="fa fa-trash-alt"></i></button>
        </form>
      </div>
  </div>

  <?php
    endif
  ?>
                           



     <!-- **********************MANARAKA ************ -->
    

    <?php
          if(!empty($params['enfants'])):
              $enfants=$params['enfants'];

        
          foreach($enfants as $enfant)
          {
            $role=lcfirst($enfant->getRoleFamille());
    

    ?>

    <div class="enfant">
      <h3><?=$enfant->getRoleFamille()?></h3>

      <div class="detail">
          <h4>Anarana: <?= $enfant->getNom() ?> </h4>
          <h4>Fanampiny: <?= $enfant->getPrenom() ?></h4>
          <h4>Sexe: <?= $enfant->getSexe() ?></h4>

          <h4>Teraka tamin ny: <?= $enfant->getDateNaissance() ?></h4>
          <h4>Toerana nahaterahana: <?= $enfant->getLieuNaissance() ?></h4>

          <h4>Karampanondro: <?= $enfant->getCin() ?></h4>
          <h4>Toerana nanaovana Karampanondro: <?= $enfant->getLieuCin() ?></h4>
          <h4>Taona nanaovana Karampanondro: <?= $enfant->getDateCin() ?></h4>

          <h4>Fahavelomana: <?php  if($enfant->getVie()==true){echo "Velona";}else{echo"Maty";} ?></h4>
          <h4>Asa atao :<?= $enfant->getProfession() ?></h4>
          <h4>Ray:  <?= $enfant->getPere() ?></h4>
          <h4>Reny:  <?= $enfant->getMere() ?></h4>
                                    
                                    
      </div>
      
      <div class="option">


           <button>
             <a href="/dossier/index-<?=$role?>/<?=$enfant->getId()?>">Hamorona taratasy</a>

           </button>


           <button>
    
             <a href="/personne/modifier-<?=$role?>/<?=$enfant->getId()?>">Hanova</a>
           </button>

           <form action="/personne/supprimer-<?=$role?>/<?=$enfant->getId()?>" method="POST">
              <button>
                <i class="fa fa-trash-alt"></i>
              </button>
           </form>
      </div>
    </div>

    <?php
      }
     endif;
    ?>

                          
</div>

<?php
 endif
?>