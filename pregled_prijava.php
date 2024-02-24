<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje Polise</title>

    <link rel="stylesheet" href="public/styles.css">
    <link rel="icon" href="public/resursi/paragraf_logo.png"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="models/polisa.js"></script>
    <script src="models/DodatniOsiguranik.js"></script>


</head>
<body style="background-color:#f4f4f4">
    <?php include 'navigacija.php'?>
    
    <!--Container za listu prijava i tabelu za prikaz polisa-->
    <!--Lista prijava-->
    <div class="pregled_koren">
        <h2>Moje Polise</h2>
        <div id="listaPrijava" class="list_prijava">
    </div>
     <!--Tabelarni prikaz polise koji se dinamicki popunjava i prikazuje-->
    <div style="display: none;" id="prijave" class="prikaz_prijava">
        <div id="ime_container" class="prikaz_polje">Ime</div>
        <div id="rodjendan_container" class="prikaz_polje">rodjen</div>
        <div id="br_pasosa_container" class="prikaz_polje">br pasosa</div>
        <div id="email_container" class="prikaz_polje">email</div>
        <div id="telefon_container" class="prikaz_polje"></div>
        <div id="od_container" class="prikaz_polje">od</div>
        <div id="do_container" class="prikaz_polje">do</div>
        <div id="br_dana_container" class="prikaz_polje">br dana</div>
        <div id="tip_container" class="prikaz_polje">tip</div>
        <!--Dugme za prikaz dodatnih osiguranika grupne polise-->
        <div id="prikazi_container" class="prikazi_container">prikazi vise</div>
    </div>  

    </div>
    <!--Kraj korenog elementa i pocetak prozora za prikaz dodatnih osiguranika-->
    <!--Ovde se sve popunjava dinamicki-->
    <div style="display: none;" id="do" class="dodatni_osiguranici">
    <h1 id="do_naslov" style="text-align:center;">Dodatni Osiguranici:</h1>
    <img src="public/resursi/close.png" id="closeBtn" class="closeBtn">
    <div id="d_o_c" class="container_d_osiguranika">

    </div>
    </div>
  


</body>
<footer>
    <div class="language_selection">
         <img id="serbian_select" src="public/resursi/serbian_flag.png"/>
         <img id="english_select" src="public/resursi/usa_flag.webp"/>
    </div>
</footer>

<script>
   let userId =sessionStorage.getItem('id');
   console.log(userId);
   let polise = ""
   let polisa_arr =null;
    //referenca na sve UI elemente
   let prijaveDiv = $('#prijave');
   let imeContainerDiv = $('#ime_container');
   let rodjendanContainerDiv = $('#rodjendan_container');
   let brPasosaContainerDiv = $('#br_pasosa_container');
   let emailContainerDiv = $('#email_container');
   let telefonContainerDiv = $('#telefon_container');
   let odContainerDiv = $('#od_container');
   let doContainerDiv = $('#do_container');
   let brDanaContainerDiv = $('#br_dana_container');
   let tipContainerDiv = $('#tip_container');
   let prikaziContainerDiv = $('#prikazi_container');
   let d_o=$('#do');
   let doc=$('#d_o_c');
   let closeBtn = $('#closeBtn');
 
//funkcija za prikaz dodatnih osiguranika
function prikaziDo(){
    d_o.css("display","flex");
}
//funkcija za prikaz svih elementa na prikazu prijave
function prikaziPrijave(){
        $("#prijave").css("display", "flex");
        //ukinuti onclick funkciju od prosle povezane polise
        prikaziContainerDiv.off('click');
}
//postavi podatke input polise na odgovarajuca polja
function postaviPrijavu(polisa){
        imeContainerDiv.text("Ime Nosioca: " + polisa.getPolisaIme())
        rodjendanContainerDiv.text("Datum Rodjenja: " + polisa.getPolisaDatumRodjenja())
        brPasosaContainerDiv.text("Broj Pasosa: " + polisa.getPolisaBrPasosa())
        emailContainerDiv.text("Email: " + polisa.getPolisaEmail());
        if(polisa.getPolisaBrTelefona()===0 || polisa.getPolisaBrTelefona()===""){
            telefonContainerDiv.text("Nije Naveden Broj Telefona")
        }else{
            telefonContainerDiv.text("Broj Telefona: " + polisa.getPolisaBrTelefona());
        }
        odContainerDiv.text("Od: " + polisa.getPolisaOd())
        doContainerDiv.text("Do: " + polisa.getPolisaDo())
        brDanaContainerDiv.text(calculateDateDifference(polisa.getPolisaOd(),polisa.getPolisaDo()) + " dana");
        tipContainerDiv.text("Tip osiguranja: " + polisa.getPolisaTip())
        //ako je grupno osiguranje, prikazi dugme i postavi onClick listener
        if(polisa.getPolisaTip()==='grupno'){
            prikaziContainerDiv.css('display','block');
            prikaziContainerDiv.text("Prikazi Dodatne Osiguranike");
            //onclicklistener
            prikaziContainerDiv.off('click').on('click',function(e){
                console.log(polisa.getPolisaDodatniOsiguranici())
                let osiguranici =createDodatniOsiguranikArray(polisa.getPolisaDodatniOsiguranici())
                console.log(osiguranici)
                //isprazni pre nego sto postavis nove osiguranike da se ne bi
                //beskonacno appendovalo
                doc.empty();
                //konstuisi DOM element za svakog osiguranika ponaosob
                osiguranici.forEach(osiguranik=>{
                    const toAppend = `<div class="osiguranik">
                                        <p>${osiguranik.getIme()}<p/>
                                        <p>${osiguranik.getDatumRodjenja()}<p/>
                                        <p>${osiguranik.getBrojPasosa()}<p/>
                                        </div>`;
                    doc.append(toAppend);

                })
            prikaziDo();

            })
        }else{
            //sakrij dugme za dodatne osiguranike ako je osiguranje individualno
            prikaziContainerDiv.css('display','none');
        }
    }

