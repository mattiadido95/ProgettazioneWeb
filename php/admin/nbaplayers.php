 <!-- PAGINA GESTIONE GIOCATORI NBA PRESENTI NEL SISTEMA -->

<!DOCTYPE html>
<html lang="it">
<head>
    <title>NBA PLAYERS</title>
    <meta charset="utf-8" />
    <link rel="icon" href="../../css/img/favicon.png" type="image/png" />
    <link rel="stylesheet" type="text/css" href="../../css/strutture.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
    <script src="../../javascript/utility.js"></script>
</head>
<body>

<div class="top_bar">

    <form  action="amministrazione.php">
         <button class="indietro" type="submit"><span>INDIETRO</span></button>
    </form>

    <h1>ELENCO GIOCATORI NBA NEL SISTEMA</h1>

    <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>

</div>

<div class="contenitore-centrale">
    <input type="text" id="myInput" onkeyup="findPlayer('player')" placeholder="CERCA GIOCATORE" autofocus>

        
    <?php
    require "../mysql_con.php";
    session_start();
    if(empty($_SESSION["user"])){
        header('Location: ../user/login.php');
    }
    if($_SESSION["user"]["amministratore"]==0){
        header("Location: ../home.php");
    }



    echo' <table class="tab_player" id="player">';
    echo '<thead>';
    echo'     <tr>
                <th>N.</th>
                <th>NOME</th>
                <th>COGNOME</th>
                <th>SQUADRA NBA</th>
                <th>PREZZO</th>
                <th>RUOLO</th> 
                <th>MODIFICA</th>           
            </tr>';
    echo '</thead>';

    echo '<tbody>';

    $players="SELECT * FROM nbaplayer;";
    $result=$mysqli->query($players);
    $count=1;
    while($row=mysqli_fetch_array($result)){

        echo '<tr>
                
                <td>'.$count.'</td>
                <td>'.$row['nome'].'</td>
                <td>'.$row['cognome'].'</td>
                <td>'.$row['squadraNba'].'</td>
                <td>'.$row['prezzo'].'</td>
                <td>'.$row['ruolo'].'</td>
                <td> <a onclick="modificaNBAPL('.$row['idnbaPlayer'].')"> <img alt="modifica" src="../../css/img/modifica.ico" > </a> </td>
                        
            </tr>'
        ;
        $count++;

    }
    echo '</tbody>';
    echo '</table>';

    ?>

</div>

<div class="bottom_bar">

    <input class="button" type="button" value="AGGIUNGI" onclick="aggiungiNBAPL();">

    <input class="button" type="button" value="ELIMINA" onclick="eliminaNBAPL();">

</div>

</body>
</html>