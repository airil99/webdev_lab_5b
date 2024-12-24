<?php
include 'Database.php';
include 'User.php';

// Create an instance of the Database class and get the connection
$database = new Database();
$db = $database->getConnection();

// Create an instance of the User class
$user = new User($db);
$result = $user->getUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 40px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            text-decoration: none;
            padding: 8px 12px;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
        }

        a:hover {
            background-color: #0056b3;
        }

        .action-buttons a {
            margin-right: 10px;
        }

        .no-users {
            text-align: center;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>User List</h1>
        <table>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Level</th>
                <th colspan="2">Action</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                // Fetch each row from the result set
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row["matric"]; ?></td>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["role"]; ?></td>
                        <td class="action-buttons">
                            <a href="update_form.php?matric=<?php echo $row["matric"]; ?>">Update</a>
                            <a href="delete.php?matric=<?php echo $row["matric"]; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='5' class='no-users'>No users found</td></tr>";
            }
            // Close connection
            $db->close();
            ?>
        </table>
    </div>
</body>

</html>
