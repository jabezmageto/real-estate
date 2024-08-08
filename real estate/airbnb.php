<?php
include 'config.php';

// Fetch Airbnb listings from the database
$sql = "SELECT * FROM properties";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airbnb Listings - Real Estate Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            color: black;
            background-color: wheat;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            
            justify-content: flex-start;
        }

        header .nav {
            display: flex;
            justify-content: right;
            gap: 15px;
            position: relative;
        }

        header .nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            position: relative;
        }

        header .nav a:hover {
            text-decoration: underline;
        }

        header .dropdown {
            position: relative;
        }

        header .dropdown .dropbtn {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        header .dropdown .dropbtn:hover {
            background-color: #0056b3;
        }

        header .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            top: 100%;
            left: 0;
        }

        header .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        header .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        header .dropdown:hover .dropdown-content {
            display: block;
        }

        .container {
            margin: 20px auto;
            width: 90%;
            max-width: 1200px;
        }

        .property-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .property-item {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 30%;
            text-align: center;
            transition: transform 0.3s;
            opacity: 0.7;
        }

        .property-item:hover {
            transform: translateY(-5px);
        }

        .property-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .property-item h3 {
            color: black;
            margin: 10px 0;
        }

        .property-item p {
            color: #666;
            margin: 10px 0;
        }

        .btn-custom {
            background-color: #4a90e2;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
            padding: 10px 20px;
            display: inline-block;
        }

        .btn-custom:hover {
            background-color: #357abd;
        }

        a {
            color: black;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .modal-header h5 {
            margin: 0;
            color: #007bff;
        }
        .modal-body {
            padding: 20px 0;
        }
        .modal-buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .modal-buttons a {
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
        }
        .modal-buttons a.secondary {
            background-color: #6c757d;
        }
        .btn-close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Real Estate Platform</h1>
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
                <a href="upload.php" id="sellButton">Sell</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1>Airbnb Listings</h1>
        <a href="index.php" class="btn-custom">Back to Home</a>
        <div class="property-list">
            <?php
            while ($property = $result->fetch_assoc()) {
                echo "<div class='property-item'>";
                echo "<img src='uploads/" . htmlspecialchars($property['image']) . "' alt='Property Image'>";
                echo "<h3>" . htmlspecialchars($property['title']) . "</h3>";
                echo "<p>Price: $" . htmlspecialchars($property['price']) . "</p>";
                echo "<p>Location: " . htmlspecialchars($property['location']) . "</p>";
                echo "<a href='view-details.php?id=" . htmlspecialchars($property['id']) . "' class='btn-custom'>View Details</a>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById('loginRegisterModal');

        // Get the button that opens the modal
        var sellButton = document.getElementById("sellButton");

        // When the user clicks the button, open the modal
        sellButton.onclick = function(event) {
            event.preventDefault(); // Prevent the default action
            modal.style.display = "block";
        };

        // Get the element that closes the modal
        var closeBtn = document.querySelector(".btn-close");

        // When the user clicks on the close button, close the modal
        closeBtn.onclick = function() {
            modal.style.display = "none";
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    </script>
</body>
</html>

<?php
$conn->close();
?>
