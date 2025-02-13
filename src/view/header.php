<!DOCTYPE html>
<html>
    <header>
        <link rel="stylesheet" href="styles/css/bootstrap.css?v=<?=time()?>" />
        <link rel="stylesheet" href="styles/css/dataTables.bootstrap5.css?v=<?=time()?>" />
        <link rel="stylesheet" href="styles/css/style.css?v=<?=time()?>" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    </header>
    <body>
        <head>
        <div class="border-bottom w-100 p-3">
            <nav class="d-flex justify-content-around container">
                <ul>
                    <a href="/home" class="p-2">Accueil</a>
                    <a href="/logs" class="p-2">logs</a>
                    <a href="/site" class="p-2">site</a>
                    <?php
                    if (isset($_SESSION['user'])) {
                        ?>
                        <a href="/disconnect" class="p-2">disconnect</a>
                        <?php
                    }else{
                        ?>
                        <a href="/login" class="p-2">login</a>
                        <a href="/register" class="p-2">register</a>
                        <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
        </head>
        <main class="container pt-5">