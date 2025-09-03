<?php
session_start(); // Start session to store errors and active form state

// Retrieve errors from session (if any)
$errors = [
  'login' => $_SESSION['login_error'] ?? '',
  'register' => $_SESSION['register_error'] ?? '',
];

// Which form should be shown when page loads? (default: login)
$activeForm = $_SESSION['active_form'] ?? 'login';

// Clear all session data so errors don’t persist after refresh
session_unset();

//Helper Functions

// Function to display an error if it exists
function showError($error)
{
  return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

// Function to set "active" class for the visible form
function isActiveForm($formName, $activeForm)
{
  return $formName === $activeForm ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>School Enrollment</title>
  <link rel="stylesheet" href="loginStyle.css" />
</head>

<body>
  <div class="container">

    <!-- ================= LOGIN FORM ================= -->
    <div class="form-box <?= isActiveForm('login', $activeForm); ?>" id="login-form">
      <form action="login_register.php" method="post">
        <h2>Login</h2>

        <!-- Display login error if any -->
        <?= showError($errors['login']); ?>

        <!-- Login fields -->
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />

        <!-- Submit button -->
        <button type="submit" name="login">Login</button>

        <!-- Link to switch to Register form -->
        <p>Don't have an account? <a href="#" onclick="showForm('register-form')">Register</a></p>
      </form>
    </div>

    <!-- ================= REGISTER FORM ================= -->
    <div class="form-box <?= isActiveForm('register', $activeForm); ?>" id="register-form">
      <form action="login_register.php" method="post" enctype="multipart/form-data">
        <h2>Register</h2>

        <!-- Display register error if any -->
        <?= showError($errors['register']); ?>

        <!-- User info -->
        <input type="text" name="name" placeholder="Name" required />
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="date" name="birthday" required />
        <input type="number" step="0.01" name="gwa" placeholder="GWA" required />

        <!-- Guardian info -->
        <input type="text" name="guardian_name" placeholder="Guardian's Name" required />
        <input type="text" name="guardian_phone" placeholder="Guardian's Phone" required />

        <!-- File uploads -->
        <label>1x1 Picture:</label>
        <input type="file" name="picture" accept="image/*" required />

        <label>Grade Card Certificate:</label>
        <input type="file" name="grade_card" accept=".jpg,.jpeg,.png,.pdf" required />

        <!-- Role (Student/Admin) -->
        <select name="role" required>
          <option value="">- - Select Role - -</option>
          <option value="user">Student</option>
          <option value="admin">Admin</option>
        </select>

        <!-- Program selection -->
        <label for="program">Select Your Program:</label>
        <select name="program" id="program" required>
          <option value="">-- Select Program --</option>
          <option value="BSCS">Bachelor of Science in Computer Science</option>
          <option value="BAECON">Bachelor of Arts in Economics</option>
          <option value="BBA">Bachelor of Business Administration</option>
          <option value="BE">Bachelor of Engineering (Various Specializations)</option>
          <option value="BFA">Bachelor of Fine Arts</option>
          <option value="BSN">Bachelor of Science in Nursing</option>
          <option value="MBA">Master of Business Administration (MBA)</option>
          <option value="MSDA">Master of Science in Data Analytics</option>
          <option value="MAEDUC">Master of Arts in Education</option>
          <option value="MPH">Master of Public Health</option>
          <option value="PHD">Doctor of Philosophy (Various Disciplines)</option>
          <option value="DIMA">Digital Marketing Certification</option>
          <option value="PMP">Project Management Professional</option>
          <option value="DS">Data Science Bootcamp</option>
          <option value="CBS">Cybersecurity Fundamentals</option>
        </select>

        <!-- Submit button -->
        <button type="submit" name="register">Register</button>

        <!-- Link to switch back to Login form -->
        <p>Already have an account? <a href="#" onclick="showForm('login-form')">Login</a></p>
      </form>
    </div>

  </div>

  <!-- JS for toggling between login & register -->
  <script src="script.js"></script>
</body>

</html>