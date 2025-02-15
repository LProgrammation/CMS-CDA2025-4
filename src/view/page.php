<form action="#" method="post">
    <input type="hidden" name="id_site" id="id_site" value="<?=$id_site?>">
    <input type="hidden" name="id_page" id="id_page" value="<?=$id_page?>">
    <h4 class="w-100 text-center">Mes Pages</h4>
    <nav class="d-flex justify-content-center">
        <?php foreach($tabNavbarSite as $key=>$value):?>
            <a href="?id_page=<?=$value['id_page']?>" class="nav-link m-3 <?=($id_page==$value['id_page'])?"text-decoration-underline":""?>"><?=$value['title_page']?></a>
        <?php endforeach;?>
    </nav>
    <div class="d-flex justify-content-between">
        <div>
            <button type="submit" class="btn btn-primary" name="name_form" value="save_page">Enregistrer</button>
            <button class="btn ms-3 border shadow-lg" onclick="event.preventDefault(); history.back();">Retour</button>
        </div>
        <div>
            <a class="btn btn-primary me-2" href="/page/gestion-pages?id_site=<?=(isset($id_site))?$id_site:'1';?>">
                Gérer mes pages
            </a>
            <a class="btn btn-primary me-2" href="/page/new-page?id_site=<?=(isset($id_site))?$id_site:'1';?>">
                Nouvelle page
            </a>
        </div>
    </div>
    <textarea name="content" id="mytextarea">
        <?=($content_page!='')?$content_page:('Page '.$title_page)?>
    </textarea>
</form>