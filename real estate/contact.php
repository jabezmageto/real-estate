<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Real Estate Platform</title>
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
            font-size: 2.5em;
            margin: 0;
            color: #4a90e2;
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

        .contact-info {
            margin-bottom: 20px;
        }

        .contact-info h2 {
            margin-bottom: 10px;
            color: #333;
            font-size: 1.8em;
        }

        .contact-info p {
            margin: 5px 0;
            line-height: 1.6;
            color: #555;
            font-size: 1.1em;
        }

        .contact-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .contact-form button {
            padding: 12px 20px;
            background-color: #4a90e2;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        .contact-form button:hover {
            background-color: #357abd;
        }

        .map {
            margin: 20px 0;
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
        <h1>Contact Us</h1>

        <div class="contact-info">
            <h2>Our Address</h2>
            <p>123 Real Estate Avenue, Suite 456<br>
            Property City, PC 78901<br>
            Country</p>

            <h2>Phone</h2>
            <p>+123 456 7890</p>

            <h2>Email</h2>
            <p>info@realestateplatform.com</p>
        </div>

        <div class="map">
            <h2>Find Us Here</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.1985169342695!2d-122.40641768468118!3d37.78552717975827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085808a550fe9e7%3A0x69e4baf8b7f3aa60!2s123%20Real%20Estate%20Ave%2C%20San%20Francisco%2C%20CA%2094181!5e0!3m2!1sen!2sus!4v1622233439796!5m2!1sen!2sus" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <div class="contact-form">
            <h2>Send Us a Message</h2>
            <form action="contact_form_processor.php" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="text" name="subject" placeholder="Subject" required>
                <textarea name="message" rows="6" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Real Estate Platform. All rights reserved. <a href="contact.php">Contact Us</a></p>
    </footer>
</body>
</html>
