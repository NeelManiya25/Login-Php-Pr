<?php  
  session_start();
  include('connection.php');
  if (isset($_SESSION['success_message'])) {
          echo $_SESSION['success_message'];
      unset($_SESSION['success_message']);
  }
  $nameErr = $emailErr = $passwordErr = "";

  if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email)) {
      $emailErr = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid Email format";
    }

    if (empty($password)) {
      $passwordErr = "Password is required";
    } elseif(strlen($password) < 8) {
      $passwordErr = "Password must be at least 8 characters";
    } elseif (!preg_match("#[A-Z]+#", $password)) {
      $passwordErr = "Password 1 uppercase letter";
    } elseif (!preg_match("#[a-z]+#", $password)) {
      $passwordErr = "Password 1 lowercase letter";
    }
    if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {
      $hashedPassword = md5($password);
      $sql = "SELECT * FROM users WHERE `email` = '$email' AND `password` = '$hashedPassword'";

      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          if ($row['email'] == $email && $row['password'] == $hashedPassword) {
              $_SESSION['id'] = $row['id'];
              $_SESSION['full_name'] = $row['full_name'];
              $_SESSION['login_success'] = true;
              header("location: dashoboard.php");
          }
      } else {
          echo "Error: Invalid Password";
      }
    }
  }
?>

<h2>Login Form</h2>
<form method="POST">
  <label for="email">Email:</label><br>
  <input type="text" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>"><br>
  <span><?php echo $emailErr; ?></span><br><br>
  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password"><br>
  <span><?php echo $passwordErr; ?></span><br><br>
  <input type="submit" value="Submit" name="submit">
</form>
<br>
<a href="Registration.php">
  <button>Register</button>
</a>