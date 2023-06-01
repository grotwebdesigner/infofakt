<?php
    require 'functions.php';

    if (isset($_POST["magassag"])){
        save_to_db($_POST["magassag"]);
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
    <form method="post" action="duna_db.php">
        <label>Új vízállás felvitele</label>
        <input type="number" name="magassag" />
        <input type="submit" value="Rögzítés" />
    </form>
</body>
</html>


<?php
    traverse_from_db();
    average_water_db();
    top_water_db();
    low_water_db();
?>