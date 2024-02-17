<?php

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

    //vrati user id
    return $userId;
}

//API ENDPOINT
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //Proveri da li je username dat
    if (isset($_GET['username'])) {
        //izvuci username i sanitiraj ga
        $username = filter_var($_GET['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //dobavi id
        $userId = fetchUserIdByUsername($username);
        //sacuvaj id u sesiju
        $_SESSION['user_id']=$userId;
        //vrati user id kao tekst
        echo $userId;
    } else {
        //nedostaje usernamwe
        echo "Error: Username parameter is missing.";
    }
}


