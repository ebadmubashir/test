<?php
$servername = "localhost";
$username = "root";
$password = "ebad";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// CREATE operation
if (isset($_POST['create'])) {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    $sql = "INSERT INTO user (FirstName, LastName, Address, City) VALUES ('$firstName', '$lastName', '$address', '$city')";

    if ($conn->query($sql) === TRUE) {
        echo "User created successfully!";
    } else {
        echo "Error creating user: " . $conn->error;
    }
}

// READ operation
if (isset($_POST['read'])) {
    echo "<h2>Read User</h2>";
    echo '<form method="POST" action="">';
    echo '<input type="number" name="personid" placeholder="Person ID" required>';
    echo '<input type="submit" name="fetch" value="Fetch User">';
    echo '</form>';
}

// FETCH operation
if (isset($_POST['fetch'])) {
    $personID = $_POST['personid'];

    $sql = "SELECT * FROM user WHERE PersonID='$personID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>User Details</h3>";

        while ($row = $result->fetch_assoc()) {
            echo "<p><strong>Person ID:</strong> " . $row["PersonID"] . "</p>";
            echo "<p><strong>Last Name:</strong> " . $row["LastName"] . "</p>";
            echo "<p><strong>First Name:</strong> " . $row["FirstName"] . "</p>";
            echo "<p><strong>Address:</strong> " . $row["Address"] . "</p>";
            echo "<p><strong>City:</strong> " . $row["City"] . "</p>";
        }
    } else {
        echo "No user found with the specified Person ID.";
    }
}

// UPDATE operation
if (isset($_POST['update'])) {
    $personID = $_POST['personid'];
    $newAddress = $_POST['newaddress'];
    $newCity = $_POST['newcity'];

    $sql = "UPDATE user SET Address='$newAddress', City='$newCity' WHERE PersonID='$personID'";

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully!";
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Operations</title>
</head>
<body>
    <h2>Create User</h2>
    <form method="POST" action="">
        <input type="text" name="firstname" placeholder="First Name" required>
        <input type="text" name="lastname" placeholder="Last Name" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="text" name="city" placeholder="City" required>
        <input type="submit" name="create" value="Create User">
    </form>

    <h2>Read User</h2>
    <form method="POST" action="">
        <input type="submit" name="read" value="Read User">
    </form>

    <?php
    if (isset($_POST['fetch'])) {
        echo '<h2>Fetch User</h2>';
        echo '<form method="POST" action="">';
        echo '<input type="number" name="personid" placeholder="Person ID" required>';
        echo '<input type="submit" name="fetch" value="Fetch User">';
        echo '</form>';
    }
    ?>

    <?php
    if (isset($_POST['fetch']) && !empty($_POST['personid'])) {
        echo '<h2>User Details</h2>';
        echo '<p><strong>Person ID:</strong> ' . $_POST['personid'] . '</p>';

        $personID = $_POST['personid'];

        $sql = "SELECT * FROM user WHERE PersonID='$personID'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p><strong>Last Name:</strong> " . $row["LastName"] . "</p>";
                echo "<p><strong>First Name:</strong> " . $row["FirstName"] . "</p>";
                echo "<p><strong>Address:</strong> " . $row["Address"] . "</p>";
                echo "<p><strong>City:</strong> " . $row["City"] . "</p>";
            }
        } else {
            echo "No user found with the specified Person ID.";
        }
    }
    ?>

    <h2>Update User</h2>
    <form method="POST" action="">
        <input type="number" name="personid" placeholder="Person ID" required>
        <input type="text" name="newaddress" placeholder="New Address" required>
        <input type="text" name="newcity" placeholder="New City" required>
        <input type="submit" name="update" value="Update User">
    </form>
</body>
</html>
