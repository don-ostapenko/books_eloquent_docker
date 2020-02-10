<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/fontAwesome/all.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.png"/>
    <meta name="theme-color" content="#ff3239">
    <title><?= $title ?? 'Welcome' ?></title>
</head>
<body>
<header>
    <div class="container-fluid shadow">
        <div class="container">
            <nav class="navbar navbar-expand-lg px-0 py-3 d-flex justify-content-center align-items-center">
                <a href="/" class="navbar-barnd mr-4">
                    <img src="/img/logo.png" alt="Logo" width="150">
                </a>
            </nav>
        </div>
    </div>
</header>
<main>
    <div class="container">
        <div class="card error text-center">
            <div class="card-body">
                <div style="font-size: 40px; color: #e6a11d">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h1>Error 403</h1>
                <p><?= $error ?></p>
                <a class="btn btn-primary" href="/" role="button">Main page</a>
            </div>
        </div>
    </div>


<?php include __DIR__ . '/../parts/footer.php'; ?>