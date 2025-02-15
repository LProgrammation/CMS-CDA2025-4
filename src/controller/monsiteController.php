<?php 
// quand tu es connecté et que tu cliques sur l'onglet mon site, cette page apparait 
// il faut recuperer l'id du site qui correspond à celui de l'utilisateur connecté 
// il faut pouvoir effacer ce site (enlever id_site de la bdd et toutes les pages qui correspondent)
// si tu veux modifier ton site, renvoie sur /page avec id_site en POST (input hidden)

// faire des logs pour chaque action :  log model et set logs avec id user et action

class monsiteController {
    public function index($routeMap, $uri) {
        require_once "../src/model/BDD.php";
        require_once "../src/model/" . $routeMap[$uri]['name'] . "Model.php";

        $monsite_model = new monsiteModel();
        $error = null;
        $mon_sites = []; 

        if (isset($_SESSION['utilisateur']['id_utilisateur'])) {
            $role_utilisateur = $_SESSION['utilisateur']['role_utilisateur'];
            $id_utilisateur = $_SESSION['utilisateur']['id_utilisateur'];

            if ($role_utilisateur == "admin") {
                // Si admin, récupérer tous les sites
                $mon_sites = $monsite_model->getAllSites();
            } else {
                $mon_sites = $monsite_model->getSitesByUtilisateur($id_utilisateur);
            }

            if (!$mon_sites) {
                $error = "Aucun site trouvé.";
            } 
        } else {
            $error = "Utilisateur non connecté.";
        }
        require_once "../src/view/" . $routeMap[$uri]['name'] . ".php";
    }
}

?>