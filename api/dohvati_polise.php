<?php
function dohvati_korisnikovce_polise($id_korisnika){
    $ime_servera = 'localhost';
    $username_db = 'root';
    $password_db = '';
    $dbname = 'osiguranko';
    
    $conn = new mysqli($ime_servera, $username_db, $password_db, $dbname);
    
    if($conn->connect_error){
        die("Konekcija nije uspela" . $conn->connect_error);
    }

    $stmt=$conn->prepare('SELECT * FROM polise_ WHERE id_korisnika = ?');
    $stmt->bind_param("i",$id_korisnika);

    $stmt->execute();
    $result = $stmt->get_result();

    $polise = array(); //prazan niz za cuvanje podatke o polisama
    
    while ($row = $result->fetch_assoc()) {
        //dodaj svaki red rezultata u niz
        $polise[] = $row;
    }

    $stmt->close();
    $conn->close();

    return json_encode($polise);
}

//endpoint
if(isset($_GET['id_korisnika'])) {
    $id_korisnika = $_GET['id_korisnika']; //dohvati user id
    $polise_data = dohvati_korisnikovce_polise($id_korisnika);
    echo $polise_data; 
} else {
    echo "Invalid request";
}





/**<?php

function fetchUserIdByUsername($username){
    $ime_servera = 'localhost';
    $username_db = 'root';
    $password_db = '';
    $dbname = 'osiguranko';

    $conn = new mysqli($ime_servera, $username_db, $password_db, $dbname);

    if($conn->connect_error){
        die("Konekcija nije uspela" . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id_korisnik FROM korisnici WHERE korisnik_ime = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($userId);
    $stmt->fetch();
    $stmt->close();

    // Return the user ID
    return $userId;
}

// API endpoint for fetching user ID by username
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Check if the username parameter is provided
    if (isset($_GET['username'])) {
        // Get the username from the request
        $username = $_GET['username'];

        // Fetch the user ID
        $userId = fetchUserIdByUsername($username);

        // Return the user ID as a plain text response
        echo $userId;
    } else {
        // If username parameter is missing, return an error message
        echo "Error: Username parameter is missing.";
    }
}


*/