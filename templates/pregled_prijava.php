<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje Polise</title>

    <link rel="stylesheet" href="../public/styles.css">
    <link rel="icon" href="../public/resursi/paragraf_logo.png"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../models/polisa.js"></script>
    <script src="../models/DodatniOsiguranik.js"></script>


</head>
<body style="background-color:#f4f4f4">
    <?php include 'navigacija.php'?>
    
    <div class="pregled_koren">
        <div id="listaPrijava" class="list_prijava">
    </div>
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
           
            <div id="prikazi_container" class="prikazi_container">prikazi vise</div>
        </div>      
    </div>
    <div style="display: none;" id="do" class="dodatni_osiguranici">
    <h1 id="do_naslov" style="text-align:center;">Dodatni Osiguranici:</h1>
    <img src="../public/resursi/close.png" id="closeBtn" class="closeBtn">
    <div id="d_o_c" class="container_d_osiguranika">

    </div>
    </div>
  
<script>
   let userId =sessionStorage.getItem('id');
   console.log(userId);
   let polise = ""

   let polisa_arr =null;

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

   



   function calculateDateDifference(startDate, endDate) {
    const startDateObj = new Date(startDate);
    const endDateObj = new Date(endDate);

    const differenceMs = endDateObj - startDateObj;

    const differenceDays = differenceMs / (1000 * 60 * 60 * 24);

    return differenceDays;
}
function prikaziDo(){
    d_o.css("display","flex");
}
    function prikaziPrijave(){
        $("#prijave").css("display", "flex");
        prikaziContainerDiv.off('click');
    }
    function postaviPrijavu(polisa){
        imeContainerDiv.text("Ime Nosioca: " + polisa.getPolisaIme())
        rodjendanContainerDiv.text("Datum Rodjenja: " + polisa.getPolisaDatumRodjenja())
        brPasosaContainerDiv.text("Broj Pasosa: " + polisa.getPolisaBrPasosa())
        emailContainerDiv.text("Email: " + polisa.getPolisaEmail());
        if(polisa.getPolisaBrTelefona()===""){
            telefonContainerDiv.text("Nije Naveden Broj Telefona")
        }else{
            telefonContainerDiv.text("Broj Telefona: " + polisa.getPolisaBrTelefona());
        }
        odContainerDiv.text("Od: " + polisa.getPolisaOd())
        doContainerDiv.text("Do: " + polisa.getPolisaDo())
        brDanaContainerDiv.text(calculateDateDifference(polisa.getPolisaOd(),polisa.getPolisaDo()) + " dana");
        tipContainerDiv.text("Tip osiguranja: " + polisa.getPolisaTip())
        if(polisa.getPolisaTip()==='grupno'){
            prikaziContainerDiv.css('display','block');
            prikaziContainerDiv.text("Prikazi Dodatne Osiguranike");
            prikaziContainerDiv.off('click').on('click',function(e){
                console.log(polisa.getPolisaDodatniOsiguranici())
                let osiguranici =createDodatniOsiguranikArray(polisa.getPolisaDodatniOsiguranici())
                console.log(osiguranici)
                doc.empty();
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
            prikaziContainerDiv.css('display','none');
        }
    }
    
    function dohvatiPolise(){
    return new Promise((resolve, reject)=>{
        $.ajax({
            url:'../api/dohvati_polise.php',
            method:"GET",
            data:{id_korisnika:userId},
            success:function(response){
                resolve(response)
                console.log(response);

                polise=JSON.parse(response);
                
                polisa_arr=createPoliseArray(polise);

                polisa_arr.forEach(val=>{
                    console.log(val);
                })

            }

        })
    });
}
    function createPoliseArray(data) {
    const poliseArray = [];
    data.forEach(entry => {
        console.log(entry);
        const polisa = new Polisa(
           entry.id_korisnika,entry.polisa_br_pasosa,
           entry.polisa_br_telefona,entry.polisa_datum_rodjenja,
           entry.polisa_od,entry.polisa_do,entry.polisa_ime,
           entry.polisa_tip,entry.polisa_email,entry.polisa_dodatni_osiguranici,
           entry.datum_prijave

        );
        poliseArray.push(polisa);
    });
    return poliseArray;
}
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


 
    
   
   $(document).ready(function(){
    let userId = sessionStorage.getItem('id');
    let polise = "";
    let polisa_arr = null;

    function calculateDateDifference(startDate, endDate) {
        const startDateObj = new Date(startDate);
        const endDateObj = new Date(endDate);
        const differenceMs = endDateObj - startDateObj;
        const differenceDays = differenceMs / (1000 * 60 * 60 * 24);
        return differenceDays;
    }

    function dohvatiPolise() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: '../api/dohvati_polise.php',
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

    $(document).ready(function () {
        let tableBody = $('#tabela');
        let listaPrijava = $('#listaPrijava');
        let counter = 1;

        dohvatiPolise(userId).then(response => {
            polisa_arr.forEach((polisa, index) => {
                const datumZaPolisu = `<div class="polisa" data-index="${index}">${counter}) ${polisa.datumPrijave}</div>`;
                listaPrijava.append(datumZaPolisu);
                counter++;
            });
        });

        closeBtn.on('click',function(e){
            d_o.toggle();
        })

        listaPrijava.on('click', '.polisa', function (e) {
            const index = $(this).data('index');
            const clickedPolisa = polisa_arr[index];
            console.log(clickedPolisa);
            prikaziPrijave()
            postaviPrijavu(clickedPolisa);
            $('.polisa').removeClass('selected');
            $(this).addClass('selected');
            
        });
    });
});
</script>

</body>

</html>