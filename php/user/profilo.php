<!-- PAGINA PROFILO CON I DATI DELL'UTENTE -->

<!DOCTYPE html>

<html lang="it">
<head>
    <title>
        <?php
            require "../mysql_con.php";
            session_start();
            echo $_SESSION['user']['nomeUtente'];
        ?>
    </title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../../css/strutture.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
    <link rel="icon" href="../../css/img/favicon.png" type="image/png"/>
</head>

<body>
    <div class="top_bar">
        <form id="form_profile"  action="../home.php">
         <button class="indietro" type="submit"><span>INDIETRO</span></button>
        </form>
        <h1 id="text">PROFILO</h1>
        <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>
    </div>
    <div class="contenitore-centrale">

        <div id="profilo-img">
            <?php
                require "../mysql_con.php";
                if(empty($_SESSION["user"])){
                    header('Location: ../user/login.php');
                
                }
                echo '<img alt="avatar" src="../../css/img/'.$_SESSION["user"]["avatar"].'.png">';
            ?>
        </div>
                
        
        <table class="profilo">
                <tbody>
                    <tr>
                        <td class="bold" >NOME:</td>
                        <td > <?php echo $_SESSION["user"]["nome"]; ?></td>
                    </tr>
                    <tr>
                        <td class="bold">COGNOME:</td>
                        <td ><?php echo $_SESSION["user"]["cognome"]; ?></td>
                    </tr>
                    <tr>
                        <td class="bold">DATA DI NASCITA:</td>
                        <td><?php echo $_SESSION["user"]["dataNascita"]; ?></td>
                    </tr>
                    <tr>
                        <td class="bold">NOME UTENTE:</td>
                        <td><?php echo $_SESSION["user"]["nomeUtente"]; ?></td>
                    </tr>
                    <tr>
                        <td class="bold">E-MAIL:</td>
                        <td > <?php echo $_SESSION["user"]["email"]; ?></td>
                    </tr>
                    <tr>
                        <td class="bold">SESSO:</td>
                        <td><?php echo $_SESSION["user"]["sesso"]; ?></td>
                    </tr>
                    <tr>
                        <td class="bold" >AMMINISTRATORE:</td>
                        <td><?php if($_SESSION["user"]["amministratore"]==1){
                                echo "Si"; 
                            } else {
                                echo "No";
                            }
                                ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        
    </div>
    
    <div class="bottom_bar">  

    </div>

</body>


</html>