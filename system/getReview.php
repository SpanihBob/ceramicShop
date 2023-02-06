<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php";
    session_start();

    $query=$dbPDO->query("SELECT * FROM review INNER JOIN users ON review.user_id = users.id ORDER BY add_time ASC");
    // SELECT * FROM review INNER JOIN users ON review.user_id = users.id INNER JOIN shopping ON shopping.user_id = review.user_id WHERE shopping.product_id = 9 //для отзыва на товар

    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу 
?>