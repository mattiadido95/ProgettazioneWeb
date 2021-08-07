<!-- PAGINA ALLESTIMENTO SQUADRA --> 

<?php
session_start();
ob_start();
//se non sei loggato torni al login
if(empty($_SESSION["user"]))
    header("Location: ../user/login.php");

?>


<!DOCTYPE html>

    <html>

    <head>

        <title>NUOVO ROSTER</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../../css/strutture.css" />
        <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
        <link rel="icon" href="../../css/favicon.png" type="image/png" />
        <script src="../../javascript/utility.js"></script>


    </head>

    <div class="top_bar">
        <form  action="roster.php">
            <button class="indietro" type="submit"><span>ANNULLA</span></button>
        </form>
        <h1 id="text">FORMAZIONE</h1>
        <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>
    </div>

    <div class="contenitore-centrale">
        

        <form class="new-roster" action="nuovo_roster.php" method="POST">
            <h1 id="text-newteam">SELEZIONA I GIOCATORI CHE VUOI NELLA TUA SQUADRA</h1>
                <table id="new_roster">
                    <tbody>
                        <tr>
                            <td >PLAY MAKER</td>
                            <td>
                                <select name="playmaker" class="onlineform">
                                    <option value="">PM</option> 
                                    <?php
                                        $ruolo="PM";
                                        insertPlayer($ruolo);
                                    ?>
                                </select>
                            </td >
                        </tr>
                        <tr>
                            <td >GUARDIA</td>
                            <td>
                                <select name="guardia" class="onlineform">
                                    <option value="">G</option>
                                    <?php
                                        $ruolo="G";
                                        insertPlayer($ruolo);
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td >ALA PICCOLA</td>
                            <td>
                                <select name="alapiccola" class="onlineform">
                                    <option value="">AP</option>
                                    <?php
                                        $ruolo="AP";
                                        insertPlayer($ruolo);
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td >ALA GRANDE</td>
                            <td>
                                <select name="alagrande" class="onlineform">
                                    <option value="">AG</option>
                                    <?php
                                        $ruolo="AG";
                                        insertPlayer($ruolo);
                                    ?>
                                </select>
                            </td>
                            
                            
                        </tr>
                        <tr>
                            <td >CENTRO</td>
                            <td>
                            <select name="centro" class="onlineform">
                                <option value="">C</option>
                                <?php
                                    $ruolo="C";
                                    insertPlayer($ruolo);
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td >RISERVA PM</td>
                            <td>
                            <select name="riservaPM" class="onlineform">
                                <option value="">R PM</option>
                                <?php
                                    $ruolo="PM";
                                    insertPlayer($ruolo);
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td >RISERVA G</td>
                            <td>
                            <select name="riservaG" class="onlineform">
                                <option value="">R G</option>
                                <?php
                                    $ruolo="G";
                                    insertPlayer($ruolo);
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td >RISERVA AP</td>
                            <td>
                            <select name="riservaAP" class="onlineform">
                                <option value="">R AP</option>
                                <?php
                                    $ruolo="AP";
                                    insertPlayer($ruolo);
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td >RISERVA AG</td>
                            <td>
                            <select name="riservaAG" class="onlineform">
                                <option value="">R AG</option>
                                <?php
                                    $ruolo="AG";
                                    insertPlayer($ruolo);
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td >RISERVA C</td>
                            <td>
                            <select name="riservaC" class="onlineform">
                                <option value="">R C</option>
                                <?php
                                    $ruolo="C";
                                    insertPlayer($ruolo);
                                ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td >SQUADRA:</td>
                            <td>
                                <select name="squadra" class="onlineform">
                                <option value=""> TEAM</option>
                                
                                <?php
                                //vado alla ricerca dell'elenco di squadre create dall'utente 
                                //loggato a cui non è ancora stato assegnato un set di giocatori

                                require "../mysql_con.php";
                                $nome=$_SESSION["user"]["nomeUtente"];
                                if (!empty($_SESSION["user"])){
                                    
                                    $sql="SELECT TU.nome FROM utente AS U 
                                            JOIN (select * from teamutente
                                                    WHERE idteamUtente NOT IN (SELECT squadra FROM playerinteam)
                                                    ORDER BY idteamUtente ASC) AS TU 
                                            ON U.idUtente=TU.utente
                                            WHERE U.nomeUtente='$nome'";

                                    $result = $mysqli->query($sql);
                                    if(!$result) 
                                    echo '<script type="text/javascript">
                                            showERR("error","ERRORE RICERCA DELLE SQUADRE DA ALLESTIRE");
                                        </script>';
                                    
                                    if ($result->num_rows > 0) {
                                        while($row = mysqli_fetch_array($result)) {

                                            echo "
                                                <option value=" .$row['nome'].">" .$row['nome']." </option>
                                                
                                            " ;
                                        }

                                    } else {
                                        echo '<option value="">"NON CI SONO SQUADRE UTILIZZABILI"</option>';
                                        
                                    }
                                } 


                                ?>

                                </select>
                            </td>
                        </tr>
                        <tr>
                                <td id ="error-row" colspan="2">
                                    <p id="error"></p>
                                </td>
                            </tr>
                    </tbody>
                </table>
                <button class="button"type="submit">ACQUISTA</button>
            </form>
        </div>
    
    <div class="bottom_bar">
                
    </div>

    </html>

