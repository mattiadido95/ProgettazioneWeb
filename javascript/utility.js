//-------------------------------------nbaplayers.php, deleteplayers.php------------------------------------------------------------------------------------------------------------

//funizione per cercare giocatori nella lista
function findPlayer(a) {
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById(a);
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        tdname = tr[i].getElementsByTagName("td")[1];
        tdsurname = tr[i].getElementsByTagName("td")[2];
        if (tdname || tdsurname ) {
        if (tdname.textContent.toUpperCase().indexOf(filter) > -1 || tdsurname.textContent.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }       
    }
    }

    function modificaNBAPL(id) {   

        var win_width;
        var win_height;
//meta schermo meno la meta della larghezza della finestra che apro
        win_width = (window.screen.width/2) - 300;
//meta schermo meno la meta della altezza della finestr che apro
        win_height = (window.screen.height/2) - 300;

        var win = window.open("modificaPL.php?q="+id,"","height=600,width=600,left=" + win_width + ",top=" + win_height + ",screenX=" + win_width + ",screenY=" + win_height + ",");
    }

    function aggiungiNBAPL() {    

        var win_width;
        var win_height;
//meta schermo meno la meta della larghezza della finestra che apro
        win_width = (window.screen.width/2) - 300;
//meta schermo meno la meta della altezza della finestr che apro
        win_height = (window.screen.height/2) - 300;

        var win = window.open("newplayer.php","","height=600,width=600,left=" + win_width + ",top=" + win_height + ",screenX=" + win_width + ",screenY=" + win_height + ","); 
    }

    function eliminaNBAPL() {    

        var win_width;
        var win_height;
//meta schermo meno la meta della larghezza della finestra che apro
        win_width = (window.screen.width/2) - 300;
//meta schermo meno la meta della altezza della finestr che apro
        win_height = (window.screen.height/2) - 300;

        var win = window.open("deleteplayers.php","","height=600,width=600,left=" + win_width + ",top=" + win_height + ",screenX=" + win_width + ",screenY=" + win_height + ",");
    }



//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------



//-------------------------------------------------punteggiamm.php, updateCLASS.php--------------------------------------------------------------------------------------------------------------

//funzione per tenere conto dell'aggiornamento parziale dei punteggi, prepara l'aggiornamento alle classifiche
function esegui(a){
    var win = window.location.href = "../admin/punteggiamm.php?q="+a;
}

 //funizione per cercare giocatori nella lista
 function findUpdate(a) {
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById(a);
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        tdname = tr[i].getElementsByTagName("td")[0];
        tdsurname = tr[i].getElementsByTagName("td")[1];
        if (tdname || tdsurname ) {
        if (tdname.textContent.toUpperCase().indexOf(filter) > -1 || tdsurname.textContent.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }       
    }
    }


//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------



//------------------------------------------------------teams.php, inserteam.php, deleteteam.php-------------------------------------------------------------------------------------------------


//funizione per cercare team nella lista
function findTeam(a) {
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById(a);
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        tdteam = tr[i].getElementsByTagName("td")[1];
        tdprop = tr[i].getElementsByTagName("td")[2];
        if (tdteam || tdprop ) {
        if (tdteam.textContent.toUpperCase().indexOf(filter) > -1 || tdprop.textContent.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }       
    }
    }

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------





//--------------------------------------------utenti.php----------------------------------------------------------------------------------------------------------------------------------------

 //funizione per cercare giocatori nella lista
 function findUtenti(a) {
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById(a);
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        tdnick = tr[i].getElementsByTagName("td")[1];
        tdname = tr[i].getElementsByTagName("td")[2];
        tdsurname = tr[i].getElementsByTagName("td")[3];
        if (tdnick || tdname || tdsurname ) {
        if (tdnick.textContent.toUpperCase().indexOf(filter) > -1 || tdname.textContent.toUpperCase().indexOf(filter) > -1 || tdsurname.textContent.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }       
    }
    }


//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------




//---------------------------------------------lega.php------------------------------------------------------------------------------------------------------------------------------------------

    function showLega(id) {
        xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   var arr = JSON.parse(this.responseText);
                   var tbody=document.getElementById("classifica");
                   var remove =document.getElementById("row");
                   tbody.removeChild(remove);

                   for( var i=0; i<arr.length; i++){

                        var row=document.createElement("tr");
                        if(arr[i].loggato==true){
                            row.style.backgroundColor="#4682B4";
                        }

                        var cellN=document.createElement("td");
                        var cellNTxt=document.createTextNode(i+1);
                        cellN.appendChild(cellNTxt);
                        row.appendChild(cellN);

                        
                        var cellS=document.createElement("td");
                        var cellSTxt=document.createTextNode(arr[i].squadra);
                        cellS.appendChild(cellSTxt);
                        row.appendChild(cellS);

                        var cellP=document.createElement("td");
                        var cellPTxt=document.createTextNode(arr[i].puntiFatti);
                        cellP.appendChild(cellPTxt);
                        row.appendChild(cellP);  
                    
                        tbody.appendChild(row);
                   }

                }
            }
            var str = document.getElementById(id).textContent;
            
            xmlhttp.open("GET","getlega.php?q="+str,true);
            xmlhttp.send();
        } 


    function bestroster(idT){
        xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var arr = JSON.parse(this.responseText);
                    for( var i=arr.length; i>0; i--){
                        document.getElementById(i+"-N").textContent = arr[i-1].cognome;
                        document.getElementById(i+"-R").textContent = arr[i-1].ruolo;

                    };
                }
            };
            var str = document.getElementById(idT).textContent;
            
            xmlhttp.open("GET","getbroster.php?q="+str,true);
            xmlhttp.send();
    }  

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------




