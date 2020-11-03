<?php
// include ('checksession.php');
include_once ('first.php');
include_once ('navbar.php');
include_once ('connectDb.php');
?>
<style type="text/css">
	.mymap {
		width: 100%;
		height: 60vh;
	}
	.mybtn {
		margin: 10px;
	}
</style>

<div class="container">
	<div class="mybtn">
		<button onclick="window.history.go(-1);" class="btn btn-info">Go Back</button>
	</div>
	<section class="ftco-section">
		<div class="container">
			<div class="row">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3224.483598891997!2d120.32889503403409!3d16.03542509412215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x339142aa92134ed7%3A0xe692fb6026fd2b58!2sLyceum-Northwestern%20University!5e0!3m2!1sen!2sin!4v1590695902722!5m2!1sen!2sin" class = "mymap" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
			</div>
		</div>
	</section>
</div>
<?php

include_once('footer.php');
include_once('loader_alljs.php');

?>