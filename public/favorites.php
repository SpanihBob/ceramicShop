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
			<div class="cartContent">								<!-- CONTENT -->
				<h1>Избранное</h1>
			</div>	
            <script>
				favoritesAndCart("favor","/favorites", "В избранном пока ничего нет");
			</script>	
		</article>
		<?
			include_once "$path/private/footer.php"		//FOOTER
		?>
	</div>
</body>
</html>
