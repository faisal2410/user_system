<?php
session_start();
require 'Database.php';
require 'User.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = (new Database())->connect();
$user = new User($db);

$profile = $user->getProfile($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
</head>

<body>
    <h2>Profile</h2>
    <?php if ($profile): ?>
        <p>Username: <?= htmlspecialchars($profile['username']) ?></p>
        <p>Email: <?= htmlspecialchars($profile['email']) ?></p>
        <p>Joined: <?= htmlspecialchars($profile['created_at']) ?></p>
    <?php else: ?>
        <p>Profile not found.</p>
    <?php endif; ?>
</body>

</html>