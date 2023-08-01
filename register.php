<?php
require "includes/header.php";
require "config.php";

if (isset($_POST['submit'])) {
    if ($_POST['email'] == '' or $_POST['username'] == '' or $_POST['password'] == '') {
        echo "Some input fields are empty.";
    } else {
        $myemail = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

    
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=auth-sys", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        $insert = $pdo->prepare("INSERT INTO users (email, username, mypassword) VALUES (:myemail, :username, :mypassword)");
        $insert->execute([
            ':myemail' => $myemail,
            ':username' => $username,
            ':mypassword' => password_hash($password, PASSWORD_DEFAULT),
        ]);
        echo "Registration successful! You can now log in.";
    }
}
?>

<main class="form-signin w-50 m-auto">
  <form method="POST" action="register.php">
   
    <h1 class="h3 mt-5 fw-normal text-center">Please Register</h1>

    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>

    <div class="form-floating">
      <input name="username" type="text" class="form-control" id="floatingInput" placeholder="username">
      <label for="floatingInput">Username</label>
    </div>

    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
    <h6 class="mt-3">Already have an account?  <a href="login.php">Login</a></h6>

  </form>
</main>

<?php require "includes/footer.php"; ?>
