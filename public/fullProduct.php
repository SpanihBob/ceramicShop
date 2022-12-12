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
				<div id="content">		<!-- CONTENT -->				
				</div>
                <div id="contextMenu">
				    <div id="closeBtn">x</div>
			    </div>
			</div>	
		</article>
		<?
			include_once "$path/private/footer.php"				//FOOTER
		?>
	</div>


    <script>
		const crockeryContent = document.getElementById('content')
        window.onload=()=>{								//%%%%%%%%%%%%%%%%%%%%%%%%%% вывод товара на экран %%%%%%%%%%%%%%%%%%%%%%%%%%//
			fetch(`/system/displayFullProductPage.php`)                                       
			.then(response => response.json())                                  
			.then(data => {	
				data.forEach(element => {
					// console.log(element);
					let productDiv = document.createElement("div");								//parent
						let imgAndPrice = document.createElement("div");						//картинка			
						let descDiv = document.createElement("div");							//описание								
						descDiv.classList.add("descDiv");
							let imgDiv = document.createElement("div");	
								let img = document.createElement('img');						//создали картинку
								let mainImage = element.image.split(", ")[0];
								// console.log(mainImage);
								img.setAttribute("src",`../img1/${mainImage}`)					//атрибуты img для главной картинки
								img.classList.add("ImgFullProduct");
								img.setAttribute("data-id",1);

                                let dataDiv = document.createElement("div");					//div для данных о продукте

			                    let nameDiv = document.createElement("div");									//name
			                        let nameText = document.createTextNode(`${element.name}`);

			                    let priceDiv = document.createElement("div");									//price
			                        let priceText = document.createTextNode(`Цена: ${element.price}₽`);

			                    let descriptionDiv = document.createElement("div");								//description
								descriptionDiv.classList.add("descriptionDiv")
			                        let descriptionText = document.createTextNode(`${element.description}`);

								let amountDiv = document.createElement("div");									//amount
									let amountText = document.createTextNode(`остаток: ${element.amount} шт.`);


								//кнопки "добавить в корзину" и "добавить в избранное"
		                    	let addButton = addInputTypeButton("addButton", "Добавить в корзину");		//создаем кнопку "добавить в корзину" через функцию в master.js
                                    
			                    let itemInCart = document.createElement("div");								//div для информации если товар уже в корзине 
			                        let itemInCartText = document.createTextNode("Tовар в корзине");

			                    let addFavor = addInputTypeButton("addFavor", "Добавить в избранное");		//создаем кнопку "добавить в избранное" через функцию в master.js
                                    
			                    let itemInFavor = document.createElement("div");							//div для информации если товар уже в избранном 
			                        let itemInFavorText = document.createTextNode("В избранном");

		                    	let backButton = addInputTypeButton("backButton", "Назад");					//кнопка "назад"

		                    	let buyButton = addInputTypeButton("buyButton", "Купить");					//кнопка "купить"													

								let imgFullDiv = document.createElement("div");								//div для мини-картинок
								imgFullDiv.classList.add("miniImgFullProductDiv");
                                    
                                    let leftArrow = document.createElement("button");							//кнопка влево для листания мини-картинок
                                        leftArrow.innerText = "<";
                                        leftArrow.id = "leftArrow";
                                    let rightArrow = document.createElement("button");							//кнопка вправо для листания мини-картинок
                                        rightArrow.innerText = ">";
                                        rightArrow.id = "rightArrow";

								// добавляем атрибуты
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

							//_______________________Функция для вывода товара которые лежат в корзине(start)______________________________________________
							if(getCookies('user')){
								let userCartArr = [];					
								let userCart = (async function() {
									const response = await fetch(`/system/whatIsInTheCart.php`);
									const post = await response.json();
									return post;
								})					
								userCart().then(res=>{
									res.forEach(element =>userCartArr.push(element.product_id));

									dysplayNoneOrBlock(userCartArr, element.id, itemInCart, addButton);
							})}
							else {
								itemInCart.style.display = "none";
							}
						
							//_______________________Функция для вывода товара из избранного______________________________________________
							if(getCookies('user')){
								let userFavorArr = [];					
								let userFavor = (async function() {
									const response = await fetch(`/system/whatIsInTheFavor.php`);
									const post = await response.json();
									return post;
								})					
								userFavor().then(userFavorRes=>{
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
									favorDysplayNoneOrBlock(itemInFavor, addFavor);
								})
							}
							else {
								itemInFavor.style.display = "none";
								addFavor.style.display = "none";
							}
							//_____________________Функция для отправки товара в корзину (базу данных)____________________________________________

								function addProductsToTheDatabase() {
									fetch("/system/addToCartAndFavor.php", {
										method: 'post',
										headers: {
											"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
										},
										body: `productId=${element.id}&cartOrFavor=cart`,
									})
								}
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

								crockeryContent.appendChild(productDiv);
								crockeryContent.appendChild(descDiv);
							//########################			 нажимаем кнопку добавить в корзину  		###########################	
							if(getCookies('user')){
								addButton.onclick = () => {	
									addProductsToTheDatabase();
									itemInCart.style.display = "block";
									addButton.style.display = "none";
								}}
								else {
									addButton.onclick = () => {										
										loginOrSignup(crockeryContent)
									}
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

					//#######################################################			 кнопка "купить"  		######################################################
					if(getCookies('user')){
						buyButton.onclick = () => {
						window.location.href = '/ordering';
					}}
					else {
						buyButton.onclick = () => {
							loginOrSignup(crockeryContent)
						}
					}	
					
					//#######################################################			 кнопка "назад"  		######################################################

					backButton.onclick = () => {
						window.location.href = '/product';
					}

					

					//####################################################			 добавление товара в избранное 	 		##########################################
					addFavor.onclick = () => {
						fetch("/system/addToCartAndFavor.php", {
							method: 'post',
							headers: {
								"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
							},
							body: `productId=${element.id}&cartOrFavor=favor`,
						})															
						itemInFavor.style.display = "block";
						addFavor.style.display = "none";											
					}
						

					//#########################################			 выводим картинку при нажатии - на главную  		##########################################

					productDiv.onclick = event => {
						if(event.target.tagName == "IMG") {
							img.setAttribute("src",`../img1/${event.target.getAttribute("src")}`)
						}}

						
					//##########################################			 увеличиваем картинку при двойном клике 		###########################################

					productDiv.ondblclick = selectedImg => {
						if(selectedImg.target.tagName == "IMG") {

							let imageDataId = +selectedImg.target.getAttribute("data-id");	//находим data-id картинки

							contextMenu.style.display = "grid";
							let contextMenuParentDiv = document.createElement("div");
								contextMenuParentDiv.classList.add("contextMenuParentDiv");

							let contextMenuChildDiv1 = document.createElement("button");
								contextMenuChildDiv1.id = "seeStart";
								contextMenuChildDiv1.innerText = "<";
								contextMenuChildDiv1.classList.add("seeStartAndEnd");

							let contextMenuChildDiv2 = document.createElement("button");
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
				let allImageContextMenu = document.querySelectorAll(".ImgFullProduct");
							seeStart.onclick = () => {
								imageDataId = imageDataId - 1;																
								if(imageDataId > 0) {																	
									contextMenuImage.setAttribute("src", allImageContextMenu[imageDataId].getAttribute("src"));
								}
								if(imageDataId <= 0) {
									imageDataId = allImageContextMenu.length-1;
									contextMenuImage.setAttribute("src", allImageContextMenu[imageDataId].getAttribute("src"));
								}																
							}	

							seeEnd.onclick = () => {
								imageDataId = imageDataId + 1;

								if(imageDataId < allImageContextMenu.length) {
									// console.log(imageDataId);																	
									contextMenuImage.setAttribute("src", allImageContextMenu[imageDataId].getAttribute("src"));
								}
								if(imageDataId >= allImageContextMenu.length) {
									imageDataId = 1;
									// console.log(imageDataId);
									contextMenuImage.setAttribute("src", allImageContextMenu[imageDataId].getAttribute("src"));
								}}													
							}}
						})
					})
				}
    </script>
</body>
</html>
