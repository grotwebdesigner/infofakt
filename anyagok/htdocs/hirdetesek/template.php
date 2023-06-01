<?php
function header_load(){
    $login_text = "Bejelentkezés";
    $login_route = "login.php";
    if (isset($_COOKIE["current_user"])){
        $login_text = "Kijelentkezés";
        $login_route = "logout.php";
    }


    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Apróhirdetések</title>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <div id="header">
            <div id="navbar">
                <a href="ads.php">Hirdetések</a>';
                
                if (isset($_COOKIE["current_user"])){
                    echo '<a href="ads_add.php">Hirdetés feladása</a>';
                    echo '<a href="profile.php">Profilom</a>';
                }

                echo '<a href="' . $login_route .'">' . $login_text . '</a>
            </div>
        </div>
    
        <div id="content">
        ';
}

function footer_load(){
    echo '
    </div>

    <div id="footer">
        Copyright Kovács András 2022
    </div>
</body>
</html>';
}
?>