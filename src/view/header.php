
<?php
/** @var array $routeMap */
/** @var string $uri */
?>
<!DOCTYPE html>
<html lang="en">


    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $routeMap[$uri]['name']?></title>
        <link rel="stylesheet" href="../styles/css/styles.css">
        <link rel="stylesheet" href="styles/css/style.css?v=<?=time()?>" />
        <link rel="stylesheet" href="styles/css/bootstrap.css?v=<?=time()?>" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    </head>
    <body>
        <header>
        <div class="border-bottom w-100 p-3">
            <nav class="d-flex justify-content-around container">
                <ul>
                    <a href="/home" class="p-2">Accueil</a>
                    <a href="/logs" class="p-2">logs</a>
                    <a href="/site" class="p-2">site</a>
                    <?php
                    if (isset($_SESSION['user'])) {
                        if ($_SESSION['user']['role_user'] == 'admin') {
                            echo '<a href="/user_management" class="p-2">Gestion des comptes</a>';
                        }
                        echo '<a href="/logout" class="p-2">Deconnexion</a>';
                    }else{
                        ?>
                        <a href="/login" class="p-2">Se Connecter</a>
                        <a href="/register" class="p-2">S'Inscrire</a>
                        <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
        </header>
        <main class="container pt-5">