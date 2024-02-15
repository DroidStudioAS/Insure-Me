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

</head>
<body>
    <?php include 'navigacija.php'?>
    
    <div class="pregled_koren">
        <div id="listaPrijava" class="list_prijava">
    </div>

        <div style="display: none;" id="prijave" class="prikaz_prijava">
            <div id="ime_container" class="ime_container">Ime</div>
            <div id="rodjendan_container" class="rodjendan_container">rodjen</div>
            <div id="br_pasosa_container" class="br_pasosa_container">br pasosa</div>
            <div id="email_container" class="email_container">email</div>
            <div id="telefon_container", class="telefon_container"></div>
            <div id="od_container" class="od_container">od</div>
            <div id="do_container" class="do_container">do</div>
            <div id="br_dana_container" class="br_dana_container">br dana</div>
            <div id="tip_container" class="tip_container">tip</div>
           
            <div id="prikazi_container" class="prikazi_container">prikazi vise</div>
        </div>
    <!--    <table class="table" id="tabela">                   -->     
    <!--    <thead>-->
    <!--        <tr>-->
    <!--            <th>Datum unosa polise</th>-->
    <!--            <th>Ime i prezime nosioca</th>-->
    <!--            <th>Datum rođenja</th>-->
    <!--            <th>Broj pasoša</th>-->
    <!--            <th>Email</th>-->
    <!--            <th>Datum putovanja od</th>-->
    <!--            <th>Datum putovanja do</th>-->
    <!--            <th>Broj dana</th>-->
    <!--            <th>Induvidualno / Grupno osiguranje</th>-->
    <!--        </tr>-->
    <!--    </thead>-->
    <!--    <tbody>-->
  <!---->
    <!--    </tbody>-->
    <!--</table>-->
       
    </div>
    <div class="dodatni_osiguranici">
        dsadassdas
        </div>
  
<script>
   let userId =localStorage.getItem('id');
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

   function calculateDateDifference(startDate, endDate) {
    const startDateObj = new Date(startDate);
    const endDateObj = new Date(endDate);

    const differenceMs = endDateObj - startDateObj;

    const differenceDays = differenceMs / (1000 * 60 * 60 * 24);

    return differenceDays;
}
    function prikaziPrijave(){
        $("#prijave").css("display", "flex");
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
            prikaziContainerDiv.text("Prikazi Dodatne Osiguranike");
        }else{
            prikaziContainerDiv.text("");
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

 
    
   }
   $(document).ready(function(){
    let userId = localStorage.getItem('id');
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

        listaPrijava.on('click', '.polisa', function (e) {
            const index = $(this).data('index');
            const clickedPolisa = polisa_arr[index];
            console.log(clickedPolisa);
            prikaziPrijave()
            postaviPrijavu(clickedPolisa);
            
        });
    });
});
</script>

</body>

</html>