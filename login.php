<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sjekk pålogging</title>
</head>
<body>
<?php
if(isset($_POST['submit'])){
    //Gjøre om POST-data til variabler
    $brukernavn = $_POST['brukernavn'];
    $passord = md5($_POST['passord']);
    
    //Koble til databasen
    $dbc = mysqli_connect('localhost', 'root', 'Admin', 'fjell')
      or die('Error connecting to MySQL server.');
    
    //Gjøre klar SQL-strengen
    $query = "SELECT userID, username, password FROM user WHERE username='$brukernavn' AND password='$passord'";
    
    //Utføre spørringen
    $result = mysqli_query($dbc, $query)
      or die('Error querying database.');
    
    //Sjekke om spørringen gir resultater
    if(mysqli_num_rows($result) > 0){
        //Gyldig login
        $_SESSION['id'] = 2;
        header('Location: success.html');
        exit; // Terminate script after redirection
    }else{
        //Ugyldig login
        header('Location: failure.html');
        exit; // Terminate script after redirection
    }
    //Koble fra databasen
    mysqli_close($dbc);
}
?>
</body>
</html>
