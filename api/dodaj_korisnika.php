<?php 


function unesiKorisnika($korisnicko_ime, $korisnicka_sifra){
    //povezivanje sa bazom
    $ime_servera = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'osiguranko';

    $conn = new mysqli($ime_servera, $username, $password, $dbname);

    if($conn->connect_error){
        die("Konekcija nije uspela" . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO korisnici (korisnik_ime, korisnik_sifra) VALUES (?, ?)");
    $stmt->bind_param('ss',$korisnicko_ime,$korisnicka_sifra);

    //izvrsavanje
    if($stmt->execute()===TRUE){
        echo 'kreiran novi zapis';
    }else{
        echo "greska" . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $ime = $_POST["ime"];
    $sifra = $_POST["sifra"];
    unesiKorisnika($ime,$sifra);
}