//-----------------------------------------modifica_lega.php----------------------------------------------------------------------------------------------------------------------------------

 //funzione per la get delle squadre da aggiungere alla lega che voglio modificare
 function aggiungi(id) {

    var str = document.getElementById(id).textContent;      
    
    var win_width;
    var win_height;
//meta schermo meno la meta della larghezza della finestra che apro
     win_width = (window.screen.width/2) - 300;
//meta schermo meno la meta della altezza della finestr che apro
     win_height = (window.screen.height/2) - 300;
     var win = window.open("inserteam.php?q="+str,"","height=600,width=600,left=" + win_width + ",top=" + win_height + ",screenX=" + win_width + ",screenY=" + win_height + ",");               
}      

  
         //funzione per la get delle squadre da eliminare alla lega che voglio modificare

         function elimina(id) {

            var str = document.getElementById(id).textContent;

            var win_width;
            var win_height;
//meta schermo meno la meta della larghezza della finestra che apro
             win_width = (window.screen.width/2) - 300;
//meta schermo meno la meta della altezza della finestr che apro
             win_height = (window.screen.height/2) - 300;

            var win = window.open("deleteteam.php?q="+str,"","height=600,width=600,left=" + win_width + ",top=" + win_height + ",screenX=" + win_width + ",screenY=" + win_height + ",");
           
    } 


//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------



//-------------------------------------------modifica_roster.php---------------------------------------------------------------------------------------------------------------------------------

//funzione per la get della squadra selezionata
function showTitolari(id) {

    var str = document.getElementById(id).textContent;

    
    var win_width;
    var win_height;
//meta schermo meno la meta della larghezza della finestra che apro
    win_width = (window.screen.width/2) - 300;
//meta schermo meno la meta della altezza della finestr che apro
    win_height = (window.screen.height/2) - 300;

    var win = window.open("titolari.php?q="+str,"","height=600,width=600,left=" + win_width + ",top=" + win_height + ",screenX=" + win_width + ",screenY=" + win_height + ",");

    }      
 //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------



 //-------------------------------------------roster.php-----------------------------------------------------------------------------------------------------------------------------------------

 function showRoster(id) {
    xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var arr = JSON.parse(this.responseText);
                for( var i=arr.length; i>0; i--){
                    document.getElementById(i+"-N").textContent = arr[i-1].cognome;
                    document.getElementById(i+"-R").textContent = arr[i-1].ruolo;

                };
            }
        };
        var str = document.getElementById(id).textContent;
        
        xmlhttp.open("GET","../roster/getroster.php?q="+str,true);
        xmlhttp.send();
    }      


    function showRiserve(id) {
        xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var arr = JSON.parse(this.responseText);
                    var tbody=document.getElementById("riserve");
                    var remove =document.getElementById("row");
                    tbody.removeChild(remove);

                    if(arr.length==0){
                        var row=document.createElement("tr");
                        var cell=document.createElement("td");
                        var cellTxt=document.createTextNode("NON CI SONO RISERVE");
                        cell.colSpan="2";  
                        cell.appendChild(cellTxt);
                        row.appendChild(cell);
                        tbody.appendChild(row);
                    } else{
                        for( var i=0; i<arr.length; i++){
 
                            var row=document.createElement("tr"); 
                            
                            var cellS=document.createElement("td");
                            var cellSTxt=document.createTextNode(arr[i].cognome);
                            cellS.appendChild(cellSTxt);
                            row.appendChild(cellS);
    
                            var cellP=document.createElement("td");
                            var cellPTxt=document.createTextNode(arr[i].ruolo);
                            cellP.appendChild(cellPTxt);
                            row.appendChild(cellP);  
                        
                            tbody.appendChild(row);
                       }
                    }
 

 
                 }
             }
            var str = document.getElementById(id).textContent;
            
            xmlhttp.open("GET","../roster/getriserve.php?q="+str,true);
            xmlhttp.send();
        }    

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------




//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function showERR(id,testo){
    
    document.getElementById(id).textContent=testo;

    if(id=="table"){
        document.getElementById("button").disabled = true;
    }

}


//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


