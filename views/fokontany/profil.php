
<div class="voirProfilFokontany">
    <div class="titreTable">
        <h3>Momba ny Fokontany</h3>
                           
    </div>
    
    <table >
        <tr class="titre">
            <td class="col-3 col-left" >Fokontany</td>

            <td class="col-2">Kaomina</td>

            <td class="col-2">Distrika</td>

            <td class="col-2"></td>

        </tr>
        <tr>
            <td class="col-left"><?=$params['fokontany']->getNom()?></td>
            <td class="col"><?=$params['fokontany']->getCommune()?></td>
            <td class="col"><?=$params['fokontany']->getDistrict()?></td>
            <td class="col">
                <button>
                   <a href="/profil/edit/<?=$params['fokontany']->getId()?>">Hahitsy</a>
                </button>
            </td>
        </tr>
    </table>
                        
    <div class="date">
        <h4>Noforonina : <?=str_replace('/'," ",$params['fokontany']->getCreatAt())?></h4>
        <h4>Nahitsy : <?=str_replace('/'," ",$params['fokontany']->getUpdatAt())?></h4>
    </div>    
</div>