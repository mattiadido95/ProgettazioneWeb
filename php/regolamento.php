<!-- PAGINA REGOLAMENTO PER PARTECIPARE AL FANTANBA --> 


<!DOCTYPE html>
<html lang="it">


<head>
    <title>REGOLAMENTO</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../css/strutture.css" />
    <link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
    <link rel="icon" href="../css/img/favicon.png" type="image/png" />
</head>
<body>

    <div class="top_bar">
        <form action="home.php">
            <button class="indietro" type="submit"><span>INDIETRO</span></button>
        </form>
        <h1 id="text">REGOLAMENTO</h1>
        <a class="reload" onclick="window.location.reload()"><img src="../css/img/refresh.png" alt="reload"></a>
    </div>

    <div class="contenitore-centrale">
        <div id="corpo">
            <ol>
<?php
                    require "mysql_con.php";
                    session_start();

                    if(!empty($_SESSION["user"]["amministratore"])){
                    $amm=$_SESSION["user"]["amministratore"];
                    if($amm==1){
                        echo "
                                <li>
                                    <h2>ACCOUNT</h2>
                                    <p>Per giocare &#232; necessario registrarsi. Dovrai creare un nuovo account se non ne possiedi gi&#224; uno.</p>
                                </li>
                                <li> 
                                    <h2>AMMINISTRATORE</h2>
                                    <p>
                                        In caso tu sia AMMINISTRATORE del sistema sar&#224; necessario che tu ogni giorno acceda al pannello amministrazione in cui dovrai aggiornare i punteggi di tutti i giocatori nel sistema alle ultime statistiche NBA.
                                        Inoltre avrai la possibilit&#224; di poter eleggere un altro utente a tua scelta come AMMINISTRATORE globale, potrai inserire nuovi gicatori NBA nel sistema o eliminarne se necessario in fase di pre-campionato (prima che vengano aperte le iscrizioni al sistema). Potrai modificare i giocatori solo a campionati conclusi, momento in cui il sistema verr&#224; resettato.
                                    </p>                        
                                </li>
                                <li>
                                    <h2>CALENDARIO</h2>
                                    <p>Il calendario di FANTANBA segue fedelmente quello NBA relativo alla sola Regular Season (playoff esclusi). 
                                        Ogni giorno dovrai schierare la miglior formazione possibile scegliendo il maggior numero di giocatori a tua disposizione che quella notte scender&#224;
                                        in campo per accumulare piu punti possibili, il tutto scegliendo 5 titolari e 5 panchinari. &#200; importante controllare quotidianamente il calendario NBA e la situazione della propria squadra. 
                                        Potrai modificare la tua formazione entro la fascia oraria compresa tra le 08:00 e 16:00, ore italiane, ogni giorno.
                                    </p>
                                </li>
                                <li>
                                    <h2>GIOCATORI NBA</h2>
                                    <p>Nel sistema sono inseriti la maggior parte dei gicatori NBA attualmente in attivo scelti per popolarit&#224; e miglior storico di statistiche annuali.
                                    </p>
                                </li>
                                <li>
                                    <h2>LA TUA SQUADRA</h2>
                                    <p>Puoi creare una o piu squdre allestendo un roster fatto di 10 giocatori, senza superare il budget di 400$ che ogni squadra ha a disposizione.
                                        Una volta creata la tua squadra potrai inziare a competere in un campionato con i tuoi amici.
                                        Il tuo roster fatto di 10 giocatori sar&#224; comprensivo di 2 giocatori per ruolo. I ruoli in cui i giocatori sono suddivisi sono: playmaker (PM), guardia (G), ala piccola (AP), ala grande (AG) e centro (C).
                                    </p>
                                </li>
                                <li>
                                    <h2>LEGA</h2>
                                    <p>Una lega &#232; un campionato creato da te o un altro utente nel quale puoi competere con i tuoi amici. Il numero di partecipanti &#232; illimitato come il numero di campionati a cui puoi partecipare con le tue squadre.
                                        In ogni lega pu&#242; esserci una tua sola squadra. Potrai creare una tua lega della quale sarai amministratore, alla quale parteciperai tu e gli amici che vorrai aggiungere.
                                    </p>
                                </li>
                                <li>
                                    <h2>PUNTEGGI GIOCATORI</h2>
                                    <p>Ogni giocatore per ogni giornata ricever&#224; un punteggio basato sulle statistiche NBA interenti ai plus/minus. 
                                        Per i 5 giocatori schierati titolari il punteggio sara del 100% mentre per gli altri 5 giocatori schierati in panchina si aggiungera alla somma totale solo il 50% dei loro punteggi.</p>
                                </li>
                                <li>
                                    <h2>PUNTEGGI TEAM</h2>
                                    <p>Ogni giornata verranno aggiornati oltre ai punteggi dei giocatori anche i punti guadagnati dalla tua squadra. Pi&#249; punti la tua squdra cumuler&#224; pi&#249; possibilit&#224; di vincere il campionato avrai. 
                                    La squdra guadagna 3Pt. in piu in classifica se la somma totale di punti dei tuoi giocatori quella giornata ha superato il tetto di 100, giadagna 2Pt. se supera il tetto di 70 e 1Pt se supera il tetto di 40.</p>
                                </li>
                                <li>
                                    <h2>CONTATTI</h2>
                                    <p>Per qualsiasi problema, domanda, dubbio o informazione potrai ricevere risposta contattandoci ai nostri recapiti che troverai  <a href=\"contatti.php\">QUI</a>. Risponderemo il prima possibile.</p>
                                </li>";
                    }else {
                        echo "  <li>
                                    <h2>ACCOUNT</h2>
                                    <p>Per giocare &#232; necessario registrarsi. Dovrai creare un nuovo account se non ne possiedi gi&#224; uno.</p>
                                </li>
                                <li>
                                    <h2>CALENDARIO</h2>
                                    <p>Il calendario di FANTANBA segue fedelmente quello NBA relativo alla sola Regular Season (playoff esclusi). 
                                        Ogni giorno dovrai schierare la miglior formazione possibile scegliendo il maggior numero di giocatori a tua disposizione che quella notte scender&#224;
                                        in campo per accumulare piu punti possibili, il tutto scegliendo 5 titolari e 5 panchinari. &#200; importante controllare quotidianamente il calendario NBA e la situazione della propria squadra. 
                                        Potrai modificare la tua formazione entro la fascia oraria compresa tra le 08:00 e 16:00, ore italiane, ogni giorno.
                                    </p>
                                </li>
                                <li>
                                    <h2>GIOCATORI NBA</h2>
                                    <p>Nel sistema sono inseriti la maggior parte dei gicatori NBA attualmente in attivo scelti per popolarit&#224; e miglior storico di statistiche annuali.
                                    </p>
                                </li>
                                <li>
                                    <h2>LA TUA SQUADRA</h2>
                                    <p>Puoi creare una o piu squdre allestendo un roster fatto di 10 giocatori, senza superare il budget di 400$ monete che ogni squadra ha a disposizione.
                                        Una volta creata la tua squadra potrai inziare a competere in un campionato con i tuoi amici.
                                        Il tuo roster fatto di 10 giocatori sar&#224; comprensivo di 2 giocatori per ruolo. I ruoli in cui i giocatori sono suddivisi sono: playmaker (PM), guardia (G), ala piccola (AP), ala grande (AG) e centro (C).
                                    </p>
                                </li>
                                <li>
                                    <h2>LEGA</h2>
                                    <p>Una lega &#232; un campionato creato da te o un altro utente nel quale puoi competere con i tuoi amici. Il numero di partecipanti &#232; illimitato come il numero di campionati a cui puoi partecipare con le tue squadre.
                                        In ogni lega pu&#242; esserci una tua sola squadra. Potrai creare una tua lega della quale sarai amministratore, alla quale parteciperai tu e gli amici che vorrai aggiungere.
                                    </p>
                                </li>
                                <li>
                                    <h2>PUNTEGGI GIOCATORI</h2>
                                    <p>Ogni giocatore per ogni giornata ricever&#224; un punteggio basato sulle statistiche NBA interenti ai plus/minus. 
                                        Per i 5 giocatori schierati titolari il punteggio sara del 100% mentre per gli altri 5 giocatori schierati in panchina si aggiungera alla somma totale solo il 50% dei loro punteggi.</p>
                                </li>
                                <li>
                                    <h2>PUNTEGGI TEAM</h2>
                                    <p>Ogni giornata verranno aggiornati oltre ai punteggi dei giocatori anche i punti guadagnati dalla tua squadra. Pi&#249; punti la tua squdra cumuler&#224; pi&#249; possibilit&#224; di vincere il campionato avrai. 
                                    La squdra guadagna 3Pt. in piu in classifica se la somma totale di punti dei tuoi giocatori quella giornata ha superato il tetto di 100, giadagna 2Pt. se supera il tetto di 70 e 1Pt se supera il tetto di 40.</p>
                                </li>
                                <li>
                                    <h2>CONTATTI</h2>
                                    <p>Per qualsiasi problema, domanda, dubbio o informazione potrai ricevere risposta contattandoci ai nostri recapiti che troverai  <a href=\"contatti.php\">QUI</a>. Risponderemo il prima possibile.</p>
                                </li>";}
                } else{
                    echo "<li>
                                <h2>ACCOUNT</h2>
                                <p>Per giocare &#232; necessario registrarsi. Dovrai creare un nuovo account se non ne possiedi gi&#224; uno.</p>
                            </li>
                            <li>
                                <h2>CALENDARIO</h2>
                                <p>Il calendario di FANTANBA segue fedelmente quello NBA relativo alla sola Regular Season (playoff esclusi). 
                                    Ogni giorno dovrai schierare la miglior formazione possibile scegliendo il maggior numero di giocatori a tua disposizione che quella notte scender&#224;
                                    in campo per accumulare piu punti possibili, il tutto scegliendo 5 titolari e 5 panchinari. &#200; importante controllare quotidianamente il calendario NBA e la situazione della propria squadra. 
                                    Potrai modificare la tua formazione entro la fascia oraria compresa tra le 08:00 e 16:00, ore italiane, ogni giorno.
                                </p>
                            </li>
                            <li>
                                <h2>GIOCATORI NBA</h2>
                                <p>Nel sistema sono inseriti la maggior parte dei gicatori NBA attualmente in attivo scelti per popolarit&#224; e miglior storico di statistiche annuali.
                                </p>
                            </li>
                            <li>
                                <h2>LA TUA SQUADRA</h2>
                                <p>Puoi creare una o piu squdre allestendo un roster fatto di 10 giocatori, senza superare il budget di 400$ monete che ogni squadra ha a disposizione.
                                    Una volta creata la tua squadra potrai inziare a competere in un campionato con i tuoi amici.
                                    Il tuo roster fatto di 10 giocatori sar&#224; comprensivo di 2 giocatori per ruolo. I ruoli in cui i giocatori sono suddivisi sono: playmaker (PM), guardia (G), ala piccola (AP), ala grande (AG) e centro (C).
                                </p>
                            </li>
                            <li>
                                <h2>LEGA</h2>
                                <p>Una lega &#232; un campionato creato da te o un altro utente nel quale puoi competere con i tuoi amici. Il numero di partecipanti &#232; illimitato come il numero di campionati a cui puoi partecipare con le tue squadre.
                                    In ogni lega pu&#242; esserci una tua sola squadra. Potrai creare una tua lega della quale sarai amministratore, alla quale parteciperai tu e gli amici che vorrai aggiungere.
                                </p>
                            </li>
                            <li>
                                <h2>PUNTEGGI GIOCATORI</h2>
                                <p>Ogni giocatore per ogni giornata ricever&#224; un punteggio basato sulle statistiche NBA interenti ai plus/minus. 
                                    Per i 5 giocatori schierati titolari il punteggio sara del 100% mentre per gli altri 5 giocatori schierati in panchina si aggiungera alla somma totale solo il 50% dei loro punteggi.</p>
                            </li>
                            <li>
                                <h2>PUNTEGGI TEAM</h2>
                                <p>Ogni giornata verranno aggiornati oltre ai punteggi dei giocatori anche i punti guadagnati dalla tua squadra. Pi&#249; punti la tua squdra cumuler&#224; pi&#249; possibilit&#224; di vincere il campionato avrai. 
                                La squdra guadagna 3Pt. in piu in classifica se la somma totale di punti dei tuoi giocatori quella giornata ha superato il tetto di 100, giadagna 2Pt. se supera il tetto di 70 e 1Pt se supera il tetto di 40.</p>
                            </li>
                            <li>
                                <h2>CONTATTI</h2>
                                <p>Per qualsiasi problema, domanda, dubbio o informazione potrai ricevere risposta contattandoci ai nostri recapiti che troverai  <a href=\"contatti.php\">QUI</a>. Risponderemo il prima possibile.</p>
                            </li>";}?>       
            </ol>
        </div>
    </div>
    <div class="bottom_bar">
        
    </div>


</body>
</html>