<?php
// Include config file
require_once "database.php";

// Define variables and initialize with empty values
$inv_number = $phone_number = $status = $amount = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Get form data
    $inv_number = $_POST["inv_number"];
    $phone_number = $_POST["phone_number"];
    $status = $_POST["status"];
    $amount = $_POST["amount"];

    // Prepare an insert statement
    $sql = "INSERT INTO prepare_items (INV_Number, Phone_Number, Status, Amount) VALUES (?, ?, ?, ?)";

    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sssi", $inv_number, $phone_number, $status, $amount);

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Redirect to landing page
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    // Close statement
    $stmt->close();
}
// Close connection
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Record</title>
</head>
<body>
    <h2>Add New Item</h2>
    <form action="create.php" method="post">
        <label>Invoice Number:</label><br>
        <input type="text" name="inv_number"><br>
        <label>Phone Number:</label><br>
        <input type="text" name="phone_number"><br>
        <label>Status:</label><br>
        <input type="text" name="status"><br>
        <label>Amount:</label><br>
        <input type="text" name="amount"><br><br>
        <input type="submit" value="Submit">
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
