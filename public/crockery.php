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
			<div id="contextMenu">
				<div id="closeBtn">x</div>
			</div>
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
													img.classList.add("ImgFullProduct");
													img.setAttribute("data-id",0);

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

													
													let leftArrow = document.createElement("div");
														leftArrow.innerText = "<";
														leftArrow.id = "leftArrow";
													let rightArrow = document.createElement("div");
														rightArrow.innerText = ">";
														rightArrow.id = "rightArrow";
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

													imgFullDiv.appendChild(leftArrow);

													let imgArr = element.image.split(", ");
													let i = 1
													imgArr.forEach(imgElement => {														
														let imageFullProduct = document.createElement("img");
														imageFullProduct.setAttribute("src",`../img1/${imgElement}`);
														imageFullProduct.classList.add("ImgFullProduct");														
														imageFullProduct.setAttribute("data-id",`${i}`);
														if(i>3) {
															imageFullProduct.setAttribute("style",`display:none`);
														}
														imgFullDiv.appendChild(imageFullProduct);
														i++;
													});
													imgFullDiv.appendChild(rightArrow);

													dataDiv.appendChild(imgFullDiv);

													crockeryProductFull.appendChild(productDiv);
													crockeryProductFull.appendChild(descDiv);

					//################################################			 кнопки смотреть мини картинки  		###############################################

													leftArrow.onclick = () => {
														let leftArrowArr = document.querySelector(".miniImgFullProductDiv").children;														
														for(let htmlTag = 0; htmlTag < leftArrowArr.length; htmlTag++) {
															if(leftArrowArr[htmlTag].tagName == "IMG"	/* && leftArrowArr[htmlTag].getAttribute("style") == "block" */) {
																console.log(leftArrowArr[htmlTag]);
															}
														}
														// leftArrowArr.forEach(element => {
														// 	console.log(element.tagName);
														// });
													}



					//#######################################################			 кнопка "назад"  		######################################################

													backButton.onclick = () => {
														crockeryProduct.style.display = "grid";
														crockeryProductFull.style.display = "none";
														crockeryProductFull.innerHTML = "";
													}


					//#######################################################			 увеличиваем картинку  		######################################################

													productDiv.onclick = selectedImg => {
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

				//#######################################################			 закрываем картинку  		######################################################

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