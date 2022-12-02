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

//Echanger les valeurs du lieu de départ et du lieu d'arriver
function swapDepartArrivee()
{
    depart = document.getElementById("lieuDepart");
    arrivee = document.getElementById("lieuArrivee");

    if(depart.value == '18 Rue Louis Beaunier, 77000 Melun, France') 
    {
        temp = arrivee.value;
        arrivee.value = depart.value;
        depart.value = temp;
        arrivee.setAttribute('readonly', "");
        depart.removeAttribute('readonly');
        arrivee.style.backgroundColor='lightgrey';
        depart.style.backgroundColor='white';
        
    }
    else if(arrivee.value == '18 Rue Louis Beaunier, 77000 Melun, France')
    {
        temp = arrivee.value;
        arrivee.value = depart.value;
        depart.value = temp;
        depart.setAttribute('readonly', "");
        arrivee.removeAttribute('readonly');
        depart.style.backgroundColor='lightgrey';
        arrivee.style.backgroundColor='white';

    }
        
}

// geolocalisation dans le input via l'icone
function insert_geoloaction_in_input(e)
{
    if (navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition((position) => {
            get_name_by_coords(position.coords.latitude, position.coords.longitude)
            .then(data => {
                e.parentNode.nextElementSibling.value = data
            })
        })
    }
    else
    {
        e.parentNode.nextElementSibling.value = "Localisation non opérationelle"
    }
}

function suggestion_addresse_dans_input(e)
{
    var input = e.parentNode.previousElementSibling
    input.value = e.innerHTML
}

function voir_plus(e)
{
    e.style.tranform = "scale(1.5)";
}
// Fontions pour l'API Mapquest
L.mapquest.key = "VC4Q3NkDA3A6FHjylBKhWXPGxKBe2OMo"

// affiche les résultats dans les input de la création d'annonce
function affiche_resultat(e, value) 
{
    if(value)
    {
        var div = e.nextElementSibling
        var counter = 0
        empty_a_div(div)
        if (counter == 0)
        {
            get_place_by_name(value).then(data => {
                if(data)
                {
                    data.results.forEach(function(result) {
                        var element = document.createElement("a")
                        element.classList.add("list-group-item")
                        element.classList.add("list-group-item-action")
                        element.setAttribute("onmousedown", "suggestion_addresse_dans_input(this);")
                        element.innerHTML = result.displayString
                        div.appendChild(element)
                    })
                }
            })
            counter++
        }
    }
}

// fonction simple qui vide une div passée en argument
function empty_a_div(div_elem)
{
    var count = div_elem.childElementCount
    if (count > 0)
    {
        while (count > 0)
        {
            var child = div_elem.firstElementChild
            div_elem.removeChild(child)
            count = div_elem.childElementCount
        }
    }
}

// regarde pas le reste ça marche c'est le principal
async function get_coords_by_name(adresse)
{
    body_request = {method: 'POST', body: '{"location": "' + adresse + '"}'}
    request = new Request("http://www.mapquestapi.com/geocoding/v1/address?key="+ L.mapquest.key, body_request)
    obj_lat_lng  = await fetch(request)
        .then((response) => response.json())
        .then((data => {
            return data.results[0].locations[0].latLng;
        }))

    var data = {
        latitude : obj_lat_lng.lat,
        longitude : obj_lat_lng.lng
    }

    return await data
}

async function get_name_by_coords(lat, lng)
{
    url = "http://www.mapquestapi.com/geocoding/v1/reverse?key=" + L.mapquest.key + "&location=" + lat + "," + lng + "&includeRoadMetadata=true&includeNearestIntersection=true"
    request = new Request(url)
    obj_lat_lng  = await fetch(request)
        .then((response) => response.json())
        .then((data => {
            return data.results[0].locations[0].street + ", " + data.results[0].locations[0].adminArea5 + ", " + data.results[0].locations[0].postalCode;
        }))

    return await obj_lat_lng

}

function get_position()
{
    return new Promise((res, rej) => {
        navigator.geolocation.getCurrentPosition(res, rej)
    })
}

async function get_place_by_name(name)
{
    let url = ""

    if (name.includes(" "))
    {
        name = name.replaceAll(" ", "+")
    }

    if (name.length > 2)
    {
        let status = await navigator.permissions.query({name: "geolocation"})

        switch(status.state)
        {
            case "denied":
                url = "http://www.mapquestapi.com/search/v3/prediction?key=" + L.mapquest.key + "&q=" + name + "&collection=adminArea,poi,address,category,franchise,airport"
                break
            
            case "granted":
                var pos = await get_position()
                url = "http://www.mapquestapi.com/search/v3/prediction?key=" + L.mapquest.key + "&q=" + name + "&collection=adminArea,poi,address,category,franchise,airport&location=" + pos.coords.longitude + "," + pos.coords.latitude
                break  
        }

        result = await fetch(url)
            .then((response) => response.json())
            .then((data => {
                return data
            }))
        return await result
    }
}

function get_info_intineraire(adresse1 , adresse2)
{
    for (let i = 0; i < arguments.length; i++)
    {
        if (arguments[i].includes(" "))
        {
            arguments[i] = arguments[i].replaceAll(" ", "+")
        }
    }
    url = "http://www.mapquestapi.com/directions/v2/route?key="+ L.mapquest.key +"&unit=k&from="+ adresse1 +"&to="+ adresse2 +""

    var request = fetch(url)
                .then(res => res.json())
                .then(data => {
                    return data
                })
    return request
}

async function calc_center_map(adresse1, adresse2)
{
    var data1 = await get_coords_by_name(adresse1)
    var data2 = await get_coords_by_name(adresse2)

    var latitude = (data1.latitude + data2.latitude) / 2
    var longitude = (data1.longitude + data2.longitude) / 2

    var result = [latitude, longitude]
    return result
}

async function create_map_route(adresse1, adresse2, id_trajet)
{
    var center_map = await calc_center_map(adresse1, adresse2)
    var map = L.mapquest.map("map-" + id_trajet, {
        center: [center_map[0], center_map[1]],
        layers: L.mapquest.tileLayer('map'),
        zoom: 15    
    })
    
    L.mapquest.directions().route({
        start: adresse1,
        end: adresse2
    })
}