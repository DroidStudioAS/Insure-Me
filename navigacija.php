<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>

    <link rel="stylesheet" href="public/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="nav">
        <div class="nav_opcija_1">
            <a id="homeLink" style="color: black;" href="index.php">Prijava <br> Osiguranja </a>
        </div>
        <div class="img_container">
        <img src="public/resursi/osiguranko_logo.png">
        </div>
        <div class="nav_opcija_2">
           <a style="color:black" id="pregledLink" href="pregled_prijava.php"> Pregled <br> Prijava </a>
        </div>
    </div>
    <script>
        let languageSelected =sessionStorage.getItem('lang');
        if(languageSelected===undefined){
            languageSelected="srb";
        }
        //proverava ima li sacuvanih podataka u sesiji
        function daliJeKorisnikUlogovan(){
                if(sessionStorage.getItem('authenticated')==="true"){
                    return true;
                }
                return false;
            }
        if(!daliJeKorisnikUlogovan()){
            $('#pregledLink').attr('href','#');     
        }else{
            $('#pregledLink').attr('href','pregled_prijava.php');     
        }
        //svake sekunde, proveri da li se korisnik ulogovao... ako jeste, obrisi interval, i stavi odg href na priajvu polise
        let interval = setInterval(function checkIfLogged(){
            if(!daliJeKorisnikUlogovan()){
            $('#pregledLink').attr('href','#');     
        }else if(daliJeKorisnikUlogovan){
            $('#pregledLink').attr('href','pregled_prijava.php'); 
            clearInterval(interval);    
        }
        },1000);
        let languageInterval = setInterval(function checkLanguage(){
            if(sessionStorage.getItem('lang')==='srb'){
                $("#homeLink").html('Prijava <br> Osiguranja')
                $("#pregledLink").html('Pregled <br> Prijava')
            }else if(sessionStorage.getItem('lang')==="eng"){
                $("#homeLink").html('Policy <br> Registration')
                $("#pregledLink").html('Browse <br> Policies')
            }
        },1000);
           
        
    </script>
</body>


</html>