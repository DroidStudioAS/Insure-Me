<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje Polise</title>

    <link rel="stylesheet" href="../public/styles.css">
    <link rel="icon" href="../public/resursi/paragraf_logo.png"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
        <table>
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
    
   function dohvatiPolise(){
    return new Promise((resolve, reject)=>{
        $.ajax({
            url:'../api/dohvati_polise.php',
            method:"GET",
            data:{id_korisnika:userId},
            success:function(response){
                resolve(response)
                console.log(response);
            }

        })
    })
    
   }
    $(document).ready(function(){
        console.log(userId);
        //polise sacuvane za korisnika
        dohvatiPolise(userId);
    })
</script>

</body>

</html>