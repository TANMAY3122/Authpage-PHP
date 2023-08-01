<?php
require "includes/header.php";

$host = "localhost";
$db_name = "auth-sys";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function verify_login($email_or_username, $password)
{
    global $conn;

    if (filter_var($email_or_username, FILTER_VALIDATE_EMAIL)) {
        $query = "SELECT * FROM users WHERE email = :email";
    } else {
        $query = "SELECT * FROM users WHERE username = :email";
    }

    $stmt = $conn->prepare($query);
    $stmt->bindValue(':email', $email_or_username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mypassword'])) {
       
        return $user;
    } else {
       
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["email_or_username"]) && isset($_POST["password"])) {
        $email_or_username = $_POST["email_or_username"];
        $password = $_POST["password"];

        $user = verify_login($email_or_username, $password);

        if ($user) {
    
            echo "Login successful!";
        } else {

            echo "Invalid email/username or password. Please try again.";
        }
    }
}
?>

<main class="form-signin w-50 m-auto">
    <form method="POST" action="login.php">
        <h1 class="h3 mt-5 fw-normal text-center">Please login</h1>
        <div class="form-floating">
            <input name="email_or_username" type="text" class="form-control" id="floatingInput"
                placeholder="Email or Username">
            <label for="floatingInput">Email or Username</label>
        </div>
        <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Log In</button>
        <h6 class="mt-3">Don't have an account? <a href="register.php">Register</a></h6>
    </form>
</main>

<?php require "includes/footer.php"; ?>
