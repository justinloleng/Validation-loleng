<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <h2>Registration Form</h2>
        <?php
        session_start();
        $name = "";
        $email = "";
        $password = "";
        $confirmpass = "";
        $gender = "";
        $biography = "";
        $country = "";
        $phone = "";
        $skills = [];
        $errors = [];


        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST["name"])) {
                $errors[] = "Name is required.";
            } else {
                $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
                if (!preg_match("/^[a-zA-Z\s]*$/", $name)) {
                    $errors[] = "Name can only contain letters and spaces.";
                }
            }


            if (empty($_POST["email"])) {
                $errors[] = "Email is required.";
            } else {
                $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Invalid email format.";
                }
            }


            if (empty($_POST["password"])) {
                $errors[] = "Password is required.";
            } else {
                $password = $_POST["password"];
                if (strlen($password) < 8 || !preg_match("/[A-Za-z]/", $password) || !preg_match("/\d/", $password)) {
                    $errors[] = "Password must be at least 8 characters long and contain both letters and numbers.";
                }
            }


            if (empty($_POST["confirmpass"])) {
                $errors[] = "Confirm password is required.";
            } else {
                $confirmpass = $_POST["confirmpass"];
                if ($password !== $confirmpass) {
                    $errors[] = "Passwords do not match.";
                }
            }


            if (empty($_POST["phone"])) {
                $errors[] = "Phone number is required.";
            } else {
                $phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
                if (!preg_match("/^[0-9]+$/", $phone)) {
                    $errors[] = "Phone number must be numeric.";
                }
            }


            if (empty($_POST["gender"])) {
                $errors[] = "Gender is required.";
            } else {
                $gender = $_POST["gender"];
            }


            if (empty($_POST["country"])) {
                $errors[] = "Country is required.";
            } else {
                $country = $_POST["country"];
            }


            if (empty($_POST["skills"])) {
                $errors[] = "Please select at least one skill.";
            } else {
                $skills = $_POST["skills"];
            }


            if (empty($_POST["biography"])) {
                $errors[] = "Biography is required.";
            } else {
                $biography = htmlspecialchars($_POST["biography"]);
                if (strlen($biography) > 200) {
                    $errors[] = "Biography must be less than 200 characters.";
                }
            }

            if (empty($errors)) {
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['phone'] = $phone;
                $_SESSION['gender'] = $gender;
                $_SESSION['country'] = $country;
                $_SESSION['skills'] = $skills;
                $_SESSION['biography'] = $biography;

                header("Location: about.php");
                exit;
            } else {
                echo "<div class='alert alert-danger'><ul>";
                foreach ($errors as $error) {
                    echo "<li>$error</li>";
                }
                echo "</ul></div>";
            }
        }
        ?>

        <form action="" method="post">
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>">
            </div>

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
            </div>

            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>

            <div class="mb-3">
                <label for="confirmpass">Confirm Password</label>
                <input type="password" class="form-control" name="confirmpass" id="confirmpass">
            </div>

            <div class="mb-3">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phone; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if ($gender == 'male') echo 'checked'; ?>>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if ($gender == 'female') echo 'checked'; ?>>
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-select" name="country" id="country">
                    <option value="">Select a country</option>
                    <option value="Philippines" <?php if ($country == 'Philippines') echo 'selected'; ?>>Philippines</option>
                    <option value="Indonesia" <?php if ($country == 'Indonesia') echo 'selected'; ?>>Indonesia</option>
                    <option value="Mumbai" <?php if ($country == 'Mumbai') echo 'selected'; ?>>Mumbai</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Skills</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="skills[]" id="html" value="HTML" <?php if (in_array("HTML", $skills)) echo 'checked'; ?>>
                    <label class="form-check-label" for="html">HTML</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="skills[]" id="css" value="CSS" <?php if (in_array("CSS", $skills)) echo 'checked'; ?>>
                    <label class="form-check-label" for="css">CSS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="skills[]" id="js" value="JavaScript" <?php if (in_array("JavaScript", $skills)) echo 'checked'; ?>>
                    <label class="form-check-label" for="js">JavaScript</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="skills[]" id="python" value="Python" <?php if (in_array("Python", $skills)) echo 'checked'; ?>>
                    <label class="form-check-label" for="python">Python</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="biography" class="form-label">Biography</label>
                <textarea class="form-control" name="biography" id="biography" rows="3" maxlength="200"><?php echo $biography; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>

</html>