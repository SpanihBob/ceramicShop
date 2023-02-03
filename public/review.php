<?
	include_once "$path/private/head.php";
?>


<body>
	<div class="container">			
		<?
			include_once "$path/private/header.php";		        //HEADER
		?>	

		<article class="article">						            <!-- ARTICLE -->
			<?
				include_once "$path/private/sidebar.php";		    //SIDEBAR
			?>
			<div class="reviewContent">								<!-- CONTENT -->
                <h1>Отзывы</h1>
			</div>		
		</article>
		<?
			include_once "$path/private/footer.php"		            //FOOTER
		?>
	</div>
    <script>
        let reviewContent = document.querySelector(".reviewContent");
		let reviewContent_chaild = document.createElement("div");
		window.onload = () => {
			fetch(`/system/getReview.php`)                                         
				.then(response => response.json())                           
				.then(data => {
					// console.log(data);
					data.forEach(el => {
						if (!data) {
							reviewContent_chaild.innerText = "К сожалению отзывов пока нет...";
						}
						else {
							console.log(el);
							let review_parent_div = document.createElement("div");				//контейнер отзыва
							let star_name_user_data = document.createElement("div");			//контейнер звезд, товара, пользователь, дата
								let star_and_product = document.createElement("div");		
									let star_container = document.createElement("div");			//контейнер для звезд
									let product_name_div = document.createElement("div");		//название товара
								let user_and_data = document.createElement("div");
									let user_div = document.createElement("div");				//пользователь
									let data_div = document.createElement("div");				//дата
							let review = document.createElement("div");							//отзыв
							let img_container = document.createElement("div");					//контейнер для img




						}
					});
				})
		}

        console.log(reviewContent);
    </script>
</body>
</html>
