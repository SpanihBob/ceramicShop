<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    
    print_r($_POST);

    $_POST['productId'] = trim($_POST['productId']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['productId'] = htmlspecialchars($_POST['productId']);                    //Преобразует специальные символы в HTML-сущности
    
    //добавление товара в корзину
        
    $dbPDO->query("INSERT INTO favor(`product_id`,`user_id`) VALUES ('$_POST[productId]','$_SESSION[id]')");
           

?>