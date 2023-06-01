<?php
require 'template.php';
require 'user_functions.php';
logout();
header("Location: /hirdetesek/login.php");
exit();
?>