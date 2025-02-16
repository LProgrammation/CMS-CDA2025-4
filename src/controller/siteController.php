<?php

namespace Src\Controller;
use  Src\Model\siteModel;
use Src\Model\monsiteModel;
use Src\Model\voirsiteModel;
use Src\Model\LogsModel;
use Src\Module\Uuid;

class siteController{
    public function index($routeMap, $uri)
    {
        $sites_model=new siteModel();
        $logs_model=new LogsModel();
        $Uuid = new Uuid()
;         $mes_sites_model=new monsiteModel();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['site_name']) && $_POST['site_name'] !== ''){
                $mes_sites_model->createLeSite($_POST['site_name']);
                $logs_model->setLogs($Uuid->guidV4(), $_SESSION['user']['id_user'], "ajout du site ".$_POST['site_name']." par l'utilisateur ".$_SESSION['user']['name_user']."");
                header('Location:/sites/mysites');
                exit();
            }
        }



        $targetSite = $routeMap[$uri]['target'];
        switch($targetSite){
            case 'new-site':
                require_once "../src/view/site_form.php";
                break;
            case 'sites-list' :
                $liste_sites=$sites_model->getSites();

                require_once "../src/view/site.php";
                break;
            case 'my-sites' :
                if(isset($_POST['submit_delete'])) {
                    $mes_sites_model->deleteLeSite($_POST['id_site']);

                    $logs_model->setLogs($Uuid->guidV4(), $_SESSION['user']['id_user'], "suppression du site ".$_POST['site_name']." par l'utilisateur ".$_SESSION['user']['name_user']." ");

                }

                $error = null;
                $mes_sites = $mes_sites_model->getMesSites($_SESSION['user']['role_user'], $_SESSION['user']['id_user']);
                require_once "../src/view/mysite.php";
                break;
            case 'see-site':

                $voirsite_model = new voirsiteModel();
                $error = null;
                $name_user = null;
                $apercu_sites = [];


                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_site'])) {
                    $id_site = $_POST['id_site'];
                    if (!empty($id_site)) {
                        $id_site = htmlspecialchars($id_site, ENT_QUOTES, 'UTF-8');
                        $apercu_sites['site'] = $voirsite_model->getSiteById($id_site);
                        $apercu_sites['pages'] = $voirsite_model->getSitePages($id_site);

                        if (!$apercu_sites) {
                            $error = "Aucun site trouvé avec cet ID.";
                        } else {
                            $name_user = isset($apercu_sites['site'][0]['name_user']) ? $apercu_sites['site'][0]['name_user'] : null;
                        }
                    } else {
                        $error = "ID de site invalide.";
                    }
                } else {
                    header('Location:/error?code=404');
                    exit();
                }

                require_once "../src/view/see_site.php";
                break;
        }
    }
   

}

?>