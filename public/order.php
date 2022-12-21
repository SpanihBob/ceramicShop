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
			<div class="orderContent">
                <h1>Мои заказы</h1>
                <div id="not_order">У вас пока нет активных заказов..</div>
                <div id="all_orders"></div>
                <div id="selected_order"></div>
			</div>	
            <script>
                window.onload = () => {
                    fetch(`/system/removeToOrderUser.php`)            
                    .then(response => response.json())                                  
                    .then(data => {
                        if(data.length==0){                             //---если нет данных
                            not_order.style.display = "block";
                            all_orders.style.display = "none";
                            selected_order.style.display = "none";
                        }                        
                        else {                                          //---если есть данные
                            console.log(data);
                            not_order.style.display = "none";
                            all_orders.style.display = "grid";
                            selected_order.style.display = "none";

                            all_orders.innerText="";
                            let userShopping = document.createElement("div");
                            data.forEach(element =>{								
                                console.log(element);
                                let userProduct = document.createElement("div");           //---родитель pfwbrktyjuj 
                                    userProduct.classList.add("userProduct");

                                let productImageDiv = document.createElement("div");
                                let productImage = document.createElement("img");
                                    productImage.setAttribute("src",`../img1/${element.image.split(", ")[0]}`);
                                    productImage.classList.add("userProductImage");

                                productImageDiv.appendChild(productImage);

                                let productInfo = document.createElement("div");
                                    productInfo.classList.add("productInfo");
                                let productName = document.createElement("div");
                                    let productNameText = document.createTextNode(`${element.name}`);
                                    productName.appendChild(productNameText);                                
                                let productCount = document.createElement("div");
                                    let productCountText = document.createTextNode(`Заказ: ${element.product_count}шт.`);
                                    productCount.appendChild(productCountText);
                                let productPrice = document.createElement("div");
                                    let productPriceText = document.createTextNode(`Цена: ${element.product_price}₽`);
                                    productPrice.appendChild(productPriceText);
                                let infoBtn = document.createElement("button");
                                    infoBtn.innerText = "Подробнее";
                                    infoBtn.classList.add("input");

                                userProduct.appendChild(productImageDiv);
                                productInfo.appendChild(productName);	
                                productInfo.appendChild(productCount);	
                                productInfo.appendChild(productPrice);	
                                productInfo.appendChild(infoBtn);	
                                userProduct.appendChild(productInfo);
                                                                    
                                userShopping.appendChild(userProduct);	
                                all_orders.appendChild(userShopping);
                                userProduct.onclick = (event) => {
                                    if(event.target == productImage) {
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
                                    if(event.target == infoBtn) {                                        
                                        all_orders.style.display = "none";
                                        selected_order.style.display = "grid";
                                        selected_order.innerText = "";
                                        let userInfo = document.createElement("div");
                                        userInfo.classList.add("user_full_info");

                                        let user_full_info_buyer_name = document.createElement("div");
                                            user_full_info_buyer_name.innerText = `Имя: ${element.buyer_name}`;
                                        let user_full_info_buyer_last_name = document.createElement("div");
                                            user_full_info_buyer_last_name.innerText = `Фамилия: ${element.buyer_last_name}`;
                                        let user_full_info_buyer_email = document.createElement("div");
                                            user_full_info_buyer_email.innerText = `email: ${element.buyer_email}`;
                                        let user_full_info_buyer_country = document.createElement("div");
                                            user_full_info_buyer_country.innerText = `Страна: ${element.buyer_country}`;
                                        let user_full_info_buyer_city = document.createElement("div");
                                            user_full_info_buyer_city.innerText = `Город: ${element.buyer_city}`;
                                        let user_full_info_buyer_street = document.createElement("div");
                                            user_full_info_buyer_street.innerText = `Улица: ${element.buyer_street}`;
                                        let user_full_info_buyer_house = document.createElement("div");
                                            user_full_info_buyer_house.innerText = `Дом: ${element.buyer_house}`;
                                        let user_full_info_buyer_apartment = document.createElement("div");
                                            user_full_info_buyer_apartment.innerText = `Квартира: ${element.buyer_apartment}`;
                                        let user_full_info_buyer_postcode = document.createElement("div");
                                            user_full_info_buyer_postcode.innerText = `Почтовый индекс: ${element.buyer_postcode}`;

                                        let order_info = document.createElement("div");
                                            order_info.classList.add("order_full_info");
                                        let user_full_info_image = document.createElement("img");
                                            user_full_info_image.setAttribute("src",`../img1/${element.image.split(", ")[0]}`);
                                            user_full_info_image.style.width = "200px";
                                        let order_data = document.createElement("div");
                                            order_data.style.display = "grid";

                                        let user_full_info_name = document.createElement("div");
                                            user_full_info_name.innerText = `Товар: ${element.name}`;
                                        let user_full_info_product_price = document.createElement("div");
                                            user_full_info_product_price.innerText = `Цена: ${element.product_price}₽`;
                                        let user_full_info_product_count = document.createElement("div");
                                            user_full_info_product_count.innerText = `Колличество: ${element.product_count}шт.`;
                                            let date = new Date(element.add_time*1000);
                                        let user_full_info_add_time = document.createElement("div");
                                            user_full_info_add_time.innerText = `Время добавления: ${date.toLocaleString('ru-RU', {
                                                                                                                                    year: 'numeric',
                                                                                                                                    month: 'numeric',
                                                                                                                                    day: 'numeric'
                                                                                                                                    })
                                                                                                    }`;
                                        userInfo.appendChild(user_full_info_buyer_name);
                                        userInfo.appendChild(user_full_info_buyer_last_name);
                                        userInfo.appendChild(user_full_info_buyer_email);
                                        userInfo.appendChild(user_full_info_buyer_country);
                                        userInfo.appendChild(user_full_info_buyer_city);
                                        userInfo.appendChild(user_full_info_buyer_street);
                                        userInfo.appendChild(user_full_info_buyer_house);
                                        userInfo.appendChild(user_full_info_buyer_apartment);
                                        userInfo.appendChild(user_full_info_buyer_postcode);
                                        
                                        order_data.appendChild(user_full_info_name);
                                        order_data.appendChild(user_full_info_product_price);
                                        order_data.appendChild(user_full_info_product_count);
                                        order_data.appendChild(user_full_info_add_time);

                                        order_info.appendChild(user_full_info_image);
                                        order_info.appendChild(order_data);

                                        selected_order.appendChild(userInfo);
                                        selected_order.appendChild(order_info);

                                        let order_back_btn = document.createElement("button");
                                        order_back_btn.classList.add("input");
                                        order_back_btn.innerText = "Назад";
                                        
                                        selected_order.appendChild(order_back_btn);

                                        order_back_btn.onclick = () => {
                                            all_orders.style.display = "grid";
                                            selected_order.style.display = "none";
                                        }
                                    
                                    }
                                }
                            })
                            
                        }
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