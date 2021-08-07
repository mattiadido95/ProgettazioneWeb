<!-- PAGINA GESTIONE FORMAZIONE SQUADRE -->

<!DOCTYPE html>
<html lang="it">

<head>

<title>MODIFICA ROSTER</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="../../css/strutture.css" />
<link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
<link rel="icon" href="../../css/img/favicon.png" type="image/png" />
<script src="../../javascript/utility.js"></script>
</head>


<body>

<div class="top_bar">

    <form  action="roster.php">
     <button class="indietro" type="submit"><span>INDIETRO</span></button>
    </form>
    <h1 id="text">ELENCO SQUADRE</h1>
    <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>

</div>


    <div class="contenitore-centrale">
        <table class="modifica-lega">
                <thead>
                        <tr>
                            <th>Utente</th>
                            <th>Campionato</th>
                            <th>Squadra</th>
                            <th>Pt.</th>
                        </tr>
                </thead>

                <tbody>
                        <?php
                            session_start();
                            require "../mysql_con.php";
                            date_default_timezone_set('Europe/Rome');

                            if(empty($_SESSION["user"])){
                                header('Location: ../user/login.php');
                               
                            }
                            
                            $utente_attivo=$_SESSION["user"]["nomeUtente"];
                            

                            //controllo se siamo nella giusta fascia orario per modificare le formazioni
                            if(date('H')>=06 && date('H')<20){

                            //cerco le squadre dell'utente loggato                           
                            $sql = "SELECT U.nomeUtente, C.nomeLega, C.nome AS squadra, C.puntiFatti
                                    FROM utente AS U JOIN
                                        (SELECT TU.utente, L.nomeLega, TU.nome, L.puntiFatti
                                            FROM fantanba.lega AS L JOIN teamutente AS TU 
                                                ON L.team = TU.idteamUtente) AS C 
                                    ON U.idUtente = C.utente
                                    WHERE U.nomeUtente='$utente_attivo'";
                                    
                                $result = $mysqli->query($sql);
                              
                                if(!$result) 
                                echo '<script type="text/javascript">
                                            showERR("error","ERRORE NELLA RICERCA DELLE SQUADRE");
                                        </script>';
                                if ($result->num_rows > 0) {
                                    //elenco le squadre appartenenti all'utente loggato
                                    $count=0;
                                    while($row = mysqli_fetch_array($result)) {
                                        
                                        echo '<tr>  
                                                <td>'.$row['nomeUtente'].'</td>
                                                <td><a>'.$row['nomeLega'].'</a></td>
                                                <td><a title="ROSTER" class="click_me" id="team'.$count.'" onclick="showTitolari(this.id)">'.$row['squadra'].'</a> </td>
                                                <td>'.$row['puntiFatti'].'</td>
                                             </tr>' ;
                                        $count++;
                                    }
                                } else {
                                    echo '<tr>
                                             <td colspan="4">NON PARTECIPI A NESSUN CAMPIONATO CON LE TUE SQUADRE</td>
                                          </tr>';
                                }

                            } else{
                                //controllo fascia oraria in cui è possibile modificare la formazione titolare
                                if(date('H')>=20){
                                echo '<tr>
                                        <td colspan="4" id="time_check">SEI ARRIVATO TARDI, ATTENDI FINO ALLE 06:00 DI DOMANI PER MODIFICARE LA FORMAZIONE</td>
                                    </tr>';
                                } 
                                else { 
                                    if(date('H')<06){
                                            echo '<tr>
                                                    <td colspan="4" id="time_check">TROPPO PRESTO, ATTENDI FINO ALLE 06:00 PER MODIFICARE LA FORMAZIONE</td>
                                                </tr>';
                                    }
                                }

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
