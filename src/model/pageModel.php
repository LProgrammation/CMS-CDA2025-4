<?php
namespace Src\Model ;
use Random\RandomException;
use \Src\Module\Uuid ;
class pageModel{
    /**
     * @param $id_site
     * @return array
     */
    public function getAllPagesBySite($id_site)
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                *
            FROM
                page
            WHERE
                id_site='".$id_site."'";
        $pdoStatement=$pdo->query($requete);
        return $pdoStatement->fetchAll();
    }

    /**
     * @param $id_page
     * @return mixed
     */
    public function getPageByID($id_page)
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                *
            FROM
                page
            WHERE
                id_page='".$id_page."'";
        $pdoStatement=$pdo->query($requete);
        return $pdoStatement->fetch();
    }

    /**
     * @param $id_site
     * @return array
     */
    public function getNavbarSite($id_site)
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                *
            FROM
                page
            WHERE
                id_site='".$id_site."'";
        $pdoStatement=$pdo->query($requete);
        return $pdoStatement->fetchAll();
    }

    /**
     * @param $id_page
     * @return false|mixed
     */
    public function getContentPage($id_page)
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                content_page
            FROM
                page
            WHERE
                id_page='".$id_page."'";
        $pdoStatement=$pdo->query($requete);
        $content_page=$pdoStatement->fetch();
        if($content_page) return $content_page['content_page'];
        else return false;
    }

    /**
     * @param $id_page
     * @return false|mixed
     */
    public function getTitlePage($id_page)
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                title_page
            FROM
                page
            WHERE
                id_page='".$id_page."'";
        $pdoStatement=$pdo->query($requete);
        $content_page=$pdoStatement->fetch();

        if ($content_page) return $content_page['title_page'];
        else return false;
    }

    /**
     * @param $user_id
     * @return array
     */
    public function getLogsByUserId($user_id)
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                *
            FROM
                log
            WHERE
                id_user=".$user_id;
        $pdoStatement=$pdo->query($requete);
        $tab_logs=$pdoStatement->fetchAll();
        return $tab_logs;
    }

    /**
     * @throws RandomException
     */
    /**
     * @param $id_site
     * @param $title_page
     * @param $type_page
     * @param $is_default_page
     * @return string
     * @throws RandomException
     */
    public function newPage($id_site, $title_page, $type_page, $is_default_page)
    {
        $pdo=BDD::getInstance();
        $requete="
        INSERT INTO
            page
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
        $UuidModel = new Uuid();
        $id_page=$UuidModel->guidv4();
        $pdoStatement->execute([
            ':uuid'=>$id_page,
            ':id_site'=>$id_site,
            ':title_page'=>$title_page,
            ':type_page'=>$type_page,
            ':is_default_page'=>$is_default_page
        ]);
        return $id_page;
    }

    /**
     * @param $id_site
     * @param $id_page
     * @param $content_page
     * @return void
     */
    public function savePage($id_site, $id_page, $content_page)
    {
        $pdo=BDD::getInstance();
        $requete="
        UPDATE
            page
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

    /**
     * @param $id_site
     * @param $id_page
     * @param $title_page
     * @return void
     */
    public function updateTitlePage($id_site, $id_page, $title_page='')
    {
        $pdo=BDD::getInstance();
        $requete="
        UPDATE
            page
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

    /**
     * @param $id_site
     * @param $id_page
     * @return void
     */
    public function updateDefaultPage($id_site, $id_page)
    {
        $pdo=BDD::getInstance();
        $requete="
        UPDATE page
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

    /**
     * @param $id_page
     * @return void
     */
    public function deletePage($id_page)
    {
        $pdo=BDD::getInstance();
        $requete="
        DELETE FROM
           page
        WHERE
            id_page=:id_page
        ";
        $pdoStatement=$pdo->prepare($requete);
        $pdoStatement->execute([
            ':id_page'=>$id_page
        ]);
    }
}