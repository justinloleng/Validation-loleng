<?php
session_start();

if (!isset($_SESSION['name'])) {
    echo "No data to display. Please go back and submit the form.";
    exit;
}
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];
$gender = $_SESSION['gender'];
$country = $_SESSION['country'];
$skills = $_SESSION['skills'];
$biography = $_SESSION['biography'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
        background-color: #f0f8ff;
    }

    .form-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
</style>

<body>
    <div class="container mt-3">
        <h2>User Information</h2>
        <ul class="list-group">
            <li class="list-group-item"><strong>Name:</strong> <?php echo $name; ?></li>
            <li class="list-group-item"><strong>Email:</strong> <?php echo $email; ?></li>
            <li class="list-group-item"><strong>Phone:</strong> <?php echo $phone; ?></li>
            <li class="list-group-item"><strong>Gender:</strong> <?php echo ucfirst($gender); ?></li>
            <li class="list-group-item"><strong>Country:</strong> <?php echo $country; ?></li>
            <li class="list-group-item"><strong>Skills:</strong> <?php echo implode(", ", $skills); ?></li>
            <li class="list-group-item"><strong>Biography:</strong> <?php echo $biography; ?></li>
        </ul>
        <a href="regisform.php" class="btn btn-primary mt-3">Back to Registration</a>
    </div>
</body>

</html>