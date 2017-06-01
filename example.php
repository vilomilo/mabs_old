<?php	
    include "mabs_script2.php";	
    $constName1 = 'EXTRA FM';
    $constName2 = 'GERO SKONIO RADIJAS';	
    $array = array('ZINIOS', 'REKLAMA', 'AUDIO', 'BIBLIOTEKA', 'LAIDA', 'LAIDOS', 'Traffic block', 'TRAFFIC BLOCK', 'ORAI', 'APZVALGA', 'MINTYS APIE LAIME', 'FONAS', 'VALANDINIS', 'VILNIAUS', 'KOMENTARAS', 'REPORTAZAS', 'KAUNIECIAI', 'BUKIME', 'SVEIKI', 'ON AIR SHOWS', 'NEMIEGOK', 'DAR', 'KLUBAS','ORAI', 'PIRKDAMAS', 'SUZINOK', 'KALBA', '2015', 'ETNORATILAI', 'TEVYNES', 'LABUI', 'EUROPOS', 'LAIKRODIS', 'LIVE', 'KAUNO', 'REGIONO', 'AKTUALIJOS', 'SAVAITE', 'UTENOJE', 'UOSTAMIESCIO', 'KLUBAS', 'POKALBIU', 'PRIES', 'PIRKDAMAS', 'SUZINOK', 'EUROPOS', 'LAIKRODIS', 'LIETUVA', 'PER', 'SAVAITE', '2016');	
	foreach ($array as $key => $sentence){
		$sentence = trim($sentence);
		$un1 = trim(strtoupper($name1));
		$un2 = trim(strtoupper($name2));
	if((strpos($un1, $sentence) !== false) || (strpos($un2, $sentence) !== false)){
		$name1 = $constName1;
		$name2 = $constName2;
		break;
		}    
			}    
	echo $name1 . " - " . $name2;
?>