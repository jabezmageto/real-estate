<?php
// Include your database connection file
include 'config.php';

// Initialize $result
$result = false;

// Check if the search query is set
if (isset($_GET['query'])) {
    $searchQuery = htmlspecialchars($_GET['query']);

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM properties WHERE description LIKE CONCAT('%', ?, '%')");
    $stmt->bind_param("s", $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Real Estate Platform</title>
    <style>
        /* Add your existing CSS here */
        body {
            background-color: #f7f7f7;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: whitesmoke;
            color: black;
            padding: 20px;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        .header-title h1 {
            margin: 0;
            font-size: 36px;
        }
        .nav {
            display: flex;
            justify-content: right;
            align-items: center;
        }
        .nav a {
            color: black;
            text-decoration: none;
            margin-left: 20px;
        }
        .nav a:hover {
            text-decoration: underline;
        }
        .section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .property {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .property img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .property .details {
            padding: 15px;
        }
        .property h3 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #007bff;
        }
        .property p {
            margin: 0 0 10px;
        }
        .property-footer {
            padding: 15px;
            background-color: #f7f7f7;
            text-align: center;
        }
        .property-footer a {
            text-decoration: none;
            color: #007bff;
            padding: 8px 16px;
            border: 1px solid #007bff;
            border-radius: 4px;
            display: inline-block;
            margin: 5px 0;
        }
        .property-footer a:hover {
            background-color: #007bff;
            color: #fff;
        }
        .property:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .property:hover img {
            transform: scale(1.05);
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }
        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-title">
                <h1>Real Estate Platform</h1>
            </div>
            <nav class="nav">
                <a href="index.php">Home</a>
                <div class="dropdown">
                    <a href="#">Listings</a>
                    <div class="dropdown-content">
                        <a href="houses-for-rent.php">Houses for Rent</a>
                        <a href="houses-for-purchase.php">Houses for Purchase</a>
                        <a href="airbnb.php">Airbnb</a>
                        <a href="bedsitter.php">Bedsitters</a>
                    </div>
                </div>
                <a href="about.php">About</a>
                <a href="contact.php">Contact</a>
               
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="section">
            <h2 class="text-primary mb-4">Search Results</h2>
            <div class="row">
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4'>";
                        echo "<div class='property'>";
                        echo "<img src='uploads/" . htmlspecialchars($row["image"]) . "' alt='Property Image'>";
                        echo "<div class='details'>";
                        echo "<h3>" . htmlspecialchars($row["title"]) . "</h3>";
                        echo "<p>" . htmlspecialchars($row["description"]) . "</p>";
                        echo "<p>Price: $" . htmlspecialchars($row["price"]) . "</p>";
                        echo "<p>Location: " . htmlspecialchars($row["location"]) . "</p>";
                        echo "</div>";
                        echo "<div class='property-footer'>";
                        echo "<a href='view-details.php?id=" . $row["id"] . "'>View Details</a>";
                        if (!isLoggedIn()) {
                            echo "<p><a href='login.php'>Login</a> to purchase</p>";
                        } else {
                            echo "<a href='purchase.php?id=" . $row["id"] . "'>Purchase</a>";
                        }
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Search Results<h1>0</h1></p>";
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("sellButton").addEventListener("click", function(event) {
            event.preventDefault();
            var isLoggedIn = <?php echo isLoggedIn() ? 'true' : 'false'; ?>;
            if (!isLoggedIn) {
                openModal();
            } else {
                window.location.href = "upload.php";
            }
        });

        function openModal() {
            document.getElementById("loginPromptModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("loginPromptModal").style.display = "none";
        }
    </script>
</body>
</html>
