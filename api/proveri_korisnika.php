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
    
    // Execute the prepared statement
    $stmt->execute();

    // Store the result
    $stmt->store_result();

    // Check if the user exists
    $num_rows = $stmt->num_rows;

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    return $num_rows > 0; // Return true if the user exists, false otherwise
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $korisnicko_ime = $_POST["ime"]; // Assuming "ime" is the username sent via POST request
    $user_exists = jelKorisnikPostoji($korisnicko_ime);
    echo $user_exists ? "true" : "false"; // Output "true" if user exists, "false" otherwise
}