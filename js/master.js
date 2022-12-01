 window.onload=function(){
  //тут пишем код, который будет ожидать загрузки DOM    
 }
 //здесь в обычном режиме 

// ############################################################################################################################################
// ###########################################                                              ###################################################
// ###########################################				ИСПОЛЬЗУЕТСЯ В	 				###################################################
// ###########################################					cart.php,					###################################################
// ###########################################					favor.php					###################################################
// ###########################################       "функция для избранного и корзины"     ###################################################
// ###########################################       		favoritesAndCart()		        ###################################################
// ###########################################                                              ###################################################
// ############################################################################################################################################
function favoritesAndCart(filePhp, patch, text) {
    const cartContent = document.querySelector('.cartContent');
		window.onload = () => {
			fetch(`/system/removeFromFavorAndCart.php`, {
				method: 'post',
				headers: {
					"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
				},
				body: `filePhp=${filePhp}`,
				})                                        
			.then(response => response.json())                                  
			.then(data => {	
				if(data[0]==undefined){
					const favorIsEmpty = document.createElement('div');
					favorIsEmpty.innerText=text;
					cartContent.appendChild(favorIsEmpty);
				}
				else{
					data.forEach(element => {
						const cartParentDiv = document.createElement('div');
							const checkboxLabel =  document.createElement('label');
								checkboxLabel.style.display = "grid";
								const checkbox =  document.createElement('input');
								checkbox.setAttribute("type","checkbox");
								checkbox.setAttribute("name",`check${element.id}`);
								checkbox.setAttribute("data-id",`${element.id}`);
								checkbox.classList.add("cartAndFavorCheckbox");
								let checkboxDiv =  document.createElement('div');
									checkboxDiv.classList.add("cartAndFavorCheckboxDiv");
								const imgDiv = document.createElement('div');
								const img = document.createElement('img');  //картинка
						
							const infoDiv = document.createElement('div');  //
								const nameDiv = document.createElement('div');//имя
									const delCrockeryDiv = document.createElement('div');//удаление товара
									const summDiv = document.createElement('div');//цена итоговая
									const amountDiv = document.createElement('div');//кол-во
									const delDiv = document.createElement('button');//del
									const numDiv = document.createElement('div');//number
									const addDiv = document.createElement('button');//add

						cartParentDiv.id = element.id;
						cartParentDiv.classList.add('cartProduct');
						imgDiv.classList.add('cartProductImgDiv');
						infoDiv.classList.add('cartInfoDiv');
						delCrockeryDiv.classList.add('cartDelProduct');
						if(filePhp=="cart"){
							amountDiv.classList.add('cartAmountDiv');
						}
						else if(filePhp=="favor"){
							amountDiv.classList.add('favorAmountDiv');
						}							

						summDiv.classList.add('finalPriceDiv');
						delDiv.classList.add('delProduct');
						numDiv.classList.add('productQuantity');
						numDiv.setAttribute("data-id", `sum${element.id}`);
						addDiv.classList.add('addProduct');

						img.setAttribute("src",`../img1/${element.image.split(", ")[0]}`);
						nameDiv.innerText = `${element.name}`;
						
						if(filePhp=='cart'){
							delDiv.innerText = `-`;
							numDiv.innerText = `${element.count}`;
							addDiv.innerText = `+`;
							summDiv.innerText = `Стоимость:${element.price * numDiv.innerText}₽`;
							let sumDelDiv = document.createElement("div");
							sumDelDiv.classList.add("sumDelDiv")
							sumDelDiv.appendChild(delDiv);
							sumDelDiv.appendChild(numDiv);
							sumDelDiv.appendChild(addDiv);
							amountDiv.appendChild(sumDelDiv);
						}
						else if(filePhp=='favor'){
							summDiv.innerText = `${element.price}`;
							amountDiv.innerText = `${element.description}`;
						}								
						checkboxLabel.appendChild(checkbox);
						checkboxLabel.appendChild(checkboxDiv);

						imgDiv.appendChild(img);

						infoDiv.appendChild(nameDiv);
						infoDiv.appendChild(delCrockeryDiv);
						infoDiv.appendChild(amountDiv);
						infoDiv.appendChild(summDiv);

						cartParentDiv.appendChild(checkboxLabel);
						cartParentDiv.appendChild(imgDiv);
						cartParentDiv.appendChild(infoDiv);
						
						cartContent.appendChild(cartParentDiv);

						// //_______________функция будет менять колличество товара в корзине (c.237 Д.Флэнаган - JavaScript)________________
					let c = counter(element.count);
						cartParentDiv.onclick = (event) => {					//счетчик колличества товара в корзине
							if(filePhp == 'cart'){
									// console.log(event.target.className);	
								if(event.target.className == "addProduct") {
									numDiv.innerText = c.add();
								} 
								else if((event.target.className == "delProduct") && (numDiv.innerText>0)) {
									if(numDiv.innerText==1){
										removeItemFromFavorAndCart(cartContent,element.name, element.image, element.product_id, filePhp, patch);
										return;
									}
									numDiv.innerText = c.del();
									
								}
								else if(event.target.className == "cartDelProduct") {
									removeItemFromFavorAndCart(cartContent,element.name, element.image, element.product_id, filePhp, patch)
								}
								summDiv.innerText = `Стоимость:${element.price * numDiv.innerText}₽`;	// выводим колличество_товара*цена_товара

								fetch("/system/updateToCart.php", {
												method: 'post',
												headers: {
													"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
												},
												body: `productId=${element.product_id}&productCount=${numDiv.innerText}`,
								})
							}
							if(filePhp == 'favor'){
								if(event.target.className == "cartDelProduct") {
									removeItemFromFavorAndCart(cartContent,element.name, element.image, element.product_id, filePhp, patch)
								}
								summDiv.innerText = `${element.price}`;	// выводим цена_товара
							}
						} 
							imgDiv.onclick = () => {
								let productId = imgDiv.parentNode.id;				
								fetch("/system/sessionFavorAndCart.php", {
									method: 'post',
									headers: {
										"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
									},
									body: `productIdCartAndFavor=${productId}`,
								})
								window.location.href = "/fullProduct";							
							}
						})
						if(filePhp=="cart") {
							const buttonToBuyFromCartEndFavor = document.createElement("button");
							buttonToBuyFromCartEndFavor.innerText = "Оформить заказ";
							buttonToBuyFromCartEndFavor.classList.add("input");
							cartContent.appendChild(buttonToBuyFromCartEndFavor);

							//########################			 	кнопка "Оформить заказ"	  			###########################
							buttonToBuyFromCartEndFavor.onclick = () => {	
								let checkboxArray = [];
								let products_found = document.querySelectorAll(".cartAndFavorCheckbox");
								products_found.forEach(prod => {
									if(prod.checked){
										checkboxArray.push(prod.getAttribute("data-id"));
									}
								})
								
								let checkboxArray_to_string = checkboxArray.join(", ");
								fetch("system/placeAnOrder.php", {
									method: 'post',
									headers: {
										"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
									},
									body: `checkboxArray_to_string=${checkboxArray_to_string}`,
								})
								.then(window.location.href = '/ordering')
								// .then(response => response.text())
								// .then(data => {console.log(data);})
							}					
						}

						if(filePhp=="favor") {
							const buttonFromFavoritesToCart = document.createElement("button");
							buttonFromFavoritesToCart.innerText = "Добавить в корзину";
							buttonFromFavoritesToCart.classList.add("input");
							cartContent.appendChild(buttonFromFavoritesToCart);

							//########################			 	кнопка "Добавить в корзину"	  		###########################
							buttonFromFavoritesToCart.onclick = () => {	
								let checkboxArray = [];
								let products_found = document.querySelectorAll(".cartAndFavorCheckbox");
								products_found.forEach(prod => {
									if(prod.checked){
										checkboxArray.push(prod.getAttribute("data-id"));
									}
								})
								
								let checkboxArray_to_string = checkboxArray.join(", ");
								console.log(checkboxArray_to_string);
								fetch("system/fromFavoritesToCart.php", {
									method: 'post',
									headers: {
										"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
									},
									body: `checkboxArray_to_string=${checkboxArray_to_string}`,
								})
								// .then(window.location.href = '/cart')
								.then(response => response.text())
								.then(data => {console.log(data);})
							}
						}					

						const selectAllButton = document.createElement("button");
						selectAllButton.innerText = "Выбрать все";
						selectAllButton.classList.add("input");
						cartContent.appendChild(selectAllButton);

						const deleteSelectedButton = document.createElement("button");
						deleteSelectedButton.innerText = "Удалить выбранное";
						deleteSelectedButton.classList.add("input");
						cartContent.appendChild(deleteSelectedButton);


//########################			 	кнопка "Выбрать все"	  			###########################
						selectAllButton.onclick = () => {
							let products_found = document.querySelectorAll(".cartAndFavorCheckbox");
							products_found.forEach(prod => {
								prod.checked = true;									
							} )
						}
//########################			 	кнопка "Удалить выбранное"	  		###########################
						deleteSelectedButton.onclick = () => {	
							let checkboxArray = [];
							let products_found = document.querySelectorAll(".cartAndFavorCheckbox");
							products_found.forEach(prod => {
								if(prod.checked){
									checkboxArray.push(prod.getAttribute("data-id"));								
								}
							})
							let checkboxString = checkboxArray.join(', ');
							delOrNot("Вы действительно хотите удалить выбранные товары?", cartContent, filePhp, checkboxString, patch, "/system/delFullToFavorAndCart.php");												
						}	
					}
				})
			}
}


