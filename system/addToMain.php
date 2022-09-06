<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    

    $query = $dbPDO->query("SELECT * FROM main");
    // print_r($query->fetch(PDO::FETCH_ASSOC));       //выводит одну строку таблицы
    // json_encode() - переводит массив или обьект в формат JSON тип данных строка
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу
    
?>