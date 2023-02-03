<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php";
    session_start();

    $query=$dbPDO->query("SELECT * FROM review INNER JOIN users ON review.user_id = users.id");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу 
?>