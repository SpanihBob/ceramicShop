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
                <h1>Заказы</h1>
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
                            all_orders.style.display = "block";
                            selected_order.style.display = "none";

                            all_orders.innerText="";
                            let userShopping = document.createElement("div");
                            data.forEach(element =>{								
                                console.log(element);
                                let userProduct = document.createElement("div");           //---родитель pfwbrktyjuj 
                                    userProduct.classList.add("userProduct");

                                let productImage = document.createElement("img");
                                    productImage.setAttribute("src",`../img1/${element.image.split(", ")[0]}`);
                                    productImage.classList.add("userProductImage");
                                let productInfo = document.createElement("div");
                                    productInfo.classList.add("productInfo");
                                let productName = document.createElement("div");
                                    let productNameText = document.createTextNode(`${element.name}`);
                                    productName.appendChild(productNameText);                                
                                let productCount = document.createElement("div");
                                    let productCountText = document.createTextNode(`Заказ: ${element.product_count}шт.`);
                                    productCount.appendChild(productCountText);
                                let productPrice = document.createElement("div");
                                    let productPriceText = document.createTextNode(`Цена: ${element.product_price}.`);
                                    productPrice.appendChild(productPriceText);
                                let infoBtn = document.createElement("button");
                                    infoBtn.innerText = "Подробнее";
                                    infoBtn.classList.add("input");
                                    infoBtn.setAttribute("data-id",`${element.id}`)

                                userProduct.appendChild(productImage);
                                productInfo.appendChild(productName);	
                                productInfo.appendChild(productCount);	
                                productInfo.appendChild(productPrice);	
                                productInfo.appendChild(infoBtn);	
                                userProduct.appendChild(productInfo);
                                                                    
                                userShopping.appendChild(userProduct);	
                                all_orders.appendChild(userShopping);
                                infoBtn.onclick = () => {
                                    console.log(infoBtn.getAttribute("data-id"));
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