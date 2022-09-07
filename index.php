<? 
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();                    //вкл. сессию
    // session_destroy();


    // .........    вспомним суперглобальные константы      ............  //
    // echo "<pre>";
    // echo print_r($_SERVER, true);    //true - означает что мы можем сохранить {print_r($_SERVER, true);} как переменную
    // print_r($_SERVER);
    // echo "</pre>";
    //[REQUEST_URI] = url + get
    //[REDIRECT_URL] = url  его и будем использовать

    // если "/" или "/main" то переадресовываем на /public/main.php
    


    // !!!!!!!!!!!!!!!!!     другой способ записи переменных  !!!!!!!!!!!!!!!!! //

    // $arr=[1,2,"jjjd", [1,"cnsj"]];
    // echo "$arr[3][1]";  //здесь вторая скобкане прочитается
    // $arr1=["name"=>"bobik"];
    // echo "$arr1[name]";  //здесь будут проблемы с ковычками
    // echo "{$arr[3][1]}";//современный способ - переменные пишутся в {} - можно писать переменную как она есть
 
    
    if(@$_SERVER['REDIRECT_URL']=="" or $_SERVER['REDIRECT_URL']=="/main")://другой способ записи if else без скобок
        require_once "$path/public/main.php";

    elseif($_SERVER['REDIRECT_URL']=="/login"):
        require_once "$path/public/login.php";
    
    elseif($_SERVER['REDIRECT_URL']=="/signup"):
        require_once "$path/public/signup.php";
    
    elseif($_SERVER['REDIRECT_URL']=="/profile"):
        require_once "$path/public/profile.php";

    elseif($_SERVER['REDIRECT_URL']=="/signup"):
        require_once "$path/public/signup.php";
    
    elseif($_SERVER['REDIRECT_URL']=="/debt"):
        require_once "$path/public/debt.php";

    elseif($_SERVER['REDIRECT_URL']=="/crockery"):
        require_once "$path/public/crockery.php";

    elseif($_SERVER['REDIRECT_URL']=="/favorites"):
        require_once "$path/public/favorites.php";
            
    else:
        require_once "$path/public/404.php";
    endif;                
?>
