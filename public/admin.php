<?
	include_once "$path/private/head.php";
?>


<body>
	<div class="container">			
		<?
			include_once "$path/private/header.php";		//HEADER
		?>	

		<article class="article">						<!-- ARTICLE -->
			<div class="sidebar" id="sidebar">
				<button class="btnSidebar" id="users_admin">
					<img class="sidebarMicroImage" src="../img/users_admin.png" alt="">
					<div>Пользователи</div>
				</button>
				<button class="btnSidebar" id="category_admin">
					<img class="sidebarMicroImage" src="../img/category_admin.png" alt="">
					<div>Категории</div>
				</button>
				<button class="btnSidebar" id="product_admin">
					<img class="sidebarMicroImage" src="../img/product_admin.png" alt="">
					<div>Товары</div>
				</button>
			</div>
			
			<div class="adminContent">								<!-- CONTENT -->
				<h1>Панель администратора</h1>
			</div>
			<script>
				const adminContent = document.querySelector(".adminContent");
				let usersContainer = document.createElement("div");				//для пользователей
				let adminUserShopping = document.createElement("div");			//для пользователей
				
				let categoryContainer = document.createElement("div");			//для категорий
				let productContainer = document.createElement("div");			//для товаров		
				window.onload = () => {
					getUsersToAdmin()
				}
				users_admin.onclick = () => {
					getUsersToAdmin()
				}
				category_admin.onclick = () => {
					getCategoryToAdmin()
				}
				product_admin.onclick = () => {
					getProductToAdmin()
				}
			</script>		
		</article>
		<?
			include_once "$path/private/footer.php"		//FOOTER
		?>
	</div>
</body>
</html>
