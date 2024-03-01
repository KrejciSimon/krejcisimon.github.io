<?php
session_start();
if (!isset($_SESSION["vehicle"])) {
    header("Location: index.html");
    die();
}
$server_name = "localhost";
$username = "root";
$password = "";
$database = "zmp";
$connection = mysqli_connect($server_name, $username, $password, $database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "select * from vozidla where id = " . $_SESSION["vehicle"];
$result = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($result);
mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="icon" href="img/Datový%20zdroj%201.svg" type="image/svg+xml">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Děkujeme 🚌</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDd
    YTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous"
          referrerpolicy="no-referrer"/>
    <link rel="stylesheet"
          href="./css/style.css">
    <link rel="stylesheet" media="screen and (max-width: 768px" href="css/mobile.css">
    <meta name="description" content="Vítejte .....">
    <meta name="keywords" content="vesnice, opava, suché lazce, sedlinka, přerovecká,,,,,klíčová slova">
</head>
<body>
<div id="iss">
    <header>
        <nav id="navbar">
            <div class="container">
                <a href="index.html"> <img src="img/interbuswhite.png" alt="logo"> </a>
                <ul>
                    <li><a href="index.html">Úvod</a></li>
                    <li><a href="service.html"> Služby </a></li>
                    <li><a href="about.html"> O nás </a></li>
                    <li><a href="park.html"> Vozový park </a></li>
                    <li><a href="contact.php"> Kontakt </a></li>
                </ul>
            </div>
        </nav>
    </header>
    <h1>Děkujeme za vaši rezervaci</h1>
    <h2>Naši pracovníci ji zkontrolují a ozvou se vám zpět.</h2>
    <section>
        <div class="car car-wrap bg-color1">
            <div class="text">
                <h2><span class="iss-color">Jméno</span></h2>
                <ul>
                    <li><?php
                        echo $_SESSION["name"];
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section>
        <div class="car car-wrap bg-color2">
            <div class="text">
                <h2><span class="iss-color">Email</span></h2>
                <ul>
                    <li><?php
                        echo $_SESSION["email"];
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section>
        <div class="car car-wrap bg-color1">
            <div class="text">
                <h2><span class="iss-color">Adresa</span> odjezdu</h2>
                <ul>
                    <li><?php
                        echo $_SESSION["departure"];
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section>
        <div class="car car-wrap bg-color2">
            <div class="text">
                <h2><span class="iss-color">Adresa</span> příjezdu</h2>
                <ul>
                    <li><?php
                        echo $_SESSION["arrival"];
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section>
        <div class="car car-wrap bg-color1">
            <div class="text">
                <h2><span class="iss-color">Datum</span></h2>
                <ul>
                    <li><?php
                        echo $_SESSION["date"];
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section>
        <div class="car car-wrap bg-color2">
            <div class="text">
                <h2><span class="iss-color">Vaše</span> vozidlo</h2>
                <ul>
                    <li><?php
                        echo $result["nazev"];
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section>
        <div class="car car-wrap bg-color1">
            <div class="text">
                <h2><span class="iss-color">Poznámka</span> k rezervaci</h2>
                <ul>
                    <li><?php
                        echo $_SESSION["message"];
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </section>

</div>

<div class="clr"></div>
<footer id="main-footer" class="bg-dark">
    <p>Inter BUS &copy; 2024 <br> ZMP - Krejčí</p>
</footer>
</body>
</html>
<?php
session_destroy();
?>
