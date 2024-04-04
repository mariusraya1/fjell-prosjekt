<?php
session_start();
// Sjekk om skjemaet er sendt inn
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hent teksten fra tekstområdet
    $text = $_POST['my_text'];
    
    // Hent navn og e-post fra skjemaet
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Databaseforbindelsesparametere
    $host = "localhost";
    $username = "root";
    $password = "Admin";
    $database = "fjell";

    // Opprett forbindelse
    $conn = new mysqli($host, $username, $password, $database);

    // Sjekk forbindelse
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Forbered SQL-setning for å sette inn teksten i databasen
    $sql = "INSERT INTO ticketsystem (beskrivelse, userID, navn, epost) VALUES ('$text', {$_SESSION['id']}, '$name', '$email')";

    // Utfør SQL-setning
    if ($conn->query($sql) === TRUE) {
        echo "Meldingen er motatt, du blir sendt epost når vi har gått gjennom saken din!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Lukk forbindelse
    $conn->close();
}
?>

