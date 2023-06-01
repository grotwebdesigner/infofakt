<?php
    require 'functions.php';
    $vizallasok = array();

    if (isset($_COOKIE["vizallasok"])){
        $vizallasok = json_decode($_COOKIE["vizallasok"]);
    }

    if (isset($_POST["magassag"])){
        array_push($vizallasok, $_POST["magassag"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="duna.css" />
    <title>Duna statisztika</title>
</head>
<body>
    <h1>Vízállás rögzítő alkalmazás</h1>
    <form method="post" action="duna.php">
        <label>Új vízállás felvitele</label>
        <input type="number" name="magassag" />
        <input type="submit" value="Rögzítés" />
    </form>
</body>
</html>


<?php
    array_traverse_with_days($vizallasok);
    average_water($vizallasok);
    top_water($vizallasok);
    low_water($vizallasok);
    setcookie("vizallasok", json_encode($vizallasok), time() + (86400 * 30), "/");
?>