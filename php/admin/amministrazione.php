 <!-- PAGINA MENU' AMMINISTRATORE GLOBALE -->

<!DOCTYPE html>
<html lang="it">

<head>
    <title>AMMINISTRAZIONE</title>
    <meta charset="utf-8" />
    <link rel="icon" href="../../css/img/favicon.png" type="image/png" />
    <link rel="stylesheet" type="text/css" href="../../css/amministrazione.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
</head>

<body>

<?php
 session_start();
 require "../mysql_con.php";
 
 if(empty($_SESSION["user"])){
     header('Location: ../user/login.php');
    
 }

 if($_SESSION["user"]["amministratore"]==0){
     header("Location: ../home.php");
 }

 echo '<h1>Benvenuto amministratore '.$_SESSION['user']['nomeUtente'].'</h1>'

?>

<div>

    

<table class="opzioni">
    
        <th>Scegli quali azioni compiere</th>

            <tr>
                <td class="ca"><a href="punteggiamm.php">Modifica punteggi giocatori</a></td>
            </tr>
            <tr>
                <td class="ca"><a href="teams.php">Elenco squadre partecipanti</a></td>
            </tr>
            <tr>
                <td class="ca"><a href="utenti.php">Elenco utenti iscritti</a></td>

            </tr>
            <tr>
                <td class="ca"><a href="nbaplayers.php">Elenco giocatori nel sistema</a></td>
            </tr>     
        
    
    </table>
    
    <form  action="../home.php">
        <input type="submit" value="HOME" />
    </form>

</div>

</body>
</html>