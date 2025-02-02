<?php

session_start();
require_once 'config.php';

if (isset($_POST['register'])) {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $role = $_POST['role'];

  if(empty($name) || empty($email) || empty($password) || empty($role)) {
    $_SESSION['register_error'] = 'All fields are required';
    $_SESSION['active_form'] = 'register';
    header('location: index.php');
    exit();
  }

  if(strlen($name) < 4 || strlen($password) < 4) {
    $_SESSION['register_error'] = 'Name and password must be at least 4 characters';
    $_SESSION['active_form'] = 'register';
    header('location: index.php');
    exit();
  }

  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['register_error'] = 'Email is invalid';
    $_SESSION['active_form'] = 'register';
    header('location: index.php');
    exit();
  }

  $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $_SESSION['register_error'] = 'Email is already registered';
    $_SESSION['active_form'] = 'register';
    $stmt->close();
    header('location: index.php');
    exit();
  }

  $stmt->close();

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
  $stmt->bind_param('ssss', $name, $email, $hashedPassword, $role);

  if ($stmt->execute()) {
    $_SESSION['register_success'] = 'Registration successful';
  } else {
    $_SESSION['register_error'] = 'Registration failed';
  }
  $stmt->close();

  header('location: index.php');
  exit();
}

if (isset($_POST['login'])) {
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  if(empty($email) || empty($password)) {
    $_SESSION['login_error'] = 'All fields are required';
    $_SESSION['active_form'] = 'login';
    header('location: index.php');
    exit();
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['login_error'] = 'Email is invalid';
    $_SESSION['active_form'] = 'login';
    header('location: index.php');
    exit();
  }

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['name'] = $user['name'];
      $_SESSION['email'] = $user['email'];

      if ($user['role'] == 'admin') {
        header('location: admin_page.php');
        exit();
      } else {
        header('location: user_page.php');
      }
        exit();
      }
  }

  $_SESSION['login_error'] = 'Email or password is incorrect';
  $_SESSION['active_form'] = 'login';
  header('location: index.php');
  exit();
}

?>