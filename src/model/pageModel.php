<?php
class pageModel{
    public function getAllPagesBySite($id_site)
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                *
            FROM
                cms_page
            WHERE
                id_site='".$id_site."'";
        $pdoStatement=$pdo->query($requete);
        return $pdoStatement->fetchAll();
    }
    public function getNavbarSite($id_site)
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                *
            FROM
                cms_page
            WHERE
                id_site='".$id_site."' AND
                type_page!='header' AND
                type_page!='footer'";
        $pdoStatement=$pdo->query($requete);
        return $pdoStatement->fetchAll();
    }
    public function getContentPage($id_page)
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                content_page
            FROM
                cms_page
            WHERE
                id_page='".$id_page."'";
        $pdoStatement=$pdo->query($requete);
        $content_page=$pdoStatement->fetch();
        return $content_page['content_page'];
    }
    public function getLogsByUserId($user_id)
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                *
            FROM
                cms_logs
            WHERE
                id_user=".$user_id;
        $pdoStatement=$pdo->query($requete);
        $tab_logs=$pdoStatement->fetchAll();
        return $tab_logs;
    }
    public function newPage($id_site, $title_page, $type_page, $is_default_page)
    {
        $pdo=BDD::getInstance();
        $requete="
        INSERT INTO
            cms_page
            (
                id_page,
                id_site,
                title_page,
                type_page,
                is_default_page
            )
        VALUES
            (
                :uuid,
                :id_site,
                :title_page,
                :type_page,
                :is_default_page
            )
        ";
        $pdoStatement=$pdo->prepare($requete);
        $pdoStatement->execute([
            ':uuid'=>guidv4(),
            ':id_site'=>$id_site,
            ':title_page'=>$title_page,
            ':type_page'=>$type_page,
            ':is_default_page'=>$is_default_page
        ]);
        return $pdoStatement;
    }
}