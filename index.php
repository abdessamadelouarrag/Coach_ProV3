<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex justify-center items-center m-7">
        <a class="bg-yellow-600 p-3 m-3 rounded-xl" href="index.php?action=coach">Coach</a>
        <a class="bg-blue-600 p-3 m-3 rounded-xl" href="index.php?action=sportif">Sportif</a>
        <a class="bg-green-600 p-3 m-3 rounded-xl" href="index.php?action=login">Login</a>
    </div>
</body>
</html>
<?php
require __DIR__ . "/routes/routes.php";
?>