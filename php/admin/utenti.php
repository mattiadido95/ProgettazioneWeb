<!-- PAGINA VISUALIZZAZIONE DATI UTENTI RERGISTRATI --> 

<!DOCTYPE html>
<html lang="it">
<head>
    <title>UTENTI</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../../css/strutture.css"/>
    <link rel="icon" href="../../css/img/favicon.png" type="image/png" />
    <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
    <script src="../../javascript/utility.js"></script>
</head>
<body>


<div class="top_bar">
    <form  action="amministrazione.php"> 
        <button class="indietro" type="submit"><span>INDIETRO</span></button>
    </form>
    <h1>ELENCO UTENTI ISCRITTI  </h1>
    <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>
</div>

<div class="contenitore-centrale">

    <input type="text" id="myInput" onkeyup="findUtenti('iscritti')" placeholder="CERCA UTENTE" autofocus>



    <?php
    require "../mysql_con.php";
    session_start();
    if(empty($_SESSION["user"])){
        header('Location: ../user/login.php');
    
    }
    if($_SESSION["user"]["amministratore"]==0){
        header("Location: ../home.php");
    }



    echo' <table class="tab_amm" id="iscritti">';
    echo '<thead>';
    echo'     <tr>
                <th>N.</th>
                <th>NOME UTENTE</th>
                <th>NOME</th>
                <th>COGNOME</th>
                <th>DATA DI NASCITA</th>
                <th>SESSO</th>
                <th>EMAIL</th>
                <th>AVATAR</th>
                <th>AMMINISTRATORE</th>
                
            </tr>';
    echo '</thead>';
    echo '<tbody>';

    $utenti="SELECT * FROM utente;";
    $result=$mysqli->query($utenti);
    $count=1;
    while($row=mysqli_fetch_array($result)){


        echo '<tr>
                <td>'.$count.'</td>
                <td>'.$row['nomeUtente'].'</td>
                <td>'.$row['nome'].'</td>
                <td>'.$row['cognome'].'</td>
                <td>'.$row['dataNascita'].'</td>
                <td>'.$row['sesso'].'</td>
                <td>'.$row['email'].'</td>
                <td><img alt="avatar" src="../../css/img/'.$row['avatar'].'.png"></td>
                <td>';
                if($row['amministratore']==1){
                    echo '
                        <form action="updateAMM.php?q='.$row['idUtente'].'" method="POST">
                            <img alt="amministratore" src="../../css/img/amministratore.png">
                            <input class="amm_img" type="image" alt="rimuovi" src="../../css/img/down.png">
                        </form>';
                    
                }else{
                    echo '
                    <form action="updateAMM.php?q='.$row['idUtente'].'" method="POST">
                        <input class="amm_img" type="image" alt="promuovi" src="../../css/img/up.png" >
                    </form>
                        ';
                }
                echo '</td>
                
            </tr>' ;

            $count++;
        

    }
    echo '</tbody>';
    echo '</table>';

    ?>
</div>
<div class="bottom_bar">

</div>
 
</body>
</html>