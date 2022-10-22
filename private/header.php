
<?
// echo $_SESSION['login'];
if(isset($_POST['modalContextMenuExit'])) {
    $_SESSION['auth']=NULL;
    $_SESSION['login']=NULL;
    header("Location: ../index.php"); 
}
?>
<header>
    <div>
        <div class="logo" id="logo">
            <img src="../img/pottery.png" alt="">
            <img src="../img/Безымянный.jpg" alt="">
        </div>    
        <input type="search" name="searchProduct" id="searchProduct">    
        <div class="headerBtn">
            <!-- <a href="/account"></a> --><div id="guest"></div>
            <a href=""><div id="favorites"></div></a>
            <a href=""><div id="shopping_cart"></div></a>
        </div>
    </div>

    
         
</header>
<div id="modalWindow">
    <div id="modalContextMenu">
        <div id="modalContextMenuSignUp">Регистрация</div>
        <div id="modalContextMenuLogIn">Вход</div>
        <div id="modalContextMenuProfile">Профиль</div>
        <form action="" method="post" id="modalContextMenuExitForm">
            <input type="submit" value="Выход" name="modalContextMenuExit">
        </form>
    </div>
</div>
<script>
    // const modalContextMenu = document.getElementById('modalContextMenu')
    // const modalWindow = document.getElementById('modalWindow')
    logo.onclick = () => {
        window.location.href = "/";
    }
    window.onclick = (event) => {
        if(event.target.id == 'guest'){
            modalContextMenu.style.left = `${event.clientX - 170}px`;
            modalWindow.style.display = 'block';
        }
        else if((event.target.id == 'modalContextMenu') || (event.target.parentNode.id == 'modalContextMenu')){
            if(event.target.id == 'modalContextMenuProfile'){
                window.location.href = "/account";
            }
            console.log(12321);
        }
        else {
            modalWindow.style.display = 'none';
        }
    }
    
    
</script>
