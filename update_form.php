<?php
include 'Database.php';
include 'User.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve the matric value from the GET request
    $matric = $_GET['matric'];

    // Process the update using the matric value
    // For example, you can fetch the user data using the matric value and display it in a form for updating
    // Create an instance of the Database class and get the connection
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $userDetails = $user->getUser($matric);

    $db->close();

    // Display the update form with the fetched user data
    if ($userDetails) {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update User</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f9;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }

                .container {
                    background-color: #fff;
                    padding: 30px;
                    border-radius: 10px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    width: 100%;
                    max-width: 400px;
                }

                h2 {
                    text-align: center;
                    color: #333;
                }

                label {
                    font-size: 16px;
                    color: #555;
                    display: block;
                    margin-bottom: 8px;
                }

                input[type="text"], select {
                    width: 100%;
                    padding: 10px;
                    margin: 8px 0;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    box-sizing: border-box;
                }

                input[type="submit"] {
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    padding: 12px 20px;
                    font-size: 16px;
                    border-radius: 5px;
                    cursor: pointer;
                    width: 100%;
                    margin-top: 10px;
                }

                input[type="submit"]:hover {
                    background-color: #45a049;
                }

                .error-message {
                    color: red;
                    text-align: center;
                    margin-top: 20px;
                }
            </style>
        </head>

        <body>
            <div class="container">
                <h2>Update User Information</h2>
                <form action="update.php" method="post">
                    <!-- Hidden input field for matric to pass it along with the form -->
                    <input type="hidden" name="matric" value="<?php echo htmlspecialchars($userDetails['matric']); ?>">

                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userDetails['name']); ?>" required><br>

                    <label for="role">Role:</label>
                    <select name="role" id="role" required>
                        <option value="">Please select</option>
                        <option value="lecturer" <?php if ($userDetails['role'] == 'lecturer') echo "selected"; ?>>Lecturer</option>
                        <option value="student" <?php if ($userDetails['role'] == 'student') echo "selected"; ?>>Student</option>
                    </select><br>

                    <input type="submit" value="Update">
                </form>
            </div>
        </body>

        </html>
        <?php
    } else {
        echo "<p class='error-message'>User not found!</p>";
    }
}
?>

