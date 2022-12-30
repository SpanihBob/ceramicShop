<? 
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();                    //вкл. сессию
    // session_destroy();
    
if(@$_SERVER['REDIRECT_URL']=="" or $_SERVER['REDIRECT_URL']=="/main")://другой способ записи if else без скобок
    require_once "$path/public/main.php";    
elseif($_SERVER['REDIRECT_URL']=="/admin"):
    {
        if(isset($_SESSION['admin'])):require_once "$path/public/admin.php";
        else:require_once "$path/public/404.php";
        endif;
    };
elseif($_SERVER['REDIRECT_URL']=="/login"):require_once "$path/public/login.php";
elseif($_SERVER['REDIRECT_URL']=="/signup"):require_once "$path/public/signup.php";
elseif($_SERVER['REDIRECT_URL']=="/productFromTheCart"):require_once "$path/public/productFromTheCart.php";
elseif($_SERVER['REDIRECT_URL']=="/order"):require_once "$path/public/order.php";    
elseif($_SERVER['REDIRECT_URL']=="/debt"):require_once "$path/public/debt.php";
elseif($_SERVER['REDIRECT_URL']=="/cart"):require_once "$path/public/cart.php";    
elseif($_SERVER['REDIRECT_URL']=="/favorites"):require_once "$path/public/favorites.php";
elseif($_SERVER['REDIRECT_URL']=="/search"):require_once "$path/public/search.php";
elseif($_SERVER['REDIRECT_URL']=="/account"):require_once "$path/public/personalAccount.php";
elseif($_SERVER['REDIRECT_URL']=="/ordering"):require_once "$path/public/ordering.php";
elseif($_SERVER['REDIRECT_URL']=="/fullProduct"):require_once "$path/public/fullProduct.php";
elseif($_SERVER['REDIRECT_URL']=="/collections"):require_once "$path/public/collection.php";
elseif($_SERVER['REDIRECT_URL']=="/interior"):require_once "$path/public/interior.php";
elseif($_SERVER['REDIRECT_URL']=="/productsToOrder"):require_once "$path/public/productsToOrder.php";
elseif($_SERVER['REDIRECT_URL']=="/product"):require_once "$path/public/product.php";
elseif($_SERVER['REDIRECT_URL']=="/crockery"):require_once "$path/public/crockery.php";        
else:
    require_once "$path/public/404.php";
endif;                
?>
