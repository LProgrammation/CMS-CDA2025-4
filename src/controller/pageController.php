<?php
/**
 * Summary of homeController
 */
class pageController{
    public function index($routeMap, $uri){
        require_once "../src/model/".$routeMap[$uri]['name']."Model.php";
        $page_model=new pageModel();
        switch($routeMap[$uri]['target']){
            case 'new-page':
                $is_there_header=False;
                $is_there_footer=False;
                $tabAllPages=$page_model->getAllPagesBySite($_POST['id_site']??'1');
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
            case 'gestion-page':
                $tabAllPages=$page_model->getNavbarSite($_POST['id_site']??'1');
                require_once "../src/view/".$routeMap[$uri]['name']."_gestion.php";
                break;
            case null:
                $tabNavbarSite=$page_model->getNavbarSite($_POST['id_site']??'1');
                $content_page=$page_model->getContentPage($_GET['id_page']??$tabNavbarSite[0]['id_page']);
                require_once "../src/view/".$routeMap[$uri]['name'].".php";
                break;
        }
    }
}