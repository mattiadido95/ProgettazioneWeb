<!-- PAGINA REGISTRAZIONE AL SISTEMA -->

<!DOCTYPE html>
<html lang="it">

<head>
    <title>Registrazione</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../../css/strutture.css" />
    <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
    <link rel="icon" href="../../css/img/favicon.png" type="image/png"/>
    <script src="../../javascript/utility.js"></script>
</head>

<body>

    <div class="top_bar">
        <form action="../home.php">
            <button class="indietro" type="submit"><span>ANNULLA</span></button>
        </form>
        <h1>REGISTRATI SU FANTANBA</h1>
        <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>
    </div>

    <div class="contenitore-centrale">
        <form class="registrazione" action="registrazione.php" method="POST">        
            <table >
                <tbody>
                    <tr>
                        <td >NOME:</td>
                        <td>
                            <input type="text"  placeholder="Nome"  name="nome" autofocus>
                        </td>
                    </tr>

                    <tr>
                        <td >COGNOME:</td>
                        <td>
                            <input type="text"  placeholder="Cognome"  name="cognome">
                        </td>
                    </tr>

                    <tr>
                        <td >DATA DI NASCITA:*</td>
                        <td>
                            <input type="date" name="dataNascita">
                        </td>
                    </tr>

                    <tr>
                        <td >NOME UTENTE:*</td>
                        <td>
                            <input type="text" placeholder="User" name="nomeUtente">
                        </td>
                    </tr>

                    <tr>
                        <td >E-MAIL:*</td>
                        <td>
                            <input id="email" type="email" placeholder="Aaaa@aaaa.com" name="email">
                        </td>
                    </tr>

                    <tr>
                        <td >PASSWORD:*</td>
                        <td>
                             <input id="password" type="password"  placeholder="Password" name="password">
                        </td>
                    </tr>

                    <tr>
                        <td >SESSO:</td>
                        <td>
                            <select name="sesso" class="onlineform">
                                <option value=" ">SELEZIONA UN OPZIONE</option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td >DOMANDA DI SICUREZZA:*</td>
                        <td>
                            <select name="domanda">
                            <option value=" ">SELEZIONA UN DOMANDA</option>
                            <?php
                                require "../mysql_con.php";
                                $query= "SELECT * FROM domanderecpw";
                                $result = $mysqli->query($query);
                                while($row = mysqli_fetch_array($result)) {
                                    echo "
                                        <option value=" .$row['iddomanda'].">" .$row['testo']."</option>
                                        
                                    " ;

                                }
                                

                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td >RISPOSTA DI SICUREZZA:*</td>
                        <td>
                            <input type="text" name="risposta" placeholder="Risposta di sicurezza">
                        </td>
                    </tr>

                    <tr id="avatar-tr">
                        <td id="avatar">AVATAR:</td>
                        <td >
                            <div class="avatar_img">
                                <div class="avatar_choice"><input type="radio" name="avatar" value="avatar1" checked="checked"/> <img alt="avatar" class="avatar" src="../../css/img/avatar1.png"></div>
                                <div class="avatar_choice"><input type="radio" name="avatar" value="avatar2"/> <img alt="avatar" class="avatar" src="../../css/img/avatar2.png"></div>
                                <div class="avatar_choice"><input type="radio" name="avatar" value="avatar3"/> <img alt="avatar" class="avatar" src="../../css/img/avatar3.png"></div>
                                <div class="avatar_choice"><input type="radio" name="avatar" value="avatar4"/> <img alt="avatar" class="avatar" src="../../css/img/avatar4.png"></div>
                            </div>
                         </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p id="error"></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                             <button id="inserisci" class="button" type="submit">INSERISCI</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    
    <div class="bottom_bar">
            
    </div>




    
    </body>
    </html>

    
<?php

require "../mysql_con.php";
ob_start();

$oggi = date("Y-m-d");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){  
    $nome= ucfirst(strtolower($_POST['nome']));
    $cognome= mysqli_real_escape_string($mysqli,strtoupper($_POST['cognome']));
    $dataNascita= $_POST['dataNascita'];
    $sesso= $_POST['sesso'];
    $nomeUtente = mysqli_real_escape_string($mysqli,$_POST['nomeUtente']);
    $password = $_POST['password'];
    $avatar = $_POST['avatar'];
    $email = $_POST['email'];
    $domanda = $_POST['domanda'];
    $risposta = $_POST['risposta'];
    
    
    if(empty($nomeUtente)||empty($password)||empty($dataNascita)||empty($email)||empty($domanda)||empty($risposta)) {
        //controllo se ci sono campi vuoti
        echo '<script type="text/javascript">
                showERR("error","NON SONO STATE INSERITE TUTTE LE INFORMAZIONI");
             </script>';
    } else{
        //campi riempiti
        //controllo se il nome utente scelto è gia in uso da un altro utente
        $sql="SELECT *  FROM UTENTE  WHERE nomeUtente='$nomeUtente'";
        $result=mysqli_query($mysqli, $sql);
        $rows=mysqli_num_rows($result);
        
        if($rows==0){
            //nome utente disponibile, controllo domanda e password
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo '<script type="text/javascript">
                            showERR("error","FORMATO EMAIL NON VALIDO");
                        </script>
                ';
            } else if($dataNascita>$oggi){
                //controllo se la data di nascita immessa è valida
                echo '<script type="text/javascript">
                            showERR("error","DATA SCELTA NON AMMESSA");
                        </script>
                 ';

            
            } else if (strlen($_POST['password'])<6) {
                //controllo se la password è di una lunghezza minima di 6 caratteri
                        echo '<script type="text/javascript">
                                    showERR("error","FORMATO PASSWORD NON VALIDO");
                                </script>
                        ';
            } else {
                
                //controlli superati, procedo con la registrazione del nuovo utente
                    $sql = "INSERT INTO fantanba.utente (nome, cognome, dataNascita, sesso, nomeUtente, password, avatar, email, domanda, risposta)
                    VALUES ('$nome','$cognome','$dataNascita','$sesso','$nomeUtente', '$password', '$avatar', '$email', '$domanda', '$risposta')";
                    
                
                    if ($mysqli->query($sql) === TRUE) {
                        //registrazone avvenuta con successo, passare al login
                        echo'
                            <script type="text/javascript">
                                window.location.href="login.php";
                            </script>
                        ';
                        
                    } else {
                        //errore nella registrazione del nuovo utente
                        echo '<script type="text/javascript">
                                showERR("error","ERRORE NELLA REGISTRAZIONE DEL NUOVO UTENTE");
                            </script>';
                    } 
            }
        } else {
            //nome utente non disponibile
            echo '  <script type="text/javascript"> 
                        showERR("error","NOME UTENTE NON DISPONIBILE");
                    </script>';  

        }
    
    }
}
 

?>



