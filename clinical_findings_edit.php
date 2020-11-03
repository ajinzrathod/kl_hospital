<?php
include ('checksession.php');

include_once ('first.php');
include_once ('navbar.php');
include_once ('connectDb.php');
?>
<link rel="stylesheet" type="text/css" href="css/edit_details.css">

<section class="ftco-section">
	<div class="form-container">  
		<form id="contact" action="" method="post">
			<h3>Colorlib Contact Form</h3>
			<h4>Contact us for custom quote</h4>
			<fieldset>
				<input placeholder="Your name" type="text" tabindex="1" required autofocus>
			</fieldset>
			<fieldset>
				<input placeholder="Your Email Address" type="email" tabindex="2" required>
			</fieldset>
			<fieldset>
				<input placeholder="Your Phone Number (optional)" type="tel" tabindex="3" required>
			</fieldset>
			<fieldset>
				<input placeholder="Your Web Site (optional)" type="url" tabindex="4" required>
			</fieldset>
			<fieldset>
				<textarea placeholder="Type your message here...." tabindex="5" required></textarea>
			</fieldset>
			<fieldset>
				<button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
			</fieldset>
		</form>
	</div>
</section>
<?php

include_once('footer.php');
include_once('loader_alljs.php');

?>