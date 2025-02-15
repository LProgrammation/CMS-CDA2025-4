 <h1 class="mt-3 mb-5 text-center">
    <?php 
        if ($nom_utilisateur !== null) {
            echo htmlspecialchars($nom_utilisateur);
        } else {
            echo "Nom d'utilisateur non trouvé";  
        }
    ?>
</h1>

<div class="container">
    <div class="row">
        <?php 
            $header = '';
            $main = '';
            $footer = '';

            // stock dans variable pour affichage dans le bon ordre 

            if (!empty($apercu_sites)) {
                foreach ($apercu_sites as $apercu_site) {
                    if (isset($apercu_site['type_page'])) {
                        if ($apercu_site['type_page'] === 'header') {
                            $header = $apercu_site['content_page'];
                        }

                        if ($apercu_site['type_page'] === 'main' && $apercu_site['default_page'] == 1) {
                            $main = $apercu_site['content_page'];
                        }

                        if ($apercu_site['type_page'] === 'footer') {
                            $footer = $apercu_site['content_page'];
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








