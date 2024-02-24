<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="public/styles.css">
    <link rel="icon" href="public/resursi/paragraf_logo.png"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" />

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Datepicker CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="models/DodatniOsiguranik.js"></script>
</head>
<body>
    <!--Imports-->
    <?php include 'navigacija.php'?>
    <?php include 'models/polisa.php'?>   
    <!--Login And Registration form START-->
    <div id="loginContainer" class="login_container">
       <form class="forma_login" id="loginForm">
       <h1 id="naslov">Prijava Korisnika</h1>
       <img src="public/resursi/osiguranko_logo.png"/>
        <input id="korisnicko_ime" placeholder="Korisničko Ime" class="login_unos" type="text"/>
        <input id="sifra" placeholder="Lozinka" class="login_unos" type="password"/>
        <input class="okidac"  type="submit" value="Prijavi se" id="submitButton"/>
       </form>
       <div>
        <a href="#" id="toggleLink">Nemaš Nalog? Registruj se</a>
       </div>
    </div>
    <!--Forma za login i registraciju KRAJ-->

    <!--Forma za login i registraciju POCETAK-->

    <!--Forma za Unos polisa i dodatne osiguranike POCETAK-->
    <div id="koren" class="koren">
        <!--dobrodoslica je prazna jer se dinamicki postavlja nakon logovanja-->
        <h1 class="dobrodoslica" id="dobrodoslica"></h1>
       <h1 id="policy_header"> Unos Polise</h1>
       <form>
        <h3 id="nameLabel"">
            Ime Nosioca
        </h3>
        <div class="input_ime_prezime">
            <input class="koren_input" id="ime" type="text" placeholder="Ime*" autocapitalize="words">
            <input class="koren_input" id="prezime" type="text" placeholder="Prezime*" autocapitalize="words">
        </div>
        <h3 id="birthdayLabel">
            Datum Rodjenja
        </h3>
        <input placeholder="*" class="koren_input" type="text" class="form_control" id="datum_rodjenja" autocomplete="off">
        <h3 id="passNumLabel">
            Broj Pasosa
        </h3>
        <input placeholder="*" class="koren_input" id="brojPasosa" type="number">
        <h3 id="contactLabel">
            Kontakt
        </h3>
        <div class="contact_container">
            <input  class="koren_input" id="mail" placeholder="email*" type="email">
            <input  class="koren_input" id="br_telefona" placeholder="Broj Telefona" type="number">
        </div>
        <h3 id="dateOfTripLabel">
            Kad Putujete?
        </h3>
        <div class="input-group">
            <div class="datum_putovanja">
                <div class="grupa_datum">
                <!--Autocomplete iskljucen na svim datepickerima, kako bi se video sam datepicker-->
                <p id="fromLabel">Od:</p> <input type="text" class="koren_input" id="pocetni_datum" autocomplete="off" placeholder="*">
                </div>
                <div class="grupa_datum">
                <p id="toLabel">Do:</p> <input type="text"  class="koren_input"id="krajnji_datum" autocomplete="off" placeholder="*">
                </div>
            </div>
        </div>
        <h3 id="policyTypeLabel">Tip Osiguranja *</h3>
        <div class="radio_grupa">
            <label id="individualLabel" for="individualno"> Individualno </label>
            <input id="individualno" type="radio" name="tip_polise" value="individualno">
            <label id="groupLabel" for="grupno"> Grupno </label>
            <input id="grupno" type="radio" name="tip_polise" value="grupno">
        </div>
        
        <div class="okidaci">
            <input id="okidac_slanje_forme" class="okidac" type="submit" value="Prijavi Polisu"/>
            <!--Dugme se prikazuje SAMO ako se odabere #grupno radio dugme-->
            <input style="display: none;" id="okidac_d_o" type="submit" class="okidac" value="Dodaj Osiguranika"/>
        </div>
       </form>
       <!--Forma za unos polise KRAJ-->

        <!--Forma za unos i prikaz dodatnih osiguranika POCETAK-->
       <div id="prozor_dodatni_osiguranici" class="dodatni_osiguranici_container" style="display: none;" >
       <!--Gornja polovina sluzi za unos-->
        <div class="gornja_polovina">
            <img id="zatvori_prozor" src="public/resursi/close.png"/>
            <h1 id="addedPeopleHeader">
                Dodatni Osiguranici
            </h1>
            <h3 id='addedPersonNameLabel'>
                Ime:
            </h3>
            <div class="ime_dodatnog_osugranika">        
                <input class="input_do" placeholder="ime" type="text" name="" id="ime_d_o" autocapitalize="words">
                <input class="input_do" placeholder="prezime" type="text" name="" id="prezime_d_o" autocapitalize="words">
            </div>

            <h3 id='addedPersonBirthdayLabel'>Datum Rodjenja:</h3>
            <input class="input_do" type="text" id="rodjendan_d_o" autocomplete="off">

            <h3 id='addedPersonPassportLabel'>Broj Pasosa</h3>
            <input class="input_do" type="number" id="broj_pasosa_d_o"/>
            <br>
            <input id="dodaj_osiguranika" class="okidac" type="submit" value="Dodaj Osiguranika"/>
        </div>
        <!--Prostor rezervisan za prikaz dodatih osiguranika na polisi, dinamicki se popunjava-->
        <div id="dodati_osiguranici" class="dodati_osiguranici">
            
         
        </div>

        </div>
    </div>
    <!--Forma za Unos polisa i dodatne osiguranike KRAJ-->
   
