<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    echo $_POST['checkboxArray_to_string'];

    $query = $dbPDO->query("SELECT id FROM cart WHERE user_id = $_SESSION[id] AND product_id IN ($_POST[checkboxArray_to_string])");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу
    // if(json_encode($query->fetchAll(PDO::FETCH_ASSOC))!=[]){
    //     echo "ok";
    // }
?>