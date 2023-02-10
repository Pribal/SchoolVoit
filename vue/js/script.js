// Fonction afficher/cacher Modifier Voiture
async function get_id_parent(e, id_datalist_model)
{
    // Récup données voiture
    id = e.parentNode.id;
    element = document.getElementById(id);
    immat = element.querySelector('#matricule');
    marque = element.querySelector('#marque');
    modele = element.querySelector('#modele');

    empty_datalist(id_datalist_model)
    array_modele = await get_car_model(marque.value)
    fill_datalist(array_modele, id_datalist_model)
    
    
    document.getElementById("id_car").value = id;
    document.getElementById("marque_form").value = marque.value; 
    document.getElementById("modele_form").value = modele.value; 
    document.getElementById("matricule_form").value = immat.value;
}

// Fonction pour vider une datalist par son id passé en paramètre
function empty_datalist(id_datalist)
{
    datalist_element = document.getElementById(id_datalist)
    options = datalist_element.querySelectorAll("option")
    options.forEach((option) => {
        datalist_element.removeChild(option)
    })
}

function fill_datalist(data_array, id_datalist)
{
    datalist_element = document.getElementById(id_datalist)
    data_array.forEach((model) => {
        option = document.createElement("option")
        option.value = model
        option.innerHTML = model
        datalist_element.appendChild(option)
    })  
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

async function get_info_itineraire(ad1, ad2)
{
    if (ad1.includes(" ") || ad2.includes(" "))
    {
        ad1.replaceAll(" ", "+")
        ad2.replaceAll(" ", "+")
    }

    url = "http://www.mapquestapi.com/directions/v2/route?key="+ L.mapquest.key +"&unit=k&locale=fr_FR&from="+ad1+"&to="+ad2

    result = await fetch(url)
            .then((res) => res.json())
            .then((data) => {
                return data
            })


    var data = {
        distance: result["route"]["legs"][0]["distance"],
        temps: result["route"]["legs"][0]["formattedTime"]
    }
    return data
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
    var offconvas = document.getElementById("trajet-"+id_trajet) 

    var span_distance = offconvas.querySelector("#distance")
    var span_temps = offconvas.querySelector("#temps_trajet")
    var loader = document.getElementById("loader-"+id_trajet) 

    var info_trajet = await get_info_itineraire(adresse1, adresse2)

    span_distance.innerHTML = info_trajet["distance"]
    span_temps.innerHTML = info_trajet["temps"]

    var center_map = await calc_center_map(adresse1, adresse2)
    var map = L.mapquest.map("map-" + id_trajet,{
        layers: L.mapquest.tileLayer('map'),
        center: [center_map[0], center_map[1]],
        zoom: 15
    })

    map.whenReady(function(e) {
        loader.style.display = "none";
        e.target._container.style.display = "block";
        map.invalidateSize()
        var lat_lng = L.latLng(center_map[0], center_map[1])
        map.setView(lat_lng, 15)
        L.mapquest.directions().route({
            start: adresse1,
            end: adresse2
        })
    })}
}

// Ne pas regarder, code dégeu mais fonctionnel
function update_time(name)
{
    obj = document.getElementById(name);
    date = new Date();
    if(date.getMonth() < 10)
    {
        month = "0"+date.getMonth()
    }
    else
    {
        month = date.getMonth()
    }

    if(date.getDate() < 10)
    {
        minutes = "0"+date.getDate()
    }
    else
    {
        minutes = date.getDate()
    }

    if(date.getDate() < 10)
    {
        jour = "0"+date.getDate()
    }
    else
    {
        jour = date.getDate()
    }

    if(date.getHours() < 10)
    {
        hours = "0"+date.getHours()
    }
    else
    {
        hours = date.getHours()
    }

    if(date.getMinutes()<10)
    {
        minutes = "0"+date.getMinutes()
    }
    else{
        minutes = date.getMinutes()
    }
    date_str = date.getFullYear()+"-"+month+"-"+jour+"T"+hours+":"+minutes
    obj.value = date_str
}

// fonction pour valider une valeur d'input présente dans une datalist
async function valid_value_from_datalist(e, datalist, id_msg_error, id_input_modele, id_datalist_model)
{
    result = false
    const input_modele_element = document.getElementById(id_input_modele)
    const datalist_element = document.getElementById(datalist)
    const error_msg_element = document.getElementById(id_msg_error)
    const datalist_modele = document.getElementById(id_datalist_model)
    empty_datalist(id_datalist_model)

    
    if(e.value != "")
    {
        console.log(datalist_element)
        datalist_option = datalist_element.querySelectorAll("option")
        datalist_option.forEach((option) => {
            if(option.value == e.value)
            {
                result = true
            }
        })

        if(!result)
        {
            error_msg_element.style.display = "block"
            input_modele_element.setAttribute("disabled", true)
            input_modele_element.value = ""
            empty_datalist(id_datalist_model)
        }
        else
        {
            input_modele_element.removeAttribute("disabled")
            results = await get_car_model(e.value)
            fill_datalist(results, id_datalist_model)
        }
    }
    else
    {
        input_modele_element.setAttribute("disabled", true)
        input_modele_element.value = ""
        error_msg_element.style.display = "none"
        empty_datalist(id_datalist_model)
    }

}

async function get_car_model(value)
{
    url = "https://cdn.imagin.studio/getCarListing?customer=frpribal&make="+value
    data = await fetch(url)
        .then((response) => response.json())
    return data.modelFamily
}

