<!-- PAGINA INSERIMENTO DI UN NUOVO TEAM -->

<!DOCTYPE html>

    <html lang="it">

    <head>

        <title>NUOVO TEAM</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../../css/strutture.css" />
        <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
        <link rel="icon" href="../../css/favicon.png" type="image/png" />
        <script src="../../javascript/utility.js"></script>

    </head>
    <script language="javascript" type="text/javascript">
        function removeSpaces(string) {
        return string.split(' ').join('');
        }
    </script>
<body>


    <div class="top_bar">
        <form  action="roster.php">
            <button class="indietro" type="submit"><span>ANNULLA</span></button>
        </form>
        <h1 id="text">TEAM</h1>
        <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>
    </div>

   <div class="contenitore-centrale">
        <form class="new-team" action="nuovo_team.php" method="POST">
            <h1 id="text-newteam">CREA UN NUOVO TEAM</h1>
                <table>
                    <tbody>
                        <tr>
                            <td >NOME TEAM:*</td>
                            <td>
                                <input type="text"  placeholder="Nome"  name="nome" value="" class="onlineform" onblur="this.value=removeSpaces(this.value);" autofocus>
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

session_start();
ob_start();

//se non sei loggato torni al login
if(empty($_SESSION["user"]))
    header("Location: ../user/login.php");


require "../mysql_con.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){  
    $nome= mysqli_real_escape_string($mysqli,strtoupper($_POST['nome']));
    

    
    if(empty($nome)) {

        echo '<script type="text/javascript">
                showERR("error","DATI MANCANTI");
            </script>';
    } else{   

        $sql="SELECT *  FROM teamutente  WHERE nome='$nome'";
        $result=mysqli_query($mysqli, $sql);
        $rows=mysqli_num_rows($result);
        
        if($rows==0){
           
            $sql = "INSERT INTO fantanba.teamutente (nome, utente)
                      VALUES ('$nome', '".$_SESSION['user']['idUtente']."')";
            
            if ($mysqli->query($sql) === TRUE) {
                //squadra inserita con successo, si passa ad allestire il roster
                header('location:nuovo_roster.php');
            } else {
                echo '<script type="text/javascript">
                        showERR("error","ERRORE DI INSERIMENTO");
                    </script>';
            } 

        } else {
            echo '<script type="text/javascript">
                    showERR("error","NOME NON DISPONIBILE");
                </script>';
        }
    
    }
}
 

?>
