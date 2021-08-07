 <!-- PAGINA AMMINISTRAZIONE PUNTEGGI GIOCATORI NBA  -->

<!DOCTYPE html>
<html lang="it">

<head>
    <title>AMMINISTRAZIONE PUNTEGGI</title>
    <meta charset="utf-8" />
    <link rel="icon" href="../../css/img/favicon.png" type="image/png" />
    <link rel="stylesheet" type="text/css" href="../../css/strutture.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
    <script src="../../javascript/utility.js"></script>
</head>

<body class="punteggi">

    <div class="half">

        <div class="top_bar">

            <form  action="amministrazione.php">
                <button class="indietro" type="submit"><span>INDIETRO</span></button>
            </form>

            <h1>ELENCO GIOCATORI NBA</h1>

            <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>

        </div>  
        
        <div class="contenitore-centrale">
        <?php

            ob_start();
            session_start();
            require "../mysql_con.php";
            date_default_timezone_set('Europe/Rome');

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
            
            

//elenco tutti i giocatori nel dB
            $query="SELECT * FROM nbaplayer;";
            $result=$mysqli->query($query);

            echo"
                 <input type=\"text\" id=\"myInput\" onkeyup=\"findUpdate('myTable')\" placeholder=\"CERCA GIOCATORE\" autofocus>";

            echo '<form method="POST">';

            echo '<table class="tab_amm" id="myTable">';
            echo '<thead>';
            echo '
                <tr>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Punteggio attuale</th>
                    <th>Nuovo Punteggio</th>
                </tr>';
            echo '</thead>';
            $count=0;
            echo '<tbody>';

            while($row = mysqli_fetch_array($result)) {
// this.setSelectionRange() seleziona tutto l'attuale testo presente nell'input al click
                echo' 
                <tr>
                    <td>'.$row['nome'].'</td>
                    <td>'.$row['cognome'].'</td>
                    <td>'.$row['punteggio'].'</td>
                    <td> <input type="text" name="newpoints[]" value="0" onClick="this.setSelectionRange(0, this.value.length)"> </td>

                </tr>                       
                    ';

            }
            echo '</tbody>';
            echo '</table>';

            echo "<p class=\"info-update\">Aggiorna i punteggi dei giocatori che hanno giocato nell' utlima giornata</p>";

            echo '<input type="submit" value="AGGIORNA PUNTEGGI">';

            echo '</form>';

            echo "<p class=\"info-update\">Data ultima modifica ai punteggi ";
                    
                        //mostrare dati ultima modifica ai punteggi
                        $date="SELECT * FROM lastupdate WHERE tipologia='punteggio';";
                        $a=$mysqli->query($date);
                        while($row = mysqli_fetch_array($a)){
                            echo $row['data'];
                            echo " apportata da ";
                            echo $row['utente'];
                        }
            echo "</p>";
            
            if($str==1){

                echo "<p class=\"info-update\">Ora aggiorna le classifiche dei capionati</p>";

                echo "               
                     <form action=\"updateCLASS.php\">
                        <input type=\"submit\" value=\"AGGIORNA CLASSIFICHE\">
                    </form>
                        
                   ";
                            
                 echo "<p class=\"info-update\">Data ultima modifica alle classifiche ";
                   
             //mostrare dati ultima modifica ai punteggi
                 $date="SELECT * FROM lastupdate WHERE tipologia='classifiche';";
                 $a=$mysqli->query($date);
                 while($row = mysqli_fetch_array($a)){
                     echo $row['data'];
                     echo " apportata da ";
                     echo $row['utente'];
                 }
             echo "</p>";

                }


           
//salvo tutti i campi input in un array $point che avrà tutti i nuovi punteggi
           $point = isset($_POST['newpoints']) ? $_POST['newpoints'] : array();
               
//rilancio la query per avere tutti gli id dei giocatori nel db
            $result=$mysqli->query($query);
           
//array per salvare gli id di tutti i giocatori nel dB
            $listid=[];
            while($row = mysqli_fetch_assoc($result))    {
                $listid[]=$row['idnbaPlayer'];   
            }  

            

//variabile per controllare se ci sono errori durante ogni aggiornamento dei punteggi
            $check=false;
          
//richiesta di aggiornare i punteggi al SUBMIT
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){

                $i=0;            
                
                //azzero tutti i punteggi dei giocatori che non hanno giocato nell'ultima giornata e che quindi non hanno statistiche valide
                $azzera="UPDATE nbaplayer SET punteggio='0';";
                $mysqli->query($azzera);
                
                //aggiorno i punteggi dei giocatori che invece hanno giocato e hanno punteggi validi
                while($i<$result->num_rows){
                $update="UPDATE nbaplayer SET punteggio='$point[$i]' WHERE idnbaPlayer='$listid[$i]' ;";
                $test=$mysqli->query($update);
                $i++;

                //se durante l'esecuzione della update ci sono errori setto $check a false per evidenziare un errore
                if($test){
                    $check=true;
                }else {
                    $check=false;
                    echo 
                            '<script type="text/javascript">
                                showERR("error","PROBLEMI AGGIORNAMENTO PUNTEGGI GIOCATORI");
                            </script>';
                    break;  
                }

                }


//salvo la data attuale cosi da avere nel dB la data dell'ultima modifica ai punteggi
                $now=date("Y-m-d H:i:s");
                $utente=$_SESSION["user"]["nomeUtente"];
                $lastupdate="UPDATE lastupdate SET data='$now', utente='$utente' WHERE tipologia='punteggio';";
                $prova=$mysqli->query($lastupdate);
                if(!$prova){
                    echo 
                            '<script type="text/javascript">
                                showERR("error","PROBLEMI AGGIORNAMENTO DATA ULTIMA MODIFICA");
                            </script>';
                    
                }   
            $a=1;
            
            echo "<script>esegui($a);</script>";
} 

           
            
 ?>
</div>
 
    <div class="bottom_bar">
        <p id="error"></p>
    </div>




            
    </div>

    <div class="half">
        <iframe src="https://www.basketball-reference.com/boxscores/">

    </div>






</body>

</html>

