<?php
require 'template.php';
require 'user_functions.php';
header_load();
if (isLoggedIn() == FALSE){
    header("Location: /hirdetesek/login.php");
    exit();
}
check_user_mod();
profile_form();


footer_load();

?>