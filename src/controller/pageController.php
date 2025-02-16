<?php
namespace Src\Controller ;
use Src\Model\pageModel;
use Src\Model\LogsModel;
use Src\Module\Uuid;
/**
 * Summary of homeController
 */
class pageController{
    public function index($routeMap, $uri){

        $page_model=new pageModel();
        $logs_model=new LogsModel();
        $UuidModule = new Uuid();
        switch($routeMap[$uri]['target']){
            case 'new-page':
                $is_there_header=False;
                $is_there_footer=False;
                $tabAllPages=$page_model->getAllPagesBySite($_POST['id_site']??null);
                foreach($tabAllPages as $key=>$value){
                    if($value['type_page']=='header'){
                        $is_there_header=True;
                    }
                    if($value['type_page']=='footer'){
                        $is_there_footer=True;
                    }
                }
                if(isset($_POST['create_page'])){
                    require_once "../src/module/uuid.php";
                    $page_model->newPage($_POST['id_site'],$_POST['title_page'], $_POST['type_page']??'main',  $_POST['is_default_page']??'0');
                }
                require_once "../src/view/".$routeMap[$uri]['name']."_form.php";
                break;

            case 'gestion-pages':
                $tabAllPages=$page_model->getNavbarSite($_GET['id_site']);
                require_once "../src/view/".$routeMap[$uri]['name']."_gestion.php";
                break;

            case 'delete-page':
                $page=$page_model->getPageByID($_GET['id_page']);
                require_once "../src/view/".$routeMap[$uri]['name']."_delete.php";
                break;

            case null:
                if(isset($_POST['id_site'])){
                    $id_site = $_POST['id_site']??null ;
                }
                else{
                    $page = $page_model->getPageByID($_GET['id_page']) ;
                    $id_site = $page['id_site'];

                }
                $id_new_page=null;

                if(isset($_POST['name_form'])){
                    switch($_POST['name_form']){
                        case 'edit_gestion_form':
                            foreach($_POST as $key=>$value){
                                if(substr($key,0,14)=='title_page_id_'){
                                    $id_page=substr($key,14);
                                    $page_model->updateTitlePage($id_page,$value);
                                }
                                if($key=='id_default_page'){
                                    $page_model->updateDefaultPage($_POST['id_site'], $_POST['id_default_page']);
                                }
                            }
                            $logs_model->setLogs($UuidModule->guidv4(),$_SESSION['user']['id_user'], "Modification des pages du site avec l'id :$id_site");
                            break;
                        case 'create_page':
                            require_once "../src/module/uuid.php";

                            $id_new_page=$page_model->newPage($_POST['id_site'],$_POST['title_page'], $_POST['type_page']??'main',  $_POST['is_default_page']??'0');
                            if(isset($_POST['is_default_page'])){
                                $page_model->updateDefaultPage($_POST['id_site'], $id_new_page);
                            }
                            $logs_model->setLogs($UuidModule->guidv4(), $_SESSION['user']['id_user'], "Création d'une nouvelle page avec l'id :$id_new_page pour le site avec l'id :$id_site");

                            break;

                        case 'delete_page':

                            $page=$page_model->getPageByID($_POST['id_page']);
                            $page_model->deletePage($_POST['id_page']);
                            $logs_model->setLogs($UuidModule->guidv4(),$_SESSION['user']['id_user'], "Suppression de la page :'".$page['title_page']."' pour le site avec l'id :$id_site");
                            break;

                        case 'save_page':
                            $page_model->savePage($_POST['id_site'],$_POST['id_page'],$_POST['content']);
                            $logs_model->setLogs($UuidModule->guidv4(), $_SESSION['user']['id_user'], "Modification de la page avec l'id :".$_POST['id_page']." pour le site avec l'id :$id_site");
                            break;
                    }
                }


                $id_default_page='';
                $tabNavbarSite=$page_model->getNavbarSite($id_site);
                foreach($tabNavbarSite as $key=>$value){
                    if($value['is_default_page']==1){

                        $id_default_page=$value['id_page'];
                    }
                }

                $content_page=$page_model->getContentPage($id_new_page??$_GET['id_page']??$id_default_page??$tabNavbarSite[0]['id_page']);
                $title_page=$page_model->getTitlePage($id_new_page??$_GET['id_page']??$id_default_page??$tabNavbarSite[0]['id_page']);
                $id_page=$id_new_page??$_GET['id_page']??$id_default_page??$tabNavbarSite[0]['id_page'];
                require_once "../src/view/".$routeMap[$uri]['name'].".php";
                break;
        }
    }
}