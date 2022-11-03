<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    $_POST['productId'] = trim($_POST['productId']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['productId'] = htmlspecialchars($_POST['productId']);                    //Преобразует специальные символы в HTML-сущности
    $_POST['productCount'] = trim($_POST['productCount']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['productCount'] = htmlspecialchars($_POST['productCount']);                    //Преобразует специальные символы в HTML-сущности
    //обновление колличества товара в корзине
    $dbPDO->query("UPDATE cart SET count = '$_POST[productCount]' WHERE user_id='$_SESSION[id]' AND product_id='$_POST[productId]'");
?>