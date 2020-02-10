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
            <nav class="navbar navbar-expand-lg px-0 py-3 d-flex justify-content-between align-items-center">
                <a href="/" class="navbar-barnd mr-4">
                    <img src="/img/logo.png" alt="Logo" width="150">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span><img class="no-focus" src="/img/menu.svg" alt="menu" width="35"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto rd">
                        <li class="nav-item active">
                            <a href="/" class="nav-link">Main</a>
                        </li>

                        <?php if (!empty($user)): ?>
                            <li class="nav-item dropdown">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button"
                                   aria-haspopup="true" aria-expanded="false">Hello, <?= $user->nickname ?></a>
                                <div class="dropdown-menu">
                                    <?php if (!empty($user) && $user->isAdmin()): ?>
                                        <a class="dropdown-item" href="/admin">Admin panel</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/admin/book/add">Add book</a>
                                    <?php endif; ?>
                                    <a class="dropdown-item" href="/users/signOut">Sign Out</a>
                                </div>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/users/signIn">Sign in</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<main>
    <div class="container">