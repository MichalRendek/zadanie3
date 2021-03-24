<?php
    $hostname = "localhost";
    $username = "xrendekm";
    $password = "heslo123";
    $dbname = "zadanie3";

    $db = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    date_default_timezone_set("Europe/Bratislava");