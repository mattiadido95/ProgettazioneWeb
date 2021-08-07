<!-- PAGINA PER RECUPERARE LA PASSWORD IN CASO DI SMARRIMENTO -->


<!DOCTYPE html>
<html lang="it">
<head>
    <title>RECUPERO PASSWORD</title>
    <meta charset="utf-8" />
    <link rel="icon" href="../../css/img/favicon.png" type="image/png" />
    <link rel="stylesheet" type="text/css" href="../../css/strutture.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
    <script src="../../javascript/utility.js"></script>
</head>
<body>


    <div class="top_bar">
   
        <form action="../home.php">
            <button class="indietro" type="submit"><span>INDIETRO</span></button>
        </form>
        <h1>RECUPERO PASSWORD</h1>
        <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>
    </div>

    

     <div class="contenitore-centrale">
        <div class="contenitoreRP">
            <form method="POST">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                NOME UTENTE:
                            </td>
                            <td>
                                <input class="input-RP" type="text" name="utente" placeholder="USER">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                DOMANDA DI SICUREZZA:
                            </td>
                            <td>
                                <select class="select-RP" name="domanda">
                                    <!-- <option value=""></option> -->
                                    <?php
                                        require "../mysql_con.php";

                                        $query="SELECT * FROM domanderecpw";
                                        $result = $mysqli->query($query);
                                        while($row = mysqli_fetch_array($result)){
                                            echo "
                                                <option value=".$row['iddomanda'].">".$row['testo']."</option>
                                            ";
                                        }

                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td  >
                                RISPOSTA:
                            </td>
                            <td>
                                <input class="input-RP" type="text" name="risposta" placeholder="RISPOSTA">
                            </td>
                        </tr>
                        <tr id="nuovapass">
                            <td  >
                                NUOVA PASSWORD:
                            </td>
                            <td>
                                <input id="password" class="input-RP" type="text" name="nuovapass" placeholder="NUOVA PASSWORD">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p id="error"></p>
                            </td>
                        </tr>
                        <tr id="button">
                            <td colspan="2">
                                <button class="button" type="submit">RISPONDI</button>
                            </td>
                        </tr>
                    </tbody>
                </table>     
            </form>

        <?php
        
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){


                if(!empty($_POST['utente'])){


                $nomeUtente=mysqli_real_escape_string($mysqli,$_POST['utente']);

                //cerco quanti tentativi ho ancora
                $query="SELECT tentativi FROM utente WHERE nomeUtente='$nomeUtente'";
                $result=$mysqli->query($query);
                $row=mysqli_fetch_array($result);
                $tentativi=$row[0];   
                        
                    
                if($tentativi <= 0){
                    echo '<script type="text/javascript">
                    showERR("table","ACCOUNT BLOCCATO CONTATTA LA DIREZIONE");
                    </script>';
                } else{

                //controllo se l'utente è nel sistema
                $query="SELECT * FROM utente WHERE nomeUtente='$nomeUtente'";
                $result=$mysqli->query($query);
                $rows=mysqli_num_rows($result);

                if($rows==0){
                //nome utente non trovato
                    echo '<script type="text/javascript">
                            showERR("error","nome utente non trovato nel sistema");
                        </script>';
                                

                } else {

                //operazioni per nome utente esistente
                    $query="SELECT domanda FROM utente WHERE nomeUtente='$nomeUtente'";
                    $row=mysqli_fetch_array($result);
                    $idDomanda=$row[0];

                    if($idDomanda == mysqli_real_escape_string($mysqli,$_POST['domanda'])){
                        //operazioni domanda scelta esatta
                        $query="SELECT risposta FROM utente WHERE nomeUtente='$nomeUtente'";
                        $result=$mysqli->query($query);
                        $row=mysqli_fetch_array($result);
                        $risposta=$row[0];
                        
                        if(mysqli_real_escape_string($mysqli,$_POST['risposta']) == $risposta){
                
                                //operazioni risposta data corretta
                                $newpass=mysqli_real_escape_string($mysqli,$_POST['nuovapass']);
                                if (strlen($newpass)<6){
                                        echo '<script type="text/javascript">
                                            showERR("error","la nuova password non è valida");
                                        </script>
                                    ';
                                    
                                } else {
                                    $query="UPDATE utente SET password='$newpass' WHERE nomeUtente='$nomeUtente'";
                                    $mysqli->query($query);
                                    header('Location: login.php');
                                }

                            
                        
                        }else {
                                //operazioni risposta data sbagliata

                                //aggiorno il numero di tentativi fatti
                                $query="UPDATE utente SET tentativi=tentativi-1 WHERE nomeUtente='$nomeUtente'";
                                $mysqli->query($query);

                                //cerco quanti tentativi ho ancora
                                $query="SELECT tentativi FROM utente WHERE nomeUtente='$nomeUtente' ";
                                $result=$mysqli->query($query);
                                $row=mysqli_fetch_array($result);
                                $tentativi=$row[0];

                                if($tentativi == 0){

                                    echo '<script type="text/javascript">
                                        showERR("table","ACCOUNT BLOCCATO CONTATTA LA DIREZIONE");
                                    </script>';
                    
                                } else{

                                echo '<script type="text/javascript">
                                    showERR("update","Risposta errata, ricordati che hai a disposizione solo '. $tentativi.' tentativi");
                                </script>';    
                                }                  

                            }
                            
                    } else {
                                //operazioni per domanda di sicurezza scelta errata

                                //aggiorno il numero di tentativi fatti
                                $query="UPDATE utente SET tentativi=tentativi-1 WHERE nomeUtente='$nomeUtente'";
                                $mysqli->query($query);

                                //cerco quanti tentativi ho ancora
                                $query="SELECT tentativi FROM utente WHERE nomeUtente='$nomeUtente' ";
                                $result=$mysqli->query($query);
                                $row=mysqli_fetch_array($result);
                                $tentativi=$row[0];


                                if($tentativi == 0){

                                    echo '<script type="text/javascript">
                                        showERR("a","ACCOUNT BLOCCATO CONTATTA LA DIREZIONE");
                                    </script>';
                    
                                } else{

                                echo '<script type="text/javascript">
                                    showERR("error","Domanda scelta errata, ricordati che hai a disposizione solo '. $tentativi.' tentativi");
                                </script>';
                                }

                        }

                    }

        

                }   
            } else{
                echo '<script type="text/javascript">
                                    showERR("error","COMPLETA TUTTI I CAMPI");
                                </script>';
            }   
            }
        ?>
        </div>
    </div>

    <div class="bottom_bar">

    </div>

</body>
</html>