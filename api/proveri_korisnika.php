<?php 
function jelKorisnikPostoji($korisnicko_ime){
    $ime_servera = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'osiguranko';

    $conn = new mysqli($ime_servera, $username, $password, $dbname);

    if($conn->connect_error){
        die("Konekcija nije uspela" . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id_korisnik FROM korisnici WHERE korisnik_ime = ?");
    $stmt->bind_param('s', $korisnicko_ime);
    
    //izvrsavanje upita
    $stmt->execute();

    $stmt->store_result();

    //da li korisnik postoji
    $num_rows = $stmt->num_rows;

    //zatvori konekciju
    $stmt->close();
    $conn->close();

    return $num_rows > 0; //vrati true ako korisnik posotji, false u suprotnom
}

//endpoint
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $korisnicko_ime = $_POST["ime"]; 
    $user_exists = jelKorisnikPostoji($korisnicko_ime);
    echo $user_exists ? "true" : "false"; 
}