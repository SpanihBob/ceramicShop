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
			<div class="crockeryContent" id="content">									<!-- CONTENT -->				
			</div>
			<!-- <div class="crockeryProduct"></div>
			<div class="crockeryProductFull"></div>
			<div id="contextMenu">
				<div id="closeBtn">x</div>
			</div> -->
		</div>


			<script>
				window.onload=()=>{
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
								console.log(element);
								let subcategoryDiv = document.createElement("div");
								let subcategoryImg = document.createElement("img");
								let subcategoryText = document.createElement("div");

								subcategoryDiv.setAttribute("data-id",`${element.id}`);
								subcategoryImg.setAttribute("src",`../img/${element.image}`);
								subcategoryText.innerText=`${element.name}`;
								
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
										.then(
											window.location.href = '/product'
										)                                  
										
								}
							})
						})
					}
					loadCategory('collections','product_collections')
				}
			</script>		
		</article>
		<?
			include_once "$path/private/footer.php"		//FOOTER
		?>
	</div>
</body>
</html>