 <!-- INSERIMENTO NUOVO GIOCATORE NBA NEL SISTEMA -->

<!DOCTYPE html>
<html lang="it">
<head>
    <title>NUOVO GIOCATORE</title>
    <meta charset="utf-8" />
    <link rel="icon" href="../../css/img/favicon.png" type="image/png" />
    <link rel="stylesheet" type="text/css" href="../../css/popwin.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
    <script src="../../javascript/utility.js"></script>
</head>

<body>

<div class="top_bar">
    <a class="reload" onclick="window.close()"><img alt="close" src="../../css/img/close.png"></a>
    <h1>NUOVO GIOCATORE</h1>
    <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>
</div>
    
<div class="contenitore-centrale">

    <form action="newplayer.php" method="POST">
        <table class="newPL">
            <tr>
                <td>NOME:</td>
                <td><input type="text" name="nome" autofocus></td>
            </tr>
            <tr>
                <td>COGNOME:</td>
                <td><input type="text" name="cognome"></td>
            </tr>
            <tr>
                <td>Squadra NBA:</td>
                <td><input type="text" name="NBAteam"></td>
            </tr>
            <tr>
                <td>PREZZO:</td>
                <td><input type="text" name="prezzo"></td>
            </tr>
            <tr>
                <td>RUOLO:</td>
                <td><input type="text" name="ruolo"></td>
            </tr>
            
        </table>

        <input class="button" type="submit" value="INSERISCI">


        
    </form>

</div>

    <div class="bottom_bar">
        <p id="error"></p>
    </div>




    <?php
    
        require "../mysql_con.php";

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nome=$_POST['nome'];
            $cognome=strtoupper($_POST['cognome']);
            $squadraNBA=$_POST['NBAteam'];
            $prezzo=$_POST['prezzo'];
            $ruolo=strtoupper($_POST['ruolo']);


            if(empty($nome)||empty($cognome)||empty($squadraNBA)||empty($prezzo)||empty($ruolo)){
                echo '<script type="text/javascript">
                showERR("error","MANCANO DELLE INFORMAZIONI");
            </script>' ;
            }else{
                $cercaduplicato="SELECT * FROM nbaplayer WHERE nome='$nome' AND cognome='$cognome'";
                $result=mysqli_query($mysqli, $cercaduplicato);
                $rows=mysqli_num_rows($result);
                
                if($rows==0){

                    if($prezzo<=300){
                        $insert="INSERT INTO nbaplayer (nome,cognome,squadraNba,prezzo,ruolo) 
                                    VALUES ('$nome', '$cognome', '$squadraNBA', '$prezzo','$ruolo')
                                    ";
                        $result=$mysqli->query($insert);
                        if(!$result){ 
                            echo 
                            '<script type="text/javascript">
                                showERR("error","ERRORE INSERIMENTO NUOVO GIOCATORE");
                            </script>'
                            ;
                        }else{
                            header("Location: newplayer.php");
                        }
                    } else {
                        echo 
                        '<script type="text/javascript">
                                showERR("error","PREZZO SCELTO TROPPO ELEVATO");
                            </script>';
                    }

                } else{
                    echo 
                    '<script type="text/javascript">
                                showERR("error","STAI INSERENDO UN GIOCATORE GIA PRESENTE NEL SISTEMA");
                            </script>';
                }
            }
        }

    ?>














</body>
</html>
