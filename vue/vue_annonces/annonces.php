<style>
    #bouton_ajout_annonce {
        height: 50%; 
        background-color: transparent; 
        color: black;
        border: none;
        border-radius: 0;
        /* transition: border-bottom .5s; */
        border-radius: 15px;
    }

    #bouton_ajout_annonce:hover {
        border-bottom: blue solid 2px;
        border-radius: 0;
    }

    hr {
        width: 50%;
        color: blue;
        margin: 0 auto;
    }

    #annonces {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>

<div id="header_annonce" style="display: flex; font-family: Verdana; height: 10vh;">
    <div id="welcome" style="width: 50%; display: flex; justify-content: center; align-items: center;">
        <h4>Bienvenue <span style="font-size: larger; background-image: url(vue/images/confetti-5.gif); font-size: 50px; font-weight: bolder; color: transparent;  background-clip: text; -webkit-background-clip: text;"><?= ucfirst($_SESSION["prenom"]) ?></span></h4>
    </div>
    <div id="ajout_annonce" style="width: 50%; display: flex; justify-content: center; align-items: center;">
        <button class="btn btn-primary" id="bouton_ajout_annonce" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Ajouter une annonce</button>
    </div>
</div>
<br><hr><br>
<div id="annonces">
    <h3>Voici les Annonces les plus proche de chez vous</h3>
    <br>
    <?php
    foreach($listeAnnonce as $ligne)
    {    
        echo "<br> Annonce ".$ligne["id_trajet"]."<br>";
        echo $ligne['depart']."<br>";
        echo $ligne['lieu_depart']."<br>";
        echo $ligne['lieu_arrivee']."<br>";
        echo $ligne['nb_place']."<br>";
        echo $ligne['fumeur']."<br>";
    }
    ?>
</div>


<!-- OffCanvas -->
>>>>>>>>> Temporary merge branch 2
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