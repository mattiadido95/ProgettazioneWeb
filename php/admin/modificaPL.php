<!-- PAGINA GESTIONE MODIFICA DATI GIOCATORI REGISTRATI NEL SISTEMA -->

<!DOCTYPE html>
<html lang="it">
<head>
    <title>MODIFICA</title>
    <meta charset="utf-8" />
    <link rel="icon" href="../../css/img/favicon.png" type="image/png" />
    <link rel="stylesheet" type="text/css" href="../../css/popwin.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
    <script src="../../javascript/utility.js"></script>
</head>

<body>

<div class="top_bar">
    <a class="reload" onclick="window.close()"><img alt="close" src="../../css/img/close.png"></a>
    <h1>MODIFICA GIOCATORE</h1>
    <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>
</div>
<div class="contenitore-centrale">

<?php

    require "../mysql_con.php";
    session_start();
    if(empty($_SESSION["user"])){
        header('Location: ../user/login.php');
    }
    if($_SESSION["user"]["amministratore"]==0){
        header("Location: ../home.php");
    }
   

    $str='';
    if( isset($_GET['q'])){
    $str= ($_GET['q']);
    }

    $idPL=$str;
  
    $findPL="SELECT * FROM nbaplayer WHERE idnbaPlayer='$str'";
    $result=$mysqli->query($findPL);
    $row=mysqli_fetch_array($result);
 
    echo  "<form action=\"modificaPL.php?q=$str\" method=\"POST\">";
    echo "<table class=\"upPL\">";
    echo"
        <tr>
            <td>NOME: </td>
            <td>".$row['nome']."</td>
            <td> <input type=\"text\" name=\"nome\" placeholder=\"nuovo valore\" autofocus> </td>
        </tr>

        <tr>
            <td>COGNOME: </td>
            <td>".$row['cognome']."</td>
            <td> <input type=\"text\" name=\"cognome\" placeholder=\"nuovo valore\"> </td>
        </tr>

        <tr>
            <td>SQUADRA NBA: </td>
            <td>".$row['squadraNba']."</td>
            <td> <input type=\"text\" name=\"nbateam\" placeholder=\"nuovo valore\"> </td>
        </tr>

        <tr>
            <td>PREZZO: </td>
            <td>".$row['prezzo']."</td>
            <td> <input type=\"text\" name=\"prezzo\" placeholder=\"nuovo valore\"> </td>
        </tr>

        <tr>
            <td>RUOLO: </td>
            <td>".$row['ruolo']."</td>
            <td> <input type=\"text\" name=\"ruolo\" placeholder=\"nuovo valore\"> </td>
        </tr>

        ";


        echo "</table>";
        echo '<input class="button" type="submit" value="AGGIORNA">';
        echo '</form>';

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        

            $colname = array("nome","cognome","squadraNba","prezzo","ruolo");
    
            if("" == trim($_POST['nome'])){
                $nome = '0';
            }else{
                $nome=$_POST['nome'];
            }

            if("" == trim($_POST['cognome'])){
                $cognome = '0';
            }else{
                $cognome=strtoupper($_POST['cognome']);
            }

            if("" == trim($_POST['nbateam'])){
                $squadra = '0';
            }else{
                $squadra=$_POST['nbateam'];
            }

            if("" == trim($_POST['prezzo'])){
                $prezzo = '0';
            }else{
                $prezzo=$_POST['prezzo'];
            }

            if("" == trim($_POST['ruolo'])){
                $ruolo = '0';
            }else{
                $ruolo=strtoupper($_POST['ruolo']);
            }

        $newdati = array($nome, $cognome, $squadra, $prezzo, $ruolo);
        $length = count($newdati);

        for($i = 0; $i < $length; $i++) {
            if($newdati[$i]=='  0'){ continue; 
            } else {

                $aggiorna="UPDATE nbaplayer SET $colname[$i]='$newdati[$i]' WHERE idnbaPlayer='$str';
                ";
               

                if ($mysqli->query($aggiorna) === FALSE) {
                    echo '<script type="text/javascript">
                            showERR("error","ERRORE AGGIORNAMENTO GIOCATORE");
                        </script>';
                }else{
                    header("location: modificaPL.php?q=$str");

                }
            }

        } 
    } 
        

?>
</div>

<div class="bottom_bar">
    <p id="error"></p>
</div>
</body>
</html>