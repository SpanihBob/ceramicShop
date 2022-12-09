<?
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php"; //подкл. к БД
    session_start();

    $_POST['name'] = trim($_POST['name']);                              
    $_POST['name'] = htmlspecialchars($_POST['name']); 

    $_POST['last_name'] = trim($_POST['last_name']);                              
    $_POST['last_name'] = htmlspecialchars($_POST['last_name']); 

    $_POST['email'] = trim($_POST['email']);                              
    $_POST['email'] = htmlspecialchars($_POST['email']); 

    $_POST['country'] = trim($_POST['country']);                              
    $_POST['country'] = htmlspecialchars($_POST['country']);

    $_POST['city'] = trim($_POST['city']);                              
    $_POST['city'] = htmlspecialchars($_POST['city']); 

    $_POST['street'] = trim($_POST['street']);                              
    $_POST['street'] = htmlspecialchars($_POST['street']);

    $_POST['house'] = trim($_POST['house']);                              
    $_POST['house'] = htmlspecialchars($_POST['house']); 

    $_POST['apartment'] = trim($_POST['apartment']);                              
    $_POST['apartment'] = htmlspecialchars($_POST['apartment']); 

    $_POST['postcode'] = trim($_POST['postcode']);                              
    $_POST['postcode'] = htmlspecialchars($_POST['postcode']);

    $_POST['purchase_details'] = trim($_POST['purchase_details']);                              
    $_POST['purchase_details'] = htmlspecialchars($_POST['purchase_details']);

    $time = time();
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    $buyer_data = explode("; ", $_POST['purchase_details']);

    foreach ($buyer_data as $value) {
        $buyer_data_value = explode(",", $value);
        echo " ";
        echo "2:$buyer_data_value[1] ";
        echo "3:$buyer_data_value[2] ";
    
    $query = $dbPDO->query("INSERT INTO shopping (
        user_id,
        product_id,
        add_time,
        product_count,
        product_price,
        buyer_name,
        buyer_last_name,
        buyer_email,
        buyer_country,
        buyer_city,
        buyer_street,
        buyer_house,
        buyer_apartment,
        buyer_postcode
    )
    VALUES (
        '$_SESSION[id]',
        '$buyer_data_value[0]',
        '$time',
        '$buyer_data_value[1]',
        '$buyer_data_value[2]',
        '$_POST[name]',
        '$_POST[last_name]',
        '$_POST[email]',
        '$_POST[country]',
        '$_POST[city]',
        '$_POST[street]',
        '$_POST[house]',
        '$_POST[apartment]',
        '$_POST[postcode]'
    )");

    $dbPDO->query("DELETE FROM cart WHERE user_id='$_SESSION[id]' AND product_id='$buyer_data_value[0]'");
}
?>