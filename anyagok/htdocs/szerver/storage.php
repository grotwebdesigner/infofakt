<?php
require 'functions.php';

$tomb = array(10,20,30);
array_push($tomb, 40);
array_delete($tomb, 30);
array_traverse($tomb);

?>