// ############################################################################################################################################
// ###########################################                                              ###################################################
// ###########################################				ИСПОЛЬЗУЕТСЯ В	 				###################################################
// ###########################################				crockery.php,					###################################################
// ###########################################				interior.php,					###################################################
// ###########################################				collection.php					###################################################
// ###########################################       "функция для загрузки категории"       ###################################################
// ###########################################       		loadCategory()		        	###################################################
// ###########################################                                              ###################################################
// ############################################################################################################################################

function loadCategory(cat, productCat){
	fetch(`/system/changeToCategoryPage.php`, {
		method: 'post',
		headers: {
			"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
		},
		body: `tableName=${cat}`
		})                                        
	.then(response => response.json())                                  
	.then(data => {
		const content = document.getElementById("content");
		data.forEach(element => {
			// console.log(element);
			
			let subcategoryDiv = document.createElement("div");
			let subcategoryImg = document.createElement("img");
			let subcategoryText = document.createElement("div");

			subcategoryDiv.setAttribute("data-id",`${element.id}`);
			subcategoryImg.setAttribute("src",`../img1/${element.subcategoryImage}`);
			subcategoryText.innerText=`${element.subcategory}`;
			
			subcategoryDiv.classList.add("crockeryCard");
			subcategoryImg.classList.add("crockeryImg");
			subcategoryText.classList.add("crockeryText");

			subcategoryDiv.appendChild(subcategoryImg);
			subcategoryDiv.appendChild(subcategoryText);
			content.appendChild(subcategoryDiv);

			subcategoryDiv.onclick = () => {
				let subcategoryId = subcategoryDiv.getAttribute('data-id');		//получили id
					fetch("/system/getSubcategory.php", {
						method: 'post',
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
						},
						body: `subcategoryId=${subcategoryId}&productCat=${productCat}`,
					})
					.then(data=>
						{window.location.href = "/product"}
					)
			}
		})
	})
}




// ############################################################################################################################################
// ###########################################                                              ###################################################
// ###########################################				ИСПОЛЬЗУЕТСЯ В	 				###################################################
// ###########################################				product.php						###################################################
// ###########################################   "функция для вывода страницы продуктов"    ###################################################
// ###########################################       		displayProductPage()		    ###################################################
// ###########################################                                              ###################################################
// ############################################################################################################################################

