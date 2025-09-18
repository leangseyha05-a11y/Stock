<?php
if(isset($_GET["id"]) && !empty($_GET["id"])){
    // Include config file
    require_once "database.php";

    // Prepare a delete statement
    $sql = "DELETE FROM prepare_items WHERE id = ?";

    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Records deleted successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    // Close statement
    $stmt->close();

    // Close connection
    $mysqli->close();
} else{
    // If ID parameter is missing, redirect
    header("location: index.php");
    exit();
}
?>
