<!DOCTYPE html>
<html>
<head>
    <title>User Management System</title>
    <style>
        /* CSS styles go here */
    </style>
</head>
<body>
    <?php

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "ebad";
    $dbname = "test";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create the user table if it doesn't exist
    $table = "CREATE TABLE IF NOT EXISTS user (
        PersonID int,
        LastName varchar(255),
        FirstName varchar(255),
        Address varchar(255),
        City varchar(255)
    )";

    if ($conn->query($table) === TRUE) {
        echo "<p>Table created successfully or already exists.</p>";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // PHP code for handling form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $address = $_POST['address'];
        $city = $_POST['city'];

        // Insert the user data into the database
        $sql = "INSERT INTO user (FirstName, LastName, Address, City) VALUES ('$firstName', '$lastName', '$address', '$city')";
        if ($conn->query($sql) === TRUE) {
            echo "<p>User created successfully!</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <h1>User Management System</h1>

    <form method="POST" action="">
        <h2>Create User</h2>
        <input type="text" name="firstname" placeholder="First Name" required>
        <input type="text" name="lastname" placeholder="Last Name" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="text" name="city" placeholder="City" required>
        <input type="submit" value="Create User">
    </form>

    <table>
        <caption>User List</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Retrieve and display user data from the database
            $sql = "SELECT * FROM user";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["PersonID"] . "</td>";
                    echo "<td>" . $row["FirstName"] . " " . $row["LastName"] . "</td>";
                    echo "<td>" . $row["Address"] . "</td>";
                    echo "<td>" . $row["City"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>0 results</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
