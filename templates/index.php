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
        <input placeholder="Korisničko Ime" class="login_unos" type="text"/>
        <input placeholder="Lozinka" class="login_unos" type="password"/>
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
            <input type="name" placeholder="Ime">
            <input type="name" placeholder="Prezime">
        </div>
        <h3>
            Datum Rodjenja
        </h3>
        <input type="date">
        <h3>
            Broj Pasosa
        </h3>
        <input type="number">
        <h3>
            Kontakt
        </h3>
        <div>
            <input placeholder="email" type="email">
            <input placeholder="Broj Telefona" type="number">
        </div>
        <h3>
            Kad Putujete?
        </h3>
        <div class="input-group">
            <input type="text" class="form-control" id="dateRange">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <h3>Grupno Ili Individualno Osiguranje</h3>
        <div class="radio_grupa">
            <label for="individualno"> Individualno </label>
            <input id="individualno" type="radio" name="tip_polise">
            <label for="grupno"> Grupno </label>
            <input id="grupno" type="radio" name="tip_polise">

        </div>
       </form>
    </div>

    <script>
        $(document).ready(function(){
            $('#koren').toggle()
            $('#submitButton').off('click').on('click',function(e){
                        //obradi logovanje
                        //AKO je logovanje uspesno:
                        e.preventDefault();
                        console.log('obradi logovanje')
                        $('#loginContainer').toggle()
                        $('#koren').toggle()
                        $('#dateRange').datepicker({
                            format: 'yyyy-mm-dd', // Set the desired date format
                            clearBtn: true, // Show a "Clear" button
                            todayHighlight: true, // Highlight today's date
                            multidate: 2, // Allow selection of multiple dates
                            multidateSeparator: ' - ' // Separator for the selected date range
                        }).on('changeDate', function(e){
                              if(e.dates.length >= 2){
                                 $(this).datepicker('hide');
                            }
                            if(e.dates.length > 2){
                              $(this).datepicker('setDates', [e.date]);
                             }
                            });


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
