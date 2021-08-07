<?php

/* RACCOLTA DATI RELATIVI ALLA CLASSIFICA DELLA LEGA SELEZIONATA */

session_start();
require "../mysql_con.php";
if(empty($_SESSION["user"])){
    header('Location: ../user/login.php');
   
}

$str='';
if( isset($_GET['q'])){
$str= ($_GET['q']);
}


$utente_attivo=$_SESSION["user"]["nomeUtente"];

$sql="SELECT A.squadra, L.puntiFatti, A.nomeUtente
        FROM lega AS L JOIN (SELECT T.idteamUtente, T.nome AS squadra, T.utente, U.nomeUtente
                             FROM teamutente AS T JOIN utente AS U ON T.utente=U.idUtente ) AS A
        ON L.team=A.idteamUtente
        WHERE L.nomeLega='$str' 
        ORDER BY puntiFatti DESC";

$result = mysqli_query($mysqli,$sql);

$array=array();
while($r=mysqli_fetch_object($result)){
    if($r->nomeUtente==$utente_attivo){
        $r->{'loggato'} = true;  
    }else{ 
        $r->{'loggato'} = false;
    }
    array_push($array,$r);
}
print json_encode($array);
?>
