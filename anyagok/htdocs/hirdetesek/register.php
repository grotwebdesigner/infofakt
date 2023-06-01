<?php
require 'template.php';
require 'user_functions.php';
check_register();
header_load();

?>
<form id="loginmenu" action="register.php" method="post">
    <label> E-mail </label>
    <input type="email" name="email" />
    <label> Jelszó </label>
    <input type="password" name="password" />
    <label> Jelszó ismét </label>
    <input type="password" name="password2" />
    <label> Vezetéknév </label>
    <input type="text" name="firstname" />
    <label> Keresztnév </label>
    <input type="text" name="lastname" />
    <input type="submit" value="Regisztráció" />
    
</form>
<?php
footer_load();

?>