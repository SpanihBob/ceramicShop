<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    echo $_POST['checkboxArray_to_string'];
    $checkboxArray = explode(", ", $_POST['checkboxArray_to_string']);

    $time = time(); 
    $query = $dbPDO->query("SELECT * FROM cart WHERE user_id = $_SESSION[id] AND product_id IN ($_POST[checkboxArray_to_string])");

    $bdArray = [];                                              //массив из значений которые есть в корзине
    foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $value) {
        array_push($bdArray, $value['product_id']);
    };

    foreach ($checkboxArray as $value) {
        if (in_array($value, $bdArray)==false) {
            $query2 = $dbPDO->query("INSERT INTO cart (product_id, user_id, count, add_time) VALUES ('$value', '$_SESSION[id]', 1, '$time')");
        }
    }
?>