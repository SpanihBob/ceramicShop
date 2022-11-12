<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    
        $queryProduct = $dbPDO -> query("SELECT * FROM product WHERE name LIKE '$_SESSION[searchProduct]%' ORDER BY name ASC");    
        echo json_encode($queryProduct->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу
?>