<?php




require "../mysql_con.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){  
    $playmaker= mysqli_real_escape_string($mysqli,$_POST['playmaker']);
    $guardia= mysqli_real_escape_string($mysqli,$_POST['guardia']);
    $alapiccola=mysqli_real_escape_string($mysqli,$_POST['alapiccola']);
    $alagrande=mysqli_real_escape_string($mysqli,$_POST['alagrande']);
    $centro=mysqli_real_escape_string($mysqli,$_POST['centro']);
    $riservaPM=mysqli_real_escape_string($mysqli,$_POST['riservaPM']);
    $riservaG=mysqli_real_escape_string($mysqli,$_POST['riservaG']);
    $riservaAP=mysqli_real_escape_string($mysqli,$_POST['riservaAP']);
    $riservaAG=mysqli_real_escape_string($mysqli,$_POST['riservaAG']);
    $riservaC=mysqli_real_escape_string($mysqli,$_POST['riservaC']);
    $squadra=mysqli_real_escape_string($mysqli,$_POST['squadra']);

//controllo se i campi sono stati riempiti per ogni giocatore altrimenti non vado avanti con l'inserimento
  
    if(empty($playmaker)||empty($guardia)||empty($alapiccola)||empty($alagrande)||empty($centro)||empty($squadra)) {
        echo '<script type="text/javascript">
                    showERR("error","COMPLETA LA FORMAZIONE");
                </script>';
    } else{

        //controllo che riserve e titolari siano diversi
        if($playmaker!=$riservaPM && $guardia!=$riservaG && $alapiccola!=$riservaAP && $alagrande!=$riservaAP && $centro!=$riservaC){

            //controllo che i budget necessario per l'acquisto dei giocatori scelti non superino il tetto massimo stabilito            
            $money=400;

            $idPM=find_id_PL("PM",$playmaker);
            $money=$money-find_price($idPM);

            $idG=find_id_PL("G",$guardia);
            $money=$money-find_price($idG);

            $idAP=find_id_PL("AP",$alapiccola);
            $money=$money-find_price($idAP);

            $idAG=find_id_PL("AG",$alagrande);
            $money=$money-find_price($idAG);

            $idC=find_id_PL("C",$centro);
            $money=$money-find_price($idC);

            $idRPM=find_id_PL("PM",$riservaPM);
            $money=$money-find_price($idRPM);

            $idRG=find_id_PL("G",$riservaG);
            $money=$money-find_price($idRG);

            $idRAP=find_id_PL("AP",$riservaAP);
            $money=$money-find_price($idRAP);

            $idRAG=find_id_PL("AG",$riservaAG);
            $money=$money-find_price($idRAG);

            $idRC=find_id_PL("C",$riservaC);
            $money=$money-find_price($idRC);

            //se i fondi bastano allora procedo con l'inserimento della formazione
            if($money>=0) {

            //aggiorno i fondi rimanenti dopo aver selezionato la formazione
                $sql="UPDATE teamutente SET money='$money' WHERE nome='$squadra';";
                $test=mysqli_query($mysqli, $sql)or die(mysqli_error($mysqli));
                if(!$test) 
                echo '<script type="text/javascript">
                        showERR("error","ERRORE AGGIORNAMENTO FONDI RIMASTI");
                    </script>';

                        
                //cerco idteamUtente proprietario della squadra che voglio popolare
                        $query="SELECT idteamUtente FROM fantanba.teamutente WHERE nome = '$squadra'";
                        $result0=mysqli_query($mysqli, $query);
                        $squadra= mysqli_fetch_array($result0, MYSQL_BOTH);  
                        $idplayer=0;
                        if(!$result0) 
                        echo '<script type="text/javascript">
                                    showERR("error","ERRORE NELLA QUERY DI RICERCA ID DEL TEAM SELEZIONATO");
                                </script>';

                        function inserisciT($idplayer, $squadra, $ruolo){
                            //funzione di inserimento giocatori titolari nel dB
                            require "../mysql_con.php";
                            $sql = "INSERT INTO playerinteam (player, squadra, titolare)
                                VALUES ('$idplayer', '".$squadra['idteamUtente']."', '1')";
                                $result = $mysqli->query($sql);
                                if(!$result) {
                                    echo '<script type="text/javascript">
                                                showERR("error","ERRORE '.$ruolo.'");
                                            </script>';
                                
                                    return false;
                                } else{
                                    return true;
                                }                                
                        }

                        function inserisciR($idplayer, $squadra, $ruolo){
                            //funzione di inserimento giocatori riserve nel dB
                            require "../mysql_con.php";
                            $sql = "INSERT INTO playerinteam (player, squadra, titolare)
                                VALUES ('$idplayer', '".$squadra['idteamUtente']."', '0')";
                                $result = $mysqli->query($sql);
                                if(!$result) {
                                    echo '<script type="text/javascript">
                                                showERR("error","ERRORE R'.$ruolo.'");
                                            </script>';
                                
                                    return false;
                                } else{
                                    return true;
                                }                                
                        }

                //inserisco playmaker
                        $ruolo="PM";
                        $idplayer=find_id_PL($ruolo,$playmaker);
                        $result1=inserisciT($idplayer, $squadra,"PM");
                          
                        
                //inserisco guardia
                        $ruolo="G";
                        $idplayer=find_id_PL($ruolo,$guardia);
                        $result2=inserisciT($idplayer, $squadra,"G");
                        
                                
                //inserisco ala piccola
                        $ruolo="AP";
                        $idplayer=find_id_PL($ruolo,$alapiccola);
                        $result3=inserisciT($idplayer, $squadra,"AP");

                                
                //inserisco ala grande
                        $ruolo="AG";
                        $idplayer=find_id_PL($ruolo,$alagrande);
                        $result4=inserisciT($idplayer, $squadra,"AG");

                            
                //inserisco centro
                        $ruolo="C";
                        $idplayer=find_id_PL($ruolo,$centro);
                        $result5=inserisciT($idplayer, $squadra,"C");


                //inserisco riserva PM
                        $ruolo="PM";
                        $idplayer=find_id_PL($ruolo,$riservaPM);
                        $result6=inserisciR($idplayer, $squadra,"PM");


                //inserisco riserva G
                        $ruolo="G";
                        $idplayer=find_id_PL($ruolo,$riservaG);
                        $result7=inserisciR($idplayer, $squadra,"G");


                //inserisco riserva AP
                        $ruolo="AP";
                        $idplayer=find_id_PL($ruolo,$riservaAP);
                        $result8=inserisciR($idplayer, $squadra,"AP");


                //inserisco riserva AG
                        $ruolo="AG";
                        $idplayer=find_id_PL($ruolo,$riservaAG);
                        $result9=inserisciR($idplayer, $squadra,"AG");


                //inserisco riserva C
                        $ruolo="C";
                        $idplayer=find_id_PL($ruolo,$riservaC);
                        $result10=inserisciR($idplayer, $squadra,"C");                   
                    
                        if($result0 && $result1 && $result2 && $result3 && $result4 && $result5 && $result6 && $result7 && $result8 && $result9 && $result10){

                                header("Location: roster.php");
                        }

             } else {
                echo '<script type="text/javascript">
                            showERR("error","I TUOI FONDI NON BASTANO PER IL ROSTER CHE HAI ALLESTITO");
                        </script>';
                }
         } else{
            echo '<script type="text/javascript">
                        showERR("error","HAI SCELTO PIU VOLTE LO STESSO GIOCATORE");
                    </script>';
         }   
    }

}
?>

