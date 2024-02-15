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
        <div class="lista_prijava">
            <ol>
                <li>primer 1</li>
                <li>primer 2</li>

            </ol>
        </div>
        <div class="prikaz_prijava">
        <table id="tabela">
        <thead>
            <tr>
                <th>Datum unosa polise</th>
                <th>Ime i prezime nosioca</th>
                <th>Datum rođenja</th>
                <th>Broj pasoša</th>
                <th>Email</th>
                <th>Datum putovanja od</th>
                <th>Datum putovanja do</th>
                <th>Broj dana</th>
                <th>Induvidualno / Grupno osiguranje</th>
                <th>Akcija</th>
            </tr>
        </thead>
        <tbody>
            <!-- Add table rows dynamically with data -->
            <tr>
                <td>2024-02-14</td>
                <td>John Doe</td>
                <td>1990-01-01</td>
                <td>123456789</td>
                <td>john.doe@example.com</td>
                <td>2024-03-01</td>
                <td>2024-03-15</td>
                <td>15</td>
                <td>Individualno</td>
                <td><button>Show Details</button></td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
        </div>
    </div>
  
<script>
   let userId =localStorage.getItem('id');
   let polise = ""

   let polisa_arr =null;
    
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
           entry.polisa_tip,entry.polisa_email,entry.polisa_dodatni_osiguranici

        );
        poliseArray.push(polisa);
    });
    return poliseArray;
}
 
    
   }
    $(document).ready(function(){
        let tableBody = $('#tabela');
        console.log(userId);
        let polise = dohvatiPolise(userId).then(respnse=>{
            polisa_arr.forEach(polisa => {
               const row = `<tr>
                                <td></td>                                                 
                                <td>${polisa.polisaIme}</td>
                                <td>${polisa.polisaDatumRodjenja}</td>
                                <td>${polisa.polisaBrPasosa}</td>
                                <td>${polisa.polisaEmail}</td>
                                <td>${polisa.polisaOd}</td>
                                <td>${polisa.polisaDo}</td>
                                <td></td>
                                <td>${polisa.polisaTip}</td>
                                <td><button>Show Details</button></td>
                           </tr>`;
               tableBody.append(row);
           });       
         });





     

        
     
    })
</script>

</body>

</html>