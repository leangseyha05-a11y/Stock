<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<style>
    /* General Body Styles */
    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        margin: 40px auto;
        max-width: 800px;
        line-height: 1.6;
        font-size: 18px;
        color: #444;
        background-color: #f9f9f9;
        padding: 0 20px;
    }

    /* Heading Styles */
    h2 {
        text-align: center;
        color: #333;
        border-bottom: 2px solid #eee;
        padding-bottom: 10px;
        margin-bottom: 30px;
    }

    /* Table Styles */
    table {
        width: 100%;
        border-collapse: collapse; /* Removes space between borders */
        margin: 25px 0;
        font-size: 0.9em;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow */
        background-color: #fff;
    }

    /* Table Header Styles */
    table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
    }

    /* Table Cell Styles */
    table th,
    table td {
        padding: 12px 15px;
    }

    /* Table Body Row Styles */
    table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    /* Alternating Row Colors (Zebra-striping) */
    table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }
    
    /* Hover effect for rows */
    table tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Styling for Links */
    a {
        color: #009879;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
    
    /* Style for 'Add New Item' link to look like a button */
    a.button {
        display: inline-block;
        background-color: #009879;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 5px;
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
    }

    a.button:hover {
        background-color: #007a63;
        text-decoration: none;
    }
    
    /* Action link styles in the table */
    td a {
        margin-right: 10px;
    }

    td a.edit {
        color: #2196F3;
    }

    td a.delete {
        color: #f44336;
    }

</style>

<body>
    <h2>Items Details</h2>
    <a href="create.php">Add New Item</a><br><br>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Invoice Number</th>
                <th>Phone Number</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include config file
            require_once "database.php";

            // Attempt select query execution
            $sql = "SELECT * FROM prepare_items";
            if($result = $mysqli->query($sql)){
                if($result->num_rows > 0){
                    while($row = $result->fetch_array()){
                        echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['INV_Number'] . "</td>";
                            echo "<td>" . $row['Phone_Number'] . "</td>";
                            echo "<td>" . $row['Status'] . "</td>";
                            echo "<td>" . $row['Amount'] . "</td>";
                            echo "<td>";
                                echo '<a href="update.php?id='. $row['id'] .'">Edit</a>';
                                echo " | ";
                                echo '<a href="delete.php?id='. $row['id'] .'">Delete</a>';
                            echo "</td>";
                        echo "</tr>";
                    }
                    // Free result set
                    $result->free();
                } else{
                    echo '<tr><td colspan="6">No records were found.</td></tr>';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close connection
            $mysqli->close();
            ?>
        </tbody>
    </table>
</body>
</html>
