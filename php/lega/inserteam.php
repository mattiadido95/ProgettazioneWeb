<!-- PAGINA DI INSERIMENTO TEAM IN UNA DETERMINATA LEGA  -->

<!DOCTYPE html>
<html lang="it">

<head>
    <title>AGGIUNGI</title>
    <meta charset="utf-8" />
    <link rel="icon" href="../../css/img/favicon.png" type="image/png" />
    <link rel="stylesheet" type="text/css" href="../../css/popwin.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
    <script src="../../javascript/utility.js"></script>
</head>

<body>
<div class="top_bar">
    <a class="reload" onclick="window.close()"><img alt="close" src="../../css/img/close.png"></a>
    <h1>SCEGLI CHI AGGIUNGERE AL TUO CAMPIONATO</h1>
    <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>
</div>


<div class="contenitore-centrale">
        <input type="text" id="myInput" onkeyup="findTeam('insertTM')" placeholder="CERCA SQUADRA" autofocus>

            <?php
                session_start();
                require "../mysql_con.php";
                if(empty($_SESSION["user"])){
                    header('Location: ../user/login.php');
                
                }

                $str='';
                if( isset($_GET['q'])){
                $str= ($_GET['q']);
                }

        //cerco le squadre non partecipanti al campionato selezionato e che quindi posso aggiungere
                $sql="SELECT B.squadra, B.idteamUtente, U.nomeUtente 
                        FROM utente AS U JOIN 
                            (SELECT idteamUtente,nome AS squadra, utente AS idutB 
                            FROM teamutente LEFT OUTER JOIN
                                            (SELECT nomeLega, team AS idteamA, nome AS nometeam, utente AS idutA
                                                FROM lega JOIN  teamutente ON team=idteamUtente WHERE nomeLega='$str' ) AS A
                                ON utente=A.idutA
                                WHERE A.idutA IS NULL ) AS B 
                        ON U.idUtente=B.idutB
                        ";

                $result = mysqli_query($mysqli,$sql);

                echo  "<form action=\"inserteam.php?q=$str\" method=\"POST\">";
                echo "<table id=\"insertTM\">";
                echo "<thead>
                        <tr>
                            <th class=\"short\">&#10004</th>
                            <th>SQUADRA</th>
                            <th>UTENTE</th>
                        </tr>
                    </thead>";
                    echo "<tbody>";
                while($row = mysqli_fetch_array($result)) {

                    echo "  

                        <tr>
                            <td class=\"short\"> <input type='checkbox' name='teams[]' value='".$row['idteamUtente']."'></td>  
                            <td>".$row['squadra']." </td>   
                            <td>".$row['nomeUtente']." </td> 
                        </tr>
                    ";
                }
                echo "</tbody>";
                echo "</table>";

                echo "<input class=\"button\" type=\"submit\" value=\"AGGIUNGI \" name=\"submit\">";

                echo " </form>";

        // array contente le squadre selezionate che voglio aggiungere al campionato
                $checkBox = isset($_POST['teams']) ? $_POST['teams'] : array();



                if(isset($_POST['submit'])){   
                    
                    // cerco id campionato selezionato
                    $findIdL = "SELECT idLega FROM lega WHERE nomeLega='$str'";

                        
                    $mysqli->query($findIdL);
                    $result = $mysqli->query($findIdL);
                    $Idrow = mysqli_fetch_row($result); 
                

                    for ($i=0; $i<sizeof($checkBox); $i++){
        //inserisco le nuove squadre

                        $inserisci="INSERT INTO lega (idLega,nomeLega,team,puntiFatti,amministratoreLega)
                                    VALUES ('$Idrow[0]','$str','$checkBox[$i]','0','0');
                                    ";
                        
                        if ($mysqli->query($inserisci) === FALSE) {
                            echo
                            '<script type="text/javascript">
                                showERR("error","ERRORE INSERIMENTO NUOVE SQUADRE");
                            </script>';
                        }
                                
                    }  
                    header("Location: inserteam.php?q=$str");
                }
            ?>
    </div>
    <div class="bottom_bar">
        <p id="error"></p>
    </div>

</body>

</html>