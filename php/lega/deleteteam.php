<!-- PAGINA PER ELIMINAZIONE TEAM DA UNA LEGA -->

<!DOCTYPE html>
<html lang="it"> 

<head>
        <title>ELIMINA SQUADRA</title>
        <meta charset="utf-8" />
        <link rel="icon" href="../../css/img/favicon.png" type="image/png" />
        <link rel="stylesheet" type="text/css" href="../../css/popwin.css"/>
        <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
        <script src="../../javascript/utility.js"></script>
    
</head>

<body>

<div class="top_bar">
        <a class="reload" onclick="window.close()"><img alt="close" src="../../css/img/close.png"></a>
        <h1>SCEGLI CHI VUOI ELIMINARE DAL CAMPIONATO</h1>
        <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>
</div>
<div class="contenitore-centrale">
        <input type="text" id="myInput" onkeyup="findTeam('deleteTM')" placeholder="CERCA SQUADRA">
        <?php

                require "../mysql_con.php";
                session_start();
                if(empty($_SESSION["user"])){
                        header('Location: ../user/login.php');
                
                }

                $str='';
                if( isset($_GET['q'])){
                $str= ($_GET['q']);
                }
        $nomeUt=$_SESSION["user"]["nomeUtente"];

        //elenco tutte le squadre che sono nel campionato selezionato
                $sql="SELECT A.nomeTeam, nomeUtente, A.idteamUtente
                        FROM utente JOIN
                        (SELECT nome AS nomeTeam, utente AS idutA, idteamUtente
                        FROM lega JOIN teamutente 
                        ON team=idteamUtente    
                        WHERE nomeLega='$str') AS A
                        ON idUtente=A.idutA 
                WHERE nomeUtente <> '$nomeUt'
                        ";

                $result = mysqli_query($mysqli,$sql);

                echo  "<form action=\"deleteteam.php?q=$str\" method=\"POST\">";
                echo "<table id=\"deleteTM\">";
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
                        <td>".$row['nomeTeam']." </td>   
                        <td>".$row['nomeUtente']." </td>
                        </tr> " ;
                }
                

                echo "</tbody>";
                echo "</table>";
                echo "<input class=\"button\" type=\"submit\" value=\"ELIMINA\" name=\"submit\">";
                echo " </form>";
                


        // array contente i team selezionati nella checkbox
                $checkBox = isset($_POST['teams']) ? $_POST['teams'] : array();
        

                if(isset($_POST['submit'])){

                //cancello le righe contenenti il nome della squadra e del campionato che sto modificando

                        for ($i=0; $i<sizeof($checkBox); $i++){
                                $delete="DELETE FROM lega WHERE nomeLega='$str' AND team='$checkBox[$i]'";
                        
                                if ($mysqli->query($delete) === FALSE) {
                                        echo 
                                        '<script type="text/javascript">
                                                showERR("error","ERRORE ELIMINAZIONE SQUADRA DA CAMPIONATO");
                                        </script>';
                                } 
                        }
                        header("Location: deleteteam.php?q=$str");
                        
                }

        ?>
        </div>
        <div class="bottom_bar">
                <p id="error"></p>
        </div>

</body>

</html>