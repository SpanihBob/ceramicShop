<?
	include_once "$path/private/head.php";
?>


<body>
	<div class="container">			
		<?
			include_once "$path/private/header.php";			//HEADER
		?>	

		<article class="article">								<!-- ARTICLE -->
			<?
				include_once "$path/private/sidebar.php";		//SIDEBAR
			?>
			
            <div>
				<div class="crockeryContent" id="content">		<!-- CONTENT -->				
				</div>
			</div>	
		</article>
		<?
			include_once "$path/private/footer.php"				//FOOTER
		?>
	</div>


    <script>
		const crockeryContent = document.querySelector(".crockeryContent");
        window.onload=()=>{	
			function displayProductPage() {								//%%%%%%%%%%%%%%%%%%%%%%%%%% вывод товара на экран %%%%%%%%%%%%%%%%%%%%%%%%%%//
					fetch(`/system/displayProductPage.php`)                                       
					.then(response => response.json())                                  
					.then(data => {						
						console.log(data);
						const content = document.getElementById("content");
						data.forEach(element => {
							let productDiv = document.createElement("div");								//parent

							let imgDiv = document.createElement("div");	
								let img = document.createElement('img');							//создали картинку
								let mainImage = element.image.split(", ")[0];
								img.setAttribute("src",`../img1/${mainImage}`)						//for img

							let dataDiv = document.createElement("div");							//div для данных
							let name = element.name.replace(/^[a-zа-ё]/ug, m => m.toUpperCase());

								let nameDiv = document.createElement("div");					//название
									let nameText = document.createTextNode(`${name}`);

								let priceDiv = document.createElement("div");					//цена
									let priceText = document.createTextNode(`Цена: ${element.price} р.`);

								let amountDiv = document.createElement("div");					//колличество
									let amountText = document.createTextNode(`остаток: ${element.amount} шт.`);

								let dataDivAddToCartBtn = document.createElement("div");
									let dataDivAddToCartBtnText = document.createTextNode(`Добавить в корзину`);

								let dataDivAddToCartText = document.createElement("div");
									let dataDivAddToCartTextInfo = document.createTextNode(`Товар в корзине`);

						productDiv.classList.add("productDivCrockery");
						dataDiv.classList.add("dataProductDivCrockery");
						imgDiv.classList.add("imgProductCrockery");
						dataDivAddToCartBtn.classList.add("input");
						productDiv.setAttribute("data-id",element.id)

						nameDiv.appendChild(nameText);
						priceDiv.appendChild(priceText);
						amountDiv.appendChild(amountText);
						dataDivAddToCartBtn.appendChild(dataDivAddToCartBtnText);
						dataDivAddToCartText.appendChild(dataDivAddToCartTextInfo);
						
						imgDiv.appendChild(img);
						dataDiv.appendChild(nameDiv);
						dataDiv.appendChild(priceDiv);
						dataDiv.appendChild(amountDiv);
							dataDiv.appendChild(dataDivAddToCartText);
							dataDiv.appendChild(dataDivAddToCartBtn);
							
						productDiv.appendChild(imgDiv);
						productDiv.appendChild(dataDiv);

						crockeryContent.appendChild(productDiv);

		//_______________________Функция пишет что товар в корзине(start)______________________________________________
					let userCartArr = [];					
					let userCart = (async function() {
						const response = await fetch(`/system/whatIsInTheCart.php`);
						const post = await response.json();
						return post;
					})					
					userCart().then(res=>{
						res.forEach(element =>userCartArr.push(element.product_id));
						
						function dysplayNoneOrBlock(a, b){
							if(userCartArr.includes(element.id)){
											a.style.display = "block";
											b.style.display = "none";
							}
							else {									
								a.style.display = "none";
								b.style.display = "block";
							}
						}
						dysplayNoneOrBlock(dataDivAddToCartText, dataDivAddToCartBtn);
					})
				// //_________________________________________________Функция для отправки товара в корзину (базу данных)________________________________________________

				function addProductsToTheDatabase() {
						fetch("/system/addToCartAndFavor.php", {
							method: 'post',
							headers: {
								"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
							},
							body: `productId=${element.id}&cartOrFavor=cart`,
						})
					}

					//########################			 нажимаем кнопку добавить в корзину  		###########################	
					let switchState = false;		
					productDiv.onclick = event => {									
						if(event.target == dataDivAddToCartBtn) {
							addProductsToTheDatabase();
							switchState = true;
							dataDivAddToCartText.style.display = "block";
							dataDivAddToCartBtn.style.display = "none";
						}
						//########################			 Выводим выбранный продукт  		###########################	
						if(event.target==img){
							let productDivAttribute = productDiv.getAttribute("data-id");
							
						if(element.id==productDivAttribute) {
							fetch("/system/getFullProduct.php", {
											method: 'post',
											headers: {
												"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
											},
											body: `fullProduct=${element.id}`,
										})
										.then(
											window.location.href = '/fullProduct'
										)        
						}
						}
					}
				})    
			})  
			}
			displayProductPage();
        }
    </script>
</body>
</html>
