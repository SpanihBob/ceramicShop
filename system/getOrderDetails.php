<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();

    $query = $dbPDO->query("SELECT * FROM cart INNER JOIN product ON cart.product_id = product.id WHERE cart.user_id = $_SESSION[id] AND cart.product_id IN ($_SESSION[checkboxArray_to_string])");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу
?>