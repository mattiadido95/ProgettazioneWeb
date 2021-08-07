<!--PAGINA GESTIONE LEGHE CON AGGIUNTA E ELIMINAZIONE TEAM DA LEGHE CHE L'UTENTE AMMINISTRA  -->

<!DOCTYPE html>
<html lang="it">

<head>
    <title>MODIFICA LEGA</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../../css/strutture.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
    <link rel="icon" href="../../css/img/favicon.png" type="image/png" />
    <script src="../../javascript/utility.js"></script>
</head>

<body>


<div class="top_bar">
    <form  action="lega.php">
        <button class="indietro" type="submit"><span>INDIETRO</span></button>
    </form>
    <h1 id="text">CAMPIONATI CHE AMMINISTRI</h1>
    <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>
</div>

    <div class="contenitore-centrale">
        <table class="modifica-lega">
                <thead>
                      <tr>
                         <th>Utente</th>
                         <th>Campionato</th>
                         <th id="azione">Azione</th>
                            
                     </tr>
                </thead
                  >
                <tbody>


                        <?php
                            session_start();
                            require "../mysql_con.php";
                            if(empty($_SESSION["user"])){
                                header('Location: ../user/login.php');
                               
                            }


                            if (!empty($_SESSION["user"])){
                            
                            $utente_attivo=$_SESSION["user"]["nomeUtente"];
                            //cerco i campionati dell'utente loggato in cui è amministratore                       
                            $sql = "SELECT A.nomeLega, nomeUtente
                                    FROM utente JOIN
                                        (SELECT * FROM fantanba.lega JOIN teamutente ON idteamUtente = team
                                            WHERE amministratoreLega = 1) 
                                    AS A ON A.utente = idUtente WHERE nomeUtente = '$utente_attivo'
                                ";
                                $result = $mysqli->query($sql);
                                if(!$result) 
                                echo '<script type="text/javascript">
                                            showERR("error","ERRORE NELLA RICERCA DEI CAMPIONATI");
                                        </script>';

                                if ($result->num_rows > 0) {
                                
                                    //elenco i campionati amministrati dall'utente
                                    $count=0;
                                    while($row = mysqli_fetch_array($result)) {
                                        
                                        echo '<tr>  
                                                <td>'.$row['nomeUtente'].'</td>
                                                <td id="lega'.$count.'">'.$row['nomeLega'].'</a></td>
                                                <td> <a class="click_me" onclick="aggiungi(lega'.$count.'.id)"> <img alt="aggiungi" src="../../css/img/plus.png"> </a> <a class="click_me" onclick="elimina(lega'.$count.'.id)"> <img alt="elimina" src="../../css/img/minus.png"> </a> </td>                                                
                                             </tr>' ;
                                             $count++;
                                        
                                    }
                                } else {
                                    echo '<tr>
                                             <td colspan="4">NON SEI AMMINISTRATORE DI NESSUNA LEGA</td>
                                          </tr>';
                                }
                            } else {
                            //se non sei loggato                                
                                echo ' <tr>
                                        <td colspan="4">ESEGUI IL LOGIN</td>
                                       </tr>';
                            }

                        ?>

                </tbody>                             
        </table>
    </div>

<div class="bottom_bar">
    <p id="error"></p>
</div>



</body>
</html>
