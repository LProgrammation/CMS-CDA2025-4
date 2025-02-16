<?php

namespace Src\Model ;
use PDO;
use Src\Model\BDD;
use PDOException;


class voirsiteModel {
  public function getSiteById($id_site) {
      $pdo = BDD::getInstance();

      $query = $pdo->prepare("SELECT 
    s.id_site,                     
    u.name_user,             
    s.name_site
    FROM 
        site AS s
    JOIN 
        user AS u ON s.id_user = u.id_user  
    
    WHERE 
        s.id_site = :id_site
    ");

      $query->bindParam(':id_site', $id_site, PDO::PARAM_STR);
      $query->execute();

      $site = $query->fetchAll(PDO::FETCH_ASSOC);
      return $site;
  }

  public function getSitePages($id_site) {
      $pdo = BDD::getInstance();

      $query = $pdo->prepare("SELECT 
        *
    FROM 
        page AS p
    WHERE 
        p.id_site = :id_site
    ");

      $query->bindParam(':id_site', $id_site, PDO::PARAM_STR);
      $query->execute();

      $pages = $query->fetchAll(PDO::FETCH_ASSOC);

      return $pages;

  }
}
