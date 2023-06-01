<?php
require 'template.php';
require 'db.php';
require 'ad_functions.php';
header_load();
echo "Hirdetések <br/>";
print_category_selector();
ad_check_filter();

footer_load();

?>