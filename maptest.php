<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css"/>
    <style>
        #map {
            height: 50vh;
            width: 50vw;
        }
        
        </style>
</head>
<body>
    <div>
        <input type="text" id="adresse">
        <div id="results" class="list-group" style="display: flex; flex-direction: column; align-items: left">
    
        </div>
    </div>
    
    <script>
        
        const text = document.getElementById("text")
        const input = document.getElementById("adresse")
        const div = document.getElementById("results")
        const preview = document.getElementById("preview")

        L.mapquest.key = "VC4Q3NkDA3A6FHjylBKhWXPGxKBe2OMo"

        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition((position) => {
                get_name_by_coords(position.coords.latitude, position.coords.longitude).then(data => {
                    text.innerHTML = "Vous êtes actuellement au: " + data
                })
            });
        }
        else
        {
            console.log("localisation pas ok!")
        }

        input.addEventListener("input", function() {
            var counter = 0
            var count = div.childElementCount
            if (count > 0)
            {
                while (count > 0)
                {
                    var child = div.firstElementChild
                    div.removeChild(child)
                }
            }
            if (counter == 0)
            {
                get_place_by_name(input.value).then(data => {
                    console.log(data)
                    data.results.forEach(function(result) {
                        var element = document.createElement("a")
                        element.class = "list-group-item list-group-item-action"
                        element.innerHTML = result.displayString
                        div.appendChild(element)
                    })
                })
                counter++
            }
            count = div.childElementCount
        })

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

        async function get_place_by_name(name)
        {
            if (name.includes(" "))
            {
                name = name.replaceAll(" ", "+")
            }

            url = "http://www.mapquestapi.com/search/v3/prediction?key=" + L.mapquest.key + "&q=" + name + "&collection=adminArea,poi,address,category,franchise,airport"
            
            result = await fetch(url)
                .then((response) => response.json())
                .then((data => {
                    return data
                }))
            return await result
        }

        function get_carte_statique_itineraire(e, adresse1, adresse2)
        { 
            for (let i = 1; i < arguments.length; i++)
            {
                if (arguments[i].includes(" "))
                {
                    arguments[i] = arguments[i].replaceAll(" ", "+")
                }
            }
            url = "https://www.mapquestapi.com/staticmap/v5/map?start="+ adresse1 +"&end="+ adresse2 +"&size=200,200&key=" + L.mapquest.key
            e.src = url
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

        async function create_map_route(adresse1, adresse2)
        {
            var center_map = await calc_center_map(adresse1, adresse2)
            var map = L.mapquest.map("map", {
                center: [center_map[0], center_map[1]],
                layers: L.mapquest.tileLayer('map'),
                zoom: 15    
            })
            
            L.mapquest.directions().route({
                start: adresse1,
                end: adresse2
            })
        }
    </script>
    <script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
</body>
</html>
