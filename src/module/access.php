<?php

/**
 * Summary of Access
 */
namespace Src\Module ;
use \Src\Model\UserModel ;
class Access {
    /**
     * Check if the user has the specified role.
     * @param mixed $role_check
     * @return bool
     */
    public function isGranted(string $role_check = 'user'): bool {
        if ($this->isLogin()) {
            $userModel = new userModel(); // This have to be replace by usersModel class with user informations get in BDD
            $user_info = $userModel->getUserById($_SESSION['user']['id_user']);

            return $user_info && $role_check === $user_info[0]['role'];
        }

        return false;
    }

    /**
     * Check if a user is authenticated.
     * @return bool
     */
    public function isLogin(): bool {
        return isset($_SESSION['user']);
    }
}
