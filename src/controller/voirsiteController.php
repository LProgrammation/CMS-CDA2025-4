<?php
// n'importe quel utilisateur qui parcourt le site devra pouvoir accéder aux dates de création et de modification (table logs) 
// ne pas oublier de mettre lien vers site (enfin pages)


// si l'utilisateur est connecté il peut voir, modifier et supprimer tout ses sites 
// si l'utilisateur est un admin il peut voir, modifier et supprimer tous les sites 
// dans le cas où l'admin supprime un utilisateur, il récupère le site (son id remplace celui de l'utilisateur qui avait créé le site dans le BDD)

// question : l'admin peut-il supprimer des pages de là ? 
// question : l'admin peut-il supprimer des utilisateurs de là ? 


// l'admin pourra accéder à une page où il pourra supprimer des users 


// 1 faire un formulaire dans la vue de site.php avec id_site en POST => fait 
// 2 faire un affichage du site choisi en mode visiteur 
// 3 faire un affichage du site en mode connecté => voir si admin ou pas 
// 4 faire un affichage des users pour admin avec possibilité de les supprimer 


// je suis bloquée car pas de possibilité de générer du uuid en local ? 





class voirsiteController {
    public function index($routeMap, $uri) {
        require_once "../src/model/BDD.php";
        require_once "../src/model/" . $routeMap[$uri]['name'] . "Model.php";

        $voirsite_model = new voirsiteModel();
        $error = null;
        $nom_utilisateur = null; 
        $apercu_sites = []; 

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['site_id'])) {
            $id_site = $_POST['site_id'];

            if (!empty($id_site)) {
                $id_site = htmlspecialchars($id_site, ENT_QUOTES, 'UTF-8');
                $apercu_sites = $voirsite_model->getVoirSite($id_site);

                if (!$apercu_sites) {
                    $error = "Aucun site trouvé avec cet ID.";
                } else {
                    $nom_utilisateur = isset($apercu_sites[0]['nom_utilisateur']) ? $apercu_sites[0]['nom_utilisateur'] : null;
                }
            } else {
                $error = "ID de site invalide.";
            }
        } else {
            $error = "Méthode non autorisée ou ID manquant.";
        }

        require_once "../src/view/" . $routeMap[$uri]['name'] . ".php";
    }
}



?>