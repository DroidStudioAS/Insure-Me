<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava Polise</title>
    <link rel="stylesheet" href="../public/styles.css">
    <link rel="icon" href="../public/resursi/paragraf_logo.png"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" />

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Datepicker CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../models/DodatniOsiguranik.js"></script>
</head>
<body>
    <?php include 'navigacija.php'?>
    <?php include '../models/polisa.php'?>
    <img id="ls" class="leva_slika" src="../public/resursi/b-pocetna-l.png"/>
    <img id="ds" class="desna_slika" src="../public/resursi/desna_slika.png"/>

    <div id="loginContainer" class="login_container">
       <form class="forma_login" id="loginForm">
       <h1 id="naslov">Prijava Korisnika</h1>
       <img src="../public/resursi/paragraf_logo.png"/>
        <input id="korisnicko_ime" placeholder="Korisničko Ime" class="login_unos" type="text"/>
        <input id="sifra" placeholder="Lozinka" class="login_unos" type="password"/>
        <input class="okidac"  type="submit" value="Prijavi se" id="submitButton"/>
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
            <input  class="koren_input" id="ime" type="text" placeholder="Ime">
            <input  class="koren_input" id="prezime" type="text" placeholder="Prezime">
        </div>
        <h3>
            Datum Rodjenja
        </h3>
        <input  class="koren_input" type="text" class="form_control" id="datum_rodjenja">
        <h3>
            Broj Pasosa
        </h3>
        <input  class="koren_input"id="brojPasosa" type="number">
        <h3>
            Kontakt
        </h3>
        <div class="contact_container">
            <input  class="koren_input" id="mail" placeholder="email" type="email">
            <input  class="koren_input" id="br_telefona" placeholder="Broj Telefona" type="number">
        </div>
        <h3>
            Kad Putujete?
        </h3>
        <div class="input-group">
            <div class="datum_putovanja">
                <div class="grupa_datum">
                Od: <input type="text" class="koren_input" id="pocetni_datum">
                </div>
                <div class="grupa_datum">
                Do: <input type="text"  class="koren_input"id="krajnji_datum">

                </div>
                

            </div>
        </div>
        <h3>Grupno Ili Individualno Osiguranje</h3>
        <div class="radio_grupa">
            <label for="individualno"> Individualno </label>
            <input id="individualno" type="radio" name="tip_polise" value="individualno">
            <label for="grupno"> Grupno </label>
            <input id="grupno" type="radio" name="tip_polise" value="grupno">
        </div>
        <div class="okidaci">
            <input id="okidac_slanje_forme" class="okidac" type="submit" value="Prijavi Polisu"/>
            <input style="display: none;" id="okidac_d_o" type="submit" class="okidac" value="Dodaj Osiguranika"/>
        </div>
       
      

       </form>
       <div id="prozor_dodatni_osiguranici" class="dodatni_osiguranici_container" style="display: none;" >
        <div class="gornja_polovina">
        <img id="zatvori_prozor" src="../public/resursi/close.png"/>
        <h1>
            Dodatni Osiguranici
        </h1>
        <h3>
            Ime:
        </h3>

        <div class="ime_dodatnog_osugranika">        
            <input class="input_do" placeholder="ime" type="text" name="" id="ime_d_o">
            <input class="input_do" placeholder="prezime" type="text" name="" id="prezime_d_o">
        </div>

        <h3>Datum Rodjenja:</h3>
        <input class="input_do" type="text" id="rodjendan_d_o">

        <h3>Broj Pasosa</h3>
        <input class="input_do" type="number" id="broj_pasosa_d_o"/>
        <br>
        <input id="dodaj_osiguranika" class="okidac" type="submit"/>
        </div>

        <div id="dodati_osiguranici" class="dodati_osiguranici">
            
         
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
            let okidac_d_o = $('#okidac_d_o');

            /****Polja za dodatne osiguranike***/
            let ime_d_o = $("#ime_d_o");
            let prezime_d_o = $("#prezime_d_o");
            let rodjendan_d_o = $("#rodjendan_d_o");
            let br_pasosa_d_o = $("#broj_pasosa_d_o");
            let dodaj_osiguranika = $("#dodaj_osiguranika");
            let dodatiOsiguranici = $('#dodati_osiguranici');


            //vazne varijable
            let userId = -1;
            let username = "";
            
            let kontrolni_pocetni_datum="";
            let dodatni_osiguranici="";

            //dodji do danasnjeg datuma
            
            let todays_date = getTodaysDate();

            individualnoRadio.click(function(){
                    okidac_d_o.css('display','none');
                })
            grupnoRadio.click(function(){
                okidac_d_o.css('display',"inline-block")
            })

              //Ako je korisnik ulogovan,prikazi mu formu
              if(daliJeKorisnikUlogovan()){
                toggleVisibility();
                userId=sessionStorage.getItem('id');
                username=sessionStorage.getItem('username')
                console.log(userId);
                console.log(username + userId)

                setWelcomeMsg(username);
                $('#okidac_slanje_forme').off('click').on('click', function(e){
                    e.preventDefault();
                    postaviPolisu();
                })
                   
                }
              
            

            /*****Pocetak- formatiranje datepicker/a******/
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
            /*****Kraj- formatiranje datepicker/a******/


            /***********Pocetak pomocnih funkcija********/
            function daliJeKorisnikUlogovan(){
                if(sessionStorage.getItem('authenticated')==="true"){
                    return true;
                }
                return false;
            }
            function toggleVisibility(){
                $('#loginContainer').toggle()
                $('#koren').toggle()
                $('#ls').css('display','none')
                $('#ds').css('display','none')


          
              
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
                alert('Molimo Vas Popunite Sva Obavezna Polja');
                return false;
            }
            //iako do ovog bloka ne moze da se dodje, za svaki slucaj proveriti
            //da li su u grupno osiguranje dodati osiguranici
            if($("input[name='tip_polise']:checked").val()==='grupnp' && dodatni_osiguranici===""){
                alert('Ne mozete prijaviti grupno osiguranje bez dodatnih osiguranika!')
                return false;
            }

                return true;
            }
            function prikaziDo(){
                $("#prozor_dodatni_osiguranici").toggle();                 
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
                $('#dobrodoslica').text("Dobrodosli, " + name);
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
                                sessionStorage.setItem('id', userId);
                            },
                            error: function(xhr, status, error) {
                                // Reject the promise with the error details
                                reject(error);
                            }
                        });
                    });
                }
                function postaviPolisu(){
                    console.log(todays_date);
                    console.log(userId);
                    if(proveriJelPostojeParametri()===false){
                        return;
                    }
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
                        alert('Vasa Polisa Je Zabelezena');
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
                                if(proveriJelPostojeParametri){
                                  postaviPolisu();
                                }
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
                            //zapamti da je korisnik logovan
                            sessionStorage.setItem('authenticated',"true");
                            sessionStorage.setItem('username',ime);
                            username=ime;
                            dohvatiUserId(ime);
                            toggleVisibility()
                            slanjeForme()
                            setWelcomeMsg(ime)
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
                                    //zapamti da je korisnik logovan
                                    sessionStorage.setItem('authenticated',"true");
                                    sessionStorage.setItem('username',ime);
                                    toggleVisibility()
                                    slanjeForme()
                                    setWelcomeMsg(ime);

                                    dohvatiUserId(ime);

                                },
                                error: function(xhr, status, error) {
                                    console.error('Došlo je do greške prilikom slanja zahteva');
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Došlo je do greške prilikom slanja zahteva:');
                    }
                });
            }

            

            /***********Kraj pomocnih funkcija********/

            $('#koren').toggle()
            $('#zatvori_prozor').off('click').on('click', function(e){
                e.preventDefault();
                $("#prozor_dodatni_osiguranici").toggle();
            })
            okidac_d_o.off('click').on('click', function(e){
                e.preventDefault();
                prikaziDo();
            })
            $('#submitButton').off('click').on('click',function(e){
                        //obradi logovanje
                        //AKO je logovanje uspesno:
                        e.preventDefault();
                        console.log('obradi logovanje')
                        if(korisnickoIme.val()!=="" && lozinka.val()!==""){
                            logujKorisnika(korisnickoIme.val(), lozinka.val());
                        }
                       // console.log('Korisnicko ime za logovanje: ' + korisnickoIme.val())
                       // console.log('sifra za logovanje: ' + lozinka.val())
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
                          if (korisnickoIme.val().trim() === "" || lozinka.val().trim() === "") {
                              alert('Molimo Vas Popunite Korisnicko Ime I Lozinku');
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
                alert('Molimo Vas Popunite Sve Podatke O Bar 1 Dodatnom Osiguraniku')
                return;
            }
            logVals();
            dodatni_osiguranici+=ime_d_o.val() + " " +prezime_d_o.val() + "," + rodjendan_d_o.val() + "," + br_pasosa_d_o.val() + "|"
            console.log(dodatni_osiguranici);
            let dodatniOsiguranik = new DodatniOsiguranik(ime_d_o.val() + " " +prezime_d_o.val(), rodjendan_d_o.val(),br_pasosa_d_o.val());
            console.log(dodatniOsiguranik);
            alert('Dodali Ste Osiguranika: ' + ime_d_o.val() + " " +prezime_d_o.val())
            //resetuj polja
            ime_d_o.val("")
            prezime_d_o.val("")
            rodjendan_d_o.val("")
            br_pasosa_d_o.val("")
            const osiguranikZaDodati = 
            `<div class="osiguranik">
                <p>${dodatniOsiguranik.getIme()}</p>
                <p>${dodatniOsiguranik.getDatumRodjenja()}</p>
                <p>${dodatniOsiguranik.getBrojPasosa()}</p>
            </div>`;
            dodatiOsiguranici.append(osiguranikZaDodati);


           
        })
        });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    
    <!-- Bootstrap Datepicker JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>

</html>
