<?php
namespace Src\Controller ;
use \Src\Module\Access;
use \Src\Model\userModel;
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


        if (isset($_POST["submit_modif"])){
            try {
                $result = $userModel->updateUser($_POST["id_user"], $_POST["firstname_user"], $_POST["name_user"], $_POST["email_user"], $_POST["role_user"]);
                $result != null ? $message = ["success", "L'Utilisateur a bien été modifié"] : $message = ["danger", "Un problème a eu lieu lors de la modification de l'utilisateur"];
            }
            catch (Exception $e) {
                $message = ["danger", "Un problème a eu lieu lors de la modification de l'utilisateur"];
            }
        }

        if (isset($_POST["submit_suppr"])){
            try {
                $result = $userModel->deleteUser($_POST["id_user"]);
                $result != null ? $message = ["success", "L'Utilisateur a bien été supprimé"] : $message = ["danger", "Un problème a eu lieu lors de la suppression de l'utilisateur"];
            }
            catch (Exception $e) {
                $message = ["danger", "Un problème a eu lieu lors de la suppression de l'utilisateur"];
            }
        }

        $users = $userModel->getUsers();

        require_once "../src/view/" . $routeMap[$uri]['name'] . ".php";
    }

}






