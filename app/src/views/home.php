<?php if (isset($_COOKIE['PHPSESSID'])) {

    session_start();

    $sessions = $_SESSION;

} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <?php require 'forms/create-cookie.php' ?>
    <?php require 'forms/create-session.php' ?>
</body>
<script defer src="src/scripts/cookie.js"></script>
<script defer src="src/scripts/session.js"></script>

</html>