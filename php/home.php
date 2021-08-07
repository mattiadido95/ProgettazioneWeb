<!DOCTYPE html>
<html lang="it">

<head>

    <title>FANTANBA</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../css/layout.css" />
    <link rel="stylesheet" type="text/css" href="../css/reset.css"/>
    <link rel="icon" href="../css/img/favicon.png" type="image/png" />

</head>

<body class="main_body">
    <div class="wrapper">
        <header>
        
            <?php
            session_start();
            if (!empty($_SESSION["user"])){

                if($_SESSION["user"]["amministratore"]==1){
                    //se sono loggato e sono amministatore globale

                    if($_SESSION["user"]["sesso"]=="F"){
                        //sesso femminile
                        echo "
                        <div class=\"top\">
                            <div class=\"loggato\">
                                <ul>
                                    <li>
                                        BENVENUTA&nbsp; <a title=\"IL TUO PROFILO\" href=\"user/profilo.php\">".  $_SESSION["user"]["nomeUtente"]."</a>
                                    </li>
                                    <li>
                                        <a href=\"user/logout.php\">ESCI</a>
                                    </li>
                                </ul>
                            </div>  
                            <div class=\"amministratore\">
                                <a href=\"../php/admin/amministrazione.php\">
                                    <img src=\"../css/img/setting.png\" alt=\"amministrazione\">
                                </a>
                            </div>                
                        </div>
                        ";
                    } else {
                        //sesso maschile
                        echo "
                        <div class=\"top\">
                            <div class=\"loggato\">
                                <ul>
                                    <li>
                                        BENVENUTO&nbsp; <a title=\"IL TUO PROFILO\" href=\"user/profilo.php\">".  $_SESSION["user"]["nomeUtente"]."</a>
                                    </li>
                                    <li>
                                        <a href=\"user/logout.php\">ESCI</a>
                                    </li>
                                </ul>
                            </div>  
                            <div class=\"amministratore\">
                                <a href=\"../php/admin/amministrazione.php\">
                                    <img src=\"../css/img/setting.png\" alt=\"amministrazione\">
                                </a>
                            </div>                
                        </div>
                        ";
                    }
                    
                } else {
                    //se sono loggato ma non sono amministratore globale
                    if($_SESSION["user"]["sesso"]=="F"){
                        //sesso femminile
                        echo "
                        <div>
                            <div class=\"loggato\">
                                <ul>
                                    <li>
                                        BENVENUTA&nbsp; <a title=\"IL TUO PROFILO\" href=\"user/profilo.php\">".  $_SESSION["user"]["nomeUtente"]."</a>
                                    </li>
                                    <li>
                                        <a href=\"user/logout.php\">ESCI</a> 
                                    </li>
                                </ul>
                            </div> 
                        ";
                    } else {
                        //sesso maschile
                        echo "
                        <div>
                            <div class=\"loggato\">
                                <ul>
                                    <li>
                                        BENVENUTO&nbsp; <a title=\"IL TUO PROFILO\" href=\"user/profilo.php\">".  $_SESSION["user"]["nomeUtente"]."</a>
                                    </li>
                                    <li>
                                        <a href=\"user/logout.php\">ESCI</a> 
                                    </li>
                                </ul>
                            </div> 
                        ";
                    }
                }
            
            }else {
               //se non sono loggato
                echo'
                    <div class="login">
                    <ul>
                        <li>
                            <a href="user/login.php">Login</a>
                        </li>
                        <li>
                            <a href="user/registrazione.php">Sign in</a>
                        </li>
                    </ul>
                    </div>';
            }
        ?>

                <nav class="main-nav">
                    <ul>
                        <li>
                            <a href="roster/roster.php">ROSTER</a>
                        </li>
                        <li>
                            <a href="lega/lega.php">LEGA</a>
                        </li>


                        <li class="home-button">
                            <a href="home.php">HOME</a>
                        </li>


                        <li>
                            <a href="regolamento.php">REGOLAMENTO</a>
                        </li>
                        <li>
                            <a href="../html/manuale.html">INFO</a>
                        </li>

                    </ul>
                </nav>

        </header>

        <div class="corpo-centrale">

            <div class="corpo-centrale2">

                <img id="dreamteam" alt="dream-team" src="../css/img/dreamteam.png">

                <div class="formazione">

                    <?php
                    require "mysql_con.php";
                    //se sono loggato
                    //mostro la formazione della squadra dell'utente loggato che ha un miglior punteggio
                    if(!empty($_SESSION["user"])){
                        $idUtente=$_SESSION["user"]["idUtente"];
                        $sql="SELECT cognome, ruolo
                                FROM nbaplayer AS N JOIN
                                    (SELECT player FROM playerinteam AS P
                                        JOIN (SELECT DISTINCT (nome), puntiFatti, idteamUtente
                                                FROM lega JOIN teamutente ON team = idteamUtente
                                                WHERE utente = '$idUtente'
                                                ORDER BY puntiFatti DESC , nome ASC
                                                LIMIT 1) AS A 
                                        ON P.squadra = A.idteamUtente
                                        WHERE titolare='1') AS B 
                                ON N.idnbaPlayer = B.player
                                ORDER BY (CASE ruolo
                                    WHEN 'C' THEN 1
                                    WHEN 'AG' THEN 2
                                    WHEN 'AP' THEN 3
                                    WHEN 'G' THEN 4
                                    WHEN 'PM' THEN 5
                                END) ASC";
                        $result = mysqli_query($mysqli,$sql);
                        $riga=0;

                        echo "<table title=\"LA PIU VICINA ALL'ANELLO\">";

                        while($riga<2){
                            echo "<tr>";
                            $colonna=0;
                            while($colonna<2){
                                $row = mysqli_fetch_array($result);
                                echo "<td>";
                                        
                                        echo    "<div class=\"jersey\">
                                                <div class=\"j-name\">
                                                <p class=\"nome\"> ".$row['cognome']."</p>
                                                <p class=\"ruolo\">".$row['ruolo']."</p>
                                                </div>
                                                </div>";
                                                
                                    echo "</td>";
                                $colonna++;
                            }
                            echo "</tr>";
                            $riga++;
                        }

                            echo "<tr>";
                                $row = mysqli_fetch_array($result);

                                echo "<td colspan=\"2\">";
                                                
                                echo    "<div id=\"playmaker\" class=\"jersey\">
                                            <div class=\"j-name\">
                                            <p class=\"nome\"> ".$row['cognome']."</p>
                                            <p class=\"ruolo\">".$row['ruolo']."</p>
                                        </div>
                                        </div>";
                                        
                                echo "</td>";


                            echo "</tr>";

                        echo "</table>";

                        
                    } else{
                        //se non sono loggato
                        //mostro i giocatori con un miglior punteggio nell'ultima giornata NBA
                        $sql="SELECT cognome, ruolo
                                FROM nbaplayer
                                ORDER BY punteggio DESC
                                LIMIT 5";
                        $result = mysqli_query($mysqli,$sql);
                        $riga=0;

                        echo "<table title=\"GLI MVP DELLA NOTTE\">";

                        while($riga<2){
                            echo "<tr>";
                            $colonna=0;
                            while($colonna<2){
                                $row = mysqli_fetch_array($result);
                                echo "<td>";
                                        
                                        echo    "<div class=\"jersey\">
                                                <div class=\"j-name\">
                                                <p class=\"nome\"> ".$row['cognome']."</p>
                                                <p class=\"ruolo\">".$row['ruolo']."</p>
                                                </div>
                                                </div>";
                                                
                                    echo "</td>";
                                $colonna++;
                            }
                            echo "</tr>";
                            $riga++;
                        }

                            echo "<tr>";
                                $row = mysqli_fetch_array($result);

                                echo "<td colspan=\"2\">";
                                                
                                echo    "<div id=\"playmaker\" class=\"jersey\">
                                            <div class=\"j-name\">
                                            <p class=\"nome\"> ".$row['cognome']."</p>
                                            <p class=\"ruolo\">".$row['ruolo']."</p>
                                        </div>
                                        </div>";
                                        
                                echo "</td>";


                            echo "</tr>";

                        echo "</table>";

                }
                ?>

                </div>


            </div>



            <aside class="aside-classifica">

                <table class="table-classifica">
                    <tr class="intestazione-tabella">
                        <th class='small-th'>N.</th>
                        <th>Player</th>
                        <th class='small-th'>Pt.</th>
                    </tr>
                    <?php


                     require "mysql_con.php";
                     //se sono loggato
                       if(!empty($_SESSION["user"])){ 
                            $rank=1;
                            $idUtente=$_SESSION["user"]["idUtente"];
                            //elenco le squadre appartenenti all'utente con relativo punteggio
                            $sql = "SELECT DISTINCT (nome), puntiFatti
                                    FROM lega JOIN teamutente ON team = idteamUtente
                                    WHERE utente = '$idUtente'
                                    ORDER BY puntiFatti DESC, nome ASC";
                            $result = $mysqli->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr title=\"LA PIU VICINA ALL'ANELLO\">  
                                            <td>{$rank}</td>
                                            <td>{$row['nome']}</td>
                                            <td>{$row['puntiFatti']}</td>
                                        </tr>" ;
                                        $rank++;
                                }
                            } else {
                                if($result->num_rows == 0){
                                    echo "<tr>  
                                            <td colspan=\"3\">NON HAI SQUADRE ATTIVE</td>
                                        </tr>";
                                }else{
                                    echo "ERROR";
                                }
                                
                            }
                        } else {
                            //se non sono loggato mostro una classifica fittizia
                            $rank=1;
                            $sql = "SELECT DISTINCT (nome), puntiFatti
                                    FROM lega JOIN teamutente 
                                    ON team = idteamutente
                                    ORDER BY puntiFatti DESC
                                    LIMIT 10";
                            $result = $mysqli->query($sql);

                            if ($result->num_rows > 0) {
                                
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr title=\"CLASSIFICA\">  
                                            <td>{$rank}</td>
                                            <td>{$row['nome']}</td>
                                            <td>{$row['puntiFatti']}</td>
                                        </tr>" ;
                                        $rank++;
                                }
                            } else {
                                echo "ERROR";
                            }
                        }
                        
                     ?>

                </table>
            </aside>


        </div>
    </div>
    <footer>
        <div id="footer-text">
            <?php
                include "in_footer.php";
            ?>
        </div>
    </footer>

</body>

</html>