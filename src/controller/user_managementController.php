<?php

class user_managementController
{

    public function index($routeMap, $uri): void
    {
        require_once __DIR__ . '/../model/userModel.php';
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

        $users = $userModel->getUsers();

        require_once "../src/view/" . $routeMap[$uri]['name'] . ".php";
    }

}






