<?php
function get_carte_statique_itineraire($ad1, $ad2, $key)
{
    if(str_contains($ad1, " ") || str_contains($ad2, " "))
    {
        str_replace(" ", "+", $ad1);
        str_replace(" ", "+", $ad2);
    }
    return "https://www.mapquestapi.com/staticmap/v5/map?start=".$ad1."&end=".$ad2."&size=200,200&key=".$key;
}

function date_to_french($date)
{
    $semaine= ["lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche"]; 
    $mois = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];

    $date = strtotime($date);

    echo $semaine[date("N",$date) - 1]." ".date("j", $date)." ".$mois[date("n", $date)- 1];
}
?>