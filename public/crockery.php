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
			</div>
		

			<script>
				loadCategory('crockery','product')
			</script>		
		</article>
		<?
			include_once "$path/private/footer.php"		//FOOTER
		?>
	</div>
</body>
</html>