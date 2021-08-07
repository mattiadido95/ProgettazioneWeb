<!-- PAGINA ELIMINAZINOE GIOCATORE NBA DAL SISTEMA -->

<!DOCTYPE html>
<html lang="it">
<head>
    <title>ELIMINA GIOCATORE</title>
    <meta charset="utf-8" />
    <link rel="icon" href="../../css/img/favicon.png" type="image/png" />
    <link rel="stylesheet" type="text/css" href="../../css/popwin.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
    <script src="../../javascript/utility.js"></script>
</head>


<?php

require "../mysql_con.php";

$checkBox = isset($_POST['player']) ? $_POST['player'] : array();

if(isset($_POST['submit'])){

    //cancello le righe corrispondenti ai giocatori che voglio eliminare

            for ($i=0; $i<sizeof($checkBox); $i++){
                    $delete="DELETE FROM nbaplayer WHERE idnbaPlayer='$checkBox[$i]'";
                
                    if ($mysqli->query($delete) === FALSE) {
                            echo 
                            '<script type="text/javascript">
                                showERR("error","ERRORE ELIMINAZIONE GIOCATORE");
                            </script>';
                           
                        }
            }
        
            header('Location: deleteplayers.php');
    }
?>

<body>

<div class="top_bar">

    <a class="reload" onclick="window.close()"><img alt="close" src="../../css/img/close.png"></a>
    <h1>SCEGLI QUALI GIOCATORI ELIMINARE</h1>
    <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>
    
</div>
<div class="contenitore-centrale">

        <input type="text" id="myInput" onkeyup="findPlayer('deletePL')" placeholder="CERCA GIOCATORE" autofocus>

        

        <form action="deleteplayers.php" method="POST">
            <table id="deletePL">
                <thead>
                    <tr>
                        <th class="short">&#10004;</th>
                        <th>NOME</th>
                        <th>COGNOME</th>
                        <th class="short">#</th>

                    </tr>
                </thead>

                <tbody>
                <?php
                require "../mysql_con.php";

                $players="SELECT * FROM nbaplayer;";
                $result=$mysqli->query($players);
                while($row=mysqli_fetch_array($result)){

                    echo "<tr>
                            <td class=\"short\"> <input type='checkbox' name='player[]' value='".$row['idnbaPlayer']."'></td>  
                            <td>".$row['nome']." </td>   
                            <td>".$row['cognome']." </td>
                            <td class=\"short\">".$row['ruolo']."</td>
                        </tr>"
                    ;
                }

                ?>
                </tbody>
                </table>

                
                <input class="button" type="submit" value="ELIMINA" name="submit"> 
               


        </form>


</div>
            
    <div class="bottom_bar">
        <p id="error"></p>
    </div>
</body>
</html>