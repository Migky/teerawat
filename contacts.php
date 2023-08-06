<!DOCTYPE html>
<html>
<head>
    <title>My Contacts</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <h1>My Contacts</h1>
    <a href="add_contact.php">Add New Contact</a>
    <br><br>
    <?php
    // Connect to the database (if not already connected)
    if (!isset($conn)) {
        $servername = "localhost";
        $username = "username";
        $password = "password";
        $dbname = "contacts";
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }

    // Check if the delete button is clicked
    if (isset($_GET["delete_id"])) {
        $delete_id = $_GET["delete_id"];
        // Delete the contact from the database
        $sql = "DELETE FROM contacts WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $delete_id);
        if ($stmt->execute()) {
            echo "Contact deleted successfully!";
        } else {
            echo "Error deleting contact: " . $conn->error;
        }
        $stmt->close();
    }

    // Fetch contacts from the database
    $sql = "SELECT * FROM contacts";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>";
            echo "Name: " . $row["name"] . "<br>";
            echo "Email: " . $row["email"] . "<br>";
            echo "Phone: " . $row["phone"] . "<br>";
            echo "<a href='edit_contact.php?id=" . $row["id"] . "'>Edit</a> ";
            echo "<a href='?delete_id=" . $row["id"] . "'>Delete</a>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "No contacts found.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>