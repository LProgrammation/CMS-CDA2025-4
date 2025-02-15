<form action="/page" method="post">
    <input type="hidden" name="id_site" value="<?=$_GET['id_site']?>">
    <button class="btn btn-primary" name="name_form" value="edit_gestion_form">Valider</button>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Page par défaut</th>
                <th><i class="fa-solid fa-trash text-danger"></i></th>
            </tr>
        </thead>
        <tbody>
                <?php
                $compteur=1;
                foreach($tabAllPages as $key=>$page):?>
                    <tr>
                        <td><?=$compteur?></td>
                        <td>
                            <input type="text" class="form border-0" name="title_page_id_<?=$page['id_page']?>" id="" value="<?=$page['title_page']?>">
                        </td>
                        <td>
                            <input type="checkbox" class="checkbox-is-default-page" name="id_default_page" id="is_default_page_<?=$key?>" value="<?=$page['id_page']?>" <?=(($page['is_default_page']=='1')?'checked':'')?>>
                        </td>
                        <td><i class="fa-solid fa-trash text-danger"></i></td>
                    </tr>
                <?php
                $compteur++;
                endforeach;?>
        </tbody>
    </table>
</form>