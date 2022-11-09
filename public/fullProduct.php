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
		const crockeryContent = document.querySelector(".crockeryContent");
        window.onload=()=>{								//%%%%%%%%%%%%%%%%%%%%%%%%%% вывод товара на экран %%%%%%%%%%%%%%%%%%%%%%%%%%//
					fetch(`/system/displayFullProductPage.php`)                                       
					.then(response => response.json())                                  
					.then(data => {	
                        const content = document.getElementById("content");
						data.forEach(element => {
                            console.log(element);
                //             let productDiv = document.createElement("div");								//parent
                //                 let imgAndPrice = document.createElement("div");				
                //                 let descDiv = document.createElement("div");								

                //                 let imgDiv = document.createElement("div");	
                //                     let img = document.createElement('img');						//создали картинку
                //                     img.setAttribute("src",`../img1/${mainImage}`)				//for img
                //                     img.classList.add("ImgFullProduct");
                //                     img.setAttribute("data-id",1);

                //                 let dataDiv = document.createElement("div");						//for all

                //                     let nameDiv = document.createElement("div");					//name
                //                         let nameText = document.createTextNode(`${name}`);

                //                     let priceDiv = document.createElement("div");					//price
                //                         let priceText = document.createTextNode(`Цена: ${element.price} р.`);

                //                     let descriptionDiv = document.createElement("div");				//description
                //                         let descriptionText = document.createTextNode(`${element.description}`);

                //                     let amountDiv = document.createElement("div");					//amount
                //                         let amountText = document.createTextNode(`остаток: ${element.amount} шт.`);

                //                     let addButton = addInputTypeButton("addButton", "Добавить в корзину");		//создаем кнопку "добавить" через функцию в master.js
                                    
                //                     let itemInCart = document.createElement("div");
                //                         let itemInCartText = document.createTextNode("Tовар в корзине");

                //                     let addFavor = addInputTypeButton("addFavor", "Добавить в избранное");		//создаем кнопку "добавить" через функцию в master.js
                                    
                //                     let itemInFavor = document.createElement("div");
                //                         let itemInFavorText = document.createTextNode("В избранном");

                //                     let backButton = addInputTypeButton("backButton", "Назад");				//кнопка "назад"

                //                     let buyButton = addInputTypeButton("buyButton", "Купить");					//кнопка "купить"													

                //                     let imgFullDiv = document.createElement("div");
                //                     imgFullDiv.classList.add("miniImgFullProductDiv");

                                    
                //                     let leftArrow = document.createElement("div");
                //                         leftArrow.innerText = "<";
                //                         leftArrow.id = "leftArrow";
                //                     let rightArrow = document.createElement("div");
                //                         rightArrow.innerText = ">";
                //                         rightArrow.id = "rightArrow";
                //                     productDiv.classList.add("productDivCrockeryFull");
                //                     dataDiv.classList.add("dataProductDivCrockeryFull");
                //                     imgDiv.classList.add("imgProductCrockeryFull");
                //                     itemInCart.classList.add("textInfo");
                //                     itemInFavor.classList.add("textInfo");

                //                     itemInCart.appendChild(itemInCartText);
                //                     itemInFavor.appendChild(itemInFavorText);
                                    
                //                     nameDiv.appendChild(nameText);
                //                     priceDiv.appendChild(priceText);
                //                     descriptionDiv.appendChild(descriptionText);
                //                     amountDiv.appendChild(amountText);
                                    
                                    
                //                     imgDiv.appendChild(img);
                //                     dataDiv.appendChild(nameDiv);
                //                     dataDiv.appendChild(priceDiv);
                //                     dataDiv.appendChild(amountDiv);
                //                     dataDiv.appendChild(itemInCart);
                //                     dataDiv.appendChild(addButton);
                //                     dataDiv.appendChild(addFavor);
                //                     dataDiv.appendChild(itemInFavor);
                //                     dataDiv.appendChild(buyButton);
                //                     dataDiv.appendChild(backButton);

                                    
                //                     descDiv.appendChild(descriptionDiv);

                //                     productDiv.appendChild(imgDiv);
                //                     productDiv.appendChild(dataDiv);

                //                     dysplayNoneOrBlock(itemInCart, addButton);
                //                     favorDysplayNoneOrBlock(itemInFavor, addFavor);

                //                     imgFullDiv.appendChild(leftArrow);

                //                     let imgArr = element.image.split(", ");
                //                     let i = 1;
                //                     imgArr.forEach(imgElement => {														
                //                         let imageFullProduct = document.createElement("img");
                //                         imageFullProduct.setAttribute("src",`../img1/${imgElement}`);
                //                         imageFullProduct.classList.add("ImgFullProduct");														
                //                         imageFullProduct.setAttribute("data-id",`${i}`);
                //                         if(i>3) {
                //                             imageFullProduct.style.display = "none";
                //                         }
                //                         imgFullDiv.appendChild(imageFullProduct);
                //                         i++;
                //                     });
                //                     imgFullDiv.appendChild(rightArrow);

                //                     dataDiv.appendChild(imgFullDiv);

                //                     crockeryContent.appendChild(productDiv);
                //                     crockeryContent.appendChild(descDiv);

                //                     // console.log(switchState);
                //                     if(switchState==true){
                //                         itemInCart.style.display = "block";
                //                         addButton.style.display = "none";
                //                     }

                //                     //################################################			 кнопки смотреть мини картинки  		###############################################

				// 									let leftArrowArr = document.querySelectorAll(".miniImgFullProductDiv > img");	//получаем все картинки в div.miniImgFullProductDiv 
				// 									leftArrow.onclick = () => {	
				// 										let condition = false;		
				// 										for(let i = 0; i < leftArrowArr.length; i++) {	
				// 											if(getComputedStyle(leftArrowArr[0]).display=="none") {
				// 												condition = true;
				// 											}	

				// 											if(getComputedStyle(leftArrowArr[i]).display=="block") {																
				// 												let dataId = +leftArrowArr[i].getAttribute("data-id");
				// 												if(condition) {
				// 													leftArrowArr[dataId - 2].style.display = "block";
				// 													leftArrowArr[dataId-1].style.display = "none";
				// 												}	
				// 											}
				// 										}
				// 									}
				// 									rightArrow.onclick = () => {
				// 										let condition = false;		
				// 										for(let i = leftArrowArr.length-1; i >= 0; i--) {
				// 											if(getComputedStyle(leftArrowArr[leftArrowArr.length-1]).display=="none") {
				// 												condition = true;
				// 											}	
				// 											if(getComputedStyle(leftArrowArr[i]).display=="block") {																
				// 												let dataId = +leftArrowArr[i].getAttribute("data-id");
				// 												if(condition) {
				// 													leftArrowArr[dataId-1].style.display = "none";
				// 													leftArrowArr[dataId].style.display = "block";
				// 												}	
				// 											}
				// 										}
				// 									}


				// 	//####################################################			 добывление товара в корзину 	 		###################################################

				// 	addButton.onclick = () => {
				// 		addProductsToTheDatabase(element.id);															
				// 		itemInCart.style.display = "block";
				// 		addButton.style.display = "none";
				// 		dataDivAddToCartText.style.display = "block";
				// 		dataDivAddToCartBtn.style.display = "none";													
				// 									}	

				// 	//####################################################			 добывление товара в избранное 	 		###################################################

				// 	addFavor.onclick = () => {
				// 		fetch("/system/addToCartAndFavor.php", {
				// 			method: 'post',
				// 			headers: {
				// 				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
				// 			},
				// 			body: `productId=${element.id}&cartOrFavor=favor`,
				// 		})															
				// 		itemInFavor.style.display = "block";
				// 		addFavor.style.display = "none";											
				// 	}		

				// 	//#########################################			 выводим картинку при нажатии - на главную  		##############################################

				// 	productDiv.onclick = event => {
				// 		if(event.target.tagName == "IMG") {
				// 			img.setAttribute("src",`../img1/${event.target.getAttribute("src")}`);
                //         }}

                //         //##########################################			 увеличиваем картинку при двойном клике 		#################################################

				// 	productDiv.ondblclick = selectedImg => {
				// 		if(selectedImg.target.tagName == "IMG") {

				// 			let imageDataId = +selectedImg.target.getAttribute("data-id");	//находим data-id картинки

				// 			contextMenu.style.display = "grid";
				// 			let contextMenuParentDiv = document.createElement("div");
				// 				contextMenuParentDiv.classList.add("contextMenuParentDiv");

				// 			let contextMenuChildDiv1 = document.createElement("div");
				// 				contextMenuChildDiv1.id = "seeStart";
				// 				contextMenuChildDiv1.innerText = "<";
				// 				contextMenuChildDiv1.classList.add("seeStartAndEnd");

				// 			let contextMenuChildDiv2 = document.createElement("div");
				// 				contextMenuChildDiv2.id = "seeEnd";
				// 				contextMenuChildDiv2.innerText = ">";
				// 				contextMenuChildDiv2.classList.add("seeStartAndEnd");

				// 			let contextMenuImage = document.createElement("img");
				// 			contextMenuImage.classList.add("contextMenuImage");
				// 			contextMenuImage.setAttribute("src", selectedImg.target.getAttribute("src"));

				// 			contextMenuParentDiv.appendChild(contextMenuChildDiv1);
				// 			contextMenuParentDiv.appendChild(contextMenuImage);
				// 			contextMenuParentDiv.appendChild(contextMenuChildDiv2);

				// 			contextMenu.appendChild(contextMenuParentDiv);

				// //#########################################			 закрываем увеличеную двойным кликом картинку 		###############################################

				// 			closeBtn.onclick = () => {
				// 				contextMenu.style.display = "none";
				// 				contextMenuParentDiv.remove();			//удаляем элемент
				// 			}
				// //#######################################################			 листаем картинку 	 		######################################################

				// 								seeStart.onclick = () => {
				// 									let allImageContextMenu = document.querySelectorAll(".ImgFullProduct");
				// 									imageDataId = imageDataId - 1;																
				// 									if(imageDataId >= 0) {																	
				// 										contextMenuImage.setAttribute("src", allImageContextMenu[imageDataId].getAttribute("src"));
				// 									}
				// 									if(imageDataId < 0) {
				// 										imageDataId = allImageContextMenu.length-1;
				// 										contextMenuImage.setAttribute("src", allImageContextMenu[imageDataId].getAttribute("src"));
				// 									}																
				// 								}	

				// 								seeEnd.onclick = () => {
				// 									let allImageContextMenu = document.querySelectorAll(".ImgFullProduct");
				// 									imageDataId = imageDataId + 1;

				// 									if(imageDataId <= allImageContextMenu.length - 1) {																	
				// 										contextMenuImage.setAttribute("src", allImageContextMenu[imageDataId].getAttribute("src"));
				// 									}
				// 									if(imageDataId > allImageContextMenu.length - 1) {
				// 										imageDataId = 0;
				// 										contextMenuImage.setAttribute("src", allImageContextMenu[imageDataId].getAttribute("src"));
				// 									}																	
				// 								}													
				// 							}														
				// 						}
                    }
                )
                })
			}
    </script>
</body>
</html>