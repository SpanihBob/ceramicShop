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
								const img = document.createElement('img');  				//картинка
						
							const infoDiv = document.createElement('div');  //
								const nameDiv = document.createElement('div');				//имя
									const delCrockeryDiv = document.createElement('div');	//удаление товара
									const summDiv = document.createElement('div');			//цена итоговая
									const amountDiv = document.createElement('div');		//кол-во
									const delDiv = document.createElement('button');		//del
									const numDiv = document.createElement('div');			//number
									const addDiv = document.createElement('button');		//add

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
							summDiv.innerText = `${element.price}₽`;
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
								summDiv.innerText = `${element.price}₽`;	// выводим цена_товара
							}
						} 
							imgDiv.onclick = () => {
								let productId = imgDiv.parentNode.id;
								window.location.href = `/fullProduct?fullProduct=${productId}`;							
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
								// console.log(checkboxArray_to_string);
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
				window.location.href = `/product?subcategoryId=${subcategoryId}&productCat=${productCat}`;
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
					let priceText = document.createTextNode(`Цена: ${element.price}₽`);

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
							window.location.href = `/fullProduct?fullProduct=${element.id}`;							        
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
							// console.log(data[0]);
							adminUserShopping.innerText="";
							adminTableHeader.innerHTML = `	<div>img</div>
													<div>Название</div>
													<div>id</div>
													<div>Остаток</div>
													<div>Заказ</div>`;
							adminTableHeader.classList.add("adminTableHeader");								
							adminUserShopping.appendChild(adminTableHeader);

							data.forEach(element => {
								// console.log(element.id);								
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
									let productCountText = document.createTextNode(`${element.summ}шт.`);
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
	usersContainer.style.display = "none";
	categoryContainer.style.display = "grid";	
	productContainer.style.display = "none";
	adminContent.innerText = "";
	categoryContainer.innerText = "";
	let addCategory = document.createElement("button");
	addCategory.classList.add("input");
	addCategory.innerText = "Добавить категорию";
	addCategory.style.margin = "5px 0"
	categoryContainer.appendChild(addCategory);

	let categoryHeader = document.createElement("div");
	categoryHeader.classList.add("categoryHeader");
		categoryHeader.innerHTML = `<div>id</div>
									<div>cat_img</div>
									<div>cat_name</div>
									<div>table_SQL</div>
									<div>sub_img</div>
									<div>sub_name</div>
									<div>btn</div>
									`;
									
		categoryContainer.appendChild(categoryHeader);
	fetch(`/system/removeCategoryToAdmin.php`)                          //подключаемся к файлу /system/postbooks.php                
	.then(response => response.json())                  // в случае успеха преобразуем ответ от этого файла в json                 
	.then(data => {
		// console.log(data);
		data.forEach(element =>{
			// console.log(element.id);
			// console.log(element);
			// dataArray[element.id] = element;
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
				let subcategoryMicroImageCont = document.createElement("div");
				let subcategoryMicroImg = document.createElement("img");
				subcategoryMicroImg.setAttribute("src", `../img1/${element.subcategoryImage}`);
			let subcategoryNameCont = document.createElement("div");
				subcategoryNameCont.innerText = `${element.subcategory}`;
			let change_del = document.createElement("div");
			change_del.classList.add("change_del");
			let changeCategory = document.createElement("button");
				changeCategory.innerText = "Изменить";
				changeCategory.classList.add("input");
			let delCategory = document.createElement("button");
				delCategory.innerText = "Удалить";
				delCategory.classList.add("input");
			
			categoryMicroImageCont.appendChild(categoryMicroImg);
			subcategoryMicroImageCont.appendChild(subcategoryMicroImg);
			catCont.appendChild(idCont);
			catCont.appendChild(categoryMicroImageCont);
			catCont.appendChild(categoryNameCont);
			catCont.appendChild(categoryTableNameCont);
			catCont.appendChild(subcategoryMicroImageCont);
			catCont.appendChild(subcategoryNameCont);
			change_del.appendChild(changeCategory);
			change_del.appendChild(delCategory);
			catCont.appendChild(change_del);

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
					changeCategoryImgInputDiv.innerText = "Выберете картинку для категории";
					let changeCategoryImgInput = document.createElement("input");
						changeCategoryImgInput.setAttribute("type","file");
						changeCategoryImgInput.setAttribute("accept","accept=image/*");
						changeCategoryImgInput.setAttribute("value",`${catCont.categoryMicroImage}`);
						changeCategoryImgInput.setAttribute("name",`picture`);
					changeCategoryImgInputParentDiv.appendChild(changeCategoryImgInputDiv);
					changeCategoryImgInputParentDiv.appendChild(changeCategoryImgInput);
					
					let changeSubcategoryImgInputParentDiv = document.createElement("div");
					let changeSubcategoryImgInputDiv = document.createElement("div");
					changeSubcategoryImgInputDiv.innerText = "Выберете картинку для подкатегории";
					let changeSubcategoryImgInput = document.createElement("input");
						changeSubcategoryImgInput.setAttribute("type","file");
						changeSubcategoryImgInput.setAttribute("accept","accept=image/*");
						changeSubcategoryImgInput.setAttribute("value",`${catCont.subcategoryImage}`);
						changeSubcategoryImgInput.setAttribute("name",`sub_picture`);
					changeSubcategoryImgInputParentDiv.appendChild(changeSubcategoryImgInputDiv);
					changeSubcategoryImgInputParentDiv.appendChild(changeSubcategoryImgInput);
					
					let changeCategoryNameInputParentDiv = document.createElement("div");
					let changeCategoryNameInputDiv = document.createElement("div");
					changeCategoryNameInputDiv.innerText = "Имя категории";
					let changeCategoryNameInput = document.createElement("input");
					changeCategoryNameInput.setAttribute("type","text");
					changeCategoryNameInput.setAttribute("value",`${element.categoryName}`);
					changeCategoryNameInput.setAttribute("name",`cat_name`);
					changeCategoryNameInputParentDiv.appendChild(changeCategoryNameInputDiv);
					changeCategoryNameInputParentDiv.appendChild(changeCategoryNameInput);

					let changeCategoryTableInputParentDiv = document.createElement("div");
					let changeCategoryTableInputDiv = document.createElement("div");
					changeCategoryTableInputDiv.innerText = "Имя таблицы";
					let changeCategoryTableInput = document.createElement("input");
						changeCategoryTableInput.setAttribute("type","text");
						changeCategoryTableInput.setAttribute("value",`${element.categoryTableName}`);
						changeCategoryTableInput.setAttribute("name",`cat_table`);
					changeCategoryTableInputParentDiv.appendChild(changeCategoryTableInputDiv);
					changeCategoryTableInputParentDiv.appendChild(changeCategoryTableInput);
					
					let changeSubcategoryNameInputParentDiv = document.createElement("div");
					let changeSubcategoryNameInputDiv = document.createElement("div");
					changeSubcategoryNameInputDiv.innerText = "Имя подкатегории";
					let changeSubcategoryNameInput = document.createElement("input");
					changeSubcategoryNameInput.setAttribute("type","text");
					changeSubcategoryNameInput.setAttribute("value",`${element.subcategory}`);
					changeSubcategoryNameInput.setAttribute("name",`subcat_name`);
					changeSubcategoryNameInputParentDiv.appendChild(changeSubcategoryNameInputDiv);
					changeSubcategoryNameInputParentDiv.appendChild(changeSubcategoryNameInput);


					let changeCategorySubmit = document.createElement("input");
						changeCategorySubmit.setAttribute("type","submit");
						changeCategorySubmit.setAttribute("value",`Отправить`);
						changeCategorySubmit.setAttribute("name",`cat_send`);
						changeCategorySubmit.classList.add("input");
						changeCategorySubmit.style.width = "100%";

						changeCategory.appendChild(changeCategoryIdInputParentDiv);
						changeCategory.appendChild(changeCategoryImgInputParentDiv);
						changeCategory.appendChild(changeSubcategoryImgInputParentDiv);
						changeCategory.appendChild(changeCategoryNameInputParentDiv);
						changeCategory.appendChild(changeCategoryTableInputParentDiv);
						changeCategory.appendChild(changeSubcategoryNameInputParentDiv);
						changeCategory.appendChild(changeCategorySubmit);
						
						adminContent.appendChild(changeCategory);

					changeCategory.onsubmit = async(e) => {
						e.preventDefault();
						let response = await fetch(`/system/changeCategory.php`, {
							method: 'post',
							body: new FormData(changeCategory)
						});
						// let result = await response.text();
						// console.log(result);
						window.location.href = "/admin";
					}
				}
				if(e.target == delCategory){
					delOrNot("Удалить категорию?", categoryContainer, "category", catCont.id, "/admin", "/system/adminDelCategory.php");
				}
			}
		})
		
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
					addCategoryImgInputDiv.innerText = "Выберете картинку для категории";
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

				let addSubcategoryImgInputParentDiv = document.createElement("div");
				let addSubcategoryImgInputDiv = document.createElement("div");
					addSubcategoryImgInputDiv.innerText = "Выберете картинку для подкатегории";
				let addSubcategoryImgInput = document.createElement("input");
					addSubcategoryImgInput.setAttribute("type","file");
					addSubcategoryImgInput.setAttribute("accept","accept=image/*");
					addSubcategoryImgInput.setAttribute("name",`subcat_picture`);
					addSubcategoryImgInputParentDiv.appendChild(addSubcategoryImgInputDiv);
					addSubcategoryImgInputParentDiv.appendChild(addSubcategoryImgInput);
					
				let addSubcategoryNameInputParentDiv = document.createElement("div");
				let addSubcategoryNameInputDiv = document.createElement("div");
					addSubcategoryNameInputDiv.innerText = "Имя подкатегории";
				let addSubcategoryNameInput = document.createElement("input");
					addSubcategoryNameInput.setAttribute("type","text");
					addSubcategoryNameInput.setAttribute("name",`subcat_name`);
					addSubcategoryNameInputParentDiv.appendChild(addSubcategoryNameInputDiv);
					addSubcategoryNameInputParentDiv.appendChild(addSubcategoryNameInput);

				let addCategorySubmit = document.createElement("input");
					addCategorySubmit.setAttribute("type","submit");
					addCategorySubmit.setAttribute("value",`Отправить`);
					addCategorySubmit.setAttribute("name",`cat_send`);
					addCategorySubmit.classList.add("input");
					addCategorySubmit.style.width = "100%";

					addCategoryForm.appendChild(addCategoryImgInputParentDiv);
					addCategoryForm.appendChild(addSubcategoryImgInputParentDiv);
					addCategoryForm.appendChild(addCategoryNameInputParentDiv);
					addCategoryForm.appendChild(addCategoryTableInputParentDiv);
					addCategoryForm.appendChild(addSubcategoryNameInputParentDiv);
					addCategoryForm.appendChild(addCategorySubmit);
					
					adminContent.appendChild(addCategoryForm);

					addCategoryForm.onsubmit = async(e) => {
					e.preventDefault();
					let response = await fetch(`/system/addCategory.php`, {
						method: 'post',
						body: new FormData(addCategoryForm)
					});
					let result = await response.text();
					console.log(result);
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
function getProductToAdmin() {											//%%%%%%%%%%%%%%%%%%%%%%%%%% вывод товаров %%%%%%%%%%%%%%%%%%%%%%%%%%//
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
		productHeader.classList.add("productHeader");
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

// ////////////////////////////////////



// ...............................Создание нового товара............................

			let input_array = [																		//создаем массив для input
				["Название","text","product__name"],
				["Цена","number","price"],
				["Остаток","number","amount"]
			];
			input_array.forEach(el=>{																//создаем input
				let new_input_parent_div = document.createElement("div");
				let new_input_div = document.createElement("div");
				new_input_div.innerText = `${el[0]}: `;
				let new_input = document.createElement("input");
				new_input.id = `${el[2]}`;
				new_input.setAttribute("type", `${el[1]}`);
				new_input_parent_div.appendChild(new_input_div);
				new_input_parent_div.appendChild(new_input);
				newProductForm.appendChild(new_input_parent_div);
			});


			let category_parent_div = document.createElement("div");
			let new_category_div = document.createElement("div");
			new_category_div.innerText = `Категория: `;
			let new_select_category = document.createElement("select");
			new_select_category.id = `category`;

			let first_options = document.createElement("option");
			first_options.innerText = "--Выберете категорию--";
			new_select_category.appendChild(first_options);

				let subcategory_parent_div = document.createElement("div");
				let new_subcategory_div = document.createElement("div");
				new_subcategory_div.innerText = `Подкатегория: `;
				let new_select_subcategory = document.createElement("select");
				new_select_subcategory.id = `subcategory`;

				let first_subcategory_options = document.createElement("option");
				first_subcategory_options.innerText = "--Выберете Подкатегорию--";
				new_select_subcategory.appendChild(first_subcategory_options);
				
				
				fetch(`/system/getCat.php`)                                         
				.then(response => response.json())                           
				.then(data => {
					let data_array = [];
					let data_array_2 = [];
					data.forEach(element => {
						if(data_array.includes(element.categoryName)==false){							
							data_array.push(element.categoryName);
							data_array_2.push([element.categoryName, element.categoryId]);
							let new_options = document.createElement("option");
							new_options.innerText = `${element.categoryName}`;
							new_select_category.appendChild(new_options);
						}
					});
					
					let subcategory_data_array = [];
					new_select_category.onchange = () => {
						subcategory_data_array = [];
						while (new_select_subcategory.firstChild) {									//удаление всех дочерних элементов
							new_select_subcategory.removeChild(new_select_subcategory.firstChild);
						}
						
						let first_subcategory_options = document.createElement("option");
						first_subcategory_options.innerText = "--Выберете Подкатегорию--";
						new_select_subcategory.appendChild(first_subcategory_options);
						
						data.forEach(element => {
							if(element.categoryName == new_select_category.value){
								subcategory_data_array.push([element.subcategory, element.id]);
								// console.log(element.subcategory);
								let new_options_subcategory = document.createElement("option");
								new_options_subcategory.innerText = `${element.subcategory}`;
								new_select_subcategory.appendChild(new_options_subcategory);
							}
						})					
						console.log(subcategory_data_array);
					} 

					category_parent_div.appendChild(new_category_div);
					category_parent_div.appendChild(new_select_category);
					newProductForm.appendChild(category_parent_div);
					
					subcategory_parent_div.appendChild(new_subcategory_div);
					subcategory_parent_div.appendChild(new_select_subcategory);
					newProductForm.appendChild(subcategory_parent_div);

					
					let new_input_description_parent_div = document.createElement("div");
					let full_product_redact_input_description_div = document.createElement("div");
					full_product_redact_input_description_div.innerText = "Описание: ";
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
						let category_data = "";
						data_array_2.forEach(el=>{
							if(el.includes(new_select_category.value)==true){
								category_data = el[1];
							}
						})
						
						let subcategory_data = '';
						subcategory_data_array.forEach(el=>{
							if(el.includes(new_select_subcategory.value)==true){
								subcategory_data = el[1];
							}
						})
						console.log(category_data);
						console.log(subcategory_data);
						let input_img_arr = document.querySelectorAll(".admin_redact_product_page_img");
						input_img_arr.forEach(el => {
							let arrayImage = el.value.replace("C:\\fakepath\\", "");
							if(imgArrFull.indexOf(arrayImage) == -1 && arrayImage != ""){
								imgArrFull.push(arrayImage);	
							}
						});
						let imgArrFullToString = imgArrFull.join(', ');
						fetch(`/system/adminCreateProduct.php`, {
							method: 'post',
					headers: {
						"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
					},
					body:  `name=${product__name.value}&category=${category_data}&subcategory=${subcategory_data}&price=${price.value}&description=${description.value}&amount=${amount.value}&image=${imgArrFullToString}`									
				})            
				.then(data =>{
					alert("Товар добавлен");
					window.location.href = "/admin";
				})					
			}					
		})
		///////////////////////////
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
				delOrNot("Удалить товар?", productContainer, "product", element.id, "/admin", "/system/adminDelProduct.php");
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
				let full_product_category = document.createElement("div");
					full_product_category.innerText = `категория:  ${productArray[element.id].category}`;
				let full_product_subcategory = document.createElement("div");
					full_product_subcategory.innerText = `подкатегория:  ${productArray[element.id].subcategory}`;
				let full_product_price = document.createElement("div");
					full_product_price.innerText = `цена:  ${productArray[element.id].price}₽`;
				let full_product_amount = document.createElement("div");
					full_product_amount.innerText = `колличество:  ${productArray[element.id].amount}`;
				let full_product_description = document.createElement("div");
					full_product_description.innerText = `описание:  ${productArray[element.id].description}`;

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
				full_product_data_parent.appendChild(full_product_category);
				full_product_data_parent.appendChild(full_product_subcategory);
				full_product_data_parent.appendChild(full_product_price);
				full_product_data_parent.appendChild(full_product_amount);
				full_product_data_parent.appendChild(full_product_description);
				
				full_product_descripption_parent.appendChild(full_product_img_parent);
				full_product_descripption_parent.appendChild(full_product_data_parent);
				full_product_descripption_parent.appendChild(full_product_back_button);
				full_product_descripption_parent.appendChild(full_product_redact_button);
				
				productContainer.appendChild(full_product_descripption_parent);
				
				full_product_back_button.onclick = () => {
					displayInformationAboutAllProducts.style.display = "block";
					full_product_descripption_parent.style.display = "none";
				}

				// ...........................Редактирование товара.....................
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

					//0000000000000000000000000
					let input_array = [
						[`${productArray[element.id].name}`,"Название","text","product__name"],
						// [`${productArray[element.id].category}`,"Категория","number","category"],
						// [`${productArray[element.id].subcategory}`,"Подкатегория","number","subcategory"],
						[`${productArray[element.id].price}`,"Цена","number","price"],
						[`${productArray[element.id].amount}`,"Остаток","number","amount"]
					];
					input_array.forEach(el =>{
						let full_product_redact_input_parent_div = document.createElement("div");
						let full_product_redact_input_div = document.createElement("div");
						full_product_redact_input_div.innerText = `${el[1]}: `;
						let full_product_redact_name = document.createElement("input");
						full_product_redact_name.setAttribute("value", `${el[0]}`);
						full_product_redact_name.id = `${el[3]}`;
						full_product_redact_name.setAttribute("type", `${el[2]}`);
						full_product_redact_input_parent_div.appendChild(full_product_redact_input_div);
						full_product_redact_input_parent_div.appendChild(full_product_redact_name);
						full_product_descripption_parent_redact_form.appendChild(full_product_redact_input_parent_div);
					});

					
			let full_product_redact_category_parent_div = document.createElement("div");
			let full_product_redact_new_category_div = document.createElement("div");
			full_product_redact_new_category_div.innerText = `Категория: `;
			let full_product_redact_new_select_category = document.createElement("select");
			full_product_redact_new_select_category.id = `category`;

			let full_product_redact_first_options = document.createElement("option");
			full_product_redact_first_options.innerText = "--Выберете категорию--";
			full_product_redact_new_select_category.appendChild(full_product_redact_first_options);

				let full_product_redact_subcategory_parent_div = document.createElement("div");
				let full_product_redact_new_subcategory_div = document.createElement("div");
				full_product_redact_new_subcategory_div.innerText = `Подкатегория: `;
				let full_product_redact_new_select_subcategory = document.createElement("select");
				full_product_redact_new_select_subcategory.id = `subcategory`;

				let full_product_redact_first_subcategory_options = document.createElement("option");
				full_product_redact_first_subcategory_options.innerText = "--Выберете Подкатегорию--";
				full_product_redact_new_select_subcategory.appendChild(full_product_redact_first_subcategory_options);
				
				
				fetch(`/system/getCat.php`)                                         
				.then(response => response.json())                           
				.then(data => {
					let full_product_redact_data_array = [];
					let full_product_redact_data_array_2 = [];
					data.forEach(element => {
						if(full_product_redact_data_array.includes(element.categoryName)==false){							
							full_product_redact_data_array.push(element.categoryName);
							full_product_redact_data_array_2.push([element.categoryName, element.categoryId]);
							let full_product_redact_new_options = document.createElement("option");
							full_product_redact_new_options.innerText = `${element.categoryName}`;
							full_product_redact_new_select_category.appendChild(full_product_redact_new_options);
						}
					});
					
					let full_product_redact_subcategory_data_array = [];
					full_product_redact_new_select_category.onchange = () => {
						full_product_redact_subcategory_data_array = [];
						while (full_product_redact_new_select_subcategory.firstChild) {									//удаление всех дочерних элементов
							full_product_redact_new_select_subcategory.removeChild(full_product_redact_new_select_subcategory.firstChild);
						}
						
						let full_product_redact_first_subcategory_options = document.createElement("option");
						full_product_redact_first_subcategory_options.innerText = "--Выберете Подкатегорию--";
						full_product_redact_new_select_subcategory.appendChild(full_product_redact_first_subcategory_options);
						
						data.forEach(element => {
							if(element.categoryName == full_product_redact_new_select_category.value){
								full_product_redact_subcategory_data_array.push([element.subcategory, element.subcategoryId]);
								// console.log(element.subcategory);
								let full_product_redact_new_options_subcategory = document.createElement("option");
								full_product_redact_new_options_subcategory.innerText = `${element.subcategory}`;
								full_product_redact_new_select_subcategory.appendChild(full_product_redact_new_options_subcategory);
							}
						})					
						console.log(full_product_redact_subcategory_data_array);
					} 

					full_product_redact_category_parent_div.appendChild(full_product_redact_new_category_div);
					full_product_redact_category_parent_div.appendChild(full_product_redact_new_select_category);
					full_product_descripption_parent_redact_form.appendChild(full_product_redact_category_parent_div);
					
					full_product_redact_subcategory_parent_div.appendChild(full_product_redact_new_subcategory_div);
					full_product_redact_subcategory_parent_div.appendChild(full_product_redact_new_select_subcategory);
					full_product_descripption_parent_redact_form.appendChild(full_product_redact_subcategory_parent_div);

		
					let full_product_redact_input_description_parent_div = document.createElement("div");
						let full_product_redact_input_description_div = document.createElement("div");
						full_product_redact_input_description_div.innerText = "Описание: ";
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

// //////////////////////........................отправка формы........................////////////////////////////
					full_product_descripption_parent_redact_form.onsubmit  = async(e) => {
						e.preventDefault();
						let full_product_descripption_category_data = "";
						full_product_redact_data_array_2.forEach(el=>{
							if(el.includes(full_product_redact_new_select_category.value)==true){
								full_product_descripption_category_data = el[1];
							}
						})
						
						let full_product_descripption_subcategory_data = '';
						full_product_redact_subcategory_data_array.forEach(el=>{
							if(el.includes(full_product_redact_new_select_subcategory.value)==true){
								full_product_descripption_subcategory_data = el[1];
							}
						})

						let input_img_arr = document.querySelectorAll(".admin_redact_product_page_img");
						input_img_arr.forEach(el => {
							let arrayImage = el.value.replace("C:\\fakepath\\", "");
							if(imgArrFull.indexOf(arrayImage) == -1 && arrayImage != ""){
								imgArrFull.push(arrayImage);	
							}
						});
						let imgArrFullToString = imgArrFull.join(', ');						
						fetch(`/system/adminUpdateProduct.php`, {
							method: 'post',
							headers: {
								"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
							},
							body:  `id=${productArray[element.id].id}&name=${product__name.value}&category=${full_product_descripption_category_data}&subcategory=${full_product_descripption_subcategory_data}&price=${price.value}&description=${description.value}&amount=${amount.value}&image=${imgArrFullToString}`									
						})    
						// .then(response => response.text())
						// .then(data=>{console.log(data);})     
						.then(window.location.href = "/admin")
					}
					
					full_product_descripption_parent_redact_img_arr.onclick = (eventImg) => {
						console.log(eventImg.target.src);
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
				})////////////////
				}
			}		
		})
	})
}


