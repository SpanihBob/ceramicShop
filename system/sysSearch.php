<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    echo $_GET['searchProduct'];
    $_GET['searchProduct'] = trim($_GET['searchProduct']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_GET['searchProduct'] = htmlspecialchars($_GET['searchProduct']);                    //Преобразует специальные символы в HTML-сущности

    // $queryProduct = $dbPDO -> query("SELECT * FROM product WHERE name LIKE '$_GET[searchProduct]%' ORDER BY name ASC");    
    // echo json_encode($queryProduct->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу
    
?>