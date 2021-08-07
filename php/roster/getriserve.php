<?php
/* RACCOLTA DATI RELATIVI ALL FORMAZIONE NON TITOLARE DA MOSTRARE NELLA PAGINA ROSTER */
require "../mysql_con.php";
session_start();
if(empty($_SESSION["user"])){
    header('Location: ../user/login.php');
   
}

$str='';
if( isset($_GET['q'])){
$str= ($_GET['q']);
}


$sql="SELECT NP.cognome, NP.ruolo
        FROM nbaplayer AS NP JOIN
            (SELECT TU.nome AS squadra, PIL.player, PIL.titolare
                    FROM teamutente AS TU JOIN playerinteam AS PIL 
                        ON TU.idteamUtente = PIL.squadra) AS TP 
        ON NP.idnbaPlayer = TP.player
        WHERE TP.titolare = 0 AND TP.squadra = '$str'
        ";

$result = mysqli_query($mysqli,$sql);

$array=array();
while($r=mysqli_fetch_object($result)){
    array_push($array,$r);
}
print json_encode($array);

?>
