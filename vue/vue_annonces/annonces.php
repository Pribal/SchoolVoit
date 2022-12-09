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

    .dropdown-divider {
        width: 100%;
    }

    #annonces {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #annonces_liste {
        display: flex;
        justify-content: space-around;
        gap: 10px;
        flex-wrap: wrap;
        width: 80%;
    }

    .annonce {
        background-color: #fbfffb;
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 20%;
        border-style: outset;
    }

    .annonce > h5 {
        white-space: nowrap;
        margin: 0;
    }

    .list-group-item .list-group-item-action {
        user-select: none; 
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none; 
        -ms-user-select: none;
    }

    .list-group-item:hover .list-group-item-action:hover {
        cursor: pointer;
    }

    .card {
        transition: transform ease-in-out .3s;
    }
    .card:hover{
        transform: scale(1.05)
    }

    .btn_annonce {
        border: none;
        background-color: white;
    }

</style>
<?php
setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');
include("model/fonctions_php.php");
?>

<div id="header_annonce" style="display: flex; font-family: Verdana; height: 10vh; margin-top: 10vh;">
    <div id="welcome" style="width: 50%; display: flex; justify-content: center; align-items: center;">
        <h4>Bienvenue <span style="font-size: larger; background-image: url(vue/images/confetti-5.gif); font-size: 50px; font-weight: bolder; color: transparent;  background-clip: text; -webkit-background-clip: text;"><?= ucfirst($_SESSION["prenom"]) ?></span></h4>
    </div>
    <div id="ajout_annonce" style="width: 50%; display: flex; justify-content: center; align-items: center;">
        <button class="btn btn-primary" id="bouton_ajout_annonce" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Ajouter une annonce</button>
    </div>
