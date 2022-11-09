<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php";
    session_start();
    // session_destroy();

    $_POST['fullProduct'] = trim($_POST['fullProduct']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['fullProduct'] = htmlspecialchars($_POST['fullProduct']);                    //Преобразует специальные символы в HTML-сущности
    

    $_SESSION['fullProductId'] = $_POST['fullProduct'];
    print_r($_SESSION['fullProduct']); 
    
?>