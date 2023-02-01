<?
	include_once "$path/private/head.php";
	// echo "<pre>";
	// print_r($_SESSION);
	// echo "</pre>";
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
			<div class="orderingContent">								<!-- CONTENT -->				
				<h1>Страница оформления заказа</h1>
			</div>
			<script>
				window.onload = () => {
					let orderingContent = document.querySelector(".orderingContent");
					placingAnOrder(orderingContent);
				}				
			</script>		
		</article>
		<?
			include_once "$path/private/footer.php"		//FOOTER
		?>
	</div>
</body>
</html>
