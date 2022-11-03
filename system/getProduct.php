<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php";
    session_start();

    $_POST['productId'] = trim($_POST['productId']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['productId'] = htmlspecialchars($_POST['productId']);                    //Преобразует специальные символы в HTML-сущности
    $_POST['catId'] = trim($_POST['catId']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['catId'] = htmlspecialchars($_POST['catId']);                    //Преобразует специальные символы в HTML-сущности

    $query=$dbPDO->query("SELECT * FROM product WHERE subcategory = '$_POST[productId]' AND category =  '$_POST[catId]'");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу 
    
?>