<?
	include_once "$path/private/head.php";
?>


<body>
	<div class="container">			
		<?
			include_once "$path/private/header.php";		//HEADER
		?>	

		<article class="article">						<!-- ARTICLE -->
			<?
				include_once "$path/private/sidebar.php";		//SIDEBAR
			?>
			<div>
			<div class="crockeryContent">								<!-- CONTENT -->
				<?
					$queryCrockery = $dbPDO -> prepare("SELECT * FROM crockery");
					$queryCrockery -> execute();
					foreach($queryCrockery as $rowCrockery) {                                           
						echo <<<html
								<div data-id="$rowCrockery[id]" class="crockeryCard">
									<img class="crockeryImg" src="../img1/$rowCrockery[crockeryImage]" alt="">
									<div class="crockeryText">$rowCrockery[crockeryName]</div>
								</div>
							html;
					}  
				?>
			</div>
			<div class="crockeryProduct"></div>
			<div class="crockeryProductFull"></div>
		</div>

			<script>
				const crockeryContent = document.querySelector(".crockeryContent");
				const crockeryProduct = document.querySelector(".crockeryProduct");
				const crockeryProductFull = document.querySelector(".crockeryProductFull");

		//#######################################################			 Выводим список товаров 		######################################################

				crockeryContent.onclick = event => {
					crockeryProduct.innerHTML = '';
					// console.log(event.target.className);
					if(event.target.className == "crockeryCard") {
						getProduct(event.target, 1);						
					}
					if(event.target.parentNode.className == "crockeryCard") {
						getProduct(event.target.parentNode, 1);
					}
				
				}

				function getProduct(event, catId) {
					let attribute = event.getAttribute("data-id");
					fetch("/system/getProduct.php", {
							method: 'post',
							headers: {
								"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
							},
							body: `productId=${attribute}&catId=${catId}`,
							})
						.then(response =>response.json())
						.then(data => {
							crockeryContent.style.display = "none";
							crockeryProduct.style.display = "grid";

							data.forEach(element => {
								let productDiv = document.createElement("div");								//parent

									let imgDiv = document.createElement("div");	
										let img = document.createElement('img');						//создали картинку
										img.setAttribute("src",`../img1/${element.poster}`)				//for img

									let dataDiv = document.createElement("div");						//for all
									let name = element.name.replace(/^[a-zа-ё]/ug, m => m.toUpperCase());

										let nameDiv = document.createElement("div");					//name
											let nameText = document.createTextNode(`${name}`);

										let priceDiv = document.createElement("div");					//price
											let priceText = document.createTextNode(`Цена: ${element.price} р.`);

										let amountDiv = document.createElement("div");					//amount
											let amountText = document.createTextNode(`остаток: ${element.amount} шт.`);

								productDiv.classList.add("productDivCrockery");
								dataDiv.classList.add("dataProductDivCrockery");
								imgDiv.classList.add("imgProductCrockery");
								productDiv.setAttribute("data-id",element.id)

								nameDiv.appendChild(nameText);
								priceDiv.appendChild(priceText);
								amountDiv.appendChild(amountText);
								
								imgDiv.appendChild(img);
								dataDiv.appendChild(nameDiv);
								dataDiv.appendChild(priceDiv);
								dataDiv.appendChild(amountDiv);

								productDiv.appendChild(imgDiv);
								productDiv.appendChild(dataDiv);

								crockeryProduct.appendChild(productDiv);
								
					//#######################################################			 Выводим выбранный продукт  		######################################################	
								
								productDiv.onclick = event => {
									let productDivAttribute;
									if(event.target==productDiv){
										productDivAttribute = event.target.getAttribute("data-id");
									}
									else {
										productDivAttribute = event.target.parentNode.parentNode.getAttribute("data-id");
									}
									// console.log(productDivAttribute);
									if(element.id==productDivAttribute) {
										crockeryProduct.style.display = "none";
										crockeryProductFull.style.display = "grid";

												let productDiv = document.createElement("div");								//parent
												let imgAndPrice = document.createElement("div");				
												let descDiv = document.createElement("div");								

												let imgDiv = document.createElement("div");	
													let img = document.createElement('img');						//создали картинку
													img.setAttribute("src",`../img1/${element.poster}`)				//for img

												let dataDiv = document.createElement("div");						//for all

													let nameDiv = document.createElement("div");					//name
														let nameText = document.createTextNode(`${name}`);

														// element.name.replace(/(?:^)/ug, m => m.toUpperCase());

													let priceDiv = document.createElement("div");					//price
														let priceText = document.createTextNode(`Цена: ${element.price} р.`);

													let descriptionDiv = document.createElement("div");				//description
														let descriptionText = document.createTextNode(`${element.description}`);

													let amountDiv = document.createElement("div");					//amount
														let amountText = document.createTextNode(`остаток: ${element.amount} шт.`);

													let addButton = addInputTypeButton("addButton", "Добавить в корзину", "addButton");		//создаем кнопку "добавить" через функцию в master.js
													
													let backButton = addInputTypeButton("backButton", "Назад", "backButton");				//кнопка "назад"

													let buyButton = addInputTypeButton("buyButton", "Купить", "buyButton");					//кнопка "купить"													

													let imgFullDiv = document.createElement("div");
													imgFullDiv.classList.add("miniImgFullProductDiv");

													productDiv.classList.add("productDivCrockeryFull");
													dataDiv.classList.add("dataProductDivCrockeryFull");
													imgDiv.classList.add("imgProductCrockeryFull");

													nameDiv.appendChild(nameText);
													priceDiv.appendChild(priceText);
													descriptionDiv.appendChild(descriptionText);
													amountDiv.appendChild(amountText);

													imgDiv.appendChild(img);
													dataDiv.appendChild(nameDiv);
													dataDiv.appendChild(priceDiv);
													dataDiv.appendChild(amountDiv);
													dataDiv.appendChild(addButton);
													dataDiv.appendChild(buyButton);
													dataDiv.appendChild(backButton);

													
													descDiv.appendChild(descriptionDiv);

													productDiv.appendChild(imgDiv);
													productDiv.appendChild(dataDiv);

													let imgArr = element.image.split(", ");
													imgArr.forEach(imgElement => {
														let imageFullProduct = document.createElement("img");
														imageFullProduct.setAttribute("src",`../img1/${imgElement}`);
														imageFullProduct.classList.add("miniImgFullProduct");
														imgFullDiv.appendChild(imageFullProduct);
													});

													dataDiv.appendChild(imgFullDiv);

													crockeryProductFull.appendChild(productDiv);
													crockeryProductFull.appendChild(descDiv);

					//#######################################################			 кнопка "назад"  		######################################################

						backButton.onclick = () => {
							crockeryProduct.style.display = "grid";
							crockeryProductFull.style.display = "none";
							crockeryProductFull.innerHTML = "";
						}


					//#######################################################			 увеличиваем картинку  		######################################################									
						productDiv.onclick = selectedImg => {
							if(selectedImg.target.tagName == "IMG") {
								//пишем контекстное меню с картинкой на большом экране!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
							}
							
						}
										console.log(element);
									}
								}
							});
						})
				}
			</script>		
		</article>
		<?
			include_once "$path/private/footer.php"		//FOOTER
		?>
	</div>
</body>
</html>