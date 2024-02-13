<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava Polise</title>
    <link rel="stylesheet" href="../public/styles.css">
    <link rel="icon" href="../public/resursi/paragraf_logo.png"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include 'navigacija.php'?>
    <div class="login_container">
       <h1 id="naslov">Prijava Korisnika</h1>
       <img src="../public/resursi/paragraf_logo.png"/>
       <form class="forma_login" id="loginForm">
        <input placeholder="Korisničko Ime" class="login_unos" type="text"/>
        <input placeholder="Lozinka" class="login_unos" type="password"/>
        <input  type="submit" value="Prijavi se" id="submitButton"/>
       </form>
       <div>
        <a href="#" id="toggleLink">Nemaš Nalog? Registruj se</a>
       </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#submitButton').off('click').on('click',function(e){
                        //obradi logovanje
                        e.preventDefault();
                        console.log('obradi logovanje')

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
</body>

</html>
