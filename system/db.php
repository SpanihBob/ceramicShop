<?
    $dbHost = "localhost";
    $dbName = "diploma";
    $dbUsername = "root";
    $dbPassword = "";
    $dbPDO = new PDO("mysql:dbhost=$dbHost;dbname=$dbName",$dbUsername,$dbPassword,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");        // -означат что данные в БД будут сохраняться в utf8, т.е будет поддерживаться кириллица

    // $db=new mysqli("localhost", "root","","web113library");

    // $query=$dbPDO->query("SELECT * FROM `users`");
    // print_r($query->fetch(PDO::FETCH_ASSOC));
?>