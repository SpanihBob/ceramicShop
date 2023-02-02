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
			<div class="contactContent">								<!-- CONTENT -->
				<h1>Контакты</h1>
			</div>
            <script>
                let contactContent = document.querySelector(".contactContent");
                window.onload = () => {
                    fetch(`/system/getContacts.php`)                                       
                    .then(response => response.json())                                  
                    .then(data => {	
                        // console.log(data);
                        let contacts_parent_div = document.createElement("div");        //большой родитель
                        let header_text;
                        data.forEach(element => {
                            console.log(element);
                            let contact_div = document.createElement("div");            //малый родитель
                            let header_div = document.createElement("div");
                                header_div.classList.add("contactInfo_header_div");
                                let text_div = document.createElement("div");
                                text_div.innerText = element.text;
                                text_div.classList.add("contactInfo_text_div");
                            
                            if (element.header != header_text) {
                                header_div.innerText = `${element.header}: `;                                
                            }
                            else header_div.innerText = "";                              
                            header_text = element.header;

                            contact_div.appendChild(header_div);
                            contact_div.appendChild(text_div);
                            contacts_parent_div.appendChild(contact_div);
                        });
                        contactContent.appendChild(contacts_parent_div);
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
