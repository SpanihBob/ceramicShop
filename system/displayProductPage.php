<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    
    //вывод продукта
    $table = $_SESSION['transferredData'][1];
    $subcategory = $_SESSION['transferredData'][0];
    $query = $dbPDO->query("SELECT * FROM `$table` WHERE subcategory = '$subcategory'");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу
    // print_r($_SESSION['transferredData'])
?>