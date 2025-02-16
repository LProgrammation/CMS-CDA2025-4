<?php
namespace Src\Model ;
class siteModel
{
    public function getSites()
    {
        $pdo = BDD::getInstance();
        $requete = "SELECT id_site, name_site, s.id_user, u.name_user AS name_user FROM site AS s JOIN user AS u ON s.id_user = u.id_user;";

        $pdoStatement = $pdo->query($requete);
        $liste_sites = $pdoStatement->fetchAll();
        return $liste_sites;
    }


}