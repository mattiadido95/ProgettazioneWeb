 <!-- PAGINA GESTIONE DELLE PROPRIE LEGHE -->

<!DOCTYPE html>
<html lang="it">

<head>
    <title>FANTANBA</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../../css/layout.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
    <link rel="icon" href="../../css/img/favicon.png" type="image/png" />
    <script src="../../javascript/utility.js"></script>
</head>

<body class="main_body">

<div class="wrapper">
    <header>
        <?php
            session_start();
            //se non sei loggato torni al login
            if(empty($_SESSION["user"]))
            header("Location: ../user/login.php");

            if (!empty($_SESSION["user"])){
                if($_SESSION["user"]["sesso"]=="F"){
                    echo "
                        <div class=\"top\">
                            <div class=\"loggato\">
                            <ul>
                                <li>
                                    BENVENUTA&nbsp;<a title=\"IL TUO PROFILO\" href=\"../user/profilo.php\">".  $_SESSION["user"]["nomeUtente"]."</a>  
                                </li>
                                <li>
                                    <a href=\"../user/logout.php\">ESCI</a>
                                </li>
                                
                            </ul>
                            </div>
                        </div>";
                } else{
                    
                    echo "
                        <div class=\"top\">
                            <div class=\"loggato\">
                            <ul>
                                <li>
                                    BENVENUTO&nbsp;<a title=\"IL TUO PROFILO\" href=\"../user/profilo.php\">".  $_SESSION["user"]["nomeUtente"]."</a>  
                                </li>
                                <li>
                                    <a href=\"../user/logout.php\">ESCI</a>
                                </li>
                                
                            </ul>
                            </div>
                        </div>";
                }

            }else {
               
                echo'
                    <div class="login">
                    <ul>
                        <li>
                            <a href="../user/login.php">Login</a>
                        </li>
                        <li>
                            <a href="../user/registrazione.php">Sing in</a>
                        </li>
                    </ul>
                    </div>';
            }
        ?>

        <nav class="main-nav">
            <ul>
                <li>
                 <?php 
                    echo' <a href="nuova_lega.php">NUOVA</a>';
                    ?>
                </li>
                <li>
                   <?php 
                    echo' <a href="modifica_lega.php">MODIFICA</a>';
                    ?>
                </li>


                <li class="home-button">
                    <a href="../home.php">HOME</a>
                </li>


                <li>
                  <a target="_blank" href="http://it.global.nba.com/statistics/?zoneid=menued-sport_nba_stats-individuali">STATISTICHE</a>
                </li>
                <li>
                    <a target="_blank" href="https://sport.sky.it/nba/home.html?gr=www">NBA</a>
                </li>

            </ul>
        </nav>

    </header>

    <div class="corpo-centrale">

        <div class="corpo-centrale2">

            <div title="LEGHE A CUI PARTECIPI" class="campionati">
                <table class="tab-campionati">
                     <thead>
                        <tr class="intestazione-tabella">
                            <th>Utente</th>
                            <th>Campionato</th>
                            <th>Squadra</th>
                            <th>Pt.</th>
                            <th>Denaro</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                        require "../mysql_con.php";

                        $utente_attivo=$_SESSION["user"]["nomeUtente"];
                        $sql = "SELECT U.nomeUtente, C.nomeLega, C.nome AS squadra, C.puntiFatti, C.money
                                FROM utente AS U JOIN
                                    (SELECT TU.utente, L.nomeLega, TU.nome, L.puntiFatti, TU.money
                                        FROM fantanba.lega AS L JOIN teamutente AS TU 
                                            ON L.team = TU.idteamUtente) AS C 
                                ON U.idUtente = C.utente
                                WHERE U.nomeUtente='$utente_attivo'";
                            $result = $mysqli->query($sql);
                            if(!$result) echo "Errore nella query";
                            if ($result->num_rows > 0) {

                            
                            $count=0;
                               
                            while($row = mysqli_fetch_array($result)) {
                                
                                    echo '<tr>  
                                    <td>'.$row['nomeUtente'].'</td>
                                    <td><a title="DETTAGLI LEGA" class="click_me" id="lega'.$count.'" onclick="showLega(this.id); bestroster(roster'.$count.'.id)">'.$row['nomeLega'].' </a></td>
                                    <td><a title="MODIFICA LA FORMAZIONE" id="roster'.$count.'" href="../roster/roster.php">'.$row['squadra'].'</a></td>
                                    <td>'.$row['puntiFatti'].'</td>
                                    <td>$'.$row['money'].'</td>
                                </tr>' ;
                                                              
                                $count++;
                                                                
                                }
                            } else {
                                echo " <tr>
                                       <td class=\"long-td\">NON PARTECIPI A NESSUN CAMPIONATO ATTUALMENTE</td>
                                       </tr>";
                            }


                    ?>
                    </tbody>  
                </table>
            </div>

             <div title="I TUOI MVP DELLA NOTTE" class="formazione">

                <?php

                    

                ?>

                <table id="getBestRoster">
                    <tr>
                        <td>
                            <div class="jersey">
                                <div class="j-name">
                                <p id="1-N" class="nome">Player</p>
                                <p id="1-R" class="ruolo">5</p>
                                </div>
                            </div>
                        </td>
                        <td>
                        <div class="jersey">
                                <div class="j-name">
                                <p id="2-N" class="nome">Player</p>
                                <p id="2-R" class="ruolo">4</p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                        <div class="jersey">
                            <div class="j-name">
                                <p id="3-N" class="nome">Player</p>
                                <p id="3-R" class="ruolo">3</p>
                            </div>
                        </td>
                        <td>
                        <div class="jersey">
                            <div class="j-name">
                                <p id="4-N" class="nome">Player</p>
                                <p id="4-R" class="ruolo">2</p>
                            </div>
                        </td>

                    </tr>
                    <tr>

                        <td colspan="2">
                        <div id="playmaker" class="jersey">
                            <div class="j-name">
                                <p id="5-N" class="nome">Player</p>
                                <p id="5-R" class="ruolo">1</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            

        </div>

        <aside title="CLASSIFICA" class="aside-classifica">

            <table id="getClassifica" class="table-classifica">
                <thead>
                    <tr class="intestazione-tabella">
                        <th class='small-th'>N.</th>
                        <th>Player</th>
                        <th class='small-th'>Pt.</th>
                    </tr>
                </thead>
                <tbody id="classifica">
                    <tr id="row">
                        <td colspan="3">SELEZIONA UN CAMPIONATO</td> 
                    </tr>
                </tbody>
            </table>
        </aside>




    </div>

</div>

    <footer>
    <div id="footer-text">
           
        </div>
    </footer>




</body>

</html>