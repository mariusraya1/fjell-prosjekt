<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="utf-8">
    <title>PHP registrering</title>
</head>
<body>
    <div class="oprettcontainer">
        <p>Opprett ny bruker:</p>
        <form method="post">
            <label for="brukernavn">Brukernavn:</label>
            <input type="text" name="username" /><br />
            <label for="passord">Passord:</label>
            <input type="password" name="password" /><br />
            <div class="btnstyle">
                <input type="submit" value="Logg inn" name="submit" />
            </div>
        </form>
    </div>    

    

    <?php
    if(isset($_POST['submit'])){
        //Gjøre om POST-data til variabler
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        
        //Koble til databasen
        $dbc = mysqli_connect('localhost', 'root', 'Admin', 'fjell')
          or die('Error connecting to MySQL server.');

        // Prepare a SELECT query to check if the username already exists
        $check_username_query = "SELECT * FROM user WHERE username = '$username'";

        // Execute the SELECT query
        $check_username_result = mysqli_query($dbc, $check_username_query);

        // Check if any rows were returned
        if (mysqli_num_rows($check_username_result) > 0) {
            // Username already exists
            echo "Username already exists. Please choose a different one.";
        } else {
            //Gjøre klar SQL-strengen
            $query = "INSERT INTO user (username, password) VALUES ('$username','$password')";
            
            //Utføre spørringen
            $result = mysqli_query($dbc, $query)
              or die('Error querying database.');
            
            //Koble fra databasen
            mysqli_close($dbc);

            //Sjekke om spørringen gir resultater
            if($result){
                //Gyldig login
                echo "Takk for at du lagde bruker! Trykk <a href='mainpage.html'>her</a> for å logge inn";
            }else{
                //Ugyldig login
                echo "Noe gikk galt, prøv igjen!";
            }
        }
    }
    ?>
</body>
</html>
