<!-- PAGINA DOVE SELEZIONARE I 5 GIOCATORI TITOTALI PER LA GIORNATA SUCCESSIVA-->

<!DOCTYPE html>
<html lang="it">

<head>
    <title>FORMAZIONE</title>
    <meta charset="utf-8" />
    <link rel="icon" href="../../css/img/favicon.png" type="image/png" />
    <link rel="stylesheet" type="text/css" href="../../css/popwin.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
    <script src="../../javascript/utility.js"></script>
</head>

<body>

<div class="top_bar">
    <a class="reload" onclick="window.close()"><img alt="close" src="../../css/img/close.png"></a>
    <h1>SCEGLI 5 TITOLARI RISPETTANDO I 5 RUOLI</h1>
    <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>
</div>

<div class="contenitore-centrale">
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

        //cerco i giocatori della squadra scelta passata tramite la variavile $str
            $sql="SELECT A.nome, A.cognome, A.ruolo, A.titolare
                            FROM teamutente AS TU JOIN
                                (SELECT NBAPL.idnbaPlayer,NBAPL.nome, NBAPL.cognome, NBAPL.ruolo, PIT.squadra, PIT.titolare
                                    FROM playerinteam AS PIT JOIN nbaplayer NBAPL 
                                        ON PIT.player = NBAPL.idnbaPlayer) AS A 
                            ON TU.idteamUtente = A.squadra
                            WHERE TU.nome='$str'
                            
                    ";

            $result = mysqli_query($mysqli,$sql);

            echo  "<form action=\"titolari.php?q=$str\" method=\"POST\">";
            
            echo "<table>";
            echo "<thead>
                    <tr>
                        <th class=\"short\">&#10004</th>
                        <th>NOME</th>
                        <th>COGNOME</th>
                        <th class=\"short\">#</th>

                    </tr>
                </thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_array($result)) {

                echo "  
                    <tr>
                        <td class=\"short\"> <input type='checkbox' name='player[]' value='".$row['cognome']."'></td>  
                        <td>".$row['nome']." </td>   
                        <td>".$row['cognome']." </td>
                        <td class=\"short\">".$row['ruolo']."</td>
                    </tr>                    
                ";
            }
            
            echo "</tbody>";
            echo "</table>";
            echo "<input class=\"button\" type=\"submit\" value=\"SCHIERA\" name=\"submit\">";
            echo " </form>";
            


        // array contente i giocatori selezionati nella checkbox
            $checkBox = isset($_POST['player']) ? $_POST['player'] : array();

            

            if(isset($_POST['submit'])){  
                
               if(sizeof($checkBox)==5){ 

                    for ($i=0; $i<sizeof($checkBox); $i++){
                            
                        // cerco per ogni giocatore nell'array il relativo ID
                                        $findIdPL = "SELECT idnbaPlayer FROM nbaplayer WHERE cognome='$checkBox[$i]'";
                
                                    
                                        if ($mysqli->query($findIdPL) == TRUE) {
                                            $result = $mysqli->query($findIdPL);
                                            $rowPL = mysqli_fetch_row($result); 

                                        } else {
                                            echo 
                                            '<script type="text/javascript">
                                                showERR("error","PROBLEMI RICERCA ID GIOCATORE");
                                            </script>';
                                            echo "<br>";
                                        }
                                    
                        // cerco ID del team della variabile $str
                                        $findIdT = "SELECT idteamUtente FROM teamutente WHERE nome='$str'";
                                    
                                        if ($mysqli->query($findIdT) == TRUE) {
                                            $result = $mysqli->query($findIdT);
                                            $rowT = mysqli_fetch_row($result);
                                        
                                        } else {
                                            echo '<script type="text/javascript">
                                                    showERR(""error"","PROBLEMI RICERCA ID SQUADRA");
                                                </script>';
                                            echo "<br>";    
                                        } 
                                    
                        //setto a 2 l'attributo "titolare" nel dB per evidenziare la formazione appena schierata
                                        $query="UPDATE fantanba.playerinteam SET titolare='2'  
                                                WHERE player='$rowPL[0]' AND squadra='$rowT[0]'";
                                
                                    
                                        if ($mysqli->query($query) === TRUE) {
                                            
                                        } else {
                                            echo 
                                            '<script type="text/javascript">
                                                showERR("error","ERRORE QUERY DI SETTAGGIO A 2 TITOLARI");
                                            </script>';
                                        }
                                    
                                            
                                    } 
                        //setto a 0 l'attributo "titolare" per tutti i giocatori della squadra che non sono nell'ultima formazione assegnata
                                    $query1="UPDATE fantanba.playerinteam SET titolare='0'  
                                                WHERE titolare<>'2' AND squadra='$rowT[0]'";
                
                                    $mysqli->query($query1);
                                    
                        //setto a 1 l'attributo "titolare" per i giocatori della nuova formazione assegnata cosi da preparare il dB per una nuova eventuale modifica alla formazione                
                                    $query2="UPDATE fantanba.playerinteam SET titolare='1'  
                                                WHERE titolare='2' AND squadra='$rowT[0]'";
                
                                    $mysqli->query($query2);
                    
    
                        
    
                } 

        }

      
        ?>
</div>

<div class="bottom_bar">
    <p id="error"></p>
</div>

<?php 
if (count($checkBox) != 5) {
    echo 
        '<script type="text/javascript">
            showERR("error","DEVI SELEZIONARE 5 GIOCATORI");
        </script>';
} else {
    echo 
    '<script type="text/javascript">
        showERR("error","FORMAZIONE SCHIERATA");
    </script>';
}

?>

</body>

</html>