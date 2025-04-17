<?php include 'header.php'; ?>

<h1>All Records</h1>

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "final");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all records
$sql = "SELECT * FROM string_info";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "String ID: " . $row['string_id'] . " - Message: " . $row['message'] . "<br>";
    }
} else {
    echo "No records found.";
}

// Handle delete request
if (isset($_POST['Delete'])) {
    $string_id = $_POST['string_id'];

    // Delete the record
    $sql = "DELETE FROM string_info WHERE string_id = $string_id";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Record deleted successfully! Refreshing...</p>";
        echo '<meta http-equiv="refresh" content="2;url=showAll.php">';
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<br><br>
<h2>Delete a Record</h2>
<form method="POST" action="">
    <label for="string_id">String ID to Delete:</label><br>
    <input type="number" id="string_id" name="string_id" required><br><br>
    <input type="submit" name="Delete" value="Delete">
</form>

</body>
</html>