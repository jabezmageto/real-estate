<?php
include 'config.php';
include 'session.php';

// Check if the user is logged in
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user ID from session
    $user_id = getUser()['id'];

    // Check if all required form fields are set
    if (isset($_POST['title'], $_POST['description'], $_POST['price'], $_POST['location']) && isset($_FILES['images'])) {
        // Process form data
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $location = $_POST['location'];

        // Process image upload
        $images = $_FILES['images'];
        $file_count = count($images['name']);

        if ($file_count < 4 || $file_count > 10) {
            echo "You must upload between 4 and 10 images.";
        } else {
            $uploaded_images = [];
            foreach ($images['tmp_name'] as $key => $tmp_name) {
                $image_name = basename($images['name'][$key]);
                $upload_path = 'uploads/' . $image_name;
                if (move_uploaded_file($tmp_name, $upload_path)) {
                    $uploaded_images[] = $image_name;
                }
            }

            // Save property details to the database
            $uploaded_images_str = implode(',', $uploaded_images);
            $sql = "INSERT INTO properties (title, description, price, location, image, user_id) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssisi', $title, $description, $price, $location, $uploaded_images_str, $user_id);
            if ($stmt->execute()) {
                header("Location: my-properties.php?upload=success");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    } else {
        echo "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('imageUpload');

    fileInput.addEventListener('change', function() {
        const files = fileInput.files;
        const fileCount = files.length;
        
        if (fileCount < 4 || fileCount > 10) {
            alert('Please select between 4 and 10 images.');
            fileInput.value = ''; // Clear the input
        }
    });
});
</script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Property</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #ff6f61, #deba5a);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 600px;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 2em;
            background: linear-gradient(to right, #ff6f61, #deba5a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input, textarea, button {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        input[type="file"] {
            padding: 0;
        }

        input:focus, textarea:focus {
            border-color: #ff6f61;
        }

        button {
            background-color: #ff6f61;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #deba5a;
        }

        p.success {
            color: #4caf50;
            font-weight: bold;
        }

        p.error {
            color: #ff4c4c;
            font-weight: bold;
        }

        a {
            color: #ff6f61;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Upload Property</h1>
        <p><a href="index.php">Home</a></p>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Title" required><br>
            <textarea name="description" placeholder="Description" required></textarea><br>
            <input type="number" step="0.01" name="price" placeholder="Price" required><br>
            <input type="text" name="location" placeholder="Location" required><br>
            <input type="file" id="imageUpload" name="images[]" multiple required><br>

            <button type="submit">Upload Property</button>
        </form>
        <?php
        if (isset($_GET['upload']) && $_GET['upload'] == 'success') {
            echo "<p class='success'>Property uploaded successfully!</p>";
        }
        ?>
    </div>
</body>
</html>
