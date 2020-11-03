<?php
@session_start();

// basename($_SERVER['REQUEST_URI']) gives file name from url
// basename($_SERVER['PHP_SELF']) gives file name from file name

// if session does not exists
if(!((isset($_SESSION['doctor_id']) && !empty($_SESSION['doctor_id'])))) {

	if(basename($_SERVER['PHP_SELF']) != "index.php") {
		if(basename($_SERVER['PHP_SELF']) == "signin.php") {

		}
		else {
			echo "<script>location='index.php'</script>";
		}
	}
}


// if session exists
else {

	if(basename($_SERVER['PHP_SELF']) == "index.php" || basename($_SERVER['PHP_SELF']) == "signin.php") {
 		// But beware of any malicious parts in your URL

		echo "<script>location='doctor_index.php'</script>";
	}

}
?>
