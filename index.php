<?php

  session_start();

  $errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
  ];
  $activeForm = $_SESSION['active_form'] ?? 'login';

  session_unset();

  function showError($error) {
      return !empty($error) ? "<p class='error-message'>$error</p>" : '';
  }

  function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login & register</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <div class="form-box <?= isActiveForm('login', $activeForm); ?>" id="login-form">
      <form action="Login_Register.php" method="post">
        <h2>Login</h2>
        <?php echo showError($errors['login']); ?>
        <input type="email" name="email" placeholder="Email" >
        <input type="password" name="password" placeholder="Password" >
        <button type="submit" name="login">Login</button>
        <p>Don't have an account? <a href="#" onclick="showForm('register-form')">Register</a></p>
      </form>
    </div>

    <div class="form-box <?= isActiveForm('register', $activeForm); ?>" id="register-form">
      <form action="Login_Register.php" method="post">
        <h2>Register</h2>
        <?php echo showError($errors['register']); ?>
        <input type="text" name="name" placeholder="Name" maxlength="50">
        <input type="email" name="email" placeholder="Email" maxlength="255">
        <input type="password" name="password" placeholder="Password" maxlength="255">
        <select name="role">
          <option value="">--Select Role--</option>
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
        <button type="submit" name="register">Register</button>
        <p>Already have an account? <a href="#" onclick="showForm('login-form')">Login</a></p>
      </form>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>