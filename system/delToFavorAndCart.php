<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    $name=$_POST['filePhp'];
    // echo $_POST['productCount'];
    //обновление колличества товара в корзине
    $dbPDO->query("DELETE FROM $name WHERE user_id='$_SESSION[id]' AND product_id='$_POST[productId]'");
    
?>