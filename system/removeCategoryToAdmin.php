<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php";
    
    $query=$dbPDO->query("SELECT * FROM `category`");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу
    
?>