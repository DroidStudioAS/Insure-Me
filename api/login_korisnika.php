<?php

function login($username, $password) {
    $ime_servera = 'localhost';
    $username_db = 'root';
    $password_db = '';
    $dbname = 'osiguranko';

    $conn = new mysqli($ime_servera, $username_db, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Konekcija nije uspela: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT korisnik_sifra FROM korisnici WHERE korisnik_ime = ?");
    $stmt->bind_param('s', $username);

    // Execute the prepared statement
    $stmt->execute();

    // Store the result
    $stmt->store_result();

    //da li ovaj user postoji
    if ($stmt->num_rows > 0) {
        //postoji
        //povezivanje parametara
        $stmt->bind_result($stored_password);

        //dohvati rezultat
        $stmt->fetch();

        //Uporedi hash unete sifre i sacuvan hash
        if (password_verify($password, $stored_password)) {
            //sifra tacna
            $stmt->close();
            $conn->close();
            return true;
        } else {
            //sifra netacna
            $stmt->close();
            $conn->close();
            return false;
        }
    } else {
        //ne postoji
        $stmt->close();
        $conn->close();
        return false;
    }
}


//Endpoint
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["ime"];
    $password = $_POST["sifra"];

    
    $result = login($username, $password);
    
    echo $result ? "true" : "false";
}

