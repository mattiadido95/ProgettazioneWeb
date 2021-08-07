 <!-- PAGINA CREAZIONE DI UNA NUOVA LEGA -->

<?php
session_start();
ob_start();

//se non sei loggato torni al login
if(empty($_SESSION["user"]))
    header("Location: ../user/login.php");

?>
<!DOCTYPE html>
    <html lang="it">

    <head>
        <title>NUOVA LEGA</title>
        <meta charset="utf-8" />
        <link rel="icon" href="../../css/img/favicon.png" type="image/png" />
        <link rel="stylesheet" type="text/css" href="../../css/strutture.css" />
        <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
        <script src="../../javascript/utility.js"></script>
    </head>
    <script language="javascript" type="text/javascript">
        function removeSpaces(string) {
        return string.split(' ').join('');
        }
    </script>

    <body>
        
    <div class="top_bar">
        <form  action="lega.php">
            <button class="indietro" type="submit"><span>ANNULLA</span></button>
        </form>
        <h1 id="text">LEGA</h1>
        <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>
    </div>
   
    
    <div class="contenitore-centrale">

        <form class="nuova-lega" action="nuova_lega.php" method="POST">
            <h1 id="text-newteam">CREA UN TUO CAMPIONATO</h1>
                <table>
                    <tbody>
                        <tr>
                            <td >NOME LEGA:*</td>
                            <td>
                                <input type="text"  placeholder="nome"  name="nome" value="" class="onlineform" onblur="this.value=removeSpaces(this.value);" autofocus>
                            </td>
                        </tr>

                        <tr>
                            <td >SQUADRA:</td>
                            <td>
                                <select name="squadra" class="onlineform">
                                <option value="">SCEGLI UN TEAM</option>
                                <?php

                                    require "../mysql_con.php";
                                    $nome=$_SESSION["user"]["nomeUtente"];

                                    if (!empty($_SESSION["user"])){
                                        $sql="SELECT TU.nome 
                                                FROM utente AS U JOIN teamutente AS TU 
                                                    ON U.idUtente=TU.utente
                                                WHERE U.nomeUtente='$nome'";
                                        $result = $mysqli->query($sql);
                                        if(!$result) 
                                        echo '<script type="text/javascript">
                                                    showERR("error","ERRORE RICERCA DELLE SQUADRE DELL UTENTE");
                                                </script>';
                                        
                                        if ($result->num_rows > 0) {
                                            while($row = mysqli_fetch_array($result)) {

                                                echo "
                                                    <option value=" .$row['nome'].">" .$row['nome']." </option>
                                                    
                                                " ;
                                            }

                                        } else {
                                            echo '<option value="">"NO TEAM"</option>';
                                        }
                                    } else {
                                        header("Location: ../user/login.php");
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
                <button class="button" type="submit">INSERISCI</button>  
        </form>
    </div>
       
    <div class="bottom_bar">
        
    </div> 

</body>


</html>


<?php

require "../mysql_con.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){  
    $nome= mysqli_real_escape_string($mysqli,strtoupper($_POST['nome']));
    $squadra= mysqli_real_escape_string($mysqli,$_POST['squadra']);

    
    if(empty($nome)||empty($squadra)) {
        echo '<script type="text/javascript">
                    showERR("error","RIEMPIRE TUTTI I CAMPI");
                </script>';
    } else{

        $sql="SELECT *  FROM lega  WHERE nomeLega='$nome'";
        $result=mysqli_query($mysqli, $sql);
        $rows=mysqli_num_rows($result);
        
        if($rows==0){
            $query= "SELECT idteamUtente FROM teamutente
                WHERE nome='$squadra'";
                $ris=mysqli_query($mysqli,$query);
            $idsquadra= mysqli_fetch_array($ris, MYSQL_BOTH);
            //inserisco la squadra nella lega appena creata
            $sql = "INSERT INTO fantanba.lega (nomeLega, team, amministratoreLega)
            VALUES ('$nome','".$idsquadra['idteamUtente']."', '1')";
            
            if ($mysqli->query($sql) === TRUE) {
                header('location:lega.php');
            } else {
                
                echo '<script type="text/javascript">
                        showERR("error","ERRORE DI INSERIMENTO");
                    </script>';
            } 

        } else {
            
            echo '<script type="text/javascript">
                        showERR("error","NOME LEGA NON DISPONIBILE");
                    </script>';

        }
    
    }
}
 

?>