</div>
<br><hr><br>
<div id="annonces">
    <h3>Annonces proches de chez vous</h3>
    <br>
    <div id="annonces_liste">
        <?php
        foreach($listeAnnonce as $ligne)
        {   
            $img_url = get_carte_statique_itineraire($ligne["lieu_depart"], $ligne["lieu_arrivee"], "VC4Q3NkDA3A6FHjylBKhWXPGxKBe2OMo");
            ?>
            <button class="btn_annonce btn" type="button" data-bs-toggle="offcanvas" data-bs-target="<?= "#trajet-".$ligne["id_trajet"] ?>" aria-controls="offcanvasBottom" onclick="create_map_route('<?= $ligne['lieu_depart'] ?>','<?= $ligne['lieu_arrivee'] ?>', <?= $ligne['id_trajet'] ?>)">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?= $img_url ?>" style="height: 100%; width: 100%;" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="card-title text-center" style="font-size: small; display: flex; flex-direction: column; align-items: center;">
                                    <?= strtoupper($ligne["lieu_depart"]) ?>
                                    <lord-icon
                                        src="https://cdn.lordicon.com/jxwksgwv.json"
                                        trigger="loop-on-hover"
                                        delay="1000"
                                        colors="primary:#121331"
                                        state="hover-3"
                                        style="width:30px;height:30px; transform: rotate(90deg);">
                                    </lord-icon>
                                    <?= strtoupper($ligne["lieu_arrivee"]) ?>
                                </div>
                                <p class="card-text">
                                    <ul style="list-style: none;">
                                        <li>Le <?= date_to_french($ligne["depart"]) ?></li>
                                        <li>Reste <?= $ligne["nb_placeDispo"] ?> places disponibles</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </button>
            <?php
                $info_annonce = DbAnnonce::getInfoAnnonce($ligne["id_trajet"]);
            ?>
            <div class="offcanvas offcanvas-bottom" data-bs-scroll="false" data-bs-backdrop="false" tabindex="-1" id="<?= "trajet-".$ligne["id_trajet"] ?>" aria-labelledby="offcanvasBottomLabel" style="height: 90vh; display: flex; flex-direction: row;">
                <div id="map-<?= $ligne["id_trajet"] ?>" style="height: 100%; width: 50vw;">
                </div>
                <div style="height: 100%; width: 50vw; display: flex; flex-direction: column;">
                    <div style="display: flex; justify-content: flex-end;">
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" style="transform: scale(1.3);"></button>
                    </div>
                    <div style="display:flex; align-items: center; flex-direction: column; height: 90%; justify-content: space-between;">
                        <h3>Trajet de <?= $info_annonce[0]["prenom"]." ".$info_annonce[0]["nom"] ?></h3>
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <p style="font-size: xxl-large; margin: 0;"><?= $info_annonce[0]["lieu_depart"] ?></p>
                            <img src="vue/images/route.png" style="height: 3em; width: 3em; transform: rotate(90deg);">
                            <p style="font-size: xxl-large;"><?= $info_annonce[0]["lieu_arrivee"] ?></p>
                        </div>
                        <div style="width: 100%;">
                            <div style="display: flex; width: 100%;">
                                <div style="width: 50%; display: flex; align-items: center; flex-direction: column; justify-content: center;">
                                    <p>Distance: <span id="distance"></span>km</p>
                                    <p>Durée du trajet: <span id="temps_trajet"></span></p>
                                </div>
                                <div style="width: 50%; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                    <img src="vue/images/icon_voiture.png" style="height: 4em; width: 4em;">
                                    <h5>Voiture de <?= $info_annonce[0]["prenom"]." ".$info_annonce[0]["nom"] ?>:</h5>
                                    <?= $info_annonce[0]["marque"]." ".$info_annonce[0]["modele"] ?>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; width: 90%; align-items: center; justify-content: center;">
                            <p style="margin: 0;">Spécification du trajet:</p>
                            &nbsp;&nbsp;&nbsp;
                            <img src="<?php if($info_annonce[0]["fumeur"]){echo "vue/images/cigarette.png";}else{echo "vue/images/ne-pas-fumer.png";}?>" style="height: 3em; width: 3em;">
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>


<!-- OffCanvas -->
<div class="offcanvas offcanvas-end offcanvas-right" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel" style='width: 43vw;'>
  <div class="offcanvas-header">
    <h3  style='text-align:center; width:100%;'class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Ajouter une annonce</h3>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form style='text-align:center; font-size:20px;' method="POST" action="index.php?ctl=annonce&action=ValidAjout">
        <div class='mb-3'>   
            <label for="DateTrajet" class="form-label">Date du trajet</label>
            <input type="datetime-local" class="form-control" id="DateTrajet" name='dateTrajet' required>
        </div>
        <div style='display:flex; width:100%; justify-content:space-between; align-items: center;'>
            <div class='mb-3' style="width:45%; display:flex; flex-direction:column;align-items:center;position: relative;">   
                <label for="lieuDepart" class="form-label">Lieu de départ</label>
                <input type="text" class="form-control" id="lieuDepart" name="lieuDepart" onfocusout="empty_a_div(this.nextElementSibling)" oninput='affiche_resultat(this, this.value)' onfocusin='affiche_resultat(this, this.value)' autocomplete="off" value='18 Rue Louis Beaunier, 77000 Melun, France' readonly required style="background-color:lightgrey;">
                <div class="list-group" style="position: absolute; bottom: 0; transform: translateY(100%); width: 100%">
                </div>
            </div>
                <lord-icon id="swap" onclick="swapDepartArrivee()"
                    src="https://cdn.lordicon.com/qeberlkz.json"
                    trigger="loop-on-hover"
                    colors="primary:#000000"
                    state="hover"
                    style="width:50px;height:50px">
                </lord-icon>
            <div class='mb-3' style="width:45%; display:flex; flex-direction:column;align-items:center; position: relative;">     
                <label for="lieuArrivee" class="form-label">Lieu d'arrivée <img src='vue/images/location-sign.png' onclick='insert_geoloaction_in_input(this)' style='height: 10%; width: 10%;'></label>
                <input type="text" class="form-control" id="lieuArrivee" name="lieuArrivee" onfocusout="empty_a_div(this.nextElementSibling)" oninput='affiche_resultat(this, this.value)' onfocusin='affiche_resultat(this, this.value)' autocomplete="off" required>
                <div class="list-group" style="position: absolute; bottom: 0; transform: translateY(100%); width: 100%">
                </div>
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
            <select id='idcar' name='idcar' required>
                <?php
                    foreach($listecar as $ligne)
                    {
                        echo "<option value=".$ligne['id_car'].">".$ligne['marque'].""." ".$ligne['modele']."</option>";
                    }
                ?>
            </select>
        </div>

        <div class='mb-3'>
            <label class="form-label">Fumeur autorisé ?</label>
            <input type="radio" id="contactChoice1" name="fumeur" value="1">
            <label for="contactChoice1">Oui</label>
            <input type="radio" id="contactChoice2"
            name="fumeur" value="0" checked>
            <label for="contactChoice2">Non</label>
        </div>
        
        <button type="submit" class="btn btn-dark">Ajouter</button>
    </form>
  </div>
</div>

<script>
    const swap_button = document.getElementById("swap")
    
    swap_button.addEventListener("click", function() {
        const depart = document.getElementById("lieuDepart")
        const arrive = document.getElementById("lieuArrivee")

        if (depart.readOnly)
        {
            depart.labels[0].innerHTML = "Lieu de départ"
            arrive.labels[0].innerHTML = "Lieu d'arrivée <img src='vue/images/location-sign.png' onclick='insert_geoloaction_in_input(this)' style='height: 10%; width: 10%;'>"
        }
        else{
            arrive.labels[0].innerHTML = "Lieu d'arrivée"
            depart.labels[0].innerHTML = "Lieu de départ <img src='vue/images/location-sign.png' onclick='insert_geoloaction_in_input(this)' style='height: 10%; width: 10%;'>"
        }
    })
</script>