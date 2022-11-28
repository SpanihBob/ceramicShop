<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    $string = $_POST['id'];
    $arr = explode(", ", $string);
    foreach ($arr as $value) {
       //обновление колличества товара в корзине
    $dbPDO->query("DELETE FROM $_POST[tableName] WHERE user_id='$_SESSION[id]' AND product_id='$value'");
    }
    
    
?>