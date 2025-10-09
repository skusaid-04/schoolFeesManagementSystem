<?php
session_start();
require_once '../php/config.php'; // Include database connection
$error_message = '';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($username) || empty($password)) {
        $error_message = 'Username and password are required.';
    } else {
        // Prepare and execute the SQL statement
        $stmt = $conn->prepare("SELECT * FROM login_admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verify password
            if (password_verify($password, $user['password']) && $user['status'] === 'active') {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email']; // Assuming you have an email field
                $_SESSION['mobile_no'] = $user['mobile_no'] ?? ''; // Assuming you have a
                $_SESSION['role'] = $user['role']; // Assuming you have a role field
                $_SESSION['profile_name'] = $user['profile_name']; // Assuming you have a profile_name field
                $_SESSION['profile_image'] = $user['profile_image']; // Assuming you have a profile_image field
                $_SESSION['default_section'] = $user['default_section'] ?? 'Primary'; // Assuming you have a default_section field
                header("Location: ../index.php"); // Redirect to the main page
                echo "<script>history.replaceState(null, null, location.href);</script>";
                exit();
            } else {
                $error_message = 'Invalid username or password.';
                echo "<script>history.replaceState(null, null, location.href);</script>";
            }
        } else {
            $error_message = 'Invalid username or password.';
            echo "<script>history.replaceState(null, null, location.href);</script>";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Al-Nadi-Ul-Falah English High School</title>
    <!-- For basic usage with plain HTML -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="https://kit.fontawesome.com/b85f5b7745.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/logoh.png">
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body class="bg-image d-flex justify-content-center align-items-center vh-100">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        <div class="card shadow">
          <div class="card-header text-center text-success">
            <h4 class="mb-0 fw-bold">Login</h4>
          </div>
          <div class="card-body">

            <!-- Error Message -->
            <?php if (!empty($error_message)): ?>
              <div class="alert alert-danger text-center py-2">
                <?php echo htmlspecialchars($error_message); ?>
              </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form method="post" action="login.php" id="login-form">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" required autocomplete="off" placeholder="Enter your username">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required autocomplete="off" placeholder="Enter your password">
                <div class="form-check mt-2">
                  <input class="form-check-input green-checkbox" type="checkbox" id="show-password" onclick="togglePassword()">
                  <label class="form-check-label" for="show-password">Show Password</label>
                </div>
              </div>
              <div class="d-grid mt-4">
                <button type="submit" name="login" class="btn btn-success">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Password Toggle Script -->
  <script>
    function togglePassword() {
      const passField = document.getElementById("password");
      passField.type = passField.type === "password" ? "text" : "password";
    }
  </script>

</body>

</html>