////////////////////////////////////////////////->-_-.m0-,.0n9m,0.

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
		ordering_form.classList.add("personalAccountContent");
		// const ordering_div = document.createElement("div");
		let product_parent_div = document.createElement("div");
		let price_array = [];
		let purchase_details = [];		//массив содержит данные о покупаемых товарах
		data.forEach(element=>{
			console.log(element);
			purchase_details.push([element.product_id, element.count, element.price])			
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
					product_price.classList.add("product_price_ordering");
					product_price.innerText = `Цена за ${element.count}шт: ${element.price*element.count}₽`;

					price_array.push(element.price*element.count);

				product_count_and_price.appendChild(product_count);
				product_count_and_price.appendChild(product_price);
				product_info.appendChild(product_name);
				product_info.appendChild(product_count_and_price);
				
				product_div.appendChild(product_image_div);
				product_div.appendChild(product_info);

				product_parent_div.appendChild(product_div);
			})
			console.log(price_array);
			let result = price_array.reduce(function(a, b) {		//итоговая сумма
				return a + b;
			});
			// console.log(purchase_details);
			let result_div = document.createElement("div");
			result_div.innerText = `Итого: ${result}₽`;
			product_parent_div.appendChild(result_div);

			fetch("/system/getUserAccount.php")
			.then(response => response.json())                                  
			.then(data => { 
				console.log(data[0]);
				let name_div = document.createElement("div");
				let last_name_div = document.createElement("div");
				let email_div = document.createElement("div");
				let country_div = document.createElement("div");
				let city_div = document.createElement("div");
				let street_div = document.createElement("div");
				let house_div = document.createElement("div");
				let apartment_div = document.createElement("div");
				let postcode_div = document.createElement("div");

				let name_label_div = document.createElement("div");
				name_label_div.innerText = "Имя";
				let last_name_label_div = document.createElement("div");
				last_name_label_div.innerText = "Фамилия";
				let email_label_div = document.createElement("div");
				email_label_div.innerText = "email";
				let country_label_div = document.createElement("div");
				country_label_div.innerText = "Страна";
				let city_label_div = document.createElement("div");
				city_label_div.innerText = "Город";
				let street_label_div = document.createElement("div");
				street_label_div.innerText = "Улица";
				let house_label_div = document.createElement("div");
				house_label_div.innerText = "Дом";
				let apartment_label_div = document.createElement("div");
				apartment_label_div.innerText = "Квартира";
				let postcode_label_div = document.createElement("div");
				postcode_label_div.innerText = "Почтовый индекс";

				let name_input = document.createElement("input");
				let last_name_input = document.createElement("input");
				let email_input = document.createElement("input");
				let country_input = document.createElement("input");
				let city_input = document.createElement("input");
				let street_input = document.createElement("input");
				let house_input = document.createElement("input");
				let apartment_input = document.createElement("input");
				let postcode_input = document.createElement("input");

				const input_array = [
					[name_input,"text","name",data[0].user_name],
					[last_name_input,"text","last_name",data[0].lastname],
					[email_input,"text","email",data[0].email],
					[country_input,"text","country",data[0].country],
					[city_input,"text","sity",data[0].city],
					[street_input,"text","street",data[0].street],
					[house_input,"number","house",data[0].house],
					[apartment_input,"number","apartment",data[0].apartment],
					[postcode_input,"number","postcode",data[0].postcode]
				]
				input_array.forEach(el => {
					el[0].setAttribute("type", `${el[1]}`);
					el[0].setAttribute("name", `${el[2]}`);
					if(el[3]) {
						el[0].setAttribute("value", `${el[3]}`);
					}
					else{
						el[0].setAttribute("value", ``);						
					}
				})

				let submit_input = document.createElement("input");
					submit_input.setAttribute("type", "submit");
					submit_input.setAttribute("name", "submit_btn");
					submit_input.classList.add("submit_input_ordering");
					
					name_div.appendChild(name_label_div);
					name_div.appendChild(name_input);
					last_name_div.appendChild(last_name_label_div);
					last_name_div.appendChild(last_name_input);
					email_div.appendChild(email_label_div);
				email_div.appendChild(email_input);
				country_div.appendChild(country_label_div);
				country_div.appendChild(country_input);
				city_div.appendChild(city_label_div);
				city_div.appendChild(city_input);
				street_div.appendChild(street_label_div);
				street_div.appendChild(street_input);
				house_div.appendChild(house_label_div);
				house_div.appendChild(house_input);
				apartment_div.appendChild(apartment_label_div);
				apartment_div.appendChild(apartment_input);
				postcode_div.appendChild(postcode_label_div);
				postcode_div.appendChild(postcode_input);

			ordering_form.appendChild(name_div);
			ordering_form.appendChild(last_name_div);
			ordering_form.appendChild(email_div);
			ordering_form.appendChild(country_div);
			ordering_form.appendChild(city_div);
			ordering_form.appendChild(street_div);
			ordering_form.appendChild(house_div);
			ordering_form.appendChild(apartment_div);
			ordering_form.appendChild(postcode_div);
			ordering_form.appendChild(submit_input);
			parent_div.appendChild(product_parent_div);
			parent_div.appendChild(ordering_form);

			ordering_form.onsubmit = (event) => {
				event.preventDefault();
				fetch("/system/addToShopping.php", {
					method: 'post',
					headers: {
						"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
					},
					body:  `purchase_details=${purchase_details.join("; ")}&name=${name_input.value}&last_name=${last_name_input.value}&email=${email_input.value}
					&country=${country_input.value}&city=${city_input.value}&street=${street_input.value}&house=${house_input.value}&apartment=${apartment_input.value}&postcode=${postcode_input.value}`	  
				})
				.then(response => response.text())                                  
				.then(data => { 
					alert("Вы успешно оформили заказ, скоро с вами свяжется наш представитель.");
					window.location.href = "/crockery";
				})
			}
		})
	})	
}

