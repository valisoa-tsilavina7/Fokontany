
                <?php
                    if(!empty($params['celibataire']) and $params['temoins']):
                    $celibataire=$params['celibataire'];
                    $temoins=$params['temoins'];
                ?>

                    <div class="creerCelibataire">
                        <h3>Manitsy Certificat de Celibataire</h3>

                            <?php

                              if(!empty($params['error'])){
                               foreach($params['error'] as $error):

                            ?>
                              <div class="error">
                                <p><?=$error?></p>
                              </div>
                            <?php
                            endforeach;
                            }
                            ?>

                        <form action="" method="POST">
                            <div class="elements">
                                <label for="motif">Antony angatahana certificat de celibataire: </label>
                                <input type="text" name="motif" id="motif" value="<?=$celibataire->getMotif()?>">
                            </div>

                            <div class="elements">
                                <button name="valider">valider</button>
                            </div>
                            
                        </form>
                    </div>

                    <div class="modifierTemoin">
                        <h3>Ireo Vavolombelona</h3>

                        <table >
                            <tr class="head">
                                <td class="col-2 first">Anarana</td>
                                <td class="col-2">Fanampiny</td>
                                <td class="col-2">Cin</td>
                                <td class="col-2">Toerana Cin</td>
                                <td class="col-2">Daty Cin</td>
                                <td class="col-2">Adresy</td>
                                <td class="col-1"></td>
                            </tr>
                            <?php
                              foreach($temoins as $temoin):
                            ?>
                            <tr>
                                <td class="first"><?=$temoin->getNom() ?></td>
                                <td class="eft"><?=$temoin->getPrenom()?></td>
                                <td class="eft"><?=$temoin->getCin()?></td>
                                <td class="eft"><?=$temoin->getLieuCin()?></td>
                                <td class="eft"><?=$temoin->getDateCin()?></td>
                                <td class="eft"><?=$temoin->getAdresse()?></td>
                                <td class="action">
                                    <button>
                                      <a href="/dossier/temoin-edit/<?=$temoin->getId() ?>">Hovaina</a>
                                    </button>
                                </td>

                            </tr>
                            <?php
                              endforeach
                            ?>
                        </table>
                    </div>

                <?php
                 endif
                ?>