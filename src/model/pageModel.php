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
    public function getTitlePage($id_page)
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                title_page
            FROM
                cms_page
            WHERE
                id_page='".$id_page."'";
        $pdoStatement=$pdo->query($requete);
        $content_page=$pdoStatement->fetch();
        return $content_page['title_page'];
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
        $id_page=guidv4();
        $pdoStatement->execute([
            ':uuid'=>$id_page,
            ':id_site'=>$id_site,
            ':title_page'=>$title_page,
            ':type_page'=>$type_page,
            ':is_default_page'=>$is_default_page
        ]);
        return $id_page;
    }
    public function savePage($id_site, $id_page, $content_page)
    {
        $pdo=BDD::getInstance();
        $requete="
        UPDATE
            cms_page
        SET
            content_page=:content_page
        WHERE
            id_site=:id_site AND
            id_page=:id_page
        ";
        $pdoStatement=$pdo->prepare($requete);
        $pdoStatement->execute([
            ':content_page'=>$content_page,
            ':id_site'=>$id_site,
            ':id_page'=>$id_page
        ]);
    }
    public function updateTitlePage($id_site, $id_page, $title_page='')
    {
        $pdo=BDD::getInstance();
        $requete="
        UPDATE
            cms_page
        SET
            title_page=:title_page
        WHERE
            id_page=:id_page
        ";
        $pdoStatement=$pdo->prepare($requete);
        $pdoStatement->execute([
            ':title_page'=>$title_page,
            ':id_page'=>$id_page
        ]);
    }
    public function updateDefaultPage($id_site, $id_page)
    {
        $pdo=BDD::getInstance();
        $requete="
        UPDATE cms_page
        SET is_default_page = CASE
            WHEN id_page = :id_page THEN 1
            ELSE 0
        END
        WHERE id_site = :id_site;
        ";
        $pdoStatement=$pdo->prepare($requete);
        $pdoStatement->execute([
            ':id_site'=>$id_site,
            ':id_page'=>$id_page
        ]);
    }
}