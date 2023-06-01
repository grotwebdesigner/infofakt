<?php
    if (isset($_POST["a_old"]) 
        && isset($_POST["b_old"])
        && is_numeric($_POST["a_old"])
        && is_numeric($_POST["b_old"])
    ){
        $a = $_POST["a_old"];
        $b = $_POST["b_old"];
        echo "A: " . $a;
        echo "<br/>";
        echo "B: " . $b;
        echo "<br/>";
        $c = $a * $b;
        echo "Téglalap területe: " . $c;
    }
    else{
        echo "Hiba! Mindkét adat megadása kötelező!";
    }
?>
<br/>
<a href="index.php">Vissza a főoldalra!</a>