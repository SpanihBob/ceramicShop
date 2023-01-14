<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();   

    $_POST['id'] = trim($_POST['id']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['id'] = htmlspecialchars($_POST['id']); 
    
    //...................................... Удаление данных категории из базы данных
    $dbPDO->query("DELETE FROM product WHERE id='$_POST[id]'");
    
?>