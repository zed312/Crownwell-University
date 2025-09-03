<?php
session_start();
require_once 'config.php';



// Register
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $program = $_POST['program'];
    $birthday = $_POST['birthday'];
    $gwa = $_POST['gwa'];
    $guardian_name = $_POST['guardian_name'];
    $guardian_phone = $_POST['guardian_phone'];

    // GWA requirement
    if ($gwa < 90) {
        $_SESSION['register_error'] = 'Enrollment denied: GWA must be at least 90.';
        $_SESSION['active_form'] = 'register';
        header("Location: index.php");
        exit();
    }

    // Handle uploads
    if (!is_dir("uploads")) {
        mkdir("uploads", 0777, true);
    }

    $picture = $_FILES['picture'];
    $grade_card = $_FILES['grade_card'];

    $picturePath = "uploads/" . time() . "_" . basename($picture["name"]);
    move_uploaded_file($picture["tmp_name"], $picturePath);

    $gradeCardPath = "uploads/" . time() . "_" . basename($grade_card["name"]);
    move_uploaded_file($grade_card["tmp_name"], $gradeCardPath);

    // Check duplicate email
    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = 'Email is already registered!';
        $_SESSION['active_form'] = 'register';
        header("Location: index.php");
        exit();
    } else {
        $conn->query("INSERT INTO users 
            (name, email, password, program, birthday, gwa, guardian_name, guardian_phone, picture, grade_card) 
            VALUES 
            ('$name', '$email', '$password', '$program', '$birthday', '$gwa', '$guardian_name', '$guardian_phone', '$picturePath', '$gradeCardPath')");

        $_SESSION['active_form'] = 'login';
        header("Location: index.php");
        exit();
    }
}


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === 'admin@gmail.com' && $password === '1234') {
        $_SESSION['name'] = 'Administrator';
        $_SESSION['email'] = $email;
        $_SESSION['role'] = 'admin';
        $_SESSION['program'] = '-';
        $_SESSION['birthday'] = '-';
        $_SESSION['gwa'] = '-';
        $_SESSION['guardian_name'] = '-';
        $_SESSION['guardian_phone'] = '-';
        $_SESSION['picture'] = 'admin.png';
        $_SESSION['grade_card'] = '-';

        header("Location: admin_page.php");
        exit();
    }


    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['program'] = $user['program'];
            $_SESSION['birthday'] = $user['birthday'];
            $_SESSION['gwa'] = $user['gwa'];
            $_SESSION['guardian_name'] = $user['guardian_name'];
            $_SESSION['guardian_phone'] = $user['guardian_phone'];
            $_SESSION['picture'] = $user['picture'];
            $_SESSION['grade_card'] = $user['grade_card'];

            if ($user['role'] === 'user') {
                header("Location: user_page.php");
            } else {
                header("Location: admin_page.php");
            }
            exit();
        }
    }

    $_SESSION['login_error'] = 'Incorrect email or password';
    $_SESSION['active_form'] = 'login';
    header("Location: index.php");

}

?>