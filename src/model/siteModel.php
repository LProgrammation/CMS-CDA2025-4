<?php
/**
 * Summary of exampleModel
 */
class siteModel
{
  public function getSites(){
    $pdo=BDD::getInstance();
    $requete = "SELECT id_site, nom_site, s.id_utilisateur, u.nom_utilisateur AS nom_utilisateur
    FROM sites AS s
    JOIN utilisateur AS u ON s.id_utilisateur = u.id_utilisateur;";


        $pdoStatement=$pdo->query($requete);
        $liste_sites=$pdoStatement->fetchAll();
        return $liste_sites;
  }



   
}