<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php";
    session_start();

    $_POST['subcategoryId'] = trim($_POST['subcategoryId']);                                //Удаляет пробелы (или другие символы) из начала и конца строки
    $_POST['subcategoryId'] = htmlspecialchars($_POST['subcategoryId']);                    //Преобразует специальные символы в HTML-сущности

    $_POST['productCat'] = trim($_POST['productCat']);                                
    $_POST['productCat'] = htmlspecialchars($_POST['productCat']);                   
    

    $_SESSION['subcategoryId'] = $_POST['subcategoryId'];
    $_SESSION['productCat'] = $_POST['productCat'];
    
?>