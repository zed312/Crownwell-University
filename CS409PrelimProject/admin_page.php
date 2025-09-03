<?php
session_start(); // Start session to track admin login

require_once 'config.php'; // Include database connection file

// Query all users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crownwell University Portal - Admin</title>
    <link rel="stylesheet" href="portalStyle.css" />
    <style>
        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f4f4f4;
        }

        /* Profile picture styling */
        img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Logout button style */
        .logout-btn {
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-container">
            <div class="logo-container">
                <!-- University logo -->
                <img src="2.png" alt="Crownwell UNIVERSITY Logo" class="logo" />
                <h2>CROWNWELL UNIVERSITY - Admin</h2>
            </div>
        </div>
    </header>

    <main>
        <section id="home" class="tab-content active">
            <!-- Hero section -->
            <div class="hero">
                <h2>Crownwell Compass</h2>
                <p>1st Semester Year 2025-2026</p>
            </div>

            <h2>Enrolled Students</h2>
            <!-- Logout button -->
            <button onclick="window.location.href='school.html'" class="logout-btn">Logout</button>
            <br>
            <br>

            <!-- Students table -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Program</th>
                        <th>Birthday</th>
                        <th>Age</th>
                        <th>GWA</th>
                        <th>Guardian</th>
                        <th>Grade Card</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()):
                            // Calculate age from birthday
                            $dob = new DateTime($row['birthday']);
                            $today = new DateTime();
                            $age = $today->diff(targetObject: $dob)->y;


                            $picturePath = !empty($row['picture']) ? $row['picture'] : "uploads/default.jpg";


                            ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <!--Student profile picture-->
                                <td>
                                    <img src="<?= htmlspecialchars($picturePath); ?>" alt="Profile Picture">
                                </td>


                                <!-- Student info -->
                                <td><?= htmlspecialchars($row['name']); ?></td>
                                <td><?= htmlspecialchars($row['email']); ?></td>
                                <td><?= htmlspecialchars($row['program']); ?></td>
                                <td><?= htmlspecialchars($row['birthday']); ?></td>
                                <td><?= $age; ?></td>
                                <td><?= htmlspecialchars($row['gwa']); ?></td>
                                <td>
                                    <?= htmlspecialchars($row['guardian_name']); ?>
                                    (<?= htmlspecialchars($row['guardian_phone']); ?>)
                                </td>
                                <!--Grade card download link-->
                                <td>
                                    <?php if (!empty($row['grade_card'])): ?>
                                        <a href="<?= htmlspecialchars($row['grade_card']); ?>" download>Download</a>
                                    <?php else: ?>

                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <!--If no students found-->
                        <tr>
                            <td colspan="10">No students enrolled yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>