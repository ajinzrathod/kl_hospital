<?php

if(isset($_GET['pageno'])){
	$pageno1=$_GET['pageno'];
}
else{
	$pageno1=1;
}
if(isset($_SESSION['recordsPerPage'])){
	$recordsPerPage = $_SESSION['recordsPerPage'];
}
else{
	$_SESSION['recordsPerPage'] = 10;
	$recordsPerPage = 10;
}

?>