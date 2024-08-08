<?php
include 'config.php';
include 'session.php'; // Ensure session management is included

// Fetch house listings from the database
$sql = "SELECT * FROM properties";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    // Output the error message
    die("Error executing query: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Real Estate Platform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            background-color: #f7f7f7;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('uploads/5.jpg');
            background-size: cover;
            background-position: center;
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
        .dropdown-content-sub {
            display: none;
            position: absolute;
            top: 0;
            left: 100%;
            background-color: #fff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .dropdown-content-sub a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content-sub a:hover {
            background-color: #f1f1f1;
        }
        .dropdown:hover .dropdown-content-sub {
            display: block;
        }
        .search-bar-container {
            background-image: url('images/img1.jpg'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            padding: 30px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .search-form {
            display: flex;
            margin: 0;
        }
        .search-form input {
            flex: 1;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
            font-size: 16px;
        }
        .search-form button {
            padding: 15px 20px;
            border: none;
            background-color: lightgreen;
            color: black;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            font-size: 16px;
        }
        .search-form button:hover {
            background-color: #0056b3;
        }
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .property {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
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
            <div class="header-title">
                <h1>Real Estate Platform</h1>
                <h2>Purchase Or Rent Your Property Here</h2>
            </div>
            <nav class="nav">
                <a href="index.php">Home</a>
                <div class="dropdown">
                    <a href="#">Listings <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="airbnb.php">Airbnb</a>
                        <a href="bedsitters.php">Bedsitters</a>
                        <a href="#">Houses For Purchase <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-content-sub">
                            <a href="apartments.php">Apartments</a>
                            <a href="condos.php">Condos</a>
                            <a href="townhouses.php">Townhouses</a>
                            <a href="villas.php">Villas</a>
                        </div>
                        <a href="#">Houses For Rent <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-content-sub">
                            <a href="houses_for_rent_apartments.php">Apartments</a>
                            <a href="houses_for_rent_condos.php">Condos</a>
                            <a href="houses_for_rent_townhouses.php">Townhouses</a>
                            <a href="houses_for_rent_villas.php">Villas</a>
                        </div>
                        <a href="hostels.php">Hostels</a>
                        <a href="shops.php">Shops To Let</a>
                    </div>
                </div>
                <a href="contact.php">Contact</a>
                <a href="about.php">About</a>
                <a href="#" id="sellBtn">Sell</a>
                <a href="upload.php"></a>
            </nav>
        </div>
    </header>
    <div class="container">
        <div class="search-bar-container">
            <form class="search-form example" action="/action_page.php">
                <input type="text" placeholder="Search for properties..." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        
        <div class="gallery">
            <?php while ($row = $result->fetch_assoc()): ?>
            <div class="property">
                <img src="uploads/<?php echo $row['image']; ?>" alt="Property Image">
                <div class="details">
                    <h3><?php echo $row['title']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <p>Location: <?php echo $row['location']; ?></p>
                    <p>Price: Ksh <?php echo $row['price']; ?></p>
                </div>
                <div class="property-footer">
                    <a href="booking.php?property_id=<?php echo $row['id']; ?>">Book Now</a> or <a href="purchase.php?property_id=<?php echo $row['id'];?> Purchase </a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Modal for Register/Login -->
    <div id="sellModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Register or Login</h5>
                <button class="btn-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <p>You need to register or log in to sell properties. Please choose an option below:</p>
                <div class="modal-buttons">
                    <a href="register.php">Register</a>
                    <a href="login.php" class="secondary">Login</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('sellBtn').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('sellModal').style.display = 'block';
        });

        function closeModal() {
            document.getElementById('sellModal').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('sellModal')) {
                closeModal();
            }
        }
    </script>
</body>
</html>
