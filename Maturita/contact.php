<?php
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $departure = $_POST["departure"];
    $arrival = $_POST["arrival"];
    $date = $_POST["date"];
    $vehicle = $_POST["vehicle"];
    $message = $_POST["message"];
    if ($message==""){
        $message = null;
    }
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database = "zmp";
    $connection = mysqli_connect($server_name, $username, $password, $database);
    if (!$connection){
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO rezervace (name, email, departure, arrival, date, vehicle, message) values ('$name', '$email', '$departure', '$arrival', '$date', '$vehicle', '$message')";
    mysqli_query($connection, $sql);
    mysqli_close($connection);
    session_start();
    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;
    $_SESSION["departure"] = $departure;
    $_SESSION["arrival"] = $arrival;
    $_SESSION["date"] = $date;
    $_SESSION["vehicle"] = $vehicle;
    $_SESSION["message"] = $message;
    if (empty($_SESSION["message"])){
        $_SESSION["message"] =  "Poznámka nebyla zadána.";
    }
    header("Location: thanks.php");
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="icon" href="img/Datový%20zdroj%201.svg" type="image/svg+xml">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakty 🎫</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet"
          href="./css/style.css">
    <link rel="stylesheet" media="screen and (max-width: 768px" href="css/mobile.css">
    <meta name="description" content="Vítejte .....">
    <meta name="keywords" content="zájezd, company, opava, doprava, autobus, dovolená, spolehlivost">
</head>
<body>

<header>
    <nav id="navbar">
        <div class="container">
            <a href="index.html"> <img src="img/interbuswhite.png" alt="logo"> </a>
            <ul>
                <li><a href="index.html">Úvod</a></li>
                <li><a href="service.html"> Služby </a></li>
                <li><a href="about.html"> O nás </a></li>
                <li><a href="park.html"> Vozový park </a></li>
                <li><a class="current" href="contact.php"> Kontakt </a></li>
            </ul>
        </div>
    </nav>
</header>

<section id="contact-form" class="py-3 bg-light">
    <div class="container">
        <h2 class="l-heading"><span class="text-primary">Rezervace</span> </h2>
        <p>Rezervujte si vaši cestu ještě dnes</p>
        <form action="contact.php" method="post">
            <div class="form-group">
                <label for="name">Jméno</label>
                <input type="text" name="name" id="name" placeholder="Zadejte Vaše jméno a příjmení" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Zadejte Váš email" required>
            </div>
            <div class="form-group">
                <label for="departure">Odjezd z:</label>
                <input type="text" name="departure" id="departure" placeholder="Zadejte adresu" required>
            </div>

            <div class="form-group">
                <label for="arrival">Příjezd do:</label>
                <input type="text" name="arrival" id="arrival" placeholder="Zadejte adresu" required>
            </div>
            <div class="form-group">
                <label for="date">Datum</label>
                <input type="date" name="date" id="date" required>
            </div>
            <div class="form-group">
                <label for="vehicle">Požadované vozidlo</label>
                <select name="vehicle" required>
                    <option value="" disabled selected hidden>Vyberte si vozidlo</option>
                    <?php
                    $server_name = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "zmp";
                    $connection = mysqli_connect($server_name, $username, $password, $database);
                    if (!$connection){
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    $sql = "SELECT * FROM vozidla";
                    $result = mysqli_query($connection, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row["id"] . "'>" . $row["nazev"] . "</option>";
                        }
                    } else {
                        echo "Nepodařilo se načíst data";
                    }
                    mysqli_close($connection);

                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="message">Poznámka k rezervaci:</label>
                <textarea name="message" id="message" maxlength="255"></textarea>
            </div>
            <div>
                <button class="btn" type="submit">Odeslat</button>
            </div>
        </form>


    </div>

</section>
<section id="contact-info" class="bg-dark">
    <div class="box bg-dark">
        <i class="fas fa-hotel fa-3x"></i>
        <h3>Adresa a PSČ</h3>

        <p>Přerovecká 21, 747 95</p>
    </div>

    <div class="box bg-dark">
        <i class="fas fa-phone fa-3x"></i>
        <h3>Telefon</h3>
        <p> 734 763 998 </p>

    </div>

    <div class="box bg-dark">
        <i class="fas fa-envelope fa-3x"></i>
        <h3>Email</h3>
        <p>info@interbus.cz</p>

    </div>
</section>

<div class="clr"></div>
<footer id="main-footer" class="bg-dark">
    <p>Inter BUS &copy; 2024 <br> ZMP - Krejčí</p>
</footer>
</body>
</html>