<?php
include 'config.php';
include 'session.php'; // Ensure session management is included

// Fetch user ID from session
$user_id = $_SESSION['user_id'];

// Fetch bookings for the logged-in user
$sql = "SELECT b.*, p.title, p.description, p.image, p.price FROM bookings b
        JOIN properties p ON b.property_id = p.id
        WHERE b.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

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
    <title>My Bookings - Real Estate Platform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
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
        .booking-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .booking {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .booking img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .booking .details {
            padding: 15px;
        }
        .booking h3 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #007bff;
        }
        .booking p {
            margin: 0 0 10px;
        }
        .booking-footer {
            padding: 15px;
            background-color: #f7f7f7;
            text-align: center;
            border-top: 1px solid #ddd;
        }
        .booking-footer span {
            display: block;
            margin-bottom: 5px;
        }
        .booking:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .booking:hover img {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-title">
                <h1>My Bookings</h1>
            </div>
            <nav class="nav">
                <a href="index.php">Home</a>
                <a href="contact.php">Contact</a>
                <a href="about.php">About</a>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>
    <div class="container">
        <div class="booking-list">
            <?php while ($row = $result->fetch_assoc()): ?>
            <div class="booking">
                <img src="uploads/<?php echo $row['image']; ?>" alt="Property Image">
                <div class="details">
                    <h3><?php echo $row['title']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <p>Price: Ksh <?php echo $row['price']; ?></p>
                    <p>Status: <?php echo $row['status']; ?></p>
                </div>
                <div class="booking-footer">
                    <span>Booking Date: <?php echo $row['booking_date']; ?></span>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
