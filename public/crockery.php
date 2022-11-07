<?
	include_once "$path/private/head.php";
?>


<body>
	<div class="container">			
		<?
			include_once "$path/private/header.php";						//HEADER
		?>	

		<article class="article">											<!-- ARTICLE -->
			<?
				include_once "$path/private/sidebar.php";					//SIDEBAR
			?>
			<div>
			<div class="crockeryContent">									<!-- CONTENT -->
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
			<div id="contextMenu">
				<div id="closeBtn">x</div>
			</div>
		</div>

			<script>
				const crockeryContent = document.querySelector(".crockeryContent");
				const crockeryProduct = document.querySelector(".crockeryProduct");
				const crockeryProductFull = document.querySelector(".crockeryProductFull");

		//#############################################			 Выводим список товаров при нажатии на категорию посуды		###############################################

				crockeryContent.onclick = event => {
					crockeryProduct.innerHTML = '';
					if(event.target.className == "crockeryCard") {
						getProduct(event.target, 1);						
					}
					if(event.target.parentNode.className == "crockeryCard") {
						getProduct(event.target.parentNode, 1);
					}				
				}

				function getProduct(event, catId) {
					let attribute = event.getAttribute("data-id");
		//________________________     вывод категории посуды     ________________________
					let displayTheCategoryOfDishes = (async function() {
						let response = await fetch("/system/getProduct.php", {
							method: 'post',
							headers: {
								"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
							},
							body: `productId=${attribute}&catId=${catId}`,
							})
						let CategoryOfDishes = await response.json();
						return CategoryOfDishes;
					})
					displayTheCategoryOfDishes().then(res => {
							// console.log(res);
							crockeryContent.style.display = "none";
							crockeryProduct.style.display = "grid";

							res.forEach(element => {
								let productDiv = document.createElement("div");								//parent

									let imgDiv = document.createElement("div");	
										let img = document.createElement('img');							//создали картинку
										let mainImage = element.image.split(", ")[0];
										// console.log(mainImage);
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

								crockeryProduct.appendChild(productDiv);
								


//_______________________Функция для вывода товара которые лежат в корзине(start)______________________________________________
					let userCartArr = [];					
					let userCart = (async function() {
						const response = await fetch(`/system/whatIsInTheCart.php`);
						const post = await response.json();
						return post;
					})					
					userCart().then(res=>{
						console.log(res );
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

//_______________________Функция для вывода товара из избранного______________________________________________
					let userFavorArr = [];					
					let userFavor = (async function() {
						const response = await fetch(`/system/whatIsInTheFavor.php`);
						const post = await response.json();
						return post;
					})					
					userFavor().then(userFavorRes=>{
						console.log(userFavorRes);
						userFavorRes.forEach(el =>userFavorArr.push(el.product_id));
						
						function favorDysplayNoneOrBlock(a, b){
							if(userFavorArr.includes(element.id)){
											a.style.display = "block";
											b.style.display = "none";
							}
							else {									
								a.style.display = "none";
								b.style.display = "block";
							}
						}
						// favorDysplayNoneOrBlock(dataDivAddToCartText, dataDivAddToCartBtn);
					// //_________________________________________________Функция для отправки товара в корзину (базу данных)________________________________________________

					function addProductsToTheDatabase() {
						fetch("/system/addToCart.php", {
							method: 'post',
							headers: {
								"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
							},
							body: `productId=${element.id}&productCount=1`,
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
										crockeryProduct.style.display = "none";
										crockeryProductFull.style.display = "grid";

												let productDiv = document.createElement("div");								//parent
												let imgAndPrice = document.createElement("div");				
												let descDiv = document.createElement("div");								

												let imgDiv = document.createElement("div");	
													let img = document.createElement('img');						//создали картинку
													img.setAttribute("src",`../img1/${mainImage}`)				//for img
													img.classList.add("ImgFullProduct");
													img.setAttribute("data-id",1);

												let dataDiv = document.createElement("div");						//for all

													let nameDiv = document.createElement("div");					//name
														let nameText = document.createTextNode(`${name}`);

													let priceDiv = document.createElement("div");					//price
														let priceText = document.createTextNode(`Цена: ${element.price} р.`);

													let descriptionDiv = document.createElement("div");				//description
														let descriptionText = document.createTextNode(`${element.description}`);

													let amountDiv = document.createElement("div");					//amount
														let amountText = document.createTextNode(`остаток: ${element.amount} шт.`);

													let addButton = addInputTypeButton("addButton", "Добавить в корзину");		//создаем кнопку "добавить" через функцию в master.js
													
													let itemInCart = document.createElement("div");
														let itemInCartText = document.createTextNode("Tовар в корзине");

													let addFavor = addInputTypeButton("addFavor", "Добавить в избранное");		//создаем кнопку "добавить" через функцию в master.js
													
													let itemInFavor = document.createElement("div");
														let itemInFavorText = document.createTextNode("В избранном");

													let backButton = addInputTypeButton("backButton", "Назад");				//кнопка "назад"

													let buyButton = addInputTypeButton("buyButton", "Купить");					//кнопка "купить"													

													let imgFullDiv = document.createElement("div");
													imgFullDiv.classList.add("miniImgFullProductDiv");

													
													let leftArrow = document.createElement("div");
														leftArrow.innerText = "<";
														leftArrow.id = "leftArrow";
													let rightArrow = document.createElement("div");
														rightArrow.innerText = ">";
														rightArrow.id = "rightArrow";
													productDiv.classList.add("productDivCrockeryFull");
													dataDiv.classList.add("dataProductDivCrockeryFull");
													imgDiv.classList.add("imgProductCrockeryFull");
													itemInCart.classList.add("textInfo");
													itemInFavor.classList.add("textInfo");

													itemInCart.appendChild(itemInCartText);
													itemInFavor.appendChild(itemInFavorText);
													
													nameDiv.appendChild(nameText);
													priceDiv.appendChild(priceText);
													descriptionDiv.appendChild(descriptionText);
													amountDiv.appendChild(amountText);
													
													
													imgDiv.appendChild(img);
													dataDiv.appendChild(nameDiv);
													dataDiv.appendChild(priceDiv);
													dataDiv.appendChild(amountDiv);
													dataDiv.appendChild(itemInCart);
													dataDiv.appendChild(addButton);
													dataDiv.appendChild(addFavor);
													dataDiv.appendChild(itemInFavor);
													dataDiv.appendChild(buyButton);
													dataDiv.appendChild(backButton);

													
													descDiv.appendChild(descriptionDiv);

													productDiv.appendChild(imgDiv);
													productDiv.appendChild(dataDiv);

													dysplayNoneOrBlock(itemInCart, addButton);
													favorDysplayNoneOrBlock(itemInFavor, addFavor);

													imgFullDiv.appendChild(leftArrow);

													let imgArr = element.image.split(", ");
													let i = 1
													imgArr.forEach(imgElement => {														
														let imageFullProduct = document.createElement("img");
														imageFullProduct.setAttribute("src",`../img1/${imgElement}`);
														imageFullProduct.classList.add("ImgFullProduct");														
														imageFullProduct.setAttribute("data-id",`${i}`);
														if(i>3) {
															imageFullProduct.style.display = "none";
														}
														imgFullDiv.appendChild(imageFullProduct);
														i++;
													});
													imgFullDiv.appendChild(rightArrow);

													dataDiv.appendChild(imgFullDiv);

													crockeryProductFull.appendChild(productDiv);
													crockeryProductFull.appendChild(descDiv);

													// console.log(switchState);
													if(switchState==true){
														itemInCart.style.display = "block";
														addButton.style.display = "none";
													}
													

					//################################################			 кнопки смотреть мини картинки  		###############################################

													let leftArrowArr = document.querySelectorAll(".miniImgFullProductDiv > img");	//получаем все картинки в div.miniImgFullProductDiv 
													leftArrow.onclick = () => {	
														let condition = false;		
														for(let i = 0; i < leftArrowArr.length; i++) {	
															if(getComputedStyle(leftArrowArr[0]).display=="none") {
																condition = true;
															}	

															if(getComputedStyle(leftArrowArr[i]).display=="block") {																
																let dataId = +leftArrowArr[i].getAttribute("data-id");
																if(condition) {
																	leftArrowArr[dataId - 2].style.display = "block";
																	leftArrowArr[dataId-1].style.display = "none";
																}	
															}
														}
													}
													rightArrow.onclick = () => {
														let condition = false;		
														for(let i = leftArrowArr.length-1; i >= 0; i--) {	
															console.log();
															if(getComputedStyle(leftArrowArr[leftArrowArr.length-1]).display=="none") {
																condition = true;
															}	
															if(getComputedStyle(leftArrowArr[i]).display=="block") {																
																let dataId = +leftArrowArr[i].getAttribute("data-id");
																if(condition) {
																	leftArrowArr[dataId-1].style.display = "none";
																	leftArrowArr[dataId].style.display = "block";
																}	
															}
														}
													}


					
					//#######################################################			 кнопка "назад"  		######################################################

					backButton.onclick = () => {
						crockeryProduct.style.display = "grid";
						crockeryProductFull.style.display = "none";
						crockeryProductFull.innerHTML = "";
					}

					//####################################################			 добывление товара в корзину 	 		###################################################

					addButton.onclick = () => {
						addProductsToTheDatabase();															
						itemInCart.style.display = "block";
						addButton.style.display = "none";
						dataDivAddToCartText.style.display = "block";
						dataDivAddToCartBtn.style.display = "none";													
													}	

					//####################################################			 добывление товара в избранное 	 		###################################################

					addFavor.onclick = () => {
						fetch("/system/addToFavor.php", {
							method: 'post',
							headers: {
								"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
							},
							body: `productId=${element.id}`,
						})															
						itemInFavor.style.display = "block";
						addFavor.style.display = "none";											
					}		

					//#########################################			 выводим картинку при нажатии - на главную  		##############################################

					productDiv.onclick = event => {
						if(event.target.tagName == "IMG") {
							img.setAttribute("src",`../img1/${event.target.getAttribute("src")}`)
						}}

					//##########################################			 увеличиваем картинку при двойном клике 		#################################################

					productDiv.ondblclick = selectedImg => {
						if(selectedImg.target.tagName == "IMG") {

							let imageDataId = +selectedImg.target.getAttribute("data-id");	//находим data-id картинки

							contextMenu.style.display = "grid";
							let contextMenuParentDiv = document.createElement("div");
								contextMenuParentDiv.classList.add("contextMenuParentDiv");

							let contextMenuChildDiv1 = document.createElement("div");
								contextMenuChildDiv1.id = "seeStart";
								contextMenuChildDiv1.innerText = "<";
								contextMenuChildDiv1.classList.add("seeStartAndEnd");

							let contextMenuChildDiv2 = document.createElement("div");
								contextMenuChildDiv2.id = "seeEnd";
								contextMenuChildDiv2.innerText = ">";
								contextMenuChildDiv2.classList.add("seeStartAndEnd");

							let contextMenuImage = document.createElement("img");
							contextMenuImage.classList.add("contextMenuImage");
							contextMenuImage.setAttribute("src", selectedImg.target.getAttribute("src"));

							contextMenuParentDiv.appendChild(contextMenuChildDiv1);
							contextMenuParentDiv.appendChild(contextMenuImage);
							contextMenuParentDiv.appendChild(contextMenuChildDiv2);

							contextMenu.appendChild(contextMenuParentDiv);

				//#########################################			 закрываем увеличеную двойным кликом картинку 		###############################################

															closeBtn.onclick = () => {
																contextMenu.style.display = "none";
																contextMenuParentDiv.remove();			//удаляем элемент
															}
				//#######################################################			 листаем картинку 	 		######################################################

															seeStart.onclick = () => {
																let allImageContextMenu = document.querySelectorAll(".ImgFullProduct");
																imageDataId = imageDataId - 1;																
																if(imageDataId >= 0) {																	
																	contextMenuImage.setAttribute("src", allImageContextMenu[imageDataId].getAttribute("src"));
																}
																if(imageDataId < 0) {
																	imageDataId = allImageContextMenu.length-1;
																	contextMenuImage.setAttribute("src", allImageContextMenu[imageDataId].getAttribute("src"));
																}																
															}	

															seeEnd.onclick = () => {
																let allImageContextMenu = document.querySelectorAll(".ImgFullProduct");
																imageDataId = imageDataId + 1;

																if(imageDataId <= allImageContextMenu.length - 1) {																	
																	contextMenuImage.setAttribute("src", allImageContextMenu[imageDataId].getAttribute("src"));
																}
																if(imageDataId > allImageContextMenu.length - 1) {
																	imageDataId = 0;
																	contextMenuImage.setAttribute("src", allImageContextMenu[imageDataId].getAttribute("src"));
																}																	
															}													
														}														
													}
										// console.log(element);
									}
								}}
					})
					
							})})
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