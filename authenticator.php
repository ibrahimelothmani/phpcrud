<?php

include 'functions.php';

// Connect to MySQL database
$pdo = pdo_connect_mysql();
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    echo "Check if the user is already logged in";
    header("Location : index.php");
    exit;
}

// check if the form is submitted 
if (isset($_POST['username']) && isset($_POST['password'])) {
    // echo "Check if the form is submitted";
    $username = $_POST['username'];
    $password = $_POST['password'];
}
// Validate credentials
$stmt = $pdo->prepare('SELECT email, username, password FROM contacts WHERE username = :username');
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();

if ($user) {
    if ($password = $user['password']) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit;
    }
} else {
    // Password is incorrect
    $error = "Invalid password";
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>$title</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body>
    <nav class="navtop">
        <div>
            <h1>Website Title</h1>
            <a href="index.php"><i class="fas fa-home"></i>Home</a>
            <a href="read.php"><i class="fas fa-address-book"></i>Contacts</a>
            <a href="authenticator.php"><i class="fas fa-address-book"></i>Login</a>
        </div>
    </nav>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- Pills navs -->
    <ul class="nav nav-pills nav-justified mb-3 mt-5 ms-5 me-5" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
        </li>
    </ul>
    <!-- Pills navs -->

    <!-- Pills content -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
            <form method="post">
                <div class="text-center mb-3">
                    <p>Sign in with:</p>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                    </button>

                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-google"></i>
                    </button>

                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-twitter"></i>
                    </button>

                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-github"></i>
                    </button>
                </div>

                <p class="text-center">or:</p>

                <!-- Username input -->
                <div class="form-outline mb-4">
                    <input type="text" id="username" class="form-control ms-5 me-5" name="username" />
                    <label class="form-label ms-5 me-5" for="username">Email or Username</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="password" class="form-control ms-5 me-5" name="password" />
                    <label class="form-label ms-5 me-5" for="password">Password</label>
                </div>

                <!-- Submit button -->
                <button type="button" class="btn btn-primary btn-block mb-4 ms-5 me-5">Sign in</button>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Not a member? <a href="#!">Register</a></p>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
            <!-- Registration form content -->
            <!-- You can implement the registration form similar to the login form -->
        </div>
    </div>

    <?php if (isset($error)) { ?>
        <div><?php echo $error; ?></div>
    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>