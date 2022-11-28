<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php";
    
    $query=$dbPDO->query("SELECT * FROM `product` INNER JOIN category ON product.category = category.id");
    echo "<pre>";
    foreach ($query as $value) {
        print_r($value);
    }
    echo "</pre>";
    // echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу
    
?>