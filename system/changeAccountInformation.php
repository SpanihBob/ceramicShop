<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php";
    session_start();
    // echo "<pre>";
    // echo "SESSION <br>";
    // print_r($_SESSION);
    // echo "get: <br>";
    // print_r($_GET);

    // echo "_POST: <br>";
    // print_r($_POST);
    // echo "_FILES: <br>";
    // print_r($_FILES);
    // echo "</pre>";
   
    
    if(isset($_POST['personalAccountFormSubmit'])) {                //код изменяет данные пользователя в БД
    
        $_POST['changeEmail'] = trim($_POST['changeEmail']);                              
        $_POST['changeEmail'] = htmlspecialchars($_POST['changeEmail']);  

        $_POST['changeName'] = trim($_POST['changeName']);                              
        $_POST['changeName'] = htmlspecialchars($_POST['changeName']);                  
    
        $_POST['changeLastname'] = trim($_POST['changeLastname']);                              
        $_POST['changeLastname'] = htmlspecialchars($_POST['changeLastname']);

        $_POST['changeCountry'] = trim($_POST['changeCountry']);                              
        $_POST['changeCountry'] = htmlspecialchars($_POST['changeCountry']);                  
    
        $_POST['changeCity'] = trim($_POST['changeCity']);                              
        $_POST['changeCity'] = htmlspecialchars($_POST['changeCity']);

        $_POST['changeStreet'] = trim($_POST['changeStreet']);                              
        $_POST['changeStreet'] = htmlspecialchars($_POST['changeStreet']);                  
    
        $_POST['changeHouse'] = trim($_POST['changeHouse']);                              
        $_POST['changeHouse'] = htmlspecialchars($_POST['changeHouse']);

        $_POST['changeApartment'] = trim($_POST['changeApartment']);                              
        $_POST['changeApartment'] = htmlspecialchars($_POST['changeApartment']);

        $_POST['changePostcode'] = trim($_POST['changePostcode']);                              
        $_POST['changePostcode'] = htmlspecialchars($_POST['changePostcode']);

        $dbPDO->query("UPDATE `users` SET 
                        `email`='$_POST[changeEmail]', 
                        `user_name`='$_POST[changeName]', 
                        `lastname`='$_POST[changeLastname]',
                        `country`='$_POST[changeCountry]',
                        `city`='$_POST[changeCity]', 
                        `street`='$_POST[changeStreet]',
                        `house`='$_POST[changeHouse]', 
                        `apartment`='$_POST[changeApartment]',
                        `postcode`='$_POST[changePostcode]' 
                        WHERE `login`='$_SESSION[login]'");
    }
?>