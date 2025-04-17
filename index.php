<?php include 'header.php'; ?>

<h1>Enter a String</h1>

<form method="POST" action="">
    <label for="message">Message (max 50 characters):</label><br>
    <input type="text" id="message" name="message" maxlength="50" required><br><br>
    <input type="submit" name="Submit" value="Submit">
</form>

<br>
<a href="showAll.php">Show all records</a>

<?php
if (isset($_POST['Submit'])) {
    $message = $_POST['message'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "final");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the message into the database
    $sql = "INSERT INTO string_info (message) VALUES ('$message')";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Record saved successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>

</body>
</html>