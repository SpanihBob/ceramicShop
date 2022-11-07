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
			<div class="crockeryContent">
                <div class="nameContent">								<!-- CONTENT -->
                    название
                </div>									
				<?
					require_once "$path/system/sysSearch.php";
				?>
			</div>
            <script>
                document.querySelector(".main__search").onclick = event => {            
                    if(event.target.className == "mainCard__cont_row3__productToCart") {
                        console.log(event.path[3].dataset.productId);
                        fetch("/system/addToCart.php", {
                            method: 'post',
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                            },
                            body: `product_id=${event.path[3].dataset.productId}`,
                        }) 
                    }
                }                
            </script>		
		</article>
		<?
			include_once "$path/private/footer.php"		//FOOTER
		?>
	</div>
</body>
</html>

        
       
		
