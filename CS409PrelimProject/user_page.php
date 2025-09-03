<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php");
    exit();
}

// Calculate age
$dob = new DateTime($_SESSION['birthday']);
$today = new DateTime();
$age = $today->diff($dob)->y;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crownwell University</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="portalStyle.css">

</head>

<body>
    <header>
        <div class="header-container">
            <div class="logo-container">
                <img src="2.png" alt="Crownwell UNIVERSITY Logo" class="logo">
                <h2>CROWNWELL UNIVERSITY</h2>
    </header>

    <main>
        <!--Home Tab-->
        <section id="home" class="tab-content active">
            <div class="hero">
                <h2>Crownwell Compass</h2>
                <p>1st Semester Year 2025-2026</p>

            </div>

            <div class="student-profile">
                <div class="card">
                    <div class="profile-container">
                        <div class="profile-info">
                            <h3><i class=""></i> Student Information</h3>
                            <h1>Welcome, <?= $_SESSION['name']; ?>!</h1>
                            <p>Program: <?= $_SESSION['program']; ?></p>
                            <p>Email: <?= $_SESSION['email']; ?></p>
                            <p>Birthday: <?= $_SESSION['birthday']; ?> (Age: <?= $age; ?>)</p>
                            <p>GWA: <?= $_SESSION['gwa']; ?></p>
                            <p>Guardian: <?= $_SESSION['guardian_name']; ?> (<?= $_SESSION['guardian_phone']; ?>)</p>
                            <br><br>
                            <button onclick="window.location.href='school.html'" class="logout-btn">Logout</button>
                        </div>
                        <div class="profile-pic">
                            <img src="<?= $_SESSION['picture']; ?>" alt="Profile Picture">
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </main>

</html>
</body>