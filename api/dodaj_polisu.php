<?php
require_once ("../models/polisa.php");


function dodajPolisu($polisa){
    $ime_servera = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'osiguranko';

    $conn = new mysqli($ime_servera, $username, $password, $dbname);

    if($conn->connect_error){
        die("Konekcija nije uspela" . $conn->connect_error);
    }
    $stmt = $conn->prepare("INSERT INTO polise_ ( id_korisnika, polisa_br_pasosa, polisa_br_telefona, polisa_datum_rodjenja, polisa_od, polisa_do, polisa_ime, polisa_tip, polisa_email, polisa_dodatni_osiguranici) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    //izvlacenje vrednosti
    $idKorisnika = $polisa->getIdKorisnika();
    $polisaBrPasosa = $polisa->getPolisaBrPasosa();
    $polisaBrTelefona = $polisa->getPolisaBrTelefona();
    $polisaDatumRodjenja = $polisa->getPolisaDatumRodjenja();
    $polisaOd = $polisa->getPolisaOd();
    $polisaDo = $polisa->getPolisaDo();
    $polisaIme = $polisa->getPolisaIme();
    $polisaTip = $polisa->getPolisaTip();
    $polisaEmail = $polisa->getPolisaEmail();
    $polisaDodatniOsiguranici = $polisa->getPolisaDodatniOsiguranici();
    
    $stmt->bind_param("isssssssss",  $idKorisnika, $polisaBrPasosa, $polisaBrTelefona, $polisaDatumRodjenja, $polisaOd, $polisaDo, $polisaIme, $polisaTip, $polisaEmail, $polisaDodatniOsiguranici);
   
     //izvrsavanje
    if($stmt->execute()===TRUE){
        echo 'kreiran novi zapis';
    }else{
        echo "greska" . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    }

    //exc blocl
    // Execution block
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming the data is sent via POST request
    // Extracting the data from the request
    $id_korisnika = $_POST['id_korisnika'];
    $polisa_br_pasosa = $_POST['polisa_br_pasosa'];
    $polisa_br_telefona = $_POST['polisa_br_telefona'];
    $polisa_datum_rodjenja = $_POST['polisa_datum_rodjenja'];
    $polisa_od = $_POST['polisa_od'];
    $polisa_do = $_POST['polisa_do'];
    $polisa_ime = $_POST['polisa_ime'];
    $polisa_tip = $_POST['polisa_tip'];
    $polisa_email = $_POST['polisa_email'];
    $polisa_dodatni_osiguranici = $_POST['polisa_dodatni_osiguranici'];

    // Create a new instance of the Polisa class using constructor
    $polisa = new Polisa(
        $id_korisnika,
        $polisa_br_pasosa,
        $polisa_br_telefona,
        $polisa_datum_rodjenja,
        $polisa_od,
        $polisa_do,
        $polisa_ime,
        $polisa_tip,
        $polisa_email,
        $polisa_dodatni_osiguranici
    );

    // Call the function to insert the Polisa into the database
    dodajPolisu($polisa);
}


