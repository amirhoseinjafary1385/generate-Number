<?php
// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get min and max values from form data
    $min = $_POST["min"];
    $max = $_POST["max"];

    // Check if max is greater than or equal to min
    if ($max < $min) {
        // Return error response if max is less than min
        echo json_encode(["success" => false, "error" => "Max value must be greater than or equal to min value"]);
        exit;
    }

    // Generate a random number within the specified range
    $number = mt_rand($min, $max);

    // Insert the generated number into the MySQL database
    $servername = "localhost";
    $username = "root"; // Replace with your MySQL username
    $password = "1234"; // Replace with your MySQL password
    $dbname = "random_numbers";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the generated number into the database
    $sql = "INSERT INTO numbers (number) VALUES ($number)";

    if ($conn->query($sql) === TRUE) {
        // Return success response
        echo json_encode(["success" => true, "number" => $number]);
    } else {
        // Return error response
        echo json_encode(["success" => false, "error" => "Error inserting number into database"]);
    }

    // Close connection
    $conn->close();
} else {
    // Return error response if form data is not submitted
    echo json_encode(["success" => false, "error" => "No form data submitted"]);
}
?>
