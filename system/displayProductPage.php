<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    
    //вывод продукта
    $query = $dbPDO->query("SELECT * FROM `product` WHERE subcategory = '$_SESSION[subcategoryId]' AND `category` = '$_SESSION[productCat]'");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу
?>