<hr>
<footer>
    <div class="language_selection">
         <img id="serbian_select" src="public/resursi/serbian_flag.png"/>
         <img id="english_select" src="public/resursi/usa_flag.webp"/>
    </div>


</footer>
<script>
        //stranica ucitana
        $(document).ready(function(){
            //Ui References
            //login form
            let loginTitle = $("#naslov");
            let loginSubmit = $("#submitButton")
            let toggleRegAndLogin = $('#toggleLink');
            let korisnickoIme = $('#korisnicko_ime');
            let lozinka = $('#sifra');
            //input form
            let welcomeMsg = $('dobrodoslica')
            let policyHeader=$("#policy_header")
            let nameLabel = $("#nameLabel")
            let ime = $('#ime');
            let prezime = $('#prezime');
            let birthdayLabel = $('#birthdayLabel');
            let datumRodjenja = $('#datum_rodjenja');
            let brojPasosa = $('#brojPasosa');
            let contactLabel = $("#contactLabel");
            let email = $('#mail');
            let brojTelefona = $('#br_telefona');
            let dateOfTripLabel = $("#dateOfTripLabel")
            let fromLabel = $("#fromLabel")
            let toLabel = $("#toLabel")
            let pocetni_datum = $('#pocetni_datum');
            let krajnji_datum = $('#krajnji_datum');
            let policyTypeLabel = $("#policyTypeLabel");
            let individualLabel = $("#individualLabel")
            let individualnoRadio = $('#individualno');
            let groupLabel = $("#groupLabel")
            let grupnoRadio = $('#grupno');
            let addPolicyTrigger = $("#okidac_slanje_forme")
            let okidac_d_o = $('#okidac_d_o');
            /****Polja za dodatne osiguranike***/
            let addedPeopleHeader=$('#addedPeopleHeader');
            let addedPersonNameLabel=$("#addedPersonNameLabel")
            let addedPersonBirthdayLabel=$("#addedPersonBirthdayLabel")
            let addedPersonPassportLabel=$("#addedPersonPassportLabel");
            let ime_d_o = $("#ime_d_o");
            let prezime_d_o = $("#prezime_d_o");
            let rodjendan_d_o = $("#rodjendan_d_o");
            let passportLabel = $("#passNumLabel");
            let br_pasosa_d_o = $("#broj_pasosa_d_o");
            //okidac za dodavanje osiguranika
            let dodaj_osiguranika = $("#dodaj_osiguranika");
            //prostor za prikaz osiguranika
            let dodatiOsiguranici = $('#dodati_osiguranici');

            /**Language Selection***/
            let serbianLang = $("#serbian_select");
            let englishLang = $("#english_select");
            let languageSelected = "srb"

            function changeLang(lang){
                languageSelected=lang;
                sessionStorage.setItem('lang',lang);
                if(lang==="srb"){
                    //login form
                    if(userOnRegister){
                        loginTitle.text('Registracija Korisnika')
                        loginSubmit.attr('value','Registruj se')
                        toggleRegAndLogin.text('Imas Nalog? Prijavi se!');
                    }else{
                        loginTitle.text('Prijava Korisnika')
                        loginSubmit.attr('value','Prijavi se')
                        toggleRegAndLogin.text('Nemas Nalog? Registruj se!');
                    }
                    korisnickoIme.attr('placeholder','Korisnicko Ime')
                    lozinka.attr('placeholder',"Lozinka")         
                    //input form
                    $('#dobrodoslica').text("Dobrodosli, " + username);
                    policyHeader.text('Unos Polise')
                    nameLabel.text('Ime Nosioca')
                    ime.attr('placeholder','Ime*')
                    prezime.attr('placeholder',"Prezime*")
                    passportLabel.text('Broj Pasosa*');
                    birthdayLabel.text('Datum Rodjenja*')
                    contactLabel.text('Kontakt')
                    brojTelefona.attr('placeholder','Broj Telefona')
                    dateOfTripLabel.text('Kad Putujete? *')
                    fromLabel.text('Od:');
                    toLabel.text('Do:')
                    policyTypeLabel.text('Tip Osiguranja *')
                    individualLabel.text('Individualno');
                    groupLabel.text('Grupno')
                    addPolicyTrigger.attr('value','Prijavi Polisu')
                    okidac_d_o.attr('value',"Dodaj Osiguranika")
                    //extra insured people form
                    addedPeopleHeader.text('Dodatni Osiguranici')
                    addedPersonNameLabel.text('Ime:')
                    addedPersonBirthdayLabel.text("Datum Rodjenja:")
                    addedPersonPassportLabel.text('Broj Pasosa:')
                    dodaj_osiguranika.attr('value','Dodaj Osiguranika')
                    ime_d_o.attr('placeholder','Ime');
                    prezime_d_o.attr('placeholder','Prezime')
                }else if(lang==="eng"){
                    if(userOnRegister){
                        loginTitle.text('User Registration')
                        loginSubmit.attr('value','Register')
                        toggleRegAndLogin.text('Already Have An Acount? Login!');
                    }else{
                        loginTitle.text('User Login')
                        loginSubmit.attr('value', 'Login')
                        toggleRegAndLogin.text('Dont Have An Acount? Register!');

                    }
                    korisnickoIme.attr('placeholder','Username');
                    lozinka.attr('placeholder',"Password")

                    //input form
                    $('#dobrodoslica').text("Welcome, " + username);
                    policyHeader.text('Enter Policy')
                    nameLabel.text('Policyholder Name')
                    ime.attr('placeholder','Name*')
                    prezime.attr('placeholder',"Surname*")
                    passportLabel.text('Passport Number*');
                    birthdayLabel.text('Date Of Birth*')
                    contactLabel.text('Contact')
                    brojTelefona.attr('placeholder','Phone Number')
                    dateOfTripLabel.text('When Are You Traveling? *')
                    fromLabel.text('From:');
                    toLabel.text('To:')
                    policyTypeLabel.text('Policy Type *')
                    individualLabel.text('Individual');
                    groupLabel.text('Group')
                    addPolicyTrigger.attr('value','Register Policy')
                    okidac_d_o.attr('value',"Add Insured Person")
                    //extra insured people
                    addedPeopleHeader.text('Additional Insured People')
                    addedPersonNameLabel.text('Name:')
                    ime_d_o.attr('placeholder','Name');
                    prezime_d_o.attr('placeholder','Surname')
                    addedPersonBirthdayLabel.text("Date Of Birth:")
                    addedPersonPassportLabel.text('Passport Number:')
                    dodaj_osiguranika.attr('value','Add Person')

                }
            }


            //Varijable kljucne za sesiju
            let userId = -1;
            let username = "";
            //Pocetni datum se inicijalizuje, i kasnije postavlja na danasnji datum
            //kako korisnik ne bi mogao da na date pickeru za od-do putovanja
            //izabere datum koji je vec prosao
            let kontrolni_pocetni_datum="";
            let dodatni_osiguranici="";

            //Dolazi do danasnjeg datuma u formatu yyyy-mm-dd
            let todays_date = getTodaysDate();

            /*******OnClickListener- prikazuje dugme za dodavanje osiguranika kad se klikne grupna,
             * a krije ga kad se klikne individualna polisa*******/
            individualnoRadio.click(function(){
                    okidac_d_o.css('display','none');
                })
            grupnoRadio.click(function(){
                okidac_d_o.css('display',"inline-block")
            })

            //Ovaj blok hvata podatke iz sesije, kako bi 
            //stranica znala da li je korisnik vec ulogovan
            //ako Jeste, treba mu prikazati formu za unos,
            //ako nije, vratiti ga na login/reg
            if(daliJeKorisnikUlogovan()){
                toggleVisibility();
                userId=sessionStorage.getItem('id');
                username=sessionStorage.getItem('username')
                setWelcomeMsg(username);
                $('#okidac_slanje_forme').off('click').on('click', function(e){
                    e.preventDefault();
                    postaviPolisu();
                })
            }

            /*****Formatiranje datepicker-a******/
            $('#datum_rodjenja').datepicker({
                  format: 'yyyy-mm-dd', //postavi format na onaj koji se cuva u bazi
                  autoclose: true, //zatvoriti datepicker pri selekciji datuma
                  todayHighlight: false, //za rodjendan, ne zelimo da highlituje danasnji datum
                  endDate:todays_date //onemoguci biranje datuma posle danasnjeg
            }); //rodjendan_dodatni_osiguranik
            $('#rodjendan_d_o').datepicker({
                  format: 'yyyy-mm-dd', 
                  autoclose: true, 
                  todayHighlight: false, 
                  endDate:todays_date //onemoguci biranje datuma posle danasnjeg

            });
            $('#pocetni_datum').datepicker({
              format: 'yyyy-mm-dd',
              autoclose: true, 
              todayHighlight: true,
              startDate: todays_date//korisnik ne moze da prijavi polisu, za datum koji je prosao
                
            }).on('changeDate', function(e){//ovaj blok postavlja datepicker za krajnji datum na 7 dana posle pocetnog
                //datum unet kao pocetni
                const selectedDate = e.date;
                const endDate = get7DaysLater(selectedDate);
    
                //postavi vrednost date pickera #krajnji datum na 7 dana posle pocetnog
                $('#krajnji_datum').datepicker('setStartDate', selectedDate);
                $('#krajnji_datum').val(endDate); 
            });
            $('#krajnji_datum').datepicker({
              format: 'yyyy-mm-dd', 
              autoclose: true, 
              todayHighlight: true
            });
            /*****Kraj- formatiranje datepicker/a******/


            /***********Pocetak pomocnih funkcija********/
            function postaviTitleStranice(string){
                $('title').text(string);
            }

            //proverava da li postoji sesija za korsnika
            function daliJeKorisnikUlogovan(){
                if(sessionStorage.getItem('authenticated')==="true"){
                    postaviTitleStranice('Prijava Polise')
                    return true;
                }
                return false;
            }
            //poziva se pri uspesnoj validaciji korisnika, kako bi se sakrio login
            function toggleVisibility(){
                $('#loginContainer').toggle()
                $('#koren').toggle()
                $('#ls').css('display','none')
                $('#ds').css('display','none')
            }
            //dolazi do danasnjeg datuma
            function getTodaysDate(){
                const currentDate = new Date();
                const year = currentDate.getFullYear();
                const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Adding 1 because getMonth() returns zero-based index
                const day = String(currentDate.getDate()).padStart(2, '0');

                const formattedDate = `${year}-${month}-${day}`;
                console.log(formattedDate);
                return formattedDate;
            }
            //dolazi do datuma 7 dana posle inputa
            function get7DaysLater(startDate) {
                 const sevenDaysLaterDate = new Date(startDate);
                 sevenDaysLaterDate.setDate(sevenDaysLaterDate.getDate() + 7);

                 //formatiraj datum
                 const year = sevenDaysLaterDate.getFullYear();
                 const month = String(sevenDaysLaterDate.getMonth() + 1).padStart(2, '0');
                 const day = String(sevenDaysLaterDate.getDate()).padStart(2, '0');
                 const formattedDate = `${year}-${month}-${day}`;

                 return formattedDate;
            }  
            function validacijaBrojaPasosa(broj){

            }
            //validaciona funkcija koja se poziva pri postavljanju forme
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
        
            //nedostatak obaveznih polja
            if(ime==="" || prezime==="" || datumRodjenja ==="" || brojPasosa==="" || 
                email===""  || pocetni_datum==="" || krajnji_datum==="" 
                || $("input[name='tip_polise']:checked").val()===undefined){
                alert('Molimo Vas Popunite Sva Obavezna Polja, Obelezena Sa *');
                return false;
            }
            //iako do ovog bloka ne moze da se dodje, za svaki slucaj proveriti
            //da li su u grupno osiguranje dodati osiguranici
            if($("input[name='tip_polise']:checked").val()==='grupno' && dodatni_osiguranici===""){
                alert('Ne Mozete Prijaviti Grupno Osiguranje Bez Dodatnih Osiguranika!')
                return false;
            }
            //proveri jel mail validan
            if(!email.includes('@')){
                alert('Molimo Vas Unesite Validnu Email Adresu!')
                return false;
            }
            //da li broj pasosa ima 9 cifara
            if(brojPasosa.length!==9){
                alert('Broj Pasosa Sastoji Se Od 9 Cifara. Molimo Vas Proverite Vas Unos')
                return false;
            }
                //ako se ni jedan blok nije aktivirao, parametri su ok!
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
                if(languageSelected==="srb"){
                $('#dobrodoslica').text("Dobrodosli, " + name);
                }else{
                    $('#dobrodoslica').text("Welcome, " + name);
                }
            }
            //
            function validacijaDodatnihOsiguranika(){
            if(ime_d_o.val()==="" || prezime_d_o.val()==="" 
            || rodjendan_d_o.val()==="" || br_pasosa_d_o.val()===""){
                alert('Molimo Vas Popunite Sve Podatke O Dodatnom Osiguraniku!')
                return false;
            }
            return true;
        }

            /***********Kraj pomocnih funkcija********/

            /***********Pocetak Asinhronih funkcija********/
            function dohvatiUserId(username) {
                    return new Promise((resolve, reject) => {
                        $.ajax({
                            url: 'api/dohvati_korisnikov_id.php', 
                            method: 'GET', 
                            data: { username: username }, 
                            success: function(response) {
                                resolve(response);
                                console.log(response)
                                userId=response;
                                sessionStorage.setItem('id', userId);
                            },
                            error: function(xhr, status, error) {
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
                    url:'api/dodaj_polisu.php',
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
                     //ukoliko je osiuranje grupno, prikazati prozor da dodavanje osiguranika
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
                    url:'api/login_korisnika.php',
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
                            postaviTitleStranice('Prijava Polise')
                        }else if (response==='false'){
                            alert('Korisnicko ime/Lozinka su netacni')
                        }
                    }
                

                })
            }
            function registrujKorisnika(ime, sifra) {
                if(sifra.length<6){
                    alert('Molimo Vas Da Unesete Sifru Od Bar 6 Karaktera Radi Vase Bezbednosti!');
                    return;
                }
                 $.ajax({
                    url: "api/proveri_korisnika.php",
                    method: 'POST',
                    data: {
                        ime: ime
                    },
                    success: function(response) {
                        if (response === "true") {
                            //Ukoliko korisnik postoji, api vraca true
                            alert("Korisnik već postoji.");
                        } else {
                            //Ukoliko korisnik Ne postoji, api vraca false, i mozemo da napravimo poziv za dodavanje korisnika
                            $.ajax({
                                url: "api/dodaj_korisnika.php",
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
                                    postaviTitleStranice('Prijava Polise')
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
            /***********Kraj asihronih metoda********/

            $('#koren').toggle()
            /******OnClickListener- gasenje prozora za dodate osiguranike *****/
            $('#zatvori_prozor').off('click').on('click', function(e){
                e.preventDefault();
                $("#prozor_dodatni_osiguranici").toggle();
            })
            /******OnClickListener- prikaz prozora za dodate osiguranike *****/
            okidac_d_o.off('click').on('click', function(e){
                e.preventDefault();
                prikaziDo();
            })
            /******OnClickListener-Dugme za login, ukoliko korisnik NIJE presao na registraciju*****/
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

            let userOnRegister = false;
            /*****OnClickListener za promenu izmedju forme registracije i login-a**** */
            $('#toggleLink').click(function(e) {
                e.preventDefault(); 
                userOnRegister = !userOnRegister;
                console.log(userOnRegister);
                //ako je na registraciji, prilagoditi naslov i onclick listener za slanje
                if (userOnRegister) {
                    postaviTitleStranice('Registracija')
                    $('#naslov').text('Registracija Korisnika');
                    $('#submitButton').attr('value', 'Registruj se');
                    $('#submitButton').off('click').on('click', function(e) {
                        e.preventDefault();
                        console.log('obradi registraciju');
                        //validacija unetog username i passworda
                        if (korisnickoIme.val().trim() === "" || lozinka.val().trim() === "") {
                              alert('Molimo Vas Popunite Korisnicko Ime I Lozinku');
                              return;
                        }             
                            registrujKorisnika(korisnickoIme.val(), lozinka.val());
                    });
                    //text za anchor ukoliko korisnik treba predje na login
                  $('#toggleLink').text('Imaš Nalog? Prijavi se');
                }else {
                    //ako je na loginu, prilagoditi naslov i onclick listener za slanje
                    postaviTitleStranice('Login')
                    $('#naslov').text('Prijava Korisnika');
                    $('#submitButton').attr('value', 'Prijavi se');
                    $('#submitButton').off('click').on('click', function(e) {
                          e.preventDefault();
                          //validacija unetog username i passworda
                          if (korisnickoIme.val().trim() === "" || lozinka.val().trim() === "") {
                              alert('Molimo Vas Popunite Korisnicko Ime I Lozinku');
                              return;
                          }
                    logujKorisnika(korisnickoIme.val(), lozinka.val());
                    console.log('hey')
                     });
                 //text za anchor ukoliko korisnik treba predje na registraciju
                  $('#toggleLink').text('Nemaš Nalog? Registruj se');
            }
            changeLang(languageSelected);
        });

        /*********Langugage feature onClickListeners**********/
        /***To change***/
        serbianLang.off('click').on('click',function(e){
           changeLang('srb')
        })
        englishLang.off('click').on('click',function(e){
            changeLang('eng')
        })

        

        /*******Dodaj osiguranika OnClickListener********/
        dodaj_osiguranika.off('click').on('click', function(e){
            e.preventDefault()
            //proveri jel su uneti podatci       
            if(!validacijaDodatnihOsiguranika()){
                alert('Molimo Vas Popunite Sve Podatke O Bar 1 Dodatnom Osiguraniku')
                return;
            }
            if(br_pasosa_d_o.val().length!==9){
                alert('Broj Pasosa Mora Da Se Sastoji Od 9 Cifara. Molimo Vas Da Proverite Vas Unos!')
                return;
            }
            logVals();
            //dodaj u dodatne osiguranike string iz kog se parsiraju objekti
            dodatni_osiguranici+=ime_d_o.val() + " " +prezime_d_o.val() + "," + rodjendan_d_o.val() + "," + br_pasosa_d_o.val() + "|"
            console.log(dodatni_osiguranici);
            //inicijalizacija dodatniOsiguranik objekta
            let dodatniOsiguranik = new DodatniOsiguranik(ime_d_o.val() + " " +prezime_d_o.val(), rodjendan_d_o.val(),br_pasosa_d_o.val());
            console.log(dodatniOsiguranik);
            //javi korisniku da je uspesno dodao osiguranika po imenu
            alert('Dodali Ste Osiguranika: ' + ime_d_o.val() + " " +prezime_d_o.val())
            //resetuj polja za sledeceg osiguranika
            ime_d_o.val("")
            prezime_d_o.val("")
            rodjendan_d_o.val("")
            br_pasosa_d_o.val("")
            //apendovanje osiguranika u dodatiOsiguranici
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
