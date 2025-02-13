<?php

/**
 * Summary of homeController
 */
class loginController
{
    public function index($routeMap, $uri)
    {
        $message = '';
        $email = $_POST['email_user'] ?? '';
        if (isset($_POST['email_user']) && isset($_POST['password_user'])) {
            $email = $_POST['email_user'];
            $password = $_POST['password_user'];

            if (empty($email) || empty($password)) {
                $message = 'Veuillez remplir tous les champs';
            } else {
                // Chargement du model
                require_once __DIR__ . '/../model/userModel.php';

                // Instanciation du model
                $authModel = new userModel();

                // Vérification de l'existance de l'utilisateur
                $user = $authModel->getUserByEmail($email)[0] ?? null;

                if (!$user) {
                    $message = 'Cet email n\'est pas associé à un compte';
                } else {
                    // Vérification du mot de passe
                    if (password_verify($password, $user['password_user'])) {
                        // Ajout des info du user dans la session
                        $_SESSION['user'] = $user;
                        header('Location: cms-cda/home');
                    }
                    else {
                        $message = 'Identifiant ou mot de passe incorrect';
                    }
                }
            }
        }
        require_once "../src/view/" . $routeMap[$uri]['name'] . ".php";
    }

}