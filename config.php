<?php
//Tilda Källström 2021
//Ladda in klasser
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.class.php';
});

define("DBHOST", "x");
define("DBUSER", "x");
define("DBPASS", "x");
define("DBDATABASE", "x");

