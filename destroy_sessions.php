<?php
// include('firstConnectDatabase.php');
// mysqli_close($conn);
session_start();
session_unset(); 
session_destroy(); 
echo "<script>location='index.php'</script>";
echo "Bye!!!";
?>