<?php
//funzione per inserire un gicatore nella select option in cui scegliere la formazione

function insertPlayer ($ruolo){

    require "../mysql_con.php"; 
    
       
       $sql=" SELECT cognome, prezzo FROM nbaplayer WHERE ruolo='$ruolo' ";

        $result = $mysqli->query($sql);

        if(!$result) 
        echo '<script type="text/javascript">
                    showERR("error","ERRORE QUERY DI COMPILAZIONE SELECT OPTION");
                </script>';
        
        if ($result->num_rows > 0) {
            while($row = mysqli_fetch_array($result)) {

                echo "
                    <option value=" .$row['cognome'].">" .$row['cognome']."   $".$row['prezzo']." </option>
                    
                   " ;
            }

        } else {
            echo '<option value="">"NO PLAYER"</option>';
        }
 } 


//funzione ricera idPlayer del giocatore per preparare la INSERT nel DB

function find_id_PL($ruolo,$cognome){
    require "../mysql_con.php";
    
    $query="SELECT idnbaPlayer FROM fantanba.nbaplayer
             WHERE cognome='$cognome' AND ruolo='$ruolo';";

    $result = mysqli_query($mysqli, $query, MYSQLI_USE_RESULT);

    if(!$result){ 
        echo '<script type="text/javascript">
                    showERR("error","ERRORE QUERY RICERCA ID GIOCATORE");
                </script>';
    }else {
        $row=mysqli_fetch_array($result);
        $idplayer=$row['idnbaPlayer'];
        return $idplayer;
   }
}

//funzione ricerca prezzo giocatore

function find_price($id){
    require "../mysql_con.php";

    $query="SELECT prezzo FROM fantanba.nbaplayer
            WHERE idnbaPlayer='$id';";

    $result = mysqli_query($mysqli, $query, MYSQLI_USE_RESULT);

    if(!$result){ 
        echo '<script type="text/javascript">
                    showERR("error","ERRORE RICERCA PREZZO GIOCATORE");
                </script>';
    }else {
        $row=mysqli_fetch_array($result);
        $prezzo=$row['prezzo'];
        return $prezzo;
    }
}


?>

