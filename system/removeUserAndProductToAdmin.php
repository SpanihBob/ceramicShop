<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php";
    
    $_POST['userId'] = trim($_POST['userId']);                                
    $_POST['userId'] = htmlspecialchars($_POST['userId']);

    // $query=$dbPDO->query("SELECT * FROM users join shopping ON users.id = shopping.user_id join product ON shopping.product_id = product.id WHERE user_id = '$_POST[userId]'");
    
    $query=$dbPDO->query("SELECT * FROM shopping INNER JOIN product ON shopping.product_id = product.id WHERE user_id = '$_POST[userId]'");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу
    
?>