 <!-- PAGINA PER IL LOGIN --> 

<!DOCTYPE html>

<html lang="it">

    <head>
        <title>LOGIN</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../../css/strutture.css"/>
        <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
        <link rel="icon" href="../../css/img/favicon.png" type="image/png" />
        <script src="../../javascript/utility.js"></script>
    </head>



    <body>

            <div class="top_bar">
                <form action="../home.php">
                    <button class="indietro" type="submit"><span>INDIETRO</span></button>
                </form>
                <h1 id="text">LOGIN</h1>
                <a class="reload" onclick="window.location.reload()"><img alt="reload" src="../../css/img/refresh.png"></a>
            </div>

            <div class="contenitore-centrale">
                <div class="container">

                    <div class="imgcontainer">
                        <img id="ball" alt="basket-ball" src="../../css/img/b-ball.png">
                    </div>

                        <form action="login.php" method="POST">          
                                    <table class="tab-login">
                                        <tbody>
                                            <tr>
                                                <td class="bold">UTENTE:</td>
                                                <td><input class="input-text" type="text" onClick="this.setSelectionRange(0, this.value.length)" placeholder="Utente" name="username" autofocus required></td>
                                            </tr>
                                            <tr>
                                                <td class="bold" id="password">PASSWORD:</td>
                                                <td> <input class="input-text" type="password" onClick="this.setSelectionRange(0, this.value.length)" placeholder="Password" name="password" required></td>
                                            </tr>
                                            <tr>
                                                <td class="button-cell" colspan="2">
                                                    <button class="button" type="submit">Entra</button>
                                                    <button class="button" type="reset">Cancella</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>
                                                        <input type="checkbox" checked="checked" name="remember"> Ricordami
                                                    </label>
                                                </td>
                                                <td>
                                                    <span class="psw">
                                                        <a href="recuperoPW.php">Password dimenticata?</a>
                                                    </span>   
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <p id="error"></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>      
                        </form>


                </div>
            </div>
        
        <div class="bottom_bar">
            
        </div>
    </body>

    </html>


        <?php
        session_start();
        ob_start(); 

        require "../mysql_con.php";

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = mysqli_real_escape_string($mysqli,$_POST["username"]);
            $password = mysqli_real_escape_string($mysqli,$_POST["password"]);    
        
            $auth = $mysqli->prepare("SELECT * FROM utente WHERE nomeUtente=? AND password=?");
            $auth->bind_param("ss", $username, $password);
            $auth->execute(); // lancio la query, e controllo quanti risultati ci sono con quel id e pwd
            $res = $auth->get_result();

            if ($res->num_rows == 0) {
                // Login fallito
            echo '<script type="text/javascript">
                        showERR("error","UTENTE O PASSWORD ERRATI");
                    </script>';
            }else {
                // Loggato con successo
                $user = $res->fetch_assoc(); // salvo l'utente nella session cosi posso leggerne i dati dove mi servono ( es. leggere username o altro )  
                $_SESSION["user"] = $user;
                header('Location: ../home.php');    
            }
        }


    ?>