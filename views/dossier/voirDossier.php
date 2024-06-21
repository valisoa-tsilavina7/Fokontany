            


            <div class="voirPagesDossier">
                        
                            <h3>Ireo Taratasy : 
                                <?php
                                  if(!empty($params['dossiers'])){
                                    echo count($params['dossiers']);
                                  }else
                                  {
                                    echo "mbola tsy misy";
                                  }
   
      
                                ?>
                            </h3>
                
                    <?php
                        if(!empty($params['personnes'] and !empty($params['dossiers'])) and !empty($params['familles'])):

                            $personnes=$params['personnes'];
                            $dossiers=$params['dossiers'];
                            $familles=$params['familles'];



   

    
                    ?>

                    <div class="residences">
                            <h3>Certificat De Residence: <?php if($params['residences'])
                               {echo count($params ['residences']);}   else{echo "0";} ?> 
                            </h3>


                        <?php
                           if(!empty($params['residences'])):
                            $residences=$params['residences'];
                         ?>
                            <table >
                                <tr class="head">
                                    <td class="col-1 first">Id</td>
                                    <td class="col-2">Antony</td>
                                    <td class="col-3">Mpangataka</td>
                                    <td class="col-2">Natao </td>
                                    <td class="col-2">Nahitsy</td>
                                    <td class="col-3"></td>
                                </tr>

                            <?php
                                foreach($residences as $residence):
                            ?>
                                <tr class="valeur">
                                    <td class="first"> <?=$residence->getId()?> </td>
                                    <td > <?=$residence->getMotif()?></td>
                                    <td>
           
                
                                         <?php
                                           foreach($personnes as $personne){
                                             if($personne->getId()===$residence->getPersonne_id())
                                             {
                                                $value= $personne->getNom()." ".$personne->getPrenom();
                                                $link=$personne->getFamille_id();
               
                                         ?>
                                           <a href="/famille/<?=$link?>"><?=$value?></a>
                                         <?php
                                           }
                                           }
                                         ?>
         
                                    </td>
                                    <td><?=$residence->getCreatAt()?></td>
                                    <td><?=$residence->getUpdatAt()?></td>
                                   
                                    <td class="actions">
                                        <button>
                                            <a href="">Hijery</a>
                                        </button>
                                        <button>
                                            <a href="">Hahitsy</a>
                                        </button>

                                        <form action="">
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
                      endif
                    ?>
            </div>