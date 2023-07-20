<?php
// Assuming you have established a database connection

// Prepare the SQL statement
$sql = "INSERT INTO user (PersonID, LastName, FirstName, Address, City)
        VALUES (?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = $pdo->prepare($sql);

// Assign values to the parameters
$personID = 1; // Replace with the actual PersonID value
$lastName = "Doe"; // Replace with the actual LastName value
$firstName = "John"; // Replace with the actual FirstName value
$address = "123 Main Street"; // Replace with the actual Address value
$city = "New York"; // Replace with the actual City value

// Bind the parameters
$stmt->bindParam(1, $personID);
$stmt->bindParam(2, $lastName);
$stmt->bindParam(3, $firstName);
$stmt->bindParam(4, $address);
$stmt->bindParam(5, $city);

// Execute the statement
$stmt->execute();

// Check if the insertion was successful
if ($stmt->rowCount() > 0) {
    echo "User created successfully.";
} else {
    echo "Failed to create user.";
}
?>
<?php
// Assuming you have established a database connection

// Prepare the SQL statement
$sql = "SELECT * FROM user WHERE PersonID = ?";

// Prepare the statement
$stmt = $pdo->prepare($sql);

// Assign the value to the parameter
$personID = 1; // Replace with the actual PersonID value

// Bind the parameter
$stmt->bindParam(1, $personID);

// Execute the statement
$stmt->execute();

// Fetch the user's information
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the user was found
if ($user) {
    echo "PersonID: " . $user['PersonID'] . "<br>";
    echo "LastName: " . $user['LastName'] . "<br>";
    echo "FirstName: " . $user['FirstName'] . "<br>";
    echo "Address: " . $user['Address'] . "<br>";
    echo "City: " . $user['City'] . "<br>";
} else {
    echo "User not found.";
}
?>
<?php
// Assuming you have established a database connection

// Prepare the SQL statement
$sql = "UPDATE user SET LastName = ?, FirstName = ?, Address = ?, City = ?
        WHERE PersonID = ?";

// Prepare the statement
$stmt = $pdo->prepare($sql);

// Assign values to the parameters
$lastName = "Smith"; // Replace with the updated LastName value
$firstName = "Jane"; // Replace with the updated FirstName value
$address = "456 Oak Avenue"; // Replace with the updated Address value
$city = "Los Angeles"; // Replace with the updated City value
$personID = 1; // Replace with the actual PersonID value

// Bind the parameters
$stmt->bindParam(1, $lastName);
$stmt->bindParam(2, $firstName);
$stmt->bindParam(3, $address);
$stmt->bindParam(4, $city);
$stmt->bindParam(5, $personID);

// Execute the statement
$stmt->execute();

// Check if the update was successful
if ($stmt->rowCount() > 0) {
    echo "User updated successfully.";
} else {
    echo "Failed to update user.";
}
?>
<?php
// Assuming you have established a database connection

// Prepare the SQL statement
$sql = "DELETE FROM user WHERE PersonID = ?";

// Prepare the statement
$stmt = $pdo->prepare($sql);

// Assign the value to the parameter
$personID = 1; // Replace with the actual PersonID value

// Bind the parameter
$stmt->bindParam(1, $personID);

// Execute the statement
$stmt->execute();

// Check if the deletion was successful
if ($stmt->rowCount() > 0) {
    echo "User deleted successfully.";
} else {
    echo "Failed to delete user.";
}
?>

