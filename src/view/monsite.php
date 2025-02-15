<h1>Votre site</h1>
<?php 
$header = '';
$main = '';
$footer = '';
if (!empty($mon_sites)) {
    foreach ($mon_sites as $mon_site) {
        if (isset($mon_site['type_page'])) {
            if ($mon_site['type_page'] === 'header') {
                $header = $mon_site['content_page'];
            }
            if ($mon_site['type_page'] === 'main' && $mon_site['default_page'] == 1) {
                $main = $mon_site['content_page'];
            }
            if ($mon_site['type_page'] === 'footer') {
                $footer = $mon_site['content_page'];
            }
        }
    }
    echo $header; 
    echo $main;   
    echo $footer; 
    
} else {
    echo "Aucun contenu disponible.";
} ?>
       
 







