<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php";
    session_start();

    $_POST['subcategoryId'] = trim($_POST['subcategoryId']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['subcategoryId'] = htmlspecialchars($_POST['subcategoryId']);                    //Преобразует специальные символы в HTML-сущности
    $_POST['table'] = trim($_POST['table']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['table'] = htmlspecialchars($_POST['table']);                    //Преобразует специальные символы в HTML-сущности

    $_SESSION['transferredData'] = [$_POST['subcategoryId'],$_POST['table']];
    // print_r($_SESSION['transferredData']); 
    
?>