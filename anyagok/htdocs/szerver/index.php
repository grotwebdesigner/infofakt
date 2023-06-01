<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Téglalap területe</title>
    <style>
        label, input {
            display: block;
            margin: 10px 0px;
            padding: 10px;
            width: 95%;
        }
        label{
            font-size: 1.2em;
        }
        .succ{
            color: green;
        }
        .fail{
            color: red;
        }
    </style>
</head>
<body>
    <h1>Belépés a titkos rendszerbe!</h1>
    <form method="POST" action="index.php">
        <label>Felhasználónév</label>
        <input type="text" name="username" required />
        <label>Jelszó</label>
        <input type="password" name="password" required />
        <input type="submit" value="Belépés" />
    </form>

    <?php
        $correct_username = "John";
        $correct_password = "almafa";

        if ( isset($_POST["username"]) && 
             isset($_POST["password"]) &&
            $_POST["username"] == $correct_username &&
            $_POST["password"] == $correct_password){
            echo '<h3 class="succ">Sikeres belépés! A kód: XYZ543</h3>';
        }
        else if (isset($_POST["username"]) && 
                 isset($_POST["password"])){
            echo '<h3 class="fail">Belépés megtagadva!</h3>';
        }
    ?>

</body>
</html>