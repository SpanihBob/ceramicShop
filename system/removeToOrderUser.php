<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php";
    session_start();
    
    $query=$dbPDO->query("SELECT * FROM shopping INNER JOIN product ON shopping.product_id = product.id WHERE shopping.user_id = '$_SESSION[id]'");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу
    
?>