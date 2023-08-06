<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
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

    // Prepare and execute the SQL query to insert the data into the "contacts" table
    $sql = "INSERT INTO contacts (name, email, phone) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $phone);

    if ($stmt->execute()) {
        // Data insertion successful
        echo "Contact added successfully!";
    } else {
        // Data insertion failed
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to the "my_contacts.php" page if accessed directly without submitting the form
    header("Location: contacts.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your existing PHP code for adding contact goes here...

    // After the data insertion is successful, you can add the following code to redirect to the "my_contacts.php" page.
    header("Location: contacts.php");
    exit;
}
?>
