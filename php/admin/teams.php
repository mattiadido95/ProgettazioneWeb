 <!-- PAGINA VISUALIZZAZIONE DEI TEAM CREATI DAGLI UTENTI --> 

<!DOCTYPE html>
<html lang="it">
<head>
    <title>TEAM</title>
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

    <h1>ELENCO SQUADRE REGISTRATE</h1>
    <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>
</div>
<div class="contenitore-centrale">
    <input type="text" id="myInput" onkeyup="findTeam('team')" placeholder="CERCA SQUADRA" autofocus>


        <table class="tab_team" id="team">
            <thead>
                <tr>
                    <th>N.</th>
                    <th>SQUADRA</th>
                    <th>PROPRIETARIO</th>
                    <th>CAMPIONATI ATTIVI</th>
                    <th>DENARO</th>
                </tr>
            </thead>

        <tbody>

            <?php
                require "../mysql_con.php";
                session_start();
                if(empty($_SESSION["user"])){
                    header('Location: ../user/login.php');
                
                }
                if($_SESSION["user"]["amministratore"]==0){
                    header("Location: ../home.php");
                }
            

                function num_champ($idTeam){
                    require "../mysql_con.php";
                    $count="SELECT count(team)  FROM lega
                            WHERE team='$idTeam'
                            GROUP BY team;
                            ";
                    $result=$mysqli->query($count);
                    $row=mysqli_fetch_row($result);
                    if($row[0]==0){
                        return 0;
                    }else {
                        return $row[0];
                    }
                }

                $team="SELECT T.nome AS nomeT, U.nomeUtente AS nomeU, T.idteamUtente, T.money FROM teamutente AS T JOIN utente AS U ON T.utente=U.idUtente;";
                $result=$mysqli->query($team);
                $count=1;
                while($row=mysqli_fetch_array($result)){

                    echo '<tr>
                                <td>'.$count.'</td>
                                <td>'.$row['nomeT'].'</td>
                                <td>'.$row['nomeU'].'</td>
                                <td>'.num_champ($row['idteamUtente']).'</td>
                                <td>'.$row['money'].'</td>
                        </tr>';
                    $count++;
                }

                
                 ?>
            </tbody>
        </table>

</div>

<div class="bottom_bar">
                
    <?php
            $query="SELECT COUNT(DISTINCT idteamUtente) FROM teamutente;";
            $result=$mysqli->query($query);
            $row=mysqli_fetch_array($result);
            $num=$row[0];
            echo '<h1>'.$num.'</h1>';

    ?>


</div>



</body>
</html>