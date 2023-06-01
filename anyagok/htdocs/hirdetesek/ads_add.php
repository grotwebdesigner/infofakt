<?php
require 'template.php';
require 'user_functions.php';
require 'ad_functions.php';
header_load();
if (isLoggedIn() == FALSE){
    header("Location: /hirdetesek/login.php");
    exit();
}
check_item_post();
?>

<form id="loginmenu" action="ads_add.php" method="post">
    <label> Termék neve </label>
    <input type="text" name="name" />
    <label> Termék leírása</label>
    <input type="text" name="description" />
    <label> Kategória </label>
    <input type="text" name="category" />
    <label> Ár </label>
    <input type="number" name="price" />
    <input type="submit" value="Meghirdetés" />
</form>

<?php

footer_load();

?>