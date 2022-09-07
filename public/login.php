<?
if( isset( $_POST['loginSend'] )) {

     $_POST['login'] = trim($_POST['login']);                              
     $_POST['login'] = htmlspecialchars($_POST['login']);                  
 
     $_POST['password'] = trim($_POST['password']);                              
     $_POST['password'] = htmlspecialchars($_POST['password']);

     $searchLogin = $dbPDO -> query("SELECT * FROM `users` WHERE `login`='$_POST[login]'");

     if( $searchLogin -> rowCount() > 0 ) {
         $seLogin = $searchLogin -> fetch(PDO::FETCH_ASSOC);
         if( password_verify( $_POST['password'], $seLogin['password'] )) {
             $_SESSION['auth']=true;
             $_SESSION['login'] = $_POST['login'];
             $_SESSION['id'] = $seLogin['id'];
             $_SESSION['avatar'] = "$path/download/$seLogin[avatar]";

             header("Location: /main");//производим переход на страницу
         }
         else {
             $_SESSION['loginError']='error';
         }
     }
     else {
         echo "неверное имя пользователя или пароль2";
     }
 }
 include_once "$path/private/head.php";  //                          #########   head  #########        
?>


<body>
	<div class="container">			
		<?
			include_once "$path/private/header.php";		    //HEADER
		?>	

		<article class="article">						        <!-- ARTICLE -->
			<?
				include_once "$path/private/sidebar.php";		//SIDEBAR
			?>
			<div id="signupContent">								            <!-- CONTENT -->
				<form action="" method="post" id="formLogin">
                    <input type="text" name="login" id="login" placeholder="Введите логин">
                    <div class="passwordDiv">
                        <input type="password" name="password" id="password" placeholder="Введите пароль">
                        <div class="eyeBtn"><img src="../img/closed-eye.png" id="img1" alt=""></div>
                    </div>
                    <input type="submit" name="loginSend" value="Вход">
                    <a href="/signup">Или регистрация</a>
                    <div class="capsLock" id="example">
                        <?
                            if(isset($_SESSION['signup'])) {
                                echo "<span style='color:green'> Регистрация успешная </span>";
                                $_SESSION['signup']=NULL;
                            }
                            if(isset($_SESSION['loginError'])) {
                                echo "<span style='color:red'> Неверное имя пользователя или пароль </span>";
                                $_SESSION['loginError']=NULL;
                            }
                        ?>
                    </div>
                </form>
			</div>

            <script>
                let eyeOpen = 0;    //src="../img/closed-eye.png"
                formLogin.onclick = event => {                                 //при клике на глаз мы видем введенный пароль
                    if(event.target.tagName == "IMG") {
                        let img = event.target;
                        let eyeInput = img.parentNode.parentNode.childNodes[1];
                        if(eyeOpen == 0) {
                            img.setAttribute("src", "../img/open-eye.png");
                            eyeOpen = 1;
                            eyeInput.setAttribute("type",`text`);
                        }
                        else {
                            img.setAttribute("src", "../img/closed-eye.png");
                            eyeOpen = 0;
                            eyeInput.setAttribute("type",`password`);
                        }                        
                    }
                }
            </script>
				
		</article>
		<?
			include_once "$path/private/footer.php"		        //FOOTER
		?>
	</div>
</body>
</html>
