<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    

    $query = $dbPDO->query("SELECT product_id FROM cart WHERE user_id = '$_SESSION[id]'");
    // print_r($query->fetch(PDO::FETCH_ASSOC));       //выводит одну строку таблицы
    // json_encode() - переводит массив или обьект в формат JSON тип данных строка
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу
    
?>