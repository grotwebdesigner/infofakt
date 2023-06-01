<?php

$nev = $_GET['nev'];
$eletkor = $_GET['eletkor'];

$szin = 'yellow';
if ($eletkor > 50){
    $szin = 'orange';
}

echo '<body style="background-color: ' . $szin .
 ' "></body>';

 echo '<h1>Welcome, ' . $nev . '!</h1>';

 $i = 0;
 while($i < $eletkor){
     echo '<img src="candle.webp" />' ;
     $i = $i + 1;
 }

 

?>