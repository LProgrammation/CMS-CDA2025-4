<?php

/**
 *Michel 2 => testsite test  / Sophie 3 => bonjour 3 / Robert 5 => test 5 / Adeline 6 => wow 9 
* 
 */
class voirsiteModel {
  public function getVoirSite($id_site) {
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
    s.id_site = :id_site
    AND (p.type_page IN ('header', 'footer') OR (p.type_page = 'main' AND p.is_default_page = 1))");

      $query->bindParam(':id_site', $id_site, PDO::PARAM_STR); 

      $query->execute();

      $apercu_sites = $query->fetchAll(PDO::FETCH_ASSOC);

      return $apercu_sites;
  }
}
