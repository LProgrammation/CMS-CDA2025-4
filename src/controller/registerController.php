<?php
namespace Src\Controller ;
use Src\Model\LogsModel;
use \Src\Model\UserModel;
use  \Src\Module\Uuid;
use Src\Module\Access;
class registerController{
    public function index($routeMap, $uri){
        $accessModule = new Access();
        if($accessModule->isGranted()){
            header("location: /error?code=404");
                exit();
        }

        // Valeurs utilisées pour l'affichage
        $message = '';

        // Variables utilisées pour réafficher les valeurs dans le formulaire en cas d'erreur
        $email_user = $_POST['email_user'] ?? '';
        $name_user = $_POST['name_user'] ?? '';
        $firstname_user = $_POST['firstname_user'] ?? '';

        // Vérification de la soumission du formulaire
        if (isset($_POST['email_user']) && isset($_POST['name_user']) && isset($_POST['firstname_user']) && isset($_POST['password_user'])) {

            // Mise en variable pour simplifier l'utilisation dans la suite du code
            $firstname_user = $_POST['firstname_user'];
            $name_user = $_POST['name_user'];
            $email_user = $_POST['email_user'];
            $password_user = $_POST['password_user'];

            // Vérifie si les variables sont vides
            if (empty($firstname_user) || empty($name_user) || empty($email_user) || empty($password_user)) {
                $message = 'Veuillez remplir tous les champs';
            } else {
                // Instanciation du model
                $userModel = new UserModel();

                // Vérifie si le user existe déjà
                $user = $userModel->getUserByEmail($email_user);

                if ($user) {
                    $message = 'Cet email est déjà utilisé';
                } elseif (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!.@;:&$%^*-]).{8,}$/', $password_user)) { // Vérification si le mot de passe est fort
                    $message = "Mot de passe invalide. Assurez-vous qu'il contient au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.";
                } else {
                    // Création de l'utilisateur
                    $Uuid = new Uuid();
                    $user_id = $Uuid->guidv4(); // Déclaration de l'id user à l'avance pour l'enregistrement en log
                    $user = $userModel->registerUsers($user_id,$firstname_user, $name_user, $email_user, password_hash($password_user, PASSWORD_BCRYPT));

                    if ($user) {
                        // Redirection
                        $logs_model = new LogsModel();
                        $logs_model->setLogs($Uuid->guidv4(),$user_id,"l'utilisateur avec l'email $email_user vient de s'inscrire et porte l'id $user_id");
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