<?php 



class registerController{
    public function index($routeMap, $uri){

        // Valeurs utilisées pour l'affichage
        $message = '';

        // Variables utilisées pour réafficher les valeurs dans le formulaire en cas d'erreur
        $email = $_POST['email_user'] ?? '';
        $nom = $_POST['name_user'] ?? '';
        $prenom = $_POST['firstname_user'] ?? '';

        // Vérification de la soumission du formulaire
        if (isset($_POST['email_user']) && isset($_POST['name_user']) && isset($_POST['firstname_user']) && isset($_POST['password_user'])) {

            // Mise en variable pour simplifier l'utilisation dans la suite du code
            $prenom = $_POST['firstname_user'];
            $nom = $_POST['name_user'];
            $email = $_POST['email_user'];
            $password = $_POST['password_user'];

            // Vérifie si les variables sont vides
            if (empty($prenom) || empty($nom) || empty($email) || empty($password)) {
                $message = 'Veuillez remplir tous les champs';
            } else {
                // Chargement du model
                require_once __DIR__ . '/../model/userModel.php';

                // Instanciation du model
                $userModel = new UserModel();

                // Vérifie si le user existe déjà
                $user = $userModel->getUserByEmail($email);

                if ($user) {
                    $message = 'Cet email est déjà utilisé';
                } elseif (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!.@;:&$%^*-]).{8,}$/', $password)) { // Vérification si le mot de passe est fort
                    $message = "Mot de passe invalide. Assurez-vous qu'il contient au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.";
                } else {
                    // Création de l'utilisateur
                    $user = $userModel->registerUsers($prenom, $nom, $email, password_hash($password, PASSWORD_BCRYPT));

                    if ($user) {
                        // Redirection
                        header('Location: /login');
                    } else {
                        $message = 'Une erreur est survenue lors de la création de votre compte';
                    }
                }
            }
        }
        // Chargement de la vue
        require_once "../src/view/".$routeMap[$uri]['name'].".php";

    }

}