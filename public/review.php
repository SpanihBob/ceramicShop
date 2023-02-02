<?
	include_once "$path/private/head.php";
?>


<body>
	<div class="container">			
		<?
			include_once "$path/private/header.php";		        //HEADER
		?>	

		<article class="article">						            <!-- ARTICLE -->
			<?
				include_once "$path/private/sidebar.php";		    //SIDEBAR
			?>
			<div class="reviewContent">								<!-- CONTENT -->
                <h1>Отзывы</h1>
			</div>		
		</article>
		<?
			include_once "$path/private/footer.php"		            //FOOTER
		?>
	</div>
    <script>
        let reviewContent = document.querySelector(".reviewContent");

        console.log(reviewContent);
    </script>
</body>
</html>
