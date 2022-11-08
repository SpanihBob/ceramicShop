<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    
    $time = time();
    print_r($_POST);

    $_POST['productId'] = trim($_POST['productId']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['productId'] = htmlspecialchars($_POST['productId']);                    //Преобразует специальные символы в HTML-сущности

    $_POST['cartOrFavor'] = trim($_POST['cartOrFavor']);                               
    $_POST['cartOrFavor'] = htmlspecialchars($_POST['cartOrFavor']); 

    //добавление товара в корзину        
    if($_POST['cartOrFavor']=='cart'){
        $dbPDO->query("INSERT INTO cart(`count`,`product_id`,`user_id`,`add_time`) VALUES (1,'$_POST[productId]','$_SESSION[id]','$time')");
    }
    //добавление товара в избранное 
    elseif($_POST['cartOrFavor']=='favor'){
        $dbPDO->query("INSERT INTO favor(`product_id`,`user_id`) VALUES ('$_POST[productId]','$_SESSION[id]')");
    }
    
           
      

?>