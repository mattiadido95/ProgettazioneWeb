<script type="text/javascript" src="../../javascript/utility.js"></script>

<?php
/* CODICE AGGIORNAMENTO CLASSIFICHE */
require "../mysql_con.php";
session_start();

if(empty($_SESSION["user"])){
    header('Location: ../user/login.php');
   
}
if($_SESSION["user"]["amministratore"]==0){
    header("Location: ../home.php");
}


$sumPoint="SELECT squadra, SUM(punteggio) AS punteggio 
            FROM playerinteam JOIN nbaplayer ON player=idnbaPlayer
            GROUP BY squadra";

$ris=$mysqli->query($sumPoint);

while($row=mysqli_fetch_array($ris)){
    
    if($row['punteggio']>=100){
        aggiorna(3,$row['squadra']);
    }else if($row['punteggio']<100 && $row['punteggio']>=40){
        aggiorna(2,$row['squadra']);
    }else{
        aggiorna(0,$row['squadra']);
    }
}

function aggiorna($plus,$team){
    require "../mysql_con.php";
    $query="UPDATE lega SET puntiFatti=puntiFatti+$plus WHERE team='$team'";
    $mysqli->query($query);
}


    $now=date("Y-m-d H:i:s");
    $utente=$_SESSION["user"]["nomeUtente"];
    $lastupdate="UPDATE lastupdate SET data='$now', utente='$utente' WHERE tipologia='classifiche';";
    $prova=$mysqli->query($lastupdate);
    if(!$prova){
        echo "problemi aggiornamento data ultima modifica delle classifiche";
        printf("Errormessag: %s\n", $mysqli->error);
    }
    
$a=0;
echo "<script>esegui($a);</script>";



?>

