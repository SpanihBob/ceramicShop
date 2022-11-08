<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД

    $_POST['tableName'] = trim($_POST['tableName']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['tableName'] = htmlspecialchars($_POST['tableName']);                    //Преобразует специальные символы в HTML-сущности

    $query = $dbPDO->query("SELECT * FROM $_POST[tableName]");
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));    //выводит всю таблицу
?>