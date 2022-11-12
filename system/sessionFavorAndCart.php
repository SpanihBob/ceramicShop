<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    
    $_POST['productIdCartAndFavor'] = trim($_POST['productIdCartAndFavor']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
	$_POST['productIdCartAndFavor'] = htmlspecialchars($_POST['productIdCartAndFavor']);                    //Преобразует специальные символы в HTML-сущности
	$_SESSION['fullProductId'] = $_POST['productIdCartAndFavor'];
?>