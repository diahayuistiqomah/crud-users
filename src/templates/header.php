<!DOCTYPE html>
<?php require_once __DIR__.'/../db/connection.php';

session_start();

// Mendapatkan path dari URL yang diakses
$path = $_SERVER['REQUEST_URI'];

// Menentukan apakah perlu dilakukan pengecekan sesi
$checkSession = false;
if (strpos($path, '/crud-php/src/users/') !== false) {
    // Jika URL mengandung '/crud-php/src/users/', maka perlu dilakukan pengecekan sesi
    $checkSession = true;
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <title>Crud User</title>
</head>

<body>
    <main>