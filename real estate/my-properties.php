<?php
include 'config.php';
include 'session.php';

// Check if user is logged in
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

// Get user information
$user = getUser();
$user_id = $user['id'];
$username = htmlspecialchars($user['username']); // Assuming 'username' is a key in getUser()

// Handle property deletion
if (isset($_POST['delete_property_id'])) {
    $property_id = intval($_POST['delete_property_id']);
    $stmt_delete = $conn->prepare("DELETE FROM properties WHERE id = ? AND user_id = ?");
    if ($stmt_delete) {
        $stmt_delete->bind_param('ii', $property_id, $user_id);
        $stmt_delete->execute();
        $stmt_delete->close();
    } else {
        die("Error preparing statement: " . $conn->error);
    }
}

// Fetch properties uploaded by the logged-in user
$sql = "SELECT * FROM properties WHERE user_id = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    die("Error preparing statement: " . $conn->error);
}

// Fetch booked properties
$sql_booked = "SELECT * FROM bookings WHERE user_id = ?";
$stmt_booked = $conn->prepare($sql_booked);
if ($stmt_booked) {
    $stmt_booked->bind_param('i', $user_id);
    $stmt_booked->execute();
    $result_booked = $stmt_booked->get_result();
} else {
    die("Error preparing statement: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Properties - Real Estate Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
        }

        .header-content {
            width: 80%;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-title h1 {
            margin: 0;
            font-size: 2em;
        }

        .nav {
            display: flex;
        }

        .nav a {
            color: #fff;
            padding: 15px 20px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
        }

        .nav a:hover {
            background-color: #555;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .section {
            margin: 20px 0;
        }

        .section h2 {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #333;
        }

        .button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 20px;
        }

        .button:hover {
            background-color: #555;
        }

        .properties {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .property {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .property:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .property h3 {
            margin-top: 0;
            color: #333;
        }

        .property img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .property p {
            color: #666;
            margin: 10px 0;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
            margin-top: 20px;
        }

        .gallery img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .delete-button {
            background-color: #ff0000;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-button:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="header-title">
                <h1>Real Estate Platform</h1>
            </div>
            <div class="nav">
                <a href="index.php">Home</a>
                <a href="my-properties.php">My Properties</a>
                <a href="listings.php">Listings</a>
                <a href="about.php">About</a>
                <a href="contact.php">Contact</a>
                <div class="dropdown">
                    <a href="#">Account</a>
                    <div class="dropdown-content">
                        <a href="register.php">Create Account</a>
                        <a href="login.php">Login</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Display the username -->
    <div class="user-info">
        <p>Welcome, <?php echo $username; ?>!</p>
    </div>

    <div class="container">
        <div class="section">
            <h2>My Properties</h2>
            <a href="upload.php" class="button">Upload New House</a>
            <div class="properties">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Handle images that might be comma-separated
                        $images = explode(',', $row["image"]);
                        echo "<div class='property'>";
                        echo "<h3>" . htmlspecialchars($row["title"]) . "</h3>";
                        
                        // Display images in a gallery
                        echo "<div class='gallery'>";
                        foreach ($images as $image) {
                            $image_src = !empty($image) ? 'uploads/' . htmlspecialchars($image) : 'uploads/default.jpg';
                            echo "<img src='$image_src' alt='Property Image'>";
                        }
                        echo "</div>";
                        
                        echo "<p>" . htmlspecialchars($row["description"]) . "</p>";
                        echo "<p>Price: $" . htmlspecialchars($row["price"]) . "</p>";
                        echo "<p>Location: " . htmlspecialchars($row["location"]) . "</p>";
                        echo "<form method='POST' action=''>";
                        echo "<input type='hidden' name='delete_property_id' value='" . htmlspecialchars($row["id"]) . "'>";
                        echo "<button type='submit' class='delete-button'>Delete</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>You have not uploaded any properties yet.</p>";
                }
                ?>
            </div>
        </div>

        <div class="section">
            <h2>Booked Properties</h2>
            <div class="properties">
                <?php
                if ($result_booked->num_rows > 0) {
                    while ($row_booked = $result_booked->fetch_assoc()) {
                        echo "<div class='property'>";
                        echo "<h3>" . htmlspecialchars($row_booked["property_title"]) . "</h3>";
                        echo "<p>Booked by: " . htmlspecialchars($row_booked["client_name"]) . "</p>";
                        echo "<p>Booking Date: " . htmlspecialchars($row_booked["booking_date"]) . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No properties have been booked yet.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$stmt->close();
$stmt_booked->close();
$conn->close();
?>
