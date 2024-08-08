<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Real Estate Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            position: relative;
        }

        .header-content {
            width: 80%;
            margin: 0 auto;
        }

        .header-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .header-title h1 {
            font-size: 2em;
            margin: 0;
        }

        .nav {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .nav a {
            color: #fff;
            padding: 15px 20px;
            text-decoration: none;
            display: block;
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
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #4a90e2;
            font-size: 2.5em;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            margin-bottom: 10px;
            color: #333;
            font-size: 2em;
            border-bottom: 2px solid #4a90e2;
            padding-bottom: 5px;
        }

        .section p {
            line-height: 1.6;
            color: #555;
            font-size: 1.1em;
        }

        .team-member {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .team-member img {
            border-radius: 50%;
            margin-right: 20px;
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 2px solid #4a90e2;
        }

        .team-member h3 {
            margin: 0;
            color: #4a90e2;
        }

        .team-member p {
            color: #777;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            margin-top: 20px;
        }

        footer a {
            color: #4a90e2;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
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
                <div class="dropdown">
                    <a href="#" class="dropbtn">Listings</a>
                    <div class="dropdown-content">
                        <a href="houses-for-rent.php">Houses for Rent</a>
                        <a href="houses-for-purchase.php">Houses for Purchase</a>
                        <a href="airbnb.php">Airbnb</a>
                        <a href="hostels.php">Hostels</a>
                    </div>
                </div>
                <a href="about.php">About</a>
                <a href="contact.php">Contact</a>
                <div class="dropdown">
                    <a href="#">Account</a>
                    <div class="dropdown-content">
                        <a href="register.php">Create Account</a>
                        <a href="login.php">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <h1>About Us</h1>
        <div class="section">
            <h2>Our Mission</h2>
            <p>
                At Real Estate Platform, our mission is to provide the best property solutions for our clients. We are committed to offering comprehensive real estate services that make buying, selling, and renting properties easy and stress-free. Our team of experienced professionals is dedicated to delivering exceptional service and helping you find the perfect property to meet your needs.
            </p>
        </div>
        <div class="section">
            <h2>Our Team</h2>
            <div class="team-member">
                <img src="images/team1.jpg" alt="Team Member 1">
                <div>
                    <h3>Jane Doe</h3>
                    <p>Chief Executive Officer</p>
                </div>
            </div>
            <div class="team-member">
                <img src="images/team2.jpg" alt="Team Member 2">
                <div>
                    <h3>John Smith</h3>
                    <p>Head of Sales</p>
                </div>
            </div>
            <!-- Add more team members as needed -->
        </div>
        <div class="section">
            <h2>Why Choose Us?</h2>
            <p>
                We stand out from the competition with our personalized approach and unwavering dedication to our clients. Our in-depth market knowledge, combined with our commitment to excellent customer service, ensures that you receive the best possible experience when working with us. Whether you are buying, selling, or renting, we are here to guide you every step of the way.
            </p>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Real Estate Platform. All rights reserved. <a href="contact.php">Contact Us</a></p>
    </footer>
</body>
</html>
