<?php

/**
 * Summary of homeController
 */
class loginController
{
    public function index($routeMap, $uri)
    {
        // Valeurs utilisées pour l'affichage
        $message = '';

        // Variables utilisées pour réafficher les valeurs dans le formulaire en cas d'erreur
        $email = $_POST['email_user'] ?? '';

        // Vérifie si les champs sont submit
        if (isset($_POST['email_user']) && isset($_POST['password_user'])) {

            // Attibution dans des varibles pour facilité l'utilisation par la suite
            $email = $_POST['email_user'];
            $password = $_POST['password_user'];

            // Vérifie si les variables sont vides
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
                        // Ajout des info du user dans la session et redirection vers l'accueil
                        $_SESSION['user'] = $user;
                        header('Location: /home');
                    }
                    else {
                        $message = 'Identifiant ou mot de passe incorrect';
                    }
                }
            }
        }
        // Chargement de la vue
        require_once "../src/view/" . $routeMap[$uri]['name'] . ".php";
    }

}