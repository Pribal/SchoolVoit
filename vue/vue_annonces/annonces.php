<?php
?>


<!-- Bouton/Offcanvas Form Ajouter  -->
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Ajouter une annonce</button>

<div class="offcanvas offcanvas-end offcanvas-right" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel" style='width: 43vw;'>
  <div class="offcanvas-header">
    <h3  style='text-align:center; width:100%;'class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Ajouter une annonce</h3>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form style='text-align:center; font-size:20px;' method="POST" action="index.php?ctl=annonce&action=ValidAjout">
        <div class='mb-3'>   
            <label for="DateTrajet" class="form-label">Date du trajet</label>
            <input type="datetime-local" class="form-control" id="DateTrajet" name='dateTrajet'>
        </div>
        <div style='display:flex; width:100%; justify-content:space-between; align-items: center;'>
            <div class='mb-3' style="width:45%; display:flex; flex-direction:column;align-items:center;">   
                <label for="DateTrajet" class="form-label">Lieu de départ</label>
                <input type="text" class="form-control" id="DateTrajet" name="lieuDepart">
            </div>
                <lord-icon
                    src="https://cdn.lordicon.com/qeberlkz.json"
                    trigger="loop-on-hover"
                    colors="primary:#000000"
                    state="hover"
                    style="width:50px;height:50px">
                </lord-icon>
            <div class='mb-3' style="width:45%; display:flex; flex-direction:column;align-items:center;">     
                <label for="DateTrajet" class="form-label">Lieu d'arrivée</label>
                <input type="text" class="form-control" id="DateTrajet" name="lieuArrivee">
            </div>
        </div>
        <div class='mb-3'>   
            <label for="nbPlace" class="form-label">Nombre de places</label>
            <select id='nbPlace' name='nbPlace'>
                <?php
                for($i=0;$i<=10;$i++)
                {
                    echo "<option value=".$i.">".$i."</option>";
                }
                ?>
            </select>
        </div>

        <div class='mb-3'>   
            <label for="voiture" class="form-label">Voiture utilisé</label>
            <select id='idcar' name='idcar'>
                <?php
                    foreach($listecar as $ligne)
                    {
                        echo "<option value=".$ligne['id_car'].">".$ligne['id_car']." ".$ligne['marque']." ".$ligne['modele']."</option>";
                    }
                ?>
            </select>
        </div>

        <div class='mb-3'>
            <label class="form-label">Fumeur autorisé ?</label>
            <input type="radio" id="contactChoice1"
            name="fumeur" value="1" >
            <label for="contactChoice1">Oui</label>
            <input type="radio" id="contactChoice2"
            name="fumeur" value="0" checked>
            <label for="contactChoice2">Non</label>
        </div>
        
        <button type="submit" class="btn btn-dark">Ajouter</button>
    </form>
  </div>
</div>