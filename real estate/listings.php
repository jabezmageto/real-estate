<?php
include 'config.php';
include 'session.php';

$sql = "SELECT * FROM properties WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$user_id = getUser()['id'];
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die("Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Listings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        .header a:hover {
            text-decoration: underline;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .form-container input,
        .form-container textarea,
        .form-container button {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .form-container button {
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #555;
        }

        .properties {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .property {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 15px;
            width: calc(33% - 40px);
            box-sizing: border-box;
            text-align: center;
        }

        .property img {
            width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .property h2 {
            font-size: 1.5em;
            margin: 10px 0;
        }

        .property p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Real Estate Listings</h1>
            <?php if (isLoggedIn()): ?>
                <p>Welcome, <?php echo getUser()['username']; ?>! <a href="index.php">Logout</a></p>
            <?php else: ?>
                <p><a href="login.php">Login</a> or <a href="register.php">Register</a> to upload your own house for sale.</p>
            <?php endif; ?>
        </div>

        <?php if (isLoggedIn()): ?>
            <div class="form-container">
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="title" placeholder="Title" required><br>
                    <textarea name="description" placeholder="Description" required></textarea><br>
                    <input type="number" step="0.01" name="price" placeholder="Price" required><br>
                    <input type="text" name="location" placeholder="Location" required><br>
                    <input type="file" name="images[]" multiple required><br>
                    <button type="submit">Upload Property</button>
                </form>
            </div>
        <?php endif; ?>

        <?php
        if (isset($_GET['upload']) && $_GET['upload'] == 'success') {
            echo "<script>alert('Property uploaded successfully!');</script>";
        }
        ?>

        <div class="properties">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='property'>";
                    echo "<h2>" . htmlspecialchars($row["title"]) . "</h2>";
                    echo "<img src='uploads/" . htmlspecialchars($row["image"]) . "' alt='Property Image'>";
                    echo "<p>" . htmlspecialchars($row["description"]) . "</p>";
                    echo "<p>Price: $" . htmlspecialchars($row["price"]) . "</p>";
                    echo "<p>Location: " . htmlspecialchars($row["location"]) . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No properties found.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
