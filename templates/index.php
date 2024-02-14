<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava Polise</title>
    <link rel="stylesheet" href="../public/styles.css">
    <link rel="icon" href="../public/resursi/paragraf_logo.png"/>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Datepicker CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include 'navigacija.php'?>
    <div id="loginContainer" class="login_container">
       <h1 id="naslov">Prijava Korisnika</h1>
       <img src="../public/resursi/paragraf_logo.png"/>
       <form class="forma_login" id="loginForm">
        <input id="korisnicko_ime" placeholder="Korisničko Ime" class="login_unos" type="text"/>
        <input id="sifra" placeholder="Lozinka" class="login_unos" type="password"/>
        <input class="okidac_login_reg"  type="submit" value="Prijavi se" id="submitButton"/>
       </form>
       <div>
        <a href="#" id="toggleLink">Nemaš Nalog? Registruj se</a>
       </div>
    </div>

    <div id="koren" class="koren">
       <h1> Unos Polise</h1>
       <form>
        <h3>
            Ime Nosioca
        </h3>
        <div class="input_ime_prezime">
            <input id="ime" type="name" placeholder="Ime">
            <input id="prezime" type="name" placeholder="Prezime">
        </div>
        <h3>
            Datum Rodjenja
        </h3>
        <input id="unos_datum_rodjenja" type="date">
        <h3>
            Broj Pasosa
        </h3>
        <input id="brojPasosa" type="number">
        <h3>
            Kontakt
        </h3>
        <div>
            <input id="mail" placeholder="email" type="email">
            <input id="br_telefona" placeholder="Broj Telefona" type="number">
        </div>
        <h3>
            Kad Putujete?
        </h3>
        <div class="input-group">
            <div class="input-group-append">
               <input id="pocetni_datum" type="date" name="" id="pocetni_datum">
               <input id="krajnji_datum" type="date" name="" id="krajnji_datum">
            </div>
        </div>
        <h3>Grupno Ili Individualno Osiguranje</h3>
        <div class="radio_grupa">
            <label for="individualno"> Individualno </label>
            <input id="individualno" type="radio" name="tip_polise" value="individualno">
            <label for="grupno"> Grupno </label>
            <input id="grupno" type="radio" name="tip_polise" value="grupno">
        </div>
        <input id="okidac_slanje_forme" class="okidac" type="submit"/>

       </form>
    </div>

    <script>
        $(document).ready(function(){
            //reference na polja unosa
            let korisnickoIme = $('#korisnicko_ime');
            let lozinka = $('#sifra');
            let ime = $('#ime');
            let prezime = $('#prezime');
            let datumRodjenja = $('#unos_datum_rodjenja');
            let brojPasosa = $('#brojPasosa');
            let email = $('#mail');
            let brojTelefona = $('#br_telefona');
            let pocetni_datum = $('#pocetni_datum');
            let krajnji_datum = $('#krajnji_datum');
            let individualnoRadio = $('#individualno');
            let grupnoRadio = $('#grupno');

            /***********Pocetak pomocnih funkcija********/
            function logVals(){
                console.log("ime: " + ime.val() + " " + prezime.val())
                console.log("Rodjen: " + datumRodjenja.val())
                console.log("Br pasosa: " + brojPasosa.val())
                console.log("Kontakt mail: " + email.val())
                console.log("Kontakt telefon: " + brojTelefona.val())
                console.log("Od: " + pocetni_datum.val() + " Do: " + krajnji_datum.val())
                console.log($("input[name='tip_polise']:checked").val());
            }
            function daliJeOsiguranjeGrupno(val){
                if(val==="grupno"){
                    return true
                }
                return false
            }
            

            /***********Kraj pomocnih funkcija********/

            $('#koren').toggle()
            $('#submitButton').off('click').on('click',function(e){
                        //obradi logovanje
                        //AKO je logovanje uspesno:
                        e.preventDefault();
                        console.log('obradi logovanje')
                        $('#loginContainer').toggle()
                        $('#koren').toggle()
                    

                        console.log('Korisnicko ime za logovanje: ' + korisnickoIme.val())
                        console.log('sifra za logovanje: ' + lozinka.val())


                        //AKO logovanje uspe, ide ovaj block
                        $("#okidac_slanje_forme").off('click').on('click', function(e){
                            e.preventDefault()
                           logVals()
                           //ukoliko je osiuranje grupno, prikazati nov prozor
                            console.log(daliJeOsiguranjeGrupno($("input[name='tip_polise']:checked").val()))
                        })


                    })
            var naRegistraciji = false;

            $('#toggleLink').click(function(e){
                e.preventDefault(); // onemoguci osvezavanje stranice klikom na sidro
                naRegistraciji = !naRegistraciji; // Toggle ulogovan value
                if(naRegistraciji){
                    $('#naslov').text('Registracija Korisnika')
                    $('#submitButton').attr('value', 'Registruj se');
                    $('#submitButton').off('click').on('click',function(e){
                        //obradi registraciju
                        e.preventDefault();
                        console.log('obradi registraciju')

                    })
                    $('#toggleLink').text('Imaš Nalog? Prijavi se');
                } else {
                    $('#naslov').text('Prijava Korisnika')
                    $('#submitButton').attr('value', 'Prijavi se');
                    $('#submitButton').off('click').on('click',function(e){
                        //obradi logovanje  
                        e.preventDefault();
                        console.log('obradi logovanje')

                    })
                    $('#toggleLink').text('Nemaš Nalog? Registruj se');
                }
            });
        });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    
    <!-- Bootstrap Datepicker JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>

</html>
