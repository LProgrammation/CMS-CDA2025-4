<form action="/page" method="post">
    <a href="/page">
        <button class="btn btn-primary">Valider</button>
    </a>
</form>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Titre</th>
            <th>Page par défaut</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $compteur=1;
        foreach($tabAllPages as $page):?>
            <tr>
                <td><?=$compteur?></td>
                <td><?=$page['title_page']?></td>
                <td>
                    <input type="checkbox" class="checkbox-is-default-page" name="default_page" id="default_page" value="<?=$page['id_page']?>" <?=(($page['is_default_page']=='1')?'checked':'')?>>
                </td>
            </tr>
        <?php
        $compteur++;
        endforeach;?>
    </tbody>
</table>