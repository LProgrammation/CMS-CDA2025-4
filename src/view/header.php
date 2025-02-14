<!DOCTYPE html>
<html>
    <body>
        <header>
        <div class="border-bottom w-100 p-3">
            <nav class="d-flex justify-content-around container">
                <ul>
                    <a href="/home" class="p-2">Accueil</a>
                    <a href="/logs" class="p-2">logs</a>
                    <a href="/site" class="p-2">site</a>
                    <a href="/page" class="p-2">page</a>
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
        </header>
        <main class="container pt-5">