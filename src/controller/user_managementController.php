<?php
namespace Src\Controller ;
use \Src\Module\Access;
use \Src\Model\userModel;
use Src\Model\LogsModel;
use Src\Module\Uuid;
use Src\Model\monsiteModel;
class user_managementController
{

    public function index($routeMap, $uri): void
    {
        //rajouter le isGranted
        $access = new Access();
        if(!$access->isGranted('admin')){
            header("location: /error?code=404");
            exit();
        }
        $message = ["success", ""];
        $userModel = new userModel();
        $logsModel = new LogsModel();
        $UuidModule = new Uuid();
        $monSiteModel = new monsiteModel();

        if (isset($_POST["submit_modif"])){
            try {

                $result = $userModel->updateUser($_POST["id_user"], $_POST["firstname_user"], $_POST["name_user"], $_POST["email_user"], $_POST["role_user"]);
                $result != null ? $message = ["success", "L'Utilisateur a bien été modifié"] : $message = ["danger", "Un problème a eu lieu lors de la modification de l'utilisateur"];
                $logsModel->setLogs($UuidModule->guidv4(), $_SESSION['user']['id_user'], "Modification de l'utilisateur portant l'email : ".$_POST['email_user']."");
            }
            catch (Exception $e) {
                $message = ["danger", "Un problème a eu lieu lors de la modification de l'utilisateur"];
            }
        }

        if (isset($_POST["submit_suppr"])){
            try {
                $result = $userModel->deleteUser($_POST["id_user"]);
                $monSiteModel->changeUserSiteByAdmin($_POST["id_user"]);
                $result != null ? $message = ["success", "L'Utilisateur a bien été supprimé"] : $message = ["danger", "Un problème a eu lieu lors de la suppression de l'utilisateur"];
                $logsModel->setLogs($UuidModule->guidv4(), $_SESSION['user']['id_user'], "Modification de l'utilisateur portant l'id : ".$_POST['id_user']."");

            }
            catch (Exception $e) {
                $message = ["danger", "Un problème a eu lieu lors de la suppression de l'utilisateur"];
            }
        }

        $users = $userModel->getUsers();

        require_once "../src/view/" . $routeMap[$uri]['name'] . ".php";
    }

}






