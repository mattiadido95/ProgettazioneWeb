<?php

/* RACCOLTA DATI RELATIVI ALLA FORMAZIONE TITOLARE DA MOSTRARE NELLA PAGINA ROSTER */

require "../mysql_con.php";
session_start();

if(empty($_SESSION["user"])){
        header('Location: ../user/login.php');
       
    }

$str='';
if( isset($_GET['q'])){
$str= ($_GET['q']);
}


$sqlr1="SELECT NP.cognome, NP.ruolo
        FROM nbaplayer AS NP JOIN
             (SELECT TU.nome AS squadra, PIL.player, PIL.titolare
	            	FROM teamutente AS TU JOIN playerinteam AS PIL 
			            ON TU.idteamUtente = PIL.squadra) AS TP 
	    ON NP.idnbaPlayer = TP.player
        WHERE TP.titolare = 1 AND TP.squadra = '$str' 
        ORDER BY (CASE NP.ruolo
        WHEN 'C' 	THEN 1
        WHEN 'AG' 	THEN 2
        WHEN 'AP'       THEN 3
        WHEN 'G'        THEN 4
        WHEN 'PM'       THEN 5
        END) ASC LIMIT 5;";

$resultr1 = mysqli_query($mysqli,$sqlr1);

$array=array();
while($r=mysqli_fetch_object($resultr1)){
    array_push($array,$r);
}
print json_encode($array);

?>
