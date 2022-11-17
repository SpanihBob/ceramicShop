<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();

    $_POST['id'] = trim($_POST['id']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['id'] = htmlspecialchars($_POST['id']); 

    $_POST['tableName'] = trim($_POST['tableName']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['tableName'] = htmlspecialchars($_POST['tableName']); 

    $dbPDO->query("DELETE FROM $_POST[tableName] WHERE id='$_POST[id]'");
    
?>