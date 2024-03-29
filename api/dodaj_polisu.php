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
    //izvuci podatke iz zahteva i sanatiziraj ih
    $id_korisnika = filter_var($_POST['id_korisnika'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $polisa_br_pasosa = filter_var($_POST['polisa_br_pasosa'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $polisa_br_telefona = filter_var($_POST['polisa_br_telefona'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $polisa_datum_rodjenja = filter_var($_POST['polisa_datum_rodjenja'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $polisa_od = filter_var($_POST['polisa_od'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $polisa_do = filter_var($_POST['polisa_do'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $polisa_ime = filter_var($_POST['polisa_ime'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $polisa_tip = filter_var($_POST['polisa_tip'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $polisa_email = filter_var($_POST['polisa_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $polisa_dodatni_osiguranici = filter_var($_POST['polisa_dodatni_osiguranici'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $datum_prijave = filter_var($_POST['datum_prijave'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


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


