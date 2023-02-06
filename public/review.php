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
							reviewContent.appendChild(reviewContent_chaild);
						}
						else {
							console.log(el);
							let review_parent_div = document.createElement("div");				//контейнер отзыва
							review_parent_div.classList.add("review_parent_div_style");
							let star_name_user_data = document.createElement("div");			//контейнер звезд, пользователь, дата
							star_name_user_data.classList.add("star_name_user_data_style");
								let star_and_product = document.createElement("div");		
									let star_container = document.createElement("div");			//контейнер для звезд
									star_container.classList.add("star_container_style")
									let product_name_div = document.createElement("div");		//название товара

								let user_and_data = document.createElement("div");
									let user_div = document.createElement("div");				//пользователь
										user_div.innerText = el.login;
										let review_date = el.add_time * 1000;
									let data_div = document.createElement("div");				//дата
										data_div.classList.add("data_div_style")
										data_div.innerText = new Date(review_date).toLocaleString("ru",{ year: "numeric",  month: "numeric",  day: "numeric", hour: "numeric",  minute: "numeric"});
							let review = document.createElement("div");							//отзыв
								review.innerText = el.reviews;
								review.classList.add("review_style");
							// let img_container = document.createElement("div");					//контейнер для img

							
							star_and_product.appendChild(star_container);
							star_and_product.appendChild(product_name_div);
							
							user_and_data.appendChild(user_div);
							user_and_data.appendChild(data_div);

							star_name_user_data.appendChild(star_and_product);
							star_name_user_data.appendChild(user_and_data);

							review_parent_div.appendChild(star_name_user_data);
							review_parent_div.appendChild(review);
							reviewContent.appendChild(review_parent_div)
							
							for(let i = 1; i <= 5; i++) {
								let star_label = document.createElement("label");
								let star_checkbox = document.createElement("input");
								let star_checkbox_div = document.createElement("div");
								if(i<=el.star_count) {
									star_checkbox_div.innerHTML = '&#9733';						//закрашеная звезда
								}
								else star_checkbox_div.innerHTML = "&#9734;";					//незакрашеная звезда
								star_checkbox.setAttribute("type", "checkbox");
								star_checkbox.classList.add("star_checkbox_style");
								star_checkbox.setAttribute("data-id", i);

								star_label.appendChild(star_checkbox);
								star_label.appendChild(star_checkbox_div);
								star_container.appendChild(star_label);
							}
							
							
							








							// // для создания отзыва:
							// for(let i = 1; i <= 5; i++) {
							// 	let star_checkbox = document.createElement("input");
							// 	star_checkbox.setAttribute("type", "checkbox");
							// 	star_checkbox.classList.add("star_checkbox_style");
							// 	star_container.appendChild(star_checkbox);
							// 	star_checkbox.setAttribute("data-id", i);
							// }
							// review_parent_div.onclick = (event) => {
							// 	if(event.target.getAttribute("type") == "checkbox"){
							// 		// console.log("event.target");
							// 		if(event.target.checked == true) {
							// 			let star_checkbox_data_id = event.target.getAttribute("data-id");
							// 		// 	for(let j = 1; j <= star_checkbox_data_id; j++) {
							// 		// 		// if()
							// 		// 	}
							// 			console.log(star_checkbox_data_id);
							// 		}
							// 	}
								
							// }
						}
					});
				})
		}

        console.log(reviewContent);
    </script>
</body>
</html>
