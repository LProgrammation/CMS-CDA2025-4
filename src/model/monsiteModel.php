<?php

/**
 *Michel 2 => testsite test  / Sophie 3 => bonjour 3 / Robert 5 => test 5 / Adeline 6 => wow 9 
* 
 */
class monsiteModel {
    public function getSitesByUtilisateur($id_utilisateur) {
        $pdo = BDD::getInstance();


        $query = $pdo->prepare("SELECT 
            s.id_site,                     
            u.nom_utilisateur,             
            p.content_page AS content_page,     
            p.type_page AS type_page,          
            p.is_default_page AS default_page  
        FROM 
            sites AS s
        JOIN 
            utilisateur AS u ON s.id_utilisateur = u.id_utilisateur  
        LEFT JOIN 
            page AS p ON s.id_site = p.id_site 
        WHERE 
            s.id_utilisateur = :id_utilisateur
            AND (p.type_page IN ('header', 'footer') OR (p.type_page = 'main' AND p.is_default_page = 1))");

        $query->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT); 

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // creer fonction pour supprimer un site 
    // creer fonction pour admin -> voir tous les sites 
}
?>
