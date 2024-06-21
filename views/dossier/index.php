
<!-- ***************************VOIR D  -->
<div class="voirDossierPersonne">


      <?php
       if(!empty($params['personne']) and !empty($params['role'])):
         $personne=$params['personne'];
         $role=lcfirst($params['role']);
      ?>
      <div class="titre">
          <h3>Hamorona Taratasy</h3>

          <div class="option">
              <button>
                <a href="/dossier/residence-<?=$role?>/<?=$personne->getId()?>">certificat de residence</a>
              </button>
              <button>
                <a href="/dossier/celibataire-<?=$role?>/<?=$personne->getId()?>">certificat de celibataire</a>
              </button>
             
          </div>

          <h3>Taratasy natao : 
              <?php
                if(!empty($params['toutCertificats'])){
                  $toutCertificats=$params['toutCertificats'];
                  $total=0;
                  foreach($toutCertificats as $cle)
                  {
                    $total=$total+count($cle);
                  }

                  if($total!=0){echo $total;}else{echo "tsy mbola nanao taratasy ";}
                }
   
      
              ?>
          </h3>
      </div>
      <?php
       endif
      ?>


          <?php
               if(!empty($params['toutCertificats'])):
   
                 $toutCertificats=$params['toutCertificats'];
   

                 foreach($toutCertificats as $cle =>$valeur)
                 {
   
    
          ?>
             <div class="certificat">

              <?php
               if(count($toutCertificats[$cle])!=0):

                $certificat=$toutCertificats[$cle];

              ?>
                 <div class="titreCertificat">
                     <h3><?php echo "Certificat de ".ucfirst($cle); ?>: <?=count($certificat)?> </h3>
                 </div>

                      <table >
                        <tr class="head">
                            <td class="col-1 first">Id</td>
                            <td class="col-3">Antony</td>
                            <td class="col-3">Natao</td>
                            <td class="col-3">Nahitsy</td>
                            <td class="col-3">action</td>
                        </tr>
                        <?php
                          foreach($certificat as $dossier):
                        ?>

                          <tr>
                            <td class="first"><?=$dossier->getId()?></td>
                            <td class="eft"><?=$dossier->getMotif()?></td>
                            <td class="eft"><?= str_replace("/"," ",$dossier->getCreatAt()) ?></td>
                            <td class="eft"><?=str_replace("/"," ",$dossier->getUpdatAt())?></td>
                            <td class="action">
                                <button>
                                  <a href="<?php echo'/dossier/'.$cle.'-voir/'.$dossier->getId()?>">Hijery</a>
                                </button>
                                <button>
                                  <a href="<?php echo'/dossier/'.$cle.'-edit/'.$dossier->getId()?>">Hovaina</a>
                                </button>
                                <form action="<?php echo'/dossier/'.$cle.'-supprimer/'.$dossier->getId()?>" method="POST">
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
                endif
              ?>

             </div>

          <?php
              }
           endif
          ?>



</div>
