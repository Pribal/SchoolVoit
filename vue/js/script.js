// Fonction afficher/cacher Modifier Voiture
function get_id_parent(e)
{
    // Récup données voiture
    id = e.parentNode.id;
    element = document.getElementById(id);
    immat = element.querySelector('#matricule');
    marque = element.querySelector('#marque');
    modele = element.querySelector('#modele');
    
    document.getElementById("id_car").value = id;
    document.getElementById("marque_form").value = marque.innerHTML; 
    document.getElementById("modele_form").value = modele.innerHTML; 
    document.getElementById("matricule_form").value = immat.innerHTML; 
}

// Fonction vérification de la taille de l'immatriculation (<10)
function verif_immat_ajout(immat)
{
    msg = document.getElementById("immat_error_ajout");
    btn = document.getElementById("btn_ajout");
    if(immat.value.length >= 10)
    {
        msg.style.display = "block";
        btn.setAttribute("disabled", "");
    }
    else
    {
        msg.style.display = "none";
        btn.removeAttribute("disabled");
    }
}

function verif_immat_modif(immat)
{
    msg = document.getElementById("immat_error_modif");
    btn = document.getElementById("btn_modif");
    if(immat.value.length > 10)
    {
        msg.style.display = "block";
        btn.setAttribute("disabled", "");
    }
    else
    {
        msg.style.display = "none";
        btn.removeAttribute("disabled");
    }
}

// Fonction de bidouille pour les hrefs
function valid_del_car(e)
{
    id = e.parentNode.id;
    url_modal = document.getElementById('url_modal');
    url_modal.href = "index.php?ctl=user&action=DelCarUser&id_car=" + id;
}

