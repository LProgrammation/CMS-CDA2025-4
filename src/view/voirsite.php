<h1 class="mt-3 mb-5 text-center">
    <?php 
        if (isset($nom_utilisateur) && $nom_utilisateur !== null) { 
            echo "<h2>Découvrez le site de $nom_utilisateur</h2>";
        } else {
            echo "Nom d'utilisateur non trouvé";  
        }
    ?>
</h1>

<div class="container">
    <div class="row">
        <?php 
            // Variables pour stocker le contenu des différentes sections
            $header = '';
            $main = '';
            $footer = '';

            // Vérifier si les pages sont présentes dans $apercu_sites
            if (!empty($apercu_sites)) {
                // Parcourir les pages pour assigner le contenu des sections
                foreach ($apercu_sites as $apercu_site) {
                    if (isset($apercu_site['type_page'])) {
                        // Stocker le contenu du header
                        if ($apercu_site['type_page'] === 'header') {
                            $header = $apercu_site['content_page'];
                        }

                        // Stocker le contenu du main (seulement si c'est la page par défaut)
                        if ($apercu_site['type_page'] === 'main' && $apercu_site['default_page'] == 1) {
                            $main = $apercu_site['content_page'];
                        }

                        // Stocker le contenu du footer
                        if ($apercu_site['type_page'] === 'footer') {
                            $footer = $apercu_site['content_page'];
                        }
                    }
                }

                // Affichage dans l'ordre : header, main, footer
                echo $header; 
                echo $main;   
                echo $footer; 

            } else {
                echo "Aucun contenu disponible."; // Message d'erreur si aucune donnée n'est trouvée
            }
        ?>

        <a href="/monsite">Mon site</a>
    </div>
</div>









