<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    
    $time = time();
    print_r($_POST);

    $_POST['productId'] = trim($_POST['productId']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['productId'] = htmlspecialchars($_POST['productId']);                    //Преобразует специальные символы в HTML-сущности
    $_POST['productCount'] = trim($_POST['productCount']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['productCount'] = htmlspecialchars($_POST['productCount']);                    //Преобразует специальные символы в HTML-сущности
    //добавление товара в корзину
        
    $dbPDO->query("INSERT INTO cart(`count`,`product_id`,`user_id`,`add_time`) VALUES ('$_POST[productCount]','$_POST[productId]','$_SESSION[id]','$time')");
           

?>