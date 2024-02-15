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

        <div class="prikaz_prijava">
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
    </div>
    <div class="dodatni_osiguranici">
        dsadassdas
        </div>
  
<script>
   let userId =localStorage.getItem('id');
   let polise = ""

   let polisa_arr =null;

   function calculateDateDifference(startDate, endDate) {
    const startDateObj = new Date(startDate);
    const endDateObj = new Date(endDate);

    const differenceMs = endDateObj - startDateObj;

    const differenceDays = differenceMs / (1000 * 60 * 60 * 24);

    return differenceDays;
}
function prikaziOsiguranike(){

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
                console.log(polise[0].polisa_br_pasosa)

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
        });
    });
});
</script>

</body>

</html>