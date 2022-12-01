<?php
function get_carte_statique_itineraire($ad1, $ad2, $key)
{
    if(str_contains($ad1, " ") || str_contains($ad2, " "))
    {
        str_replace(" ", "+", $ad1);
        str_replace(" ", "+", $ad2);
    }
    return "https://www.mapquestapi.com/staticmap/v5/map?start=".$ad1."&end=".$ad2."&size=200,200&key=".$key;
}

?>