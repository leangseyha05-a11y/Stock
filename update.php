<?php
// Include config file
require_once "database.php";

// Define variables
$inv_number = $phone_number = $status = $amount = "";
$id = 0;

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    $id = trim($_GET["id"]);

    // Prepare a select statement
    $sql = "SELECT * FROM prepare_items WHERE id = ?";
    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("i", $id);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows == 1){
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $inv_number = $row["INV_Number"];
                $phone_number = $row["Phone_Number"];
                $status = $row["Status"];
                $amount = $row["Amount"];
            } else{
                echo "No record found with that ID.";
                exit();
            }
        } else{
            echo "Oops! Something went wrong.";
        }
    }
    $stmt->close();
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST["id"];
    $inv_number = $_POST["inv_number"];
    $phone_number = $_POST["phone_number"];
    $status = $_POST["status"];
    $amount = $_POST["amount"];

    // Prepare an update statement
    $sql = "UPDATE prepare_items SET INV_Number=?, Phone_Number=?, Status=?, Amount=? WHERE id=?";

    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("sssii", $inv_number, $phone_number, $status, $amount, $id);

        if($stmt->execute()){
            header("location: index.php");
            exit();
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }
    $stmt->close();
}
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record</title>
</head>
<body>
    <h2>Update Item</h2>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <label>Invoice Number:</label><br>
        <input type="text" name="inv_number" value="<?php echo $inv_number; ?>"><br>
        <label>Phone Number:</label><br>
        <input type="text" name="phone_number" value="<?php echo $phone_number; ?>"><br>
        <label>Status:</label><br>
        <input type="text" name="status" value="<?php echo $status; ?>"><br>
        <label>Amount:</label><br>
        <input type="text" name="amount" value="<?php echo $amount; ?>"><br><br>
        <input type="submit" value="Submit">
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
