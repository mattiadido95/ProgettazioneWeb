   
<?php
/* CODICE AGGIORNAMENTO LICENZA DI AMMINISTRATORE GLOBALE */
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

    $sql="UPDATE utente SET amministratore=(
            CASE
                WHEN (amministratore='0') THEN '1'
                WHEN (amministratore='1') THEN '0'
                ELSE (amministratore)
            END)
            WHERE idUtente='$str';";

    if ($mysqli->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }else{    

            $query="SELECT COUNT(amministratore) FROM utente WHERE amministratore='1';";
            $result=$mysqli->query($query);
            $row=mysqli_fetch_row($result);
            
            if($row[0]==0){
               $reset="UPDATE utente SET amministratore='1' WHERE idUtente='$str'";
               $mysqli->query($reset);
               header("Location: utenti.php");
                
            }else{
                header("Location: utenti.php");
            }
    }
    

?>




