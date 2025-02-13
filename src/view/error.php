
    <?php
        switch ($_GET['code']) : 
            case '401':
                echo "<h1> Error 401, connexion to database error, please contact the administrator (Louis Potdevin) to fix this error</h1>";
                break;
            case '404':
                echo "<h1> Error 404, page not found</h1>";
                break;
        endswitch;

    ?>

