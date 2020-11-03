<?php
@session_start();
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "theunite_kajal", "Gamma@0227", "theunite_kl_hospital");
// include_once ('connectDb');
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}else {
    // echo " >" . $_SESSION['doctor_id'];
}
 
if(isset($_REQUEST["term"])){
    // Prepare a select statement
    // $sql = "SELECT * FROM countries WHERE name LIKE ?";
    $sql = ("SELECT * FROM personal_details WHERE id LIKE ? AND doctor_id = ?");
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sd", $param_term, $param_term2);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';

        // $param_term2 = $_SESSION['doctor_id'];
        $param_term2 = $_SESSION['doctor_id'];
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<a href='edit_details.php?id=".$row["id"]."'><p>" . $row["full_name"] . "";
                    echo "<span style='color: blue;'>&nbsp;[".$row["id"]."]</span></p></a>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($link);
?>