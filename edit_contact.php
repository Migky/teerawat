<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $contact_id = $_POST["contact_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Validate the data (optional)
    // You can add validation code here to ensure the data is in the correct format.

    // Connect to the database
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "contacts";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the data in the database
    $sql = "UPDATE contacts SET name=?, email=?, phone=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $phone, $contact_id);

    if ($stmt->execute()) {
        // Data update successful
        echo "Contact updated successfully!";
    } else {
        // Data update failed
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // Fetch contact data from the database for editing
    if (isset($_GET["id"])) {
        $contact_id = $_GET["id"];

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

        // Fetch the contact from the database
        $sql = "SELECT * FROM contacts WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $contact_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Close the database connection
        $stmt->close();
        $conn->close();
    } else {
        // If no contact ID is provided, redirect to the "my_contacts.php" page
        header("Location: my_contacts.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <h1>Edit Contact</h1>
    <form method="post" action="">
        <input type="hidden" name="contact_id" value="<?php echo $row["id"]; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $row["name"]; ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row["email"]; ?>" required><br>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $row["phone"]; ?>" required><br>
        <input type="submit" value="Update Contact">
    </form>
    <br>
    <a href="my_contacts.php">Back to My Contacts</a>
</body>
</html>