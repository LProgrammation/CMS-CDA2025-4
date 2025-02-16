<?php
namespace Src\Model ;
use Random\RandomException;
use Src\Model\BDD ;
use PDO;
use Src\Module\Uuid ;
use PDOException;
class monsiteModel {
    public function getMesSites($role_user, $id_user)
    {
        $pdo = BDD::getInstance();
        if ($role_user == 'admin') {
            $requete = "SELECT id_site, name_site, s.id_user, u.name_user AS name_user FROM site AS s JOIN user AS u ON s.id_user = u.id_user;";
        }
        else {
            $requete = 'SELECT id_site, name_site, s.id_user, u.name_user AS name_user FROM site AS s JOIN user AS u ON s.id_user = u.id_user WHERE u.id_user = :id_user;';
        }
        $pdoStatement = $pdo->prepare($requete);
        if ($role_user != 'admin') {
            $pdoStatement->bindParam(':id_user', $id_user);
        }
        $pdoStatement->execute();
        $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteLeSite($id_site) {
        $pdo = BDD::getInstance();

        try {
            $pdo->beginTransaction();

            $query1 = "DELETE FROM page WHERE id_site = :id_site";
            $stmt1 = $pdo->prepare($query1);
            $stmt1->bindParam(':id_site', $id_site, PDO::PARAM_STR);
            $stmt1->execute();

            $query2 = "DELETE FROM site WHERE id_site = :id_site";
            $stmt2 = $pdo->prepare($query2);
            $stmt2->bindParam(':id_site', $id_site, PDO::PARAM_STR);
            $stmt2->execute();

            $pdo->commit();

            return true;
        } catch (Exception $e) {
            $pdo->rollBack();
            return false;
        }
    }

    /**
     * @throws RandomException
     */
    public function createLeSite($name_site) {
        $pdo = BDD::getInstance();

        try {
            $pdo->beginTransaction();

            $query1 = "Insert into site(id_site, name_site, id_user) values(:id_site, :name_site, :id_user)";
            $stmt1 = $pdo->prepare($query1);
            $Uuid = new Uuid();
            $UuidGen = $Uuid->guidv4();
            $stmt1->bindParam(':id_site', $UuidGen, PDO::PARAM_STR);
            $stmt1->bindParam(':name_site', $name_site, PDO::PARAM_STR);
            $stmt1->bindParam(':id_user', $_SESSION['user']['id_user'], PDO::PARAM_STR);
            $stmt1->execute();


            $pdo->commit();

            return true;
        } catch (Exception $e) {
            $pdo->rollBack();
            return false;
        }
    }

    public function changeUserSiteByAdmin($id_user){
        $pdo = BDD::getInstance();

        try {
            $pdo->beginTransaction();

            $query1 = "update site set id_user = :id_new_user where id_user = :id_user";
            $stmt1 = $pdo->prepare($query1);
            $Uuid = new Uuid();
            $UuidGen = $Uuid->guidv4();
            $stmt1->bindParam(':id_new_user', $_SESSION['user']['id_user']);
            $stmt1->bindParam(':id_user', $id_user);
            $stmt1->execute();


            $pdo->commit();

            return true;
        } catch (Exception $e) {
            $pdo->rollBack();
            return false;
        }
    }
    
}

?>
