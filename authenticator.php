<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'phpcrud';
    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to database!');
    }
}
$pdo = pdo_connect_mysql();


// Check if the user is already logged in
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    header("Location: index.php");
    exit;
}


// Check if the form is submitted
if(isset($_POST['username']) && isset($_POST['password'])){
    // Validate credentials
    $username = $_POST['username'];
    $password = $_POST['password'];


     // Prepare and execute the query
     $stmt = $pdo->prepare("SELECT email, username, password FROM contacts WHERE username = :username");
     $stmt->execute(['username' => $username]);
 
     // Fetch user data
     $user = $stmt->fetch();




     if($user){
        // Verify password
        if($password == $user['password']){
            // Password is correct, start a new session
            session_start();
            // Store data in session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['username'];
            // Redirect user to dashboard page
            header("Location: index.php");
            exit;
        } else {
            // Password is incorrect
            $error = "Invalid password";
        }
    } else {
        // User not found
        $error = "User not found";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>


<div class="container">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-6">
            <h1 class="display-1">Login</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <!-- username input -->
                <div class="form-outline mb-4">
                    <input type="text" name="username" id="form2Example1" class="form-control" />
                    <label class="form-label" for="form2Example1">username</label>
                </div>


                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" class="form-control" />
                    <label class="form-label" for="form2Example2">Password</label>
                </div>


                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                    <!-- Checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                        <label class="form-check-label" for="form2Example31"> Remember me </label>
                    </div>
                    </div>


                    <div class="col">
                    <!-- Simple link -->
                    <a href="#!">Forgot password?</a>
                    </div>
                </div>


                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4" name="login">Sign in</button>


                <!-- Register buttons -->
                <div class="text-center">
                    <p>Not a member? <a href="#!">Register</a></p>
                    <p>or sign up with:</p>
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
                </form>
            </div>
            <?php if(isset($error)) { ?>
                    <div><?php echo $error; ?></div>
            <?php } ?>


    </div>
   
</div>


</body>
</html>
