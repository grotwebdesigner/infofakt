<?php
require 'db.php';


function check_user_pass($email, $password, $conn){
    $user = '';
    $hash = hash('sha256', $password);
    $sql = "SELECT * FROM users WHERE email='" . $email . 
    "' AND password='" . $hash . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $user = array($row["id"], $row["firstname"], $row["lastname"]);
        }
    } 
    else {
        return FALSE;
    }
    $conn->close();
    return $user[0];
}

function get_user_info($id){
    $conn = db_init();
    $user = '';
    $sql = "SELECT * FROM users WHERE id='" . $id . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $user = array($row["id"], $row["firstname"], $row["lastname"], $row["email"]);
        }
    } 
    else {
        die('db error');
    }
    $conn->close();
    return $user;
}

function check_login(){
    if (isset($_POST["email"]) && isset($_POST["password"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $conn = db_init();
        $succ = check_user_pass($email, $password, $conn);
        if ($succ != FALSE){
            //success
            setcookie("current_user", $succ, 0, "/");
            header("Location: /hirdetesek/login.php");
            exit();
        }
        else{
            //fail
            echo '<p class="error">Invalid email or password!</p>';
        }
    }
}

function isLoggedIn(){
    if (isset($_COOKIE["current_user"])){
        return TRUE;
    }
    else{
        return FALSE;
    }
}

function login_form(){
    echo '<form id="loginmenu" action="login.php" method="post">
    <label> E-mail </label>
    <input type="email" name="email" />
    <label> Jelszó </label>
    <input type="password" name="password" />
    <input type="submit" value="Belépés" />
    <a href="register.php">Regisztrálj új fiókot! </a>
</form>';
}

function profile_form(){
    $user_data = get_user_info($_COOKIE["current_user"]);
    echo '<form id="loginmenu" action="profile.php" method="post">
    <label> E-mail </label>
    <input type="email" name="email" value="'.$user_data[3].'" />
    <label> Vezetéknév </label>
    <input type="text" name="firstname" value="'.$user_data[1].'" />
    <label> Keresztnév </label>
    <input type="text" name="lastname" value="'.$user_data[2].'" />
    <input type="submit" value="Profil módosítása" />
</form>';
}

function check_user_mod(){
    if (isset($_POST["email"]) && isset($_POST["firstname"]) && isset($_POST["lastname"])){
        $conn = db_init();
        $id = $_COOKIE["current_user"];
        $email = $_POST["email"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $sql = "UPDATE users SET lastname = '".$lastname."', firstname = '".$firstname."', email = '".$email."' 
        WHERE id = '".$id."'";
    if ($conn->query($sql) === TRUE){
        header("Location: /hirdetesek/login.php");
        exit();
    } 
    else {
        die('db error');
    }
    $conn->close();
    }
}

function check_register(){
    if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password2"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];

        if ($password != $password2){
            echo '<p class="error">Password not match!</p>';
        }

        else{
            $conn = db_init();
            $hash = hash('sha256', $password);
            $guid = getGUID();
            $sql = "INSERT INTO users (id, email, password, firstname, lastname)
            VALUES ('" . $guid ."', '".$email."', '".$hash."', '".$firstname."', '".$lastname."')";

            if ($conn->query($sql) === TRUE){
                setcookie("current_user", $guid, time() + (86400 * 30), "/");
            } 
            else {
                die('db error');
            }
            $conn->close();
        }
        
        header("Location: /hirdetesek/login.php");
        exit();
    }
     
}

function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = ''
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
            
        return $uuid;
    }
}

function logout(){
    setcookie("current_user", "", time() - 100, "/");
}
?>