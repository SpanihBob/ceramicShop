<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php";
    session_start();

    $query=$dbPDO->query("SELECT * FROM `users` WHERE `login` = '$_SESSION[login]'");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу 
?>