<?php
// Retrieve the form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// TODO: Validate the form data

// Update the database credentials
$host = 'your_host';
$db_name = 'your_database_name';
$username = 'your_username';
$password = 'your_password';

try {
  $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Prepare and execute the SQL query
  $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)");
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':message', $message);
  $stmt->execute();

  // Close the database connection
  $conn = null;
} catch(PDOException $e) {
  // Handle database connection errors
  echo "Connection failed: " . $e->getMessage();
}

// Redirect the user back to the contact page or display a success message
header("Location: contact.html");
exit();
?>
