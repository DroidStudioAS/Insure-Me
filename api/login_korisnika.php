<?php

function login($username, $password) {
    $ime_servera = 'localhost';
    $username_db = 'root';
    $password_db = '';
    $dbname = 'osiguranko';

    // Create connection
    $conn = new mysqli($ime_servera, $username_db, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Konekcija nije uspela: " . $conn->connect_error);
    }

    // Prepare statement to select user with provided username
    $stmt = $conn->prepare("SELECT korisnik_sifra FROM korisnici WHERE korisnik_ime = ?");
    $stmt->bind_param('s', $username);

    // Execute the prepared statement
    $stmt->execute();

    // Store the result
    $stmt->store_result();

    // Check if user with provided username exists
    if ($stmt->num_rows > 0) {
        // Bind the result variables
        $stmt->bind_result($stored_password);

        // Fetch the result
        $stmt->fetch();

        // Compare passwords
        if (password_verify($password, $stored_password)) {
            // Passwords match, user is authenticated
            $stmt->close();
            $conn->close();
            return true;
        } else {
            // Passwords do not match
            $stmt->close();
            $conn->close();
            return false;
        }
    } else {
        // User with provided username does not exist
        $stmt->close();
        $conn->close();
        return false;
    }
}


// Execution block
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming username and password are sent via POST request
    $username = $_POST["ime"];
    $password = $_POST["sifra"];

    // Call the login function
    $result = login($username, $password);

    // Output the result
    echo $result ? "true" : "false";
}

