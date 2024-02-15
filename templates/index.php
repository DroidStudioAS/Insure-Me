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
    <?php include '../models/polisa.php'?>
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
        <h1 id="dobrodoslica"></h1>
       <h1> Unos Polise</h1>
       <form>
        <h3>
            Ime Nosioca
        </h3>
        <div class="input_ime_prezime">
            <input id="ime" type="text" placeholder="Ime">
            <input id="prezime" type="text" placeholder="Prezime">
        </div>
        <h3>
            Datum Rodjenja
        </h3>
        <input type="text" class="form-control" id="datum_rodjenja">
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
            <div class="datum_putovanja">
                Od: <input type="text" class="form-control" id="pocetni_datum">

                Do: <input type="text" class="form-control" id="krajnji_datum">

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
       <div id="prozor_dodatni_osiguranici" class="dodatni_osiguranici_container" style="display:none;">
        <img id="zatvori_prozor" src="../public/resursi/close.png"/>
        <h1>
            Dodatni Osiguranici
        </h1>
        <h3>
            Ime:
        </h3>

        <div class="ime_dodatnog_osugranika">        
            <input type="text" name="" id="ime_d_o">
            <input type="text" name="" id="prezime_d_o">
        </div>

        <h3>Datum Rodjenja:</h3>
        <input type="text" class="form-control" id="rodjendan_d_o">

        <h3>Broj Pasosa</h3>
        <input type="number" id="broj_pasosa_d_o"/>

        <input id="dodaj_osiguranika" type="submit"/>
        <div class="dodati_osiguranici">
            <div class="osiguranik">
                <p>Pera Peric</p>
                <p>1999-12-01</p>
                <p>2827362</p>
            </div>
         
        </div>

        </div>
    </div>

 

    <script>
        $(document).ready(function(){
            //reference na polja unosa
            let korisnickoIme = $('#korisnicko_ime');
            let lozinka = $('#sifra');
            let ime = $('#ime');
            let prezime = $('#prezime');
            let datumRodjenja = $('#datum_rodjenja');
            let brojPasosa = $('#brojPasosa');
            let email = $('#mail');
            let brojTelefona = $('#br_telefona');
            let pocetni_datum = $('#pocetni_datum');
            let krajnji_datum = $('#krajnji_datum');
            let individualnoRadio = $('#individualno');
            let grupnoRadio = $('#grupno');

            /****Polja za dodatne osiguranike***/
            let ime_d_o = $("#ime_d_o");
            let prezime_d_o = $("#prezime_d_o");
            let rodjendan_d_o = $("#rodjendan_d_o");
            let br_pasosa_d_o = $("#broj_pasosa_d_o");
            let dodaj_osiguranika = $("#dodaj_osiguranika");


            //vazne varijable
            let userId = -1;
            
            let kontrolni_pocetni_datum="";
            let dodatni_osiguranici="";

            //dodji do danasnjeg datuma
            
            let todays_date = getTodaysDate();

            /*****formatiranje datepicker/a******/
            $('#datum_rodjenja').datepicker({
                  format: 'yyyy-mm-dd', // Set the desired date format
                  autoclose: true, // Close the datepicker when a date is selected
                  todayHighlight: true // Highlight today's date
            });
            $('#rodjendan_d_o').datepicker({
                  format: 'yyyy-mm-dd', // Set the desired date format
                  autoclose: true, // Close the datepicker when a date is selected
                  todayHighlight: true // Highlight today's date
            });
            $('#pocetni_datum').datepicker({
              format: 'yyyy-mm-dd', // Set the desired date format
              autoclose: true, // Close the datepicker when a date is selected
              todayHighlight: true,
              startDate: todays_date// Highlight today's date
              
            }).on('changeDate', function(e){
                //postavi krajnji datum
                const selectedDate = e.date;
                const endDate = get7DaysLater(selectedDate);
    
                // Set the end date for #krajnji_datum datepicker
                $('#krajnji_datum').datepicker('setStartDate', selectedDate);
                $('#krajnji_datum').val(endDate); // Set the end date
            });
            $('#krajnji_datum').datepicker({
              format: 'yyyy-mm-dd', // Set the desired date format
              autoclose: true, // Close the datepicker when a date is selected
              todayHighlight: true // Highlight today's date
            });

            /***********Pocetak pomocnih funkcija********/
            function toggleVisibility(){
                $('#loginContainer').toggle()
                $('#koren').toggle()
            }
            function getTodaysDate(){
                const currentDate = new Date();
                const year = currentDate.getFullYear();
                const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Adding 1 because getMonth() returns zero-based index
                const day = String(currentDate.getDate()).padStart(2, '0');

                const formattedDate = `${year}-${month}-${day}`;
                console.log(formattedDate);
                return formattedDate;
            }
            function get7DaysLater(startDate) {
                 // Calculate 7 days later date
                 const sevenDaysLaterDate = new Date(startDate);
                 sevenDaysLaterDate.setDate(sevenDaysLaterDate.getDate() + 7);

                 // Format the date
                 const year = sevenDaysLaterDate.getFullYear();
                 const month = String(sevenDaysLaterDate.getMonth() + 1).padStart(2, '0');
                 const day = String(sevenDaysLaterDate.getDate()).padStart(2, '0');
                 const formattedDate = `${year}-${month}-${day}`;

                 return formattedDate;
            }  
            function proveriJelPostojeParametri(){
                let ime = $('#ime').val();
                let prezime = $('#prezime').val();
                let datumRodjenja = $('#unos_datum_rodjenja').val();
                let brojPasosa = $('#brojPasosa').val();
                let email = $('#mail').val();
                let brojTelefona = $('#br_telefona').val();
                let pocetni_datum = $('#pocetni_datum').val();
                let krajnji_datum = $('#krajnji_datum').val();

                

                logVals();

            if(ime==="" || prezime==="" || datumRodjenja ==="" || brojPasosa==="" || 
                email===""  || pocetni_datum==="" || krajnji_datum==="" 
                || $("input[name='tip_polise']:checked").val()===undefined){
                alert('missing vals');
                return false;
            }
                return true;
            }
            
            function logVals(){
                console.log("ime: " + ime.val() + " " + prezime.val())
                console.log("Rodjen: " + datumRodjenja.val())
                console.log("Br pasosa: " + brojPasosa.val())
                console.log("Kontakt mail: " + email.val())
                console.log("Kontakt telefon: " + brojTelefona.val())
                console.log("Od: " + pocetni_datum.val() + " Do: " + krajnji_datum.val())
                console.log($("input[name='tip_polise']:checked").val());

                console.log(ime_d_o.val() + " " + prezime_d_o.val())
                console.log(rodjendan_d_o.val())
                console.log(br_pasosa_d_o.val());
                console.log(dodatni_osiguranici)

            }
            function daliJeOsiguranjeGrupno(val){
                if(val==="grupno"){
                    return true
                }
                return false
            }
            function setWelcomeMsg(name){
                $('#dobrodoslica').text("Dobrodosao, " + name);
            }

            //ajax metode
            
            function dohvatiUserId(username) {
                    return new Promise((resolve, reject) => {
                        $.ajax({
                            url: '../api/dohvati_korisnikov_id.php', 
                            method: 'GET', // Using GET method
                            data: { username: username }, // Sending username as a parameter
                            success: function(response) {
                                // Resolve the promise with the retrieved user ID
                                resolve(response);
                                console.log(response)
                                userId=response;
                                localStorage.setItem('id', userId);
                            },
                            error: function(xhr, status, error) {
                                // Reject the promise with the error details
                                reject(error);
                            }
                        });
                    });
                }
                function postaviPolisu(){
                    console.log(todays_date)
                $.ajax({
                    url:'../api/dodaj_polisu.php',
                    method:'POST',
                    data:{
                        id_korisnika:userId,
                        polisa_br_pasosa:brojPasosa.val(),
                        polisa_br_telefona:brojTelefona.val(),
                        polisa_datum_rodjenja:datumRodjenja.val(),
                        polisa_od:pocetni_datum.val(),
                        polisa_do:krajnji_datum.val(),
                        polisa_ime:ime.val() + " " +prezime.val(),
                        polisa_tip: $("input[name='tip_polise']:checked").val(),
                        polisa_email :email.val(),
                        polisa_dodatni_osiguranici: dodatni_osiguranici,
                        datum_prijave:todays_date        
                    },
                    success : function(response){
                        console.log(response);
                        alert('polisa postavljena');
                    }
                })
            }
            function slanjeForme(){
                $("#okidac_slanje_forme").off('click').on('click', function(e){
                            e.preventDefault()
                           logVals()
                           proveriJelPostojeParametri()
                           //ukoliko je osiuranje grupno, prikazati nov prozor
                            if(daliJeOsiguranjeGrupno($("input[name='tip_polise']:checked").val()) && dodatni_osiguranici===""){
                                    $("#prozor_dodatni_osiguranici").toggle();                 
                            }
                            else{
                                postaviPolisu();
                                logVals()
                            }
                        })
            }
            function logujKorisnika(ime,sifra){
                $.ajax({
                    url:'../api/login_korisnika.php',
                    method: 'POST',
                    data: {
                        ime:ime,
                        sifra:sifra
                    },
                    success:function(response){
                        if(response==='true'){
                            alert('matches')
                            toggleVisibility()
                            slanjeForme()
                            setWelcomeMsg(ime)

                            dohvatiUserId(ime);
                        }else if (response==='false'){
                            alert('Korisnicko ime/Lozinka su netacni')
                        }
                    }
                

                })
            }
            function registrujKorisnika(ime, sifra) {
                 $.ajax({
                    url: "../api/proveri_korisnika.php", // Change this to the path of your PHP script for checking if the user exists
                    method: 'POST',
                    data: {
                        ime: ime
                    },
                    success: function(response) {
                        if (response === "true") {
                            // If user exists, trigger an alert
                            alert("Korisnik već postoji.");
                        } else {
                            // If user doesn't exist, make the other call to add the user
                            $.ajax({
                                url: "../api/dodaj_korisnika.php", // Change this to the path of your PHP script for adding the user
                                method: 'POST',
                                data: {
                                    ime: ime,
                                    sifra: sifra
                                },
                                success: function(response) {
                                    console.log(response); // Log the response from the server
                                    // Further process the response if needed
                                    toggleVisibility()
                                    slanjeForme()
                                    setWelcomeMsg(ime);

                                    dohvatiUserId(ime);

                                },
                                error: function(xhr, status, error) {
                                    console.error('Došlo je do greške prilikom slanja zahteva:', error);
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Došlo je do greške prilikom slanja zahteva:', error);
                    }
                });
            }

            

            /***********Kraj pomocnih funkcija********/

            $('#koren').toggle()
            $('#zatvori_prozor').off('click').on('click', function(e){
                e.preventDefault();
                $("#prozor_dodatni_osiguranici").toggle();
            })
            $('#submitButton').off('click').on('click',function(e){
                        //obradi logovanje
                        //AKO je logovanje uspesno:
                        e.preventDefault();
                        console.log('obradi logovanje')
                        if(korisnickoIme.val()!=="" && lozinka.val()!==""){
                            logujKorisnika(korisnickoIme.val(), lozinka.val());
                        }
                        console.log('Korisnicko ime za logovanje: ' + korisnickoIme.val())
                        console.log('sifra za logovanje: ' + lozinka.val())
                         })

            let naRegistraciji = false;
            /*****OnClickListener za promenu izmedju forme registracije i login-a**** */
            $('#toggleLink').click(function(e) {
                e.preventDefault(); // Prevent page refresh on anchor click
                naRegistraciji = !naRegistraciji; // Toggle logged-in value
                console.log(naRegistraciji);
                if (naRegistraciji) {
                    $('#naslov').text('Registracija Korisnika');
                    $('#submitButton').attr('value', 'Registruj se');
                    $('#submitButton').off('click').on('click', function(e) {
                        e.preventDefault();
                        console.log('obradi registraciju');
                        if (korisnickoIme.val() !== "" && lozinka.val() !== "") {
                            registrujKorisnika(korisnickoIme.val(), lozinka.val());
                        }
                    });
                  $('#toggleLink').text('Imaš Nalog? Prijavi se');
                }else {
                    console.log('hey');
                    $('#naslov').text('Prijava Korisnika');
                    $('#submitButton').attr('value', 'Prijavi se');
                    $('#submitButton').off('click').on('click', function(e) {
                          e.preventDefault();
                          console.log('heyyyyy');
                          if (korisnickoIme.val().trim() === "" || lozinka.val().trim() === "") {
                              alert('missing vals');
                              return;
                          }
                    logujKorisnika(korisnickoIme.val(), lozinka.val());
                    console.log('hey')
                     });
                  $('#toggleLink').text('Nemaš Nalog? Registruj se');
            }
        });

        //todo, move to helper function
        function validacijaDodatnihOsiguranika(){
            if(ime_d_o.val()==="" || prezime_d_o.val()==="" 
            || rodjendan_d_o.val()==="" || br_pasosa_d_o.val()===""){
                return false;
            }

            return true;
        }
        /*******Dodaj osiguranika OnClickListener********/
        dodaj_osiguranika.off('click').on('click', function(e){
            e.preventDefault()
            alert('tu smo')
            //dodaj u dodatne osiguranike
            if(!validacijaDodatnihOsiguranika()){
                alert('missing vals')
                return;
            }
            logVals();
            dodatni_osiguranici+=ime_d_o.val() + " " +prezime_d_o.val() + "," + rodjendan_d_o.val() + "," + br_pasosa_d_o.val() + "|"
            console.log(dodatni_osiguranici);
            alert('dodali ste osiguranika: ' + ime_d_o.val() + " " +prezime_d_o.val())
            //resetuj polja
            ime_d_o.val("")
            prezime_d_o.val("")
            rodjendan_d_o.val("")
            br_pasosa_d_o.val("")
        })
        
        

        });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    
    <!-- Bootstrap Datepicker JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>

</html>
