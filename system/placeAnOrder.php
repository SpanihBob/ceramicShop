<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();
    // echo $_POST['checkboxArray_to_string'];
    $_SESSION['checkboxArray_to_string'] = $_POST['checkboxArray_to_string'];
?>