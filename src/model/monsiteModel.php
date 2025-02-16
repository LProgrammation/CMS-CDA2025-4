<?php

class monsiteModel {
    public function getMesSites($role_utilisateur, $id_utilisateur)
    {
        $pdo = BDD::getInstance();
        if ($role_utilisateur == 'admin') {
            $requete = "SELECT id_site, nom_site, s.id_utilisateur, u.nom_utilisateur AS nom_utilisateur FROM sites AS s JOIN utilisateur AS u ON s.id_utilisateur = u.id_utilisateur;";
        }
        else {
            $requete = 'SELECT id_site, nom_site, s.id_utilisateur, u.nom_utilisateur AS nom_utilisateur FROM sites AS s JOIN utilisateur AS u ON s.id_utilisateur = u.id_utilisateur WHERE u.id_utilisateur = :id_utilisateur;';
        }
        $pdoStatement = $pdo->prepare($requete);
        if ($role_utilisateur != 'admin') {
            $pdoStatement->bindParam(':id_utilisateur', $id_utilisateur);
        }
        $pdoStatement->execute();
        $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteLeSite($site_id) {
        $pdo = BDD::getInstance();
    
        try {
            $pdo->beginTransaction();
    
            $query1 = "DELETE FROM page WHERE id_site = :site_id";
            $stmt1 = $pdo->prepare($query1);
            $stmt1->bindParam(':site_id', $site_id, PDO::PARAM_STR);
            $stmt1->execute();
    
            $query2 = "DELETE FROM sites WHERE id_site = :site_id";
            $stmt2 = $pdo->prepare($query2);
            $stmt2->bindParam(':site_id', $site_id, PDO::PARAM_STR);
            $stmt2->execute();
    
            $pdo->commit();
    
            return true; 
        } catch (Exception $e) {
            $pdo->rollBack(); 
            return false;
        }
    }
    
}

?>