//funkcija od stringa formata podatak, podattak, podatak | podatak, podatak, podatak |... pravi dodatne osiguranike
function createDodatniOsiguranikArray(str) {
    console.log('Received string:', str);
    const osiguraniciArray = [];
    let stringArr = str.split('|')
    stringArr.pop() //last element is always empty
    console.log(stringArr);
    for (let osiguranikStr of stringArr) {
        const [ime, datumRodjenja, brojPasosa] = osiguranikStr.split(',');
        let dodatniOsiguranik = new DodatniOsiguranik(ime.trim(), datumRodjenja.trim(), brojPasosa.trim());
        osiguraniciArray.push(dodatniOsiguranik);
    }
    return osiguraniciArray;
}
    //racuna br dana izmedju pocetnog i krajnjeg datuma

   function calculateDateDifference(startDate, endDate) {
        const startDateObj = new Date(startDate);
        const endDateObj = new Date(endDate);
        const differenceMs = endDateObj - startDateObj;
        const differenceDays = differenceMs / (1000 * 60 * 60 * 24);
        return differenceDays;
    }

    /*****Kraj-Pomocne Funkcije*****/

  
    /****Dokument loadovan******/
   $(document).ready(function(){
    let userId = sessionStorage.getItem('id');
    let polise = "";
    let polisa_arr = null;
    console.log(sessionStorage.getItem('lang'));

    //reroute usera ukoliko otvori ovu stranicu preko url-a a nije ulogovan
    if(userId===-1 || userId===null || userId===undefined){
        window.location.href ='index.php';
    }

 
    /******Asinhrona funkcija*******/
    function dohvatiPolise() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: 'api/dohvati_polise.php',
                method: "GET",
                data: { id_korisnika: userId },
                success: function (response) {
                    resolve(response);
                    polise = JSON.parse(response);
                    polisa_arr = createPoliseArray(polise);
                    console.log(polisa_arr);
                }
            });
        });
    }
    //pravi polise iz parsovanog jsona koji je vracen iz asinhrone funkcije dohvatiPolise()
    function createPoliseArray(data) {
        const poliseArray = [];
        data.forEach(entry => {
            const polisa = new Polisa(
                entry.id_korisnika, entry.polisa_br_pasosa,
                entry.polisa_br_telefona, entry.polisa_datum_rodjenja,
                entry.polisa_od, entry.polisa_do, entry.polisa_ime,
                entry.polisa_tip, entry.polisa_email, entry.polisa_dodatni_osiguranici,
                entry.datum_prijave
            );
            poliseArray.push(polisa);
        });
        return poliseArray;
    }
    

   
        let tableBody = $('#tabela');
        let listaPrijava = $('#listaPrijava');
        let counter = 1;

        //dohvati polise i dodaj datum svih polisa u listu uz counter
        dohvatiPolise(userId).then(response => {
            polisa_arr.forEach((polisa, index) => {
                const datumZaPolisu = `<div class="polisa" data-index="${index}">${counter}) ${polisa.datumPrijave} <br> ${polisa.getPolisaIme()}</div>`;
                listaPrijava.append(datumZaPolisu);
                counter++;
            });
        });
        //onclicklistener da se zatvori prozor dodatnih osiguranika
        closeBtn.on('click',function(e){
            d_o.toggle();
        })

        //postavljanje onClick listenera na svaku polisu koja se appendovala
        listaPrijava.on('click', '.polisa', function (e) {
            const index = $(this).data('index');
            const clickedPolisa = polisa_arr[index];
            console.log(clickedPolisa);
            prikaziPrijave()
            postaviPrijavu(clickedPolisa);
            $('.polisa').removeClass('selected');
            $(this).addClass('selected');
        });
    })




</script>

</html>