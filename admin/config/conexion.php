<?php
    setlocale(LC_TIME,"spanish");
    date_default_timezone_set("America/Bogota");
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "greicy";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }






