<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php";
    session_start();
    
    $_POST['searchEmail'] = trim($_POST['searchEmail']);                              
    $_POST['searchEmail'] = htmlspecialchars($_POST['searchEmail']);                  

    $_POST['searchLogin'] = trim($_POST['searchLogin']);                              
    $_POST['searchLogin'] = htmlspecialchars($_POST['searchLogin']);                  

    $_POST['searchPassword'] = trim($_POST['searchPassword']);                              
    $_POST['searchPassword'] = htmlspecialchars($_POST['searchPassword']);

    $_POST['searchPassword2'] = trim($_POST['searchPassword2']);                              
    $_POST['searchPassword2'] = htmlspecialchars($_POST['searchPassword2']);
    
    
    $regesEmail = "/\b[A-Za-zА-ЯЁа-яё]+@[A-Za-zА-ЯЁа-яё]+\.[A-Za-zА-ЯЁа-яё]+\b/ui";
    $regesLogin = "/[^#<>*+=;]/ui";

    $time=time();

    
    if($_POST['searchLogin']=="") {
        $errors[]="введите login";
    }
    if($_POST['searchPassword']=="") {
        $errors[]="введите пароль";
    }
    if($_POST['searchPassword']!==$_POST['searchPassword']) {
        $errors[]="пароли не совпадают";
    } 
    

    $_POST['searchPassword']=password_hash($_POST['searchPassword'],PASSWORD_DEFAULT); //хэшируем(шифруем) пароль 
    
    if (
            preg_match($regesEmail, $_POST['searchEmail'])
            && preg_match($regesLogin, $_POST['searchLogin']) ) {
    $dbPDO->query("INSERT INTO `users`( 
                            `email`,
                            `login`, 
                            `password`, 
                            `time_signup`
                            ) 
    VALUES ('$_POST[searchEmail]',
            '$_POST[searchLogin]', 
            '$_POST[searchPassword]',
            '$time'
            )");
    $_SESSION['signup']=true;
    }        
    echo "<span style='color:green'>Все в порядке!</span>";
?>

