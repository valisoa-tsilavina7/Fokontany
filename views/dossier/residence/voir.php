<?php

use App\Entity\Fokontany;

  if(!empty($params['residence']) and !empty($params['personne']) and !empty($params['famille']) 
  and !empty($params['secteur']) ):

    $residence= $params['residence'];
    $personne=$params['personne'];
    $famille=$params['famille'];
    $secteur=$params['secteur'];
    $fokontany=$params['fokontany'];


?>
<header>


       <div class="distric">
        <h3>MINISTERAN NY ANTITANY</h3>
        <h3>PREFECTORAN NY POLISY   <span class="maj" style="text-transform:uppercase;"><?=($fokontany->getDistrict())?></span></h3>
        <h3><span class="maj" style="text-transform:uppercase;"><?=$fokontany->getCommune()?></span></h3>
       </div>

       <div class="pays">
        <h3>REPOBLIKAN NY MADAGASIKARA</h3>
        <h4>Fitiavana-Tanindrazana-Fandrosoana</h4>
       </div>


</header>
<div class="section">
        <p>Ny sefom_pokotany eto <span><?=$fokontany->getNom()?></span>  dia manamarina fa</p>


        <div class="content ">
            <div class="nom col-2">
                <h3>Anarana: <span><?= $residence->getNom()?> </span> </h3>
                <h3>Fanampiny: <span><?php if($residence->getPrenom()){echo $residence->getPrenom();} ?></span></h3>
            </div>
           
            <div class="naissance col-2">
                <h3>Teraka tamin ny:  <span><?= $residence->getDateNaissance()?></span></h3> 
                <h3>Tao : <span><?= $residence->getLieuNaissance()?></span></h3>
            </div>

            <?php
               if(!empty($residence->getCin())):
            ?>
                <div class="cin col-3">
                   <h3>Karapanondro: <span><?= $residence->getCin()?></span></h3> 
                   <h3>tamin ny: <span><?= $residence->getDateCin()?></span></h3>
                   <h3>tao:  <span><?= $residence->getLieuCin()?></span></h3>
                </div>
            <?php
            endif
            ?>


           <?php
               if(!empty($residence->getPasseport())):
            ?>
                <div class="passeport col-3">
                   <h3>Pasipaoro: <span><?= $residence->getPasseport()?></span></h3> 
                   <h3>tamin ny: <span><?= $residence->getDatePasseport()?></span></h3>
                   <h3>hatramin ny: <span><?= $residence->getDateValidePasseport()?></span></h3>
                </div>
            <?php
            endif
            ?>
            

            <div class="parent col-2">
                <h3>Ray:   <span> <?= $residence->getPere()?></span></h3>
                <h3>Reny:  <span> <?= $residence->getMere()?></span></h3>

            </div>

            <div class="national col-2">
                <h3>Asa am-ndraharaha: <span><?= $residence->getProfession()?></span></h3>
                <h3>Zom-pirenena: <span><?= $residence->getNationalite()?></span></h3>
            </div>
        
            <div class="adresse col-2">
                <h3>Monina ao amin ny Lot: <span><?=$famille->getAdresse()?></span></h3>
                <h3>Voasoratra ao amin ny listrin ny mponina laharana faha: <span><?= $residence->getPersonne_id()?></span> </h3>
            </div>

            <div class="motif col-2">
                <h3>
                    Antony: <span><?= $residence->getMotif()?></span>
                </h3>
                <h3>
                    residence laharana:  <span><?= $residence->getId()?></span>
                </h3>
            </div>


            <div class="pied" >
                <h3><span><?=$fokontany->getDistrict()?></span>,
                 <span>
                     <?php
                        $date= explode("le",$residence->getUpdatAt());
                        $date=str_replace("/"," ",$date[0]);
                        echo $date;
                     ?>
                 </span></h3>
                <h3>
                    Ny Sefo-fokontany
                </h3>
            </div>


        </div>
        
</div>

<?php
  endif
?>