function displayProductPage(pagePhp) {								//%%%%%%%%%%%%%%%%%%%%%%%%%% вывод товара на экран %%%%%%%%%%%%%%%%%%%%%%%%%%//
	fetch(`/system/${pagePhp}.php`)                                       
	.then(response => response.json())                                  
	.then(data => {		
		if(data==false){
			crockeryContent.innerText = "По вашему запросу ничего не найдено...";
			crockeryContent.classList = "crockeryProductDataFalse";
		}
		data.forEach(element => {
			let productDiv = document.createElement("div");								//родитель

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
if(getCookies('user')){
	let userCartArr = [];					
	let userCart = (async function() {
		const response = await fetch(`/system/whatIsInTheCart.php`);
		const post = await response.json();
		return post;
	})					
	userCart().then(res=>{
		res.forEach(element =>userCartArr.push(element.product_id));
		
		dysplayNoneOrBlock(userCartArr, element.id, dataDivAddToCartText, dataDivAddToCartBtn);
	})
}
else{
	dataDivAddToCartText.style.display = "none";
	dataDivAddToCartBtn.style.display = "none";
}


	//########################			 нажимаем кнопку добавить в корзину  		###########################	
	let switchState = false;		
	productDiv.onclick = event => {									
		if(event.target == dataDivAddToCartBtn) {
			addProductsToTheDatabase(element.id);
			switchState = true;
			dataDivAddToCartText.style.display = "block";
			dataDivAddToCartBtn.style.display = "none";
		}
	//########################			 	Выводим выбранный продукт	  			###########################	
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
	
	
	
	// ############################################################################################################################################
	// ###########################################                                              ###################################################
	// ###########################################				ИСПОЛЬЗУЕТСЯ В	 				###################################################
	// ###########################################				   admin.php					###################################################
	// ###########################################     "функция для страницы администратора"    ###################################################
	// ###########################################     			"для пользователей"			    ###################################################
	// ###########################################       		getUsersToAdmin()		        ###################################################
	// ###########################################                                              ###################################################
	// ############################################################################################################################################

function getUsersToAdmin() {					//%%%%%%%%%%%%%%%%%%%%%%%%%% вывод пользователей %%%%%%%%%%%%%%%%%%%%%%%%%%//	
	usersContainer.style.display = "grid";	
	categoryContainer.style.display = "none";	
	productContainer.style.display = "none";	
	adminContent.innerText = "";
	usersContainer.innerText = "";
	let admin_user_header = document.createElement("div");
	admin_user_header.innerHTML = `	<div>Login</div>
									<div>Имя</div>
									<div>Фамилия</div>
									<div>Подробнее</div>`;
	admin_user_header.classList.add("admin_user_header");								
	usersContainer.appendChild(admin_user_header);

	fetch(`/system/removeUserToAdmin.php`)                          //подключаемся к файлу /system/postbooks.php                
	.then(response => response.json())                  // в случае успеха преобразуем ответ от этого файла в json                 
	.then(data => {
		// console.log(data);
		let user_id_array = [];
		data.forEach(element =>{
			if(!user_id_array.includes(element.user_id)) {
				user_id_array.push(element.user_id);

				let userCont = document.createElement("div");
				userCont.setAttribute("data-id",`${element.user_id}`);
				userCont.classList.add("admin_user");

				let userShopping = document.createElement("div");
				userShopping.classList.add("userShopping");

				let loginUser = document.createElement("div");							//login
					let loginUserText = document.createTextNode(`${element.login}`); 
				let nameUser = document.createElement("div");							//name
					let nameUserText = document.createTextNode(`${element.user_name}`); 
				let lastNameUser = document.createElement("div");						//last name
					let lastNameUserText = document.createTextNode(`${element.lastname}`); 
				let userButton = document.createElement("button");
					let userButtonText = document.createTextNode("Подробнее");
					userButton.classList.add("input");

				loginUser.appendChild(loginUserText);
				nameUser.appendChild(nameUserText);
				lastNameUser.appendChild(lastNameUserText);
				userButton.appendChild(userButtonText);		

				userCont.appendChild(loginUser);
				userCont.appendChild(nameUser);
				userCont.appendChild(lastNameUser);
				userCont.appendChild(userButton);
				
				usersContainer.appendChild(userCont);
				adminContent.appendChild(usersContainer);

				userButton.onclick = () => {
					let user_id = userButton.parentNode.getAttribute("data-id");
					if(element.user_id == user_id) {
						fetch(`/system/removeUserAndProductToAdmin.php`, {
							method: 'post',
							headers: {
								"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
							},
							body: `userId=${element.user_id}`,
						})            
						.then(response => response.json())                  // в случае успеха преобразуем ответ от этого файла в json                 
						.then(data => {
							// console.log(data);
							adminUserShopping.innerText="";
							adminTableHeader.innerHTML = `	<div>img</div>
													<div>Название</div>
													<div>id</div>
													<div>Остаток</div>
													<div>Заказ</div>`;
							adminTableHeader.classList.add("adminTableHeader");								
							adminUserShopping.appendChild(adminTableHeader);

							data.forEach(element =>{								
								let productInfoContainer = document.createElement("div");
									productInfoContainer.classList.add("userShoppingProduct");
								let productImage = document.createElement("img");
									productImage.setAttribute("src",`../img1/${element.image.split(", ")[0]}`);
									productImage.classList.add("userShoppingProductImage");
								let productName = document.createElement("div");
									let productNameText = document.createTextNode(`${element.name}`);
									productName.appendChild(productNameText);
								let productId = document.createElement("div");
									let productIdText = document.createTextNode(`${element.product_id}`);
									productId.appendChild(productIdText);
								let productAmount = document.createElement("div");
									let productAmountText = document.createTextNode(`${element.amount}шт.`);
									productAmount.appendChild(productAmountText);
								let productCount = document.createElement("div");
									let productCountText = document.createTextNode(`${element.count}шт.`);
									productCount.appendChild(productCountText);

								productInfoContainer.appendChild(productImage);
								productInfoContainer.appendChild(productName);	
								productInfoContainer.appendChild(productId);	
								productInfoContainer.appendChild(productAmount);	
								productInfoContainer.appendChild(productCount);	
																	
								adminUserShopping.appendChild(productInfoContainer);	
								adminContent.appendChild(adminUserShopping);	
								usersContainer.style.display = "none";
								adminUserShopping.style.display = "grid";
							})
							let backButton = document.createElement("button");
							backButton.innerText = "Назад к списку пользователей"
							backButton.classList.add("input");
							backButton.id = "backButton";
							adminUserShopping.appendChild(backButton);

							backButton.onclick = () => {
								usersContainer.style.display = "grid";
								adminUserShopping.style.display = "none";
							}
						})
					}					
				}
			}	
		});
	})
}


// ############################################################################################################################################
// ###########################################                                              ###################################################
// ###########################################				ИСПОЛЬЗУЕТСЯ В	 				###################################################
// ###########################################				   admin.php					###################################################
// ###########################################     "функция для страницы администратора"    ###################################################
// ###########################################     			"для категорий"			    	###################################################
// ###########################################       		getCategoryToAdmin()		    ###################################################
// ###########################################                                              ###################################################
// ############################################################################################################################################
function getCategoryToAdmin() {					//%%%%%%%%%%%%%%%%%%%%%%%%%% вывод категорий %%%%%%%%%%%%%%%%%%%%%%%%%%//
	let dataArray = [];
	usersContainer.style.display = "none";
	categoryContainer.style.display = "grid";	
	productContainer.style.display = "none";
	adminContent.innerText = "";
	categoryContainer.innerText = "";
	let categoryHeader = document.createElement("div");
	categoryHeader.classList.add("categoryHeader");
		categoryHeader.innerHTML = `<div>id</div>
									<div>Картинка</div>
									<div>Название</div>
									<div>Таблица SQL</div>
									<div>Изменить</div>
									<div>Удалить</div>
									`;
		categoryContainer.appendChild(categoryHeader);
	fetch(`/system/removeCategoryToAdmin.php`)                          //подключаемся к файлу /system/postbooks.php                
	.then(response => response.json())                  // в случае успеха преобразуем ответ от этого файла в json                 
	.then(data => {
		data.forEach(element =>{
			dataArray[element.id] = element;
			let catCont = document.createElement("div");
			catCont.classList.add("catCont");
			catCont.id = element.id;
			let idCont = document.createElement("div");
				idCont.innerText = `${element.id}`;
			let categoryNameCont = document.createElement("div");
				categoryNameCont.innerText = `${element.categoryName}`;
			let categoryMicroImageCont = document.createElement("div");
				let categoryMicroImg = document.createElement("img");
				categoryMicroImg.setAttribute("src", `../img/${element.categoryMicroImage}`)
			let categoryTableNameCont = document.createElement("div");
				categoryTableNameCont.innerText = `${element.categoryTableName}`;
			let changeCategory = document.createElement("button");
				changeCategory.innerText = "Изменить";
				changeCategory.classList.add("input");
			let delCategory = document.createElement("button");
				delCategory.innerText = "Удалить";
				delCategory.classList.add("input");
			
			categoryMicroImageCont.appendChild(categoryMicroImg);
			catCont.appendChild(idCont);
			catCont.appendChild(categoryMicroImageCont);
			catCont.appendChild(categoryNameCont);
			catCont.appendChild(categoryTableNameCont);
			catCont.appendChild(changeCategory);
			catCont.appendChild(delCategory);

			categoryContainer.appendChild(catCont);
			catCont.onclick = (e) => {
				if(e.target == changeCategory){
					categoryContainer.style.display = "none";
					let changeCategory = document.createElement("form");
						changeCategory.classList.add("personalAccountContent");

					let changeCategoryIdInputParentDiv = document.createElement("div");
					let changeCategoryIdInputDiv = document.createElement("div");
					changeCategoryIdInputDiv.innerText = "id категории";
					let changeCategoryIdInput = document.createElement("input");
						changeCategoryIdInput.setAttribute("type","text");
						changeCategoryIdInput.setAttribute("value",`${catCont.id}`);
						changeCategoryIdInput.setAttribute("name",`cat_id`);
					changeCategoryIdInputParentDiv.appendChild(changeCategoryIdInputDiv);
					changeCategoryIdInputParentDiv.appendChild(changeCategoryIdInput);

					let changeCategoryImgInputParentDiv = document.createElement("div");
					let changeCategoryImgInputDiv = document.createElement("div");
					changeCategoryImgInputDiv.innerText = "Выберете картинку";
					let changeCategoryImgInput = document.createElement("input");
						changeCategoryImgInput.setAttribute("type","file");
						changeCategoryImgInput.setAttribute("accept","accept=image/*");
						changeCategoryImgInput.setAttribute("value",`${catCont.categoryMicroImage}`);
						changeCategoryImgInput.setAttribute("name",`picture`);
					changeCategoryImgInputParentDiv.appendChild(changeCategoryImgInputDiv);
					changeCategoryImgInputParentDiv.appendChild(changeCategoryImgInput);
					
					let changeCategoryNameInputParentDiv = document.createElement("div");
					let changeCategoryNameInputDiv = document.createElement("div");
					changeCategoryNameInputDiv.innerText = "Имя категории";
					let changeCategoryNameInput = document.createElement("input");
					changeCategoryNameInput.setAttribute("type","text");
					changeCategoryNameInput.setAttribute("value",`${dataArray[catCont.id].categoryName}`);
					changeCategoryNameInput.setAttribute("name",`cat_name`);
					changeCategoryNameInputParentDiv.appendChild(changeCategoryNameInputDiv);
					changeCategoryNameInputParentDiv.appendChild(changeCategoryNameInput);

					let changeCategoryTableInputParentDiv = document.createElement("div");
					let changeCategoryTableInputDiv = document.createElement("div");
					changeCategoryTableInputDiv.innerText = "Имя таблицы";
					let changeCategoryTableInput = document.createElement("input");
						changeCategoryTableInput.setAttribute("type","text");
						changeCategoryTableInput.setAttribute("value",`${dataArray[catCont.id].categoryTableName}`);
						changeCategoryTableInput.setAttribute("name",`cat_table`);
					changeCategoryTableInputParentDiv.appendChild(changeCategoryTableInputDiv);
					changeCategoryTableInputParentDiv.appendChild(changeCategoryTableInput);


					let changeCategorySubmit = document.createElement("input");
						changeCategorySubmit.setAttribute("type","submit");
						changeCategorySubmit.setAttribute("value",`Отправить`);
						changeCategorySubmit.setAttribute("name",`cat_send`);
						changeCategorySubmit.classList.add("input");
						changeCategorySubmit.style.width = "100%";

						changeCategory.appendChild(changeCategoryIdInputParentDiv);
						changeCategory.appendChild(changeCategoryImgInputParentDiv);
						changeCategory.appendChild(changeCategoryNameInputParentDiv);
						changeCategory.appendChild(changeCategoryTableInputParentDiv);
						changeCategory.appendChild(changeCategorySubmit);
						
						adminContent.appendChild(changeCategory);

					changeCategory.onsubmit = async(e) => {
						e.preventDefault();
						let response = await fetch(`/system/changeCategory.php`, {
							method: 'post',
							body: new FormData(changeCategory)
						});
						// let result = await response.text();
						window.location.href = "/admin";
					}
				}
				if(e.target == delCategory){
					delOrNot("Удалить категорию?", categoryContainer, "category", catCont.id, "/admin", "/system/adminDelCategory.php");
				}
			}
		})
		let addCategory = document.createElement("button");
			addCategory.classList.add("input");
			addCategory.innerText = "Добавить категорию";
			categoryContainer.appendChild(addCategory);
			adminContent.appendChild(categoryContainer);

			addCategory.onclick = () => {
				categoryContainer.style.display = "none";					
				let addCategoryForm = document.createElement("form");
					addCategoryForm.classList.add("personalAccountContent");

				let addCategoryIdInputParentDiv = document.createElement("div");
				let addCategoryIdInputDiv = document.createElement("div");
				addCategoryIdInputDiv.innerText = "id категории";
				let addCategoryIdInput = document.createElement("input");
					addCategoryIdInput.setAttribute("type","text");
					addCategoryIdInput.setAttribute("name",`cat_id`);
				addCategoryIdInputParentDiv.appendChild(addCategoryIdInputDiv);
				addCategoryIdInputParentDiv.appendChild(addCategoryIdInput);

				let addCategoryImgInputParentDiv = document.createElement("div");
				let addCategoryImgInputDiv = document.createElement("div");
				addCategoryImgInputDiv.innerText = "Выберете картинку";
				let addCategoryImgInput = document.createElement("input");
					addCategoryImgInput.setAttribute("type","file");
					addCategoryImgInput.setAttribute("accept","accept=image/*");
					addCategoryImgInput.setAttribute("name",`picture`);
				addCategoryImgInputParentDiv.appendChild(addCategoryImgInputDiv);
				addCategoryImgInputParentDiv.appendChild(addCategoryImgInput);
				
				let addCategoryNameInputParentDiv = document.createElement("div");
				let addCategoryNameInputDiv = document.createElement("div");
				addCategoryNameInputDiv.innerText = "Имя категории";
				let addCategoryNameInput = document.createElement("input");
				addCategoryNameInput.setAttribute("type","text");
				addCategoryNameInput.setAttribute("name",`cat_name`);
				addCategoryNameInputParentDiv.appendChild(addCategoryNameInputDiv);
				addCategoryNameInputParentDiv.appendChild(addCategoryNameInput);

				let addCategoryTableInputParentDiv = document.createElement("div");
				let addCategoryTableInputDiv = document.createElement("div");
				addCategoryTableInputDiv.innerText = "Имя таблицы";
				let addCategoryTableInput = document.createElement("input");
					addCategoryTableInput.setAttribute("type","text");
					addCategoryTableInput.setAttribute("name",`cat_table`);
				addCategoryTableInputParentDiv.appendChild(addCategoryTableInputDiv);
				addCategoryTableInputParentDiv.appendChild(addCategoryTableInput);

				let addCategorySubmit = document.createElement("input");
					addCategorySubmit.setAttribute("type","submit");
					addCategorySubmit.setAttribute("value",`Отправить`);
					addCategorySubmit.setAttribute("name",`cat_send`);
					addCategorySubmit.classList.add("input");
					addCategorySubmit.style.width = "100%";

					addCategoryForm.appendChild(addCategoryImgInputParentDiv);
					addCategoryForm.appendChild(addCategoryNameInputParentDiv);
					addCategoryForm.appendChild(addCategoryTableInputParentDiv);
					addCategoryForm.appendChild(addCategorySubmit);
					
					adminContent.appendChild(addCategoryForm);

					addCategoryForm.onsubmit = async(e) => {
					e.preventDefault();
					let response = await fetch(`/system/addCategory.php`, {
						method: 'post',
						body: new FormData(addCategoryForm)
					});
					window.location.href = "/admin";
				}
			}
		})
	}			



// ############################################################################################################################################
// ###########################################                                              ###################################################
// ###########################################				ИСПОЛЬЗУЕТСЯ В	 				###################################################
// ###########################################				   admin.php					###################################################
// ###########################################     "функция для страницы администратора"    ###################################################
// ###########################################     			"для товаров"			    	###################################################
// ###########################################       		getProductToAdmin()		    	###################################################
// ###########################################                                              ###################################################
// ############################################################################################################################################
function getProductToAdmin() {					//%%%%%%%%%%%%%%%%%%%%%%%%%% вывод товаров %%%%%%%%%%%%%%%%%%%%%%%%%%//
	adminContent.innerText = "";
	usersContainer.style.display = "none";	
	categoryContainer.style.display = "none";	
	productContainer.style.display = "grid";
	productContainer.innerText = "";

	fetch(`/system/removeProductToAdmin.php`)                                         
	.then(response => response.json())                           
	.then(data => {
		let productArray = [];
		let productAddButton = document.createElement("button");
			productAddButton.innerText = "Добавить новый товар";
			productAddButton.classList.add("input");
			productAddButton.style.width = "100%";
		let productHeader = document.createElement("div");
		productHeader.innerHTML = 	`<div>id</div>
									<div>img</div>
									<div>product</div>
									<div>amount</div>
									<div>btn</div>
									<div>del</div>
									`;
		productHeader.classList.add("productHeader")
		let displayInformationAboutAllProducts = document.createElement("div");
		displayInformationAboutAllProducts.appendChild(productAddButton);
		displayInformationAboutAllProducts.appendChild(productHeader);
		let displayInformationAboutFullProducts = document.createElement("div");
		displayInformationAboutFullProducts.classList.add("displayInformationAboutFullProducts");
		// )))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))(((((((((((((((((((((((())))))))))))))))))))))))
		productAddButton.onclick = () => {
			let imgArrFull = [];
			adminContent.innerText = "";															//чистим экран
			let newProductForm = document.createElement("form");									//создаем форму
			newProductForm.classList.add("personalAccountContent");
			newProductForm.setAttribute("method", "post");
			newProductForm.setAttribute("action", "");

			for(let i=0;i<6;i++){																	//создаем input(type="file") = 6 штук
				let new_img_parent_div = document.createElement("div");
				let new_img_div = document.createElement("div");
				new_img_div.innerText = "Выберете картинку: ";
				let new_img = document.createElement("input");
				new_img.setAttribute("type", "file");
				new_img.setAttribute("name", `i${i}`);
				new_img.classList.add("admin_redact_product_page_img");
				new_img.id = `i${i}`;
				new_img_parent_div.appendChild(new_img_div)
				new_img_parent_div.appendChild(new_img)
				newProductForm.appendChild(new_img_parent_div);
			}
			let input_array = [																		//создаем массив для input
				["name","text","product__name"],
				["name_url","text","name_url"],
				["category","number","category"],
				["subcategory","number","subcategory"],
				["price","number","price"],
				["amount","number","amount"],
				["table_name","text","table_name"]
			];
			input_array.forEach(el =>{																//создаем input
				let new_input_parent_div = document.createElement("div");
				let new_input_div = document.createElement("div");
				new_input_div.innerText = `${el[0]}: `;
				let new_input = document.createElement("input");
				new_input.setAttribute("name", `${el[0]}`);
				new_input.id = `${el[2]}`;
				new_input.setAttribute("type", `${el[1]}`);
				new_input_parent_div.appendChild(new_input_div);
				new_input_parent_div.appendChild(new_input);
				newProductForm.appendChild(new_input_parent_div);
			});
			
			let new_input_description_parent_div = document.createElement("div");
				let full_product_redact_input_description_div = document.createElement("div");
				full_product_redact_input_description_div.innerText = "description: ";
			let full_product_redact_description = document.createElement("textarea");
				full_product_redact_description.setAttribute("name", "description");
				full_product_redact_description.id = "description";

				let new_product_send_button = document.createElement("button");
				new_product_send_button.innerText = "Отправить";
				new_product_send_button.classList.add("input");
				new_product_send_button.style.width = "100%";

				new_input_description_parent_div.appendChild(full_product_redact_input_description_div);
				new_input_description_parent_div.appendChild(full_product_redact_description);
				newProductForm.appendChild(new_input_description_parent_div);
				newProductForm.appendChild(new_product_send_button);
			
				adminContent.appendChild(newProductForm);

			newProductForm.onsubmit  = async(e) => {
				e.preventDefault();
				let input_img_arr = document.querySelectorAll(".admin_redact_product_page_img");
				input_img_arr.forEach(el => {
					let arrayImage = el.value.replace("C:\\fakepath\\", "");
					if(imgArrFull.indexOf(arrayImage) == -1 && arrayImage != ""){
						imgArrFull.push(arrayImage);	
					}
				});
				// console.log(imgArrFull);
				let imgArrFullToString = imgArrFull.join(', ');
				// console.log(imgArrFullToString);
				fetch(`/system/adminCreateProduct.php`, {
					method: 'post',
					headers: {
						"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
					},
					body:  `name=${product__name.value}&name_url=${name_url.value}&category=${category.value}&subcategory=${subcategory.value}&price=${price.value}&description=${description.value}&amount=${amount.value}&image=${imgArrFullToString}&table_name=${table_name.value}`									
				})            
				.then(window.location.href = "/admin")
			}					
		}

		data.forEach(element =>{
			productArray[element.id] = element;
			let displayProductInformation = document.createElement("div");
				displayProductInformation.classList.add("adminDisplayProductInformation");
			let product_id = document.createElement("div");
				product_id.innerText = `${element.id}`;
			let product_name = document.createElement("div");
				product_name.innerText = `${element.name}`;
			let product_btn = document.createElement("button");
				product_btn.innerText = "see";
				product_btn.classList.add("input");
			let product_btn_del = document.createElement("button");
				product_btn_del.innerText = "del";
				product_btn_del.classList.add("input");
			let product_amount = document.createElement("div");
				product_amount.innerText = `${element.amount}`;
			let product_image = document.createElement("img");
				let imgArr = element.image.split(", ");
				product_image.setAttribute("src", `../img1/${imgArr[0]}`);
				product_image.classList.add("userShoppingProductImage");
			let product_table_name = document.createElement("div");
				product_table_name.innerText = `${element.table_name}`;
			
			displayProductInformation.appendChild(product_id);
			displayProductInformation.appendChild(product_image);
			displayProductInformation.appendChild(product_name);
			
			displayProductInformation.appendChild(product_amount);
			displayProductInformation.appendChild(product_btn);
			displayProductInformation.appendChild(product_btn_del);
			displayInformationAboutAllProducts.appendChild(displayProductInformation);
			productContainer.appendChild(displayInformationAboutAllProducts);
			adminContent.appendChild(productContainer);

			product_btn_del.onclick = () => {
				// console.log(element.id);
				delOrNot("Удалить товар?", productContainer, "product", element.id, "/admin", "/system/adminDelCategory.php");
			}

			product_btn.onclick = () => {
				displayInformationAboutAllProducts.style.display = "none";
				let full_product_img_parent = document.createElement("div");
					full_product_img_parent.classList.add("full_product_img_parent");
				let full_product_data_parent = document.createElement("div");
				let full_product_descripption_parent = document.createElement("div");
				
				let full_product_id = document.createElement("div");
				full_product_id.innerText = `id:  ${productArray[element.id].id}`;
				let full_product_name = document.createElement("div");
				full_product_name.innerText = `название:  ${productArray[element.id].name}`;
				let full_product_name_url = document.createElement("div");
				full_product_name_url.innerText = `url:  ${productArray[element.id].name_url}`;
				let full_product_category = document.createElement("div");
					full_product_category.innerText = `категория:  ${productArray[element.id].category}`;
				let full_product_subcategory = document.createElement("div");
					full_product_subcategory.innerText = `подкатегория:  ${productArray[element.id].subcategory}`;
				let full_product_price = document.createElement("div");
					full_product_price.innerText = `цена:  ${productArray[element.id].price}`;
				let full_product_amount = document.createElement("div");
					full_product_amount.innerText = `колличество:  ${productArray[element.id].amount}`;
				let full_product_description = document.createElement("div");
					full_product_description.innerText = `описание:  ${productArray[element.id].description}`;
				let full_product_tableName = document.createElement("div");
					full_product_tableName.innerText = `таблица:  ${productArray[element.id].table_name}`;

				let imgArrFull = productArray[element.id].image.split(", ");		//массив содержит все картинки
				imgArrFull.forEach(el =>{
					let full_product_image = document.createElement("img");
					full_product_image.setAttribute("src", `../img1/${el}`);
					full_product_image.classList.add("full_product_image");
					full_product_img_parent.appendChild(full_product_image);
				})

				let full_product_table_name = document.createElement("div");
					full_product_table_name.innerText = productArray[element.id].table_name;
				let full_product_back_button = document.createElement("button");
					full_product_back_button.innerText = "Назад";
					full_product_back_button.classList.add("input");					
					full_product_back_button.style.width = "100%";					
				let full_product_redact_button = document.createElement("button");
					full_product_redact_button.innerText = "Редактировать";
					full_product_redact_button.classList.add("input");					
					full_product_redact_button.style.width = "100%";					
				
				full_product_data_parent.appendChild(full_product_id);
				full_product_data_parent.appendChild(full_product_name);
				full_product_data_parent.appendChild(full_product_name_url);
				full_product_data_parent.appendChild(full_product_category);
				full_product_data_parent.appendChild(full_product_subcategory);
				full_product_data_parent.appendChild(full_product_price);
				full_product_data_parent.appendChild(full_product_amount);
				full_product_data_parent.appendChild(full_product_description);
				full_product_data_parent.appendChild(full_product_tableName);
				
				full_product_descripption_parent.appendChild(full_product_img_parent);
				full_product_descripption_parent.appendChild(full_product_data_parent);
				full_product_descripption_parent.appendChild(full_product_back_button);
				full_product_descripption_parent.appendChild(full_product_redact_button);
				
				productContainer.appendChild(full_product_descripption_parent);
				
				full_product_back_button.onclick = () => {
					displayInformationAboutAllProducts.style.display = "block";
					full_product_descripption_parent.style.display = "none";
				}
				full_product_redact_button.onclick = () => {
					full_product_descripption_parent.style.display = "none";

					let full_product_descripption_parent_redact = document.createElement("div");
					let full_product_descripption_parent_redact_form = document.createElement("form");
					full_product_descripption_parent_redact_form.classList.add("personalAccountContent");
					full_product_descripption_parent_redact_form.setAttribute("method", "post");
					full_product_descripption_parent_redact_form.setAttribute("action", "");
					let full_product_descripption_parent_redact_img_arr = document.createElement("div");
					full_product_descripption_parent_redact_img_arr.classList.add("full_product_descripption_parent_redact_img_arr");
					
					imgArrFull.forEach(el =>{
						let full_product_descripption_parent_redact_image = document.createElement("img");
						full_product_descripption_parent_redact_image.setAttribute("src", `../img1/${el}`);
						full_product_descripption_parent_redact_image.classList.add("full_product_image");
						full_product_descripption_parent_redact_img_arr.appendChild(full_product_descripption_parent_redact_image);
					})
					full_product_descripption_parent_redact.appendChild(full_product_descripption_parent_redact_img_arr);

					for(let i=0;i<6;i++){
						let full_product_redact_img_parent_div = document.createElement("div");
						let full_product_redact_img_div = document.createElement("div");
						full_product_redact_img_div.innerText = "Выберете картинку: ";
						let full_product_redact_img = document.createElement("input");
						full_product_redact_img.setAttribute("type", "file");
						full_product_redact_img.setAttribute("name", `i${i}`);
						full_product_redact_img.classList.add("admin_redact_product_page_img");
						full_product_redact_img.id = `i${i}`;
						full_product_redact_img_parent_div.appendChild(full_product_redact_img_div)
						full_product_redact_img_parent_div.appendChild(full_product_redact_img)
						full_product_descripption_parent_redact_form.appendChild(full_product_redact_img_parent_div);
					}
					let input_array = [
						[`${productArray[element.id].name}`,"name","text","product__name"],
						[`${productArray[element.id].name_url}`,"name_url","text","name_url"],
						[`${productArray[element.id].category}`,"category","number","category"],
						[`${productArray[element.id].subcategory}`,"subcategory","number","subcategory"],
						[`${productArray[element.id].price}`,"price","number","price"],
						[`${productArray[element.id].amount}`,"amount","number","amount"],
						[`${productArray[element.id].table_name}`,"table_name","text","table_name"]
					];
					input_array.forEach(el =>{
						let full_product_redact_input_parent_div = document.createElement("div");
						let full_product_redact_input_div = document.createElement("div");
						full_product_redact_input_div.innerText = `${el[1]}: `;
						let full_product_redact_name = document.createElement("input");
						full_product_redact_name.setAttribute("value", `${el[0]}`);
						full_product_redact_name.setAttribute("name", `${el[1]}`);
						full_product_redact_name.id = `${el[3]}`;
						full_product_redact_name.setAttribute("type", `${el[2]}`);
						full_product_redact_input_parent_div.appendChild(full_product_redact_input_div);
						full_product_redact_input_parent_div.appendChild(full_product_redact_name);
						full_product_descripption_parent_redact_form.appendChild(full_product_redact_input_parent_div);
					});

					
					let full_product_redact_input_description_parent_div = document.createElement("div");
						let full_product_redact_input_description_div = document.createElement("div");
						full_product_redact_input_description_div.innerText = "description: ";
					let full_product_redact_description = document.createElement("textarea");
						full_product_redact_description.setAttribute("name", "description");
						full_product_redact_description.id = "description";
						full_product_redact_description.innerText = `${productArray[element.id].description}`;

						let full_product_send_button = document.createElement("button");
						full_product_send_button.innerText = "Отправить";
						full_product_send_button.classList.add("input");
						full_product_send_button.style.width = "100%";

						full_product_redact_input_description_parent_div.appendChild(full_product_redact_input_description_div);
						full_product_redact_input_description_parent_div.appendChild(full_product_redact_description);
						full_product_descripption_parent_redact_form.appendChild(full_product_redact_input_description_parent_div);
						full_product_descripption_parent_redact_form.appendChild(full_product_send_button);
						full_product_descripption_parent_redact.appendChild(full_product_descripption_parent_redact_form);
					
					productContainer.appendChild(full_product_descripption_parent_redact);

					full_product_descripption_parent_redact_form.onsubmit  = async(e) => {
						e.preventDefault();
						let input_img_arr = document.querySelectorAll(".admin_redact_product_page_img");
						input_img_arr.forEach(el => {
							let arrayImage = el.value.replace("C:\\fakepath\\", "");
							if(imgArrFull.indexOf(arrayImage) == -1 && arrayImage != ""){
								imgArrFull.push(arrayImage);	
							}
						});
						// console.log(imgArrFull);
						let imgArrFullToString = imgArrFull.join(', ');
						// console.log(imgArrFullToString);
						fetch(`/system/adminUpdateProduct.php`, {
							method: 'post',
							headers: {
								"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
							},
							body:  `id=${productArray[element.id].id}&name=${product__name.value}&name_url=${name_url.value}&category=${category.value}&subcategory=${subcategory.value}&price=${price.value}&description=${description.value}&amount=${amount.value}&image=${imgArrFullToString}&table_name=${table_name.value}`									
						})            
						.then(window.location.href = "/admin")
					}
					
					full_product_descripption_parent_redact_img_arr.onclick = (eventImg) => {
						let del_img = eventImg.target.src.replace("http://ceramicshop/img1/", "");//картинка которую удаляем
						const popupMenu = document.createElement('div');				//сама менюшка
						const popupMenuParent = document.createElement('div');			//родитель
						const popupMenuQuestion = document.createElement('div');				//вопрос
						const ButtonDiv = document.createElement('div');				
							const popupMenuButtonNo = document.createElement('button');				//кнопка 'нет'
							const popupMenuButtonYes = document.createElement('button');			//кнопка 'да'

						popupMenuQuestion.innerText = "Удалить картинку?";
						popupMenuButtonNo.innerText = "Нет";
						popupMenuButtonYes.innerText = "Да";

						popupMenuParent.classList.add('popupMenuParent');
						popupMenu.classList.add('popupMenu');
						ButtonDiv.classList.add('ButtonDiv');

						popupMenu.appendChild(popupMenuQuestion);
						ButtonDiv.appendChild(popupMenuButtonNo);
						ButtonDiv.appendChild(popupMenuButtonYes);
						popupMenu.appendChild(ButtonDiv);

						popupMenuParent.appendChild(popupMenu);
						productContainer.appendChild(popupMenuParent);

						popupMenuButtonNo.onclick = () => {			//если нажали нет
							popupMenuParent.parentNode.removeChild(popupMenuParent);		//удаляем контекстное меню
						}
						popupMenuButtonYes.onclick = () => {			//если нажали да
							let conf = confirm("Подтвердите действие");
							if(conf){
								let del_img_index = imgArrFull.indexOf(del_img);
								imgArrFull.splice(del_img_index, 1);
								full_product_descripption_parent_redact_img_arr.innerText = "";
								imgArrFull.forEach(el =>{
									let full_product_descripption_parent_redact_image = document.createElement("img");
									full_product_descripption_parent_redact_image.setAttribute("src", `../img1/${el}`);
									full_product_descripption_parent_redact_image.classList.add("full_product_image");
									full_product_descripption_parent_redact_img_arr.appendChild(full_product_descripption_parent_redact_image);
								})
								popupMenuParent.parentNode.removeChild(popupMenuParent);		//удаляем контекстное меню
							}			
						}
					}
				}
			}		
		})
	})
}

// ############################################################################################################################################
// ###########################################                                              ###################################################
// ###########################################					ИСПОЛЬЗУЕТСЯ В	 			###################################################
// ###########################################				   ordering.php					###################################################
// ###########################################    	  "функция для оформления заказа"    	###################################################
// ###########################################       		 placingAnOrder()		    	###################################################
// ###########################################                                              ###################################################
// ############################################################################################################################################
function placingAnOrder(parent_div) {
	fetch("system/getOrderDetails.php")
	.then(response => response.json())                                  
	.then(data => { //console.log(data);
		const ordering_form = document.createElement("form");
		const ordering_div = document.createElement("div");
		let product_parent_div = document.createElement("div");
		let price_array = [];
		data.forEach(element=>{
			console.log(element);			
			let product_div = document.createElement("div");
			product_div.classList.add("product_div_ordering");
			let product_image_div = document.createElement("div");
				let product_image = document.createElement("img");
				product_image.setAttribute("src",`../img1/${element.image.split(", ")[0]}`);
				product_image.classList.add("userShoppingProductImage");
				product_image.style.padding = "5px";
				
				product_image_div.appendChild(product_image);
			let product_info = document.createElement("div");
				let product_name = document.createElement("div");
					product_name.innerText = `${element.name}`;
				let product_count_and_price = document.createElement("div");
					product_count_and_price.classList.add("product_count_and_price_ordering");
				let product_count = document.createElement("div");
					product_count.innerText = `Колличество: ${element.count}шт.`;
				let product_price = document.createElement("div");
					product_price.innerText = `Цена: ${element.price*element.count}₽`;

					price_array.push(element.price*element.count);

				product_count_and_price.appendChild(product_count);
				product_count_and_price.appendChild(product_price);
				product_info.appendChild(product_name);
				product_info.appendChild(product_count_and_price);
				
				product_div.appendChild(product_image_div);
				product_div.appendChild(product_info);

				product_parent_div.appendChild(product_div);
			})
			let result = price_array.reduce(function(a, b) {		//итоговая сумма
				return a + b;
			});
			
			let result_div = document.createElement("div");
			result_div.innerText = `Итого: ${result}₽`;
			product_parent_div.appendChild(result_div);

		ordering_div.appendChild(product_parent_div);
		ordering_form.appendChild(ordering_div);
		parent_div.appendChild(ordering_form);
		console.log(parent_div);
	
	
	
	
	})
	
}