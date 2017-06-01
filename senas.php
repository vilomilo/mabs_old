<?php
    include "mabs_script2.php";

    $constName1 = 'EXTRA FM';
    $constName2 = 'GERO SKONIO RADIJAS';

    $array = array('ZINIOS', 'REKLAMA', 'LAIDA', 'LAIDOS', 'Traffic block', 'ORAI', 'APZVALGA', 'MINTYS APIE LAIME', 'FONAS', 'VALANDINIS', 'VILNIAUS', 'KOMENTARAS', 'REPORTAZAS', 'KAUNIECIAI', 'BUKIME', 'SVEIKI', 'ON AIR SHOWS', 'NEMIEGOK', 'DAR', 'KLUBAS', 'PIRKDAMAS', 'SUZINOK', 'KALBA', '2015', 'ETNORATILAI', 'TEVYNES', 'LABUI', 'EUROPOS', 'LAIKRODIS', 'LIVE', 'KAUNO', 'REGIONO', 'AKTUALIJOS', 'SAVAITE', 'UTENOJE', 'UOSTAMIESCIO', 'KLUBAS', 'POKALBIU', 'PRIES', 'PIRKDAMAS', 'SUZINOK', 'EUROPOS', 'LAIKRODIS', 'LIETUVA', 'PER', 'SAVAITE', '2016', '=', 'MS1MOD=2', 'MOD=2');
    $ca = count($array);

    for($i=0; $i<$ca; $i++){
        if(stripos('-'.$name1.'-', $array[$i]) || stripos('-'.$name2.'-', $array[$i])){
            $name1 = $constName1;
            $name2 = $constName2;
        }
    }

    echo $name1." - ";
    echo $name2;
?>