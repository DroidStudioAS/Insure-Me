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
    $stmt = $conn->prepare("INSERT INTO polise_ ( id_korisnika, polisa_br_pasosa, polisa_br_telefona, polisa_datum_rodjenja, polisa_od, polisa_do, polisa_ime, polisa_tip, polisa_email, polisa_dodatni_osiguranici, datum_prijave) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
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
    $datum_prijave=$polisa->getDatumPrijave();
    
    $stmt->bind_param("issssssssss",  $idKorisnika, $polisaBrPasosa, $polisaBrTelefona, $polisaDatumRodjenja, $polisaOd, $polisaDo, $polisaIme, $polisaTip, $polisaEmail, $polisaDodatniOsiguranici, $datum_prijave);
   
     //izvrsavanje
    if($stmt->execute()===TRUE){
        echo 'kreiran novi zapis';
    }else{
        echo "greska" . $datum_prijave . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    }

    //exc blocl
    // Execution block
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //izvuci podatke iz zahteva
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
    $datum_prijave = $_POST['datum_prijave'];

    // Napravi novu instancu polise
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
        $polisa_dodatni_osiguranici,
        $datum_prijave
    );

    //izvrsna funckcija
    dodajPolisu($polisa);
}


