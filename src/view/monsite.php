 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
        <h1>Votre site</h1>
        <?php 
            $header = '';
            $main = '';
            $footer = '';
            if (!empty($mon_sites)) {
                foreach ($mon_sites as $mon_sites) {
                    if (isset($mon_sites['type_page'])) {
                        if ($mon_sites['type_page'] === 'header') {
                            $header = $mon_sites['content_page'];
                        }
                        if ($mon_sites['type_page'] === 'main' && $mon_sites['default_page'] == 1) {
                            $main = $mon_sites['content_page'];
                        }
                        if ($mon_sites['type_page'] === 'footer') {
                            $footer = $mon_sites['content_page'];
                        }
                    }
                }
                echo $header; 
                echo $main;   
                echo $footer; 
            } else {
                echo "Aucun contenu disponible.";
            }
        ?>
    </div>
</div>

</body>
</html>







