<?php

function array_delete(&$array, $item){
    $array = array_values(
        array_filter($array, function($actual) use(&$item){
            return $actual != $item;
        })
    );
}

function array_traverse($array){
    for($i = 0; $i < count($array); $i++){
        echo $array[$i];
        echo "<br/>";
    }
}

function array_traverse_with_days($array){
    echo "<table><tr><th>Nap sorszáma</th><th>Vízállás magassága</th></tr>";
    for($i = 0; $i < count($array); $i++){
        echo "<tr>";
        echo "<td>" . ($i+1) . ". nap</td>";
        echo "<td>" . $array[$i]. " mm</td>";
        echo "</tr>";
    }
    echo "</table>";
}

function average_water($array){
    if (count($array) > 0){
        $sum = 0;
        for($i = 0; $i < count($array); $i++){
            $sum += $array[$i];
        }
        $average = $sum / count($array);
        echo "<p> Átlagos vízállás: " . $average . " mm </p>"; 
    }
}

function average_water_db(){
    $conn = db_init();
    $avg = 0;
    $sql = "SELECT AVG(allas) FROM vizallasok";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $avg = $row["AVG(allas)"];
    } 
    else {
        
    }
    $conn->close();

    echo "<p> Átlagos vízállás: " . $avg . " mm </p>"; 
}

function top_water($array){
    $max = 0;
    for($i = 1; $i < count($array); $i++){
        if ($array[$i] > $array[$max]){
            $max = $i;
        }
    }
    echo "<p> Legmagasabb vízállás: " . ($max + 1) . ".napon </p>"; 
}

function top_water_db(){
    $conn = db_init();
    $day = 0;
    $sql = "SELECT nap FROM vizallasok
    ORDER BY allas DESC
    LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $day = $row["nap"];
    } 
    else {
        
    }
    $conn->close();

    echo "<p> Legmagasabb vízállás: " . $day . ".napon </p>"; 
}

function low_water_db(){
    $conn = db_init();
    $day = 0;
    $sql = "SELECT nap FROM vizallasok
    ORDER BY allas ASC
    LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $day = $row["nap"];
    } 
    else {
        
    }
    $conn->close();

    echo "<p> Legalacsonyabb vízállás: " . $day . ".napon </p>"; 
}

function low_water($array){
    $min = 0;
    for($i = 1; $i < count($array); $i++){
        if ($array[$i] < $array[$min]){
            $min = $i;
        }
    }
    echo "<p> Legalacsonyabb vízállás: " . ($min + 1) . ".napon </p>"; 
}

function save_to_db($item){
    $conn = db_init();

    $sql = "INSERT INTO vizallasok (allas)
            VALUES (" . $item . ")";

    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function load_from_db(){
    $vizallasok = array();
    $conn = db_init();

    $sql = "SELECT * FROM vizallasok";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($vizallasok, $row["allas"]);
        }
    } 
    else {
        
    }
    $conn->close();

    return $vizallasok;
}

function traverse_from_db(){
    $conn = db_init();

    $sql = "SELECT * FROM vizallasok";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>Nap sorszáma</th><th>Vízállás magassága</th></tr>";
        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo '<td>' . $row["nap"] . '. nap</td>';
            echo '<td>' . $row["allas"] . ' mm</td>';
            echo "</tr>";
        }
        echo "</table>";
    } 
    else {
        
    }
    $conn->close();
}

function db_init(){
    $servername = "localhost";
    $username = "infofakt_user";
    $password = "Almafa123!!!";
    $dbname = "infofakt_vizallasok";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}

?>