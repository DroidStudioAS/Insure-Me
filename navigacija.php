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
            <a style="color: black;" href="index.php">Prijava <br> Osiguranja </a>
        </div>
        <div class="img_container">
        <img src="public/resursi/paragraf_logo.png">
        </div>
        <div class="nav_opcija_2">
           <a style="color:black" id="pregledLink" href="pregled_prijava.php"> Pregled <br> Prijava </a>
        </div>
    </div>
    <script>
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
        },1000)
    </script>
